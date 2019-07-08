<?php
namespace Asa\Erp;

/**
 * 调拨单主表
 * ErrorCode 1106
 */
class TbRequisition extends BaseCompanyModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_requisition');

        $this->hasMany(
            "id",
            "\Asa\Erp\TbRequisitionDetail",
            "requisitionid",
            [
                'alias' => 'requisitionDetail'
            ]
        );

        // 库存-仓库表，一对多反向
        $this->belongsTo(
            'out_id',
            '\Asa\Erp\TbWarehouse',
            'id',
            [
                'alias' => 'outWarehouse'
            ]
        );

        // 库存-仓库表，一对多反向
        $this->belongsTo(
            'in_id',
            '\Asa\Erp\TbWarehouse',
            'id',
            [
                'alias' => 'inWarehouse'
            ]
        );
    }

    public static function addRequisition($outWarehouseId, $inWarehouseId, $products){
        $di = \Phalcon\Di::getDefault();
        $db = $di->get("db");

        $db->begin();

        $requisition = new TbRequisition();
        $requisition->status = 2;
        $requisition->out_id = $outWarehouseId;
        $requisition->in_id = $inWarehouseId;
        $requisition->apply_staff = $di->get("currentUser");
        $requisition->apply_date = date('Y-m-d H:i:s');
        $requisition->companyid = $di->get("currentCompany");
        if($requisition->create()==false) {
            throw new \Exception("/11060301/生成调拨单失败。/");
        }

        foreach($products as $row) {
            $out_productstock = TbProductstock::findFirstById($row['productstockid']);

            if($out_productstock!=false) {
                $data = [
                    "out_productstockid" => $out_productstock->id,
                    "in_productstockid" => $requisition->inWarehouse->getLocalStock($out_productstock)->id,
                    "number" => $row['number'],
                    "requisitionid" => $requisition->id
                ];
                $result = $requisition->addDetail($data);
                if($result===false) {
                    $db->rollback();
                    throw new \Exception("/11060302/生成调拨单明细失败。/");
                }
            }
            else {
                $db->rollback();
                throw new \Exception("/11060303/生成调拨单明细失败-库存不存在。/");
            }
        }

        $db->commit();
        return $requisition;
    }

    function addDetail($data, $lockProductstock=true) {
        $row = new TbRequisitionDetail();
        //print_r($form);
        if($row->create($data)) {
            //print_r($form);
            if($lockProductstock===true) {
                $row->outProductstock->preReduceStock($row->number, TbProductstock::REQUISITION, $row->id);
            }

            return $row;
        }
        else {
            throw new \Exception("/11050301/添加调拨单明细失败。/");
        }
    }

    /**
     * 处理出库操作
     * @param  [type] $list [description]
     * @return [type]       [description]
     */
    function doOut($list) {
        //检查一下是否有允许出库的
        $total = 0;
        foreach($list as $value) {
            $total += $value;
        }

        $di = $this->getDI();
        $db = $di->get("db");

        $db->begin();

        try {
            if($total>0) {
                //出库
                $this->status = 3;
                $this->turnout_staff = $di->get("currentUser");
                $this->turnout_date = date("Y-m-d H:i:s");
                if($this->update()==false) {
                    throw new \Exception("/11050101/调拨单确认出库失败。/");
                }

                $details = [];
                foreach ($this->requisitionDetail as $detail) {
                    if($list[$detail->id]>$detail->number) {
                        throw new \Exception("/11050102/确认出库的数量不能超过申请调拨的数量。/");
                    }

                    $detail->out_number = $list[$detail->id];
                    if($detail->update()==false) {
                        throw new \Exception("/11050103/调拨单【明细】确认出库失败。/");
                    }

                    //锁定库存生效，出库
                    $detail->outProductstock->preReduceStockExecute($detail->out_number, TbProductstock::REQUISITION, $detail->id);
                    $detail->inProductstock->preAddStock($detail->out_number, TbProductstock::REQUISITION_PRE_IN, $detail->id);

                    //如果确认出库数量少于调拨申请的数量，则拆单生成一个拒绝的调拨单
                    $refuseNumber = $detail->number-$detail->out_number;
                    if($refuseNumber>0) {
                        $details[] = [
                            "out_productstockid" => $detail->out_productstockid,
                            "in_productstockid" => $detail->in_productstockid,
                            "number" => $refuseNumber
                        ];

                        //锁定库存取消
                        $detail->outProductstock->preReduceStockCancel($refuseNumber, TbProductstock::REQUISITION, $detail->id);
                    }
                }

                if(count($details)>0) {
                    //生成拒绝的调拨单
                    $newrequisition = new TbRequisition();
                    $newrequisition->status = 1;
                    $newrequisition->out_id = $this->out_id;
                    $newrequisition->in_id = $this->out_id;
                    $newrequisition->apply_staff = $this->apply_staff;
                    $newrequisition->apply_date = $this->apply_date;
                    $newrequisition->companyid = $this->companyid;
                    $newrequisition->memo = "out deny";
                    if($newrequisition->create()==false) {
                        throw new \Exception("/11050104/反向调拨单生成失败。/");
                    }

                    foreach ($details as $data) {
                        $data['requisitionid'] = $newrequisition->id;
                        $newrequisition->addDetail($data, false);
                    }
                }
            }
            else {
                //出库拒绝
                $this->status = 1;
                $this->turnout_staff = $di->get("currentUser");
                $this->turnout_date = date("Y-m-d H:i:s");

                if($this->update()==false) {
                    throw new \Exception("/11050105/调拨单更新失败。/");
                }

                foreach ($this->requisitionDetail as $detail) {
                    //锁定库存取消
                    $detail->outProductstock->preReduceStockCancel($detail->number, TbProductstock::REQUISITION, $detail->id);
                }
            }
        }
        catch(\Exception $e) {
            $db->rollback();
            throw $e;
        }

        $db->commit();
        return true;
    }

    function doIn($list) {
        //检查一下是否有允许出库的
        $total = 0;
        foreach($list as $value) {
            $total += $value;
        }

        $di = $this->getDI();
        $db = $di->get("db");

        $db->begin();
        try {
            if($total>0) {
                //入库
                $this->status = 5;
                $this->turnin_staff = $di->get("currentUser");
                $this->turnin_date = date("Y-m-d H:i:s");
                if($this->update()==false) {
                    throw new \Exception("/11050201/调拨单确认入库失败。/");
                }

                $details = [];
                foreach ($this->requisitionDetail as $detail) {
                    if($list[$detail->id]>$detail->out_number) {
                        throw new \Exception("/11050202/调拨单入库数量错误。/");
                    }

                    $detail->in_number = $list[$detail->id];
                    if($detail->update()==false) {
                        throw new \Exception("/11050203/调拨单入库明细更新失败。/");
                    }

                    //加库存
                    $detail->inProductstock->preAddStockExecute($detail->in_number, TbProductstock::REQUISITION, $detail->id);

                    //拒绝入库部分生成反向调拨单
                    $refuseNumber = $detail->out_number-$detail->in_number;
                    if($refuseNumber>0) {
                        $details[] = [
                            "out_productstockid" => $detail->in_productstockid,
                            "in_productstockid" => $detail->out_productstockid,
                            "number" => $refuseNumber,
                            "out_number" => $refuseNumber
                        ];
                    }
                }

                if(count($details)>0) {
                    //生成反向调拨单
                    $newrequisition = new TbRequisition();
                    $newrequisition->status = 3;
                    $newrequisition->out_id = $this->in_id;
                    $newrequisition->in_id = $this->out_id;
                    $newrequisition->apply_staff = $di->get("currentUser");
                    $newrequisition->apply_date = date("Y-m-d H:i:s");
                    $newrequisition->turnout_staff = $di->get("currentUser");
                    $newrequisition->turnout_date = date("Y-m-d H:i:s");
                    $newrequisition->companyid = $this->companyid;
                    $newrequisition->memo = "in deny";
                    if($newrequisition->create()==false) {
                        throw new \Exception("/11050205/反向调拨单创建失败。/");
                    }

                    foreach ($details as $data) {
                        $data['requisitionid'] = $newrequisition->id;
                        $detail = $newrequisition->addDetail($data, false);

                        //未确认入库的部分
                        $detail->outProductstock->preAddStockCancel($detail->number, TbProductstock::REQUISITION, $detail->id);
                        $detail->inProductstock->preAddStock($detail->number, TbProductstock::REQUISITION, $detail->id);
                    }
                }
            }
            else {
                $this->status = 4;
                $this->turnin_staff = $di->get("currentUser");
                $this->turnin_date = date("Y-m-d H:i:s");
                if($this->update()==false) {
                    throw new \Exception("/11050209/调拨单拒绝入库失败。/");
                }

                //生成反向调拨单
                $newrequisition = new TbRequisition();
                $newrequisition->status = 3;
                $newrequisition->out_id = $this->in_id;
                $newrequisition->in_id = $this->out_id;
                $newrequisition->apply_staff = $di->get("currentUser");
                $newrequisition->apply_date = date("Y-m-d H:i:s");
                $newrequisition->turnout_staff = $di->get("currentUser");
                $newrequisition->turnout_date = date("Y-m-d H:i:s");
                $newrequisition->companyid = $this->companyid;
                $newrequisition->memo = "in deny";
                if($newrequisition->create()==false) {
                    throw new \Exception("/11050210/反向调拨单创建失败。/");
                }
                foreach ($this->requisitionDetail as $detail) {
                    $data = [
                        "out_productstockid" => $detail->in_productstockid,
                        "in_productstockid" => $detail->out_productstockid,
                        "number" => $detail->out_number,
                        "out_number" => $detail->out_number,
                        "requisitionid" => $newrequisition->id
                    ];

                    $requisitionDetail = $newrequisition->addDetail($data, false);
                    if($requisitionDetail===false) {
                        throw new \Exception("/11050211/反向调拨单明细创建失败。/");
                    }

                    //减库存
                    $requisitionDetail->outProductstock->preAddStockCancel($requisitionDetail->out_number, TbProductstock::REQUISITION, $requisitionDetail->id);
                    $requisitionDetail->inProductstock->preAddStock($requisitionDetail->out_number, TbProductstock::REQUISITION, $requisitionDetail->id);
                }
            }
        }
        catch(\Exception $e) {
            $db->rollback();
            throw $e;
        }

        $db->commit();
        return true;
    }

    function getDetail() {
        $result = TbRequisitionDetail::find(
            sprintf("requisitionid=%d", $this->id)
        );
        //print_r($result->toArray());
        $array = [];
        foreach($result as $row) {
            $productstock = $row->outProductstock;
            $array[] = array_merge($productstock->toArray(), $row->toArray());
        }

        return [
            "form" => $this->toArray(),
            "list" => $array
        ];
    }
}
