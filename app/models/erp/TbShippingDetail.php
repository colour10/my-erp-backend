<?php
namespace Asa\Erp;

/**
 * 发货单明细表
 */
class TbShippingDetail extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_shipping_detail');

        $this->belongsTo(
            'orderdetailsid',
            '\Asa\Erp\TbOrderdetails',
            'id',
            [
                'alias' => 'orderdetails'
            ]
        );

        $this->belongsTo(
            'orderid',
            '\Asa\Erp\TbOrder',
            'id',
            [
                'alias' => 'order'
            ]
        );

        $this->belongsTo(
            'shippingid',
            '\Asa\Erp\TbShipping',
            'id',
            [
                'alias' => 'shipping'
            ]
        );
    }

    public function warehousing() {
        //修改库存
        $productStock = $this->getProductStock();
        return $productStock->addStock($detail->number, TbProductstock::WAREHOSING, $this->id);
    }

    public function getProductStock() {
        $companyid = $this->getDI()->get("currentCompany");
        if($companyid<=0) {
            throw new \Exception("/1001/数据错误。/");
        }

        //默认自采
        $property = 1;
        if($this->order && $this->order->property>0) {
            $property = $this->order->property;
        }

        $goods = TbGoods::findFirst(
            sprintf(
                "companyid=%d and productid=%d and sizecontentid=%d and defective_level=0 and property=%d", 
                $companyid, 
                $this->productid, 
                $this->sizecontentid, 
                $property
            )
        );

        if($goods==false) {
            //创建一个新的
            $goods = new TbGoods();
            $goods->companyid = $companyid;
            $goods->productid = $this->productid;
            $goods->sizecontentid = $this->sizecontentid;
            $goods->property = $property;
            $goods->defective_level = 0;
            $goods->change_time = date("Y-m-d H:i:s");
            $goods->change_staff = $this->getDI()->get("currentUser");
            $goods->price = $this->price;
            if($goods->create()===false) {
                throw new Exception("/110201/创建商品条目失败/");
            }
        }

        $warehouseid = $this->shipping->warehouseid;
        if($warehouseid>0) {
            $productstock = TbProductstock::findFirst(
                sprintf("companyid=%d and warehouseid=%d and goodsid=%d", $companyid, $warehouseid, $goods->id)
            );

            if($productstock==false) {
                //创建库存记录
                $productstock = TbProductstock::initStock([
                    "goods" => $goods,
                    "warehouseid" => $warehouseid
                ]);
            }
            return $productstock;
        }
        else {
            throw new \Exception("/110202/数据错误，仓库不能为空。/");
        }
    }
}
