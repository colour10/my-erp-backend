<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbBrandgroup;
use Asa\Erp\TbBrandgroupchild;
use Asa\Erp\TbBrandgroupchildProperty;

/**
 * 品类表控制器
 * Class BrandgroupController
 * @package Multiple\Home\Controllers
 */
class BrandgroupController extends ZadminController
{

    public function initialize()
    {
        parent::initialize();
        $this->setModelName('Asa\\Erp\\TbBrandgroup');
    }

    function before_page()
    {
        $_POST["__orderby"] = "displayindex asc";
    }

    function loadnodeAction()
    {
        $brandgroupid = (int)$_POST['brandgroupid'];
        if ($brandgroupid == 0) {
            $result = TbBrandgroup::find([
                'order' => "displayindex asc",
            ]);

            $array = [];
            foreach ($result as $row) {
                $array[] = [
                    "name"   => $row->name_cn,
                    "id"     => $row->id,
                    "key"    => "b" . $row->id,
                    "isLeaf" => false,
                ];
            }
            return $this->success($array);
        } else {
            $result = TbBrandgroupchild::find([
                sprintf("brandgroupid=%d", $brandgroupid),
                'order' => "displayindex asc",
            ]);

            $array = [];
            foreach ($result as $row) {
                $array[] = [
                    "name"   => $row->name_cn,
                    "id"     => $row->id,
                    "key"    => "c" . $row->id,
                    "isLeaf" => true,
                ];
            }
            return $this->success($array);
        }
    }

    function copypropertyAction()
    {
        $result = TbBrandgroupchildProperty::find(
            sprintf("brandgroupchildid=%d", $_POST['brandgroupchildid'])
        );

        if (count($result) > 0) {
            $this->db->begin();
            $targets = explode(",", $_POST['target']);
            foreach ($targets as $targetId) {
                foreach ($result as $row) {
                    $property = TbBrandgroupchildProperty::findFirst(
                        sprintf("brandgroupchildid=%d and propertyid=%d", $targetId, $row->propertyid)
                    );

                    if ($property == false) {
                        $property = new TbBrandgroupchildProperty();
                        $property->propertyid = $row->propertyid;
                        $property->brandgroupchildid = $targetId;
                        $property->displayindex = $row->displayindex;
                        if ($property->create() == false) {
                            $this->db->rollback();
                            return $this->error($property);
                        }
                    }
                }
            }

            $this->db->commit();
        }
        return $this->success();
    }
}
