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

    function addDetal($data) {
        $row = new TbRequisitionDetail();
        //print_r($form);
        if($row->create($data)) {
            //print_r($form);
            return $row;
        }
        else {
            return false;
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
        if($total>0) {
            //出库
            $this->status = 3;
            $this->turnout_staff = $di->get("currentUser");
            $this->turnout_date = date("Y-m-d H:i:s");
            if($this->update()==false) {
                $db->rollback();
                throw new \Exception("/11050101/调拨单确认出库失败。/");
            }

            $details = [];
            foreach ($this->requisitionDetail as $detail) {
                if($list[$detail->id]>$detail->number) {
                    $db->rollback();
                    throw new \Exception("/11050102/确认出库的数量不能超过申请调拨的数量。/");
                }

                $detail->out_number = $list[$detail->id];
                if($detail->update()==false) {
                    $db->rollback();
                    throw new \Exception("/11050103/调拨单【明细】确认出库失败。/");
                }

                //减库存
                $ret = $detail->outProductstock->reduceStock($detail->out_number, TbProductstock::REQUISITION_OUT, $detail->id);
                if($ret==false) {
                    $db->rollback();
                    throw new \Exception("/11050104/调整库存失败或者库存不足。/");
                }

                $ret = $detail->inProductstock->preAddStock($detail->out_number, TbProductstock::REQUISITION_PRE_IN, $detail->id);
                if($ret==false) {
                    $db->rollback();
                    throw new \Exception("/11050105/调入仓库调整库存失败。/");
                }

                //如果确认出库数量少于调拨申请的数量，则拆单生成一个拒绝的调拨单
                if($detail->number-$detail->out_number>0) {
                    $details[] = [
                        "out_productstockid" => $detail->out_productstockid,
                        "in_productstockid" => $detail->in_productstockid,
                        "number" => $detail->number-$detail->out_number
                    ];
                }
            }

            if(count($details)>0) {
                //生成拒绝的调拨单
                $newrequisition = new TbRequisition();
                $newrequisition->status = 1;
                $newrequisition->out_id = $this->out_id;
                $newrequisition->in_id = $this->in_id;
                $newrequisition->apply_staff = $this->apply_staff;
                $newrequisition->apply_date = $this->apply_date;
                $newrequisition->companyid = $this->companyid;
                $newrequisition->memo = "out deny";
                if($newrequisition->create()==false) {
                    $db->rollback();
                    return false;
                }

                foreach ($details as $data) {
                    $data['requisitionid'] = $newrequisition->id;
                    $result = $newrequisition->addDetal($data);
                    if($result===false) {
                        $db->rollback();
                        return false;
                    }
                }
            }
        }
        else {
            $this->status = 1;
            $this->turnout_staff = $di->get("currentUser");
            $this->turnout_date = date("Y-m-d H:i:s");

            if($this->update()==false) {
                $db->rollback();
                return false;
            }
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
        if($total>0) {
            //入库
            $this->status = 5;
            $this->turnin_staff = $di->get("currentUser");
            $this->turnin_date = date("Y-m-d H:i:s");
            if($this->update()==false) {
                $db->rollback();
                throw new \Exception("/11050201/调拨单确认入库失败。/");
            }

            $total = 0;
            $details = [];
            foreach ($this->requisitionDetail as $detail) {
                if($list[$detail->id]>$detail->out_number) {
                    $db->rollback();
                    throw new \Exception("/11050202/调拨单入库数量错误。/");
                }

                $detail->in_number = $list[$detail->id];
                if($detail->update()==false) {
                    $db->rollback();
                    throw new \Exception("/11050203/调拨单入库明细更新失败。/");
                }

                //加库存
                $ret = $detail->inProductstock->preAddStockExecute($detail->in_number, TbProductstock::REQUISITION_IN_EXECUTE, $detail->id);
                if($ret==false) {
                    $db->rollback();
                    throw new \Exception("/11050204/调拨单入库仓库库存更新失败。/");
                }

                $total += $detail->out_number-$detail->in_number;

                if($detail->number-$detail->out_number>0) {
                    $details[] = [
                        "out_productstockid" => $detail->in_productstockid,
                        "in_productstockid" => $detail->out_productstockid,
                        "number" => $detail->out_number-$detail->in_number,
                        "out_number" => $detail->out_number-$detail->in_number
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
                    $db->rollback();
                    throw new \Exception("/11050205/反向调拨单创建失败。/");
                }

                foreach ($details as $data) {
                    $data['requisitionid'] = $newrequisition->id;
                    $result = $newrequisition->addDetal($data);
                    if($result!==true) {
                        $db->rollback();
                        throw new \Exception("/11050206/反向调拨单明细创建失败。/");
                    }

                    //未确认入库的部分
                    $ret = $newrequisition->outProductstock->preAddStockCancel($result->number, TbProductstock::REQUISITION_PRE_IN_CANCEL, $result->id);
                    if($ret===false) {
                        $db->rollback();
                        throw new \Exception("/11050207/反向调拨单明细创建失败。/");
                    }

                    $ret = $newrequisition->inProductstock->preAddStock($result->number, TbProductstock::REQUISITION_PRE_IN_CANCEL, $result->id);
                    if($ret===false) {
                        $db->rollback();
                        throw new \Exception("/11050208/反向调拨单明细创建失败。/");
                    }
                }
            }
        }
        else {
            $this->status = 4;
            $this->turnin_staff = $di->get("currentUser");
            $this->turnin_date = date("Y-m-d H:i:s");

            if($this->update()==false) {
                $db->rollback();
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
                $db->rollback();
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

                $requisitionDetail = $newrequisition->addDetal($data);
                if($requisitionDetail===false) {
                    $db->rollback();
                    throw new \Exception("/11050211/反向调拨单明细创建失败。/");
                }

                //减库存
                $ret = $requisitionDetail->outProductstock->reduceStock($requisitionDetail->out_number, TbProductstock::REQUISITION_OUT, $requisitionDetail->id);
                if($ret===false) {
                    $db->rollback();
                    throw new \Exception("/11050112/调整库存失败。/");
                }

                $ret = $requisitionDetail->inProductstock->preAddStock($requisitionDetail->out_number, TbProductstock::REQUISITION_PRE_IN, $requisitionDetail->id);
                if($ret===false) {
                    $db->rollback();
                    throw new \Exception("/11050113/调入仓库调整库存失败。/");
                }
            }
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
