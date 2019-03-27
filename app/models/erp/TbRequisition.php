<?php
namespace Asa\Erp;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Uniqueness;

/**
 * 调拨单主表
 */
class TbRequisition extends BaseCommonModel
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
    }

    public function validation() {
        $validator = new Validation();

//        $validator->add(
//            "age",
//            new Between(
//                [
//                    "minimum" => 18,
//                    "maximum" => 60,
//                    "message" => "年龄必须是18~60岁",
//                ]
//            )
//        );
//
//        $validator->add(
//            'name',
//            new Uniqueness(
//                [
//                    'message' => '姓名不能重复',
//                ]
//            )
//        );

        return $this->validate($validator);
    }

    function addDetal($data) {
        $row = new TbRequisitionDetail();
        //print_r($form);
        if($row->create($data)) {
            //print_r($form);
            return true;
        }
        else {
           
            return $row;
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
                return false;
            }

            $total = 0;
            foreach ($this->requisitionDetail as $detail) {
                if($list[$detail->id]>$detail->number) {
                    $db->rollback();
                    return false;
                }

                $detail->out_number = $list[$detail->id];
                if($detail->update()==false) {
                    $db->rollback();
                    return false;
                }
                $total += $detail->number-$detail->out_number;
            }

            if($total>0) {
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

                foreach ($this->requisitionDetail as $detail) {
                    if($detail->number==$detail->out_number) {
                        continue;
                    }
                    $data = [
                        "productid" => $detail->productid,
                        "sizecontentid" => $detail->sizecontentid,
                        "number" => $detail->number-$detail->out_number,
                        "requisitionid" => $newrequisition->id
                    ];
                    $result = $newrequisition->addDetal($data);
                    if($result!==true) {
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
                return false;
            }

            $total = 0;
            foreach ($this->requisitionDetail as $detail) {
                if($list[$detail->id]>$detail->out_number) {
                    $db->rollback();
                    return false;
                }

                $detail->in_number = $list[$detail->id];
                if($detail->update()==false) {
                    $db->rollback();
                    return false;
                }
                $total += $detail->out_number-$detail->in_number;
            }

            if($total>0) {
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
                    return false;
                }

                foreach ($this->requisitionDetail as $detail) {
                    if($detail->in_number==$detail->out_number) {
                        continue;
                    }
                    $data = [
                        "productid" => $detail->productid,
                        "sizecontentid" => $detail->sizecontentid,
                        "number" => $detail->out_number-$detail->in_number,
                        "out_number" => $detail->out_number-$detail->in_number,
                        "requisitionid" => $newrequisition->id
                    ];
                    $result = $newrequisition->addDetal($data);
                    if($result!==true) {
                        $db->rollback();
                        return false;
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
                return false;
            }
        }

        $db->commit();
        return true;
    } 
}
