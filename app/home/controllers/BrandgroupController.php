<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbBrandgroup;
use Asa\Erp\TbBrandgroupchild;
use Asa\Erp\TbBrandgroupchildProperty;
use Asa\Erp\TbMaterialnote;
use Asa\Erp\Util;

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

    /**
     * 复制属性
     *
     * @return false|string
     */
    public function copypropertyAction()
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

    /**
     * 取出当前品类所有的材质备注
     */
    public function materialnotesAction()
    {
        // brandgroupid 必须传值
        if (!$brandgroupid = $this->request->getPost('brandgroupid')) {
            throw new \Exception('brandgroupid is invalid');
        }
        // brandgroupid 必须是正整数
        if (!Util::isPositiveInteger($brandgroupid)) {
            throw new \Exception('brandgroupid is invalid');
        }
        // 先取出所有的材质备注列表
        $materialnotes = TbMaterialnote::find([
            'columns' => 'id, brandgroupids',
        ]);
        // 进行遍历
        $result = [];
        foreach ($materialnotes as $materialnote) {
            $brandgroupids_array = explode(',', $materialnote->brandgroupids);
            if (in_array($brandgroupid, $brandgroupids_array)) {
                $result[] = $materialnote;
            }
        }
        // 返回
        return $this->success(array_column($result, 'id'));
    }
}
