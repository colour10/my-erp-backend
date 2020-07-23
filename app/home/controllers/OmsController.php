<?php

namespace Multiple\Home\Controllers;


use Asa\Erp\TbOmsOrder;
use GuzzleHttp\Client;

/**
 * 与 OMS 对接
 *
 * Class OmsController
 * @package Multiple\Home\Controllers
 */
class OmsController extends BaseController
{
    public function initialize()
    {
        parent::initialize();
    }

    function indexAction()
    {
    }

    /**
     * 获取 guzzleHttp 的实例
     *
     * @return Client
     */
    function getClient()
    {
        // 使用 Client 请求数据，并添加 headers 头部
        return new Client([
            // 设置 headers 头部
            'headers' => [
                'Authorization'   => 'Bearer ' . $this->oms_token,
                'Content-Type'    => 'application/json',
                'Accept'          => '*/*',
                'cache-control'   => 'no-cache',
                'Accept-Encoding' => 'gzip, deflate',
            ],
        ]);
    }

    /**
     * 取出 config.php 中 oms 的配置信息
     *
     * @return mixed
     */
    function getOmsConfig()
    {
        return $this->config->oms;
    }

    /**
     * 商品档案上新和更新接口
     *
     * 请求的格式为：
     * {
     * "Id":0,
     * "ProductItems":[
     * {
     * "Name":"FENDI女士平跟凉拖鞋",
     * "ShortDescription":"正常",
     * "VendorId":34,
     * "Sku":"0ae7f024-941c-4a1c-b4dc-b148049ff484",
     * "Spu":"0ae7f024-941c-4a1c-b4dc-b148049ff484",
     * "Price":3053.3333333333333333333333333,
     * "StockQuantity":0.0,
     * "OldPrice":6350.0,
     * "ProductCost":0.0,
     * "HKGPrice":0.0,
     * "EURPrice":0.0,
     * "CHNPrice":3053.3333333333333333333333333,
     * "BDAPrice":0.0,
     * "HKGCost":0.0,
     * "HKGPriceCost":0.0,
     * "EURCost":0.0,
     * "EURPriceCost":0.0,
     * "CHNCost":2290.0,
     * "CHNPriceCost":2290.0,
     * "BDACost":0.0,
     * "BDAPriceCost":0.0,
     * "ShortInSizePrice":0.0,
     * "EURRetailPrice":650.0,
     * "Currency":"EUR",
     * "Times":"SS2020",
     * "Gender":20,
     * "GenderText":null,
     * "SpecCount":17,
     * "Manufacturer":"芬迪|FENDI",
     * "Published":0,
     * "CreatedOnUtc":"2020-05-14T03:05:52.4027332Z",
     * "UpdateOnUtc":null,
     * "CreatedTimeStamp":1589425552402,
     * "UpdateTimeStamp":null,
     * "DefaultImg":"http://123.57.175.202:8087/IMG/675a8e15-cfad-4d35-98c6-96e796ad8022.jpg",
     * "SortNum":0,
     * "HsCode":"",
     * "CountryId":307,
     * "CountryName":"意大利",
     * "UnitId":"025",
     * "UnitName":"双",
     * "WrapId":"5H4",
     * "WrapName":"塑料薄膜袋",
     * "VATRate":0.13,
     * "ConsumptionTaxRate":0.0,
     * "TradeType":2,
     * "CustomsChannelId":"35",
     * "UploadType":1,
     * "UploadStatus":0,
     * "ProductImgs":"[{\"order\":0,\"url\":\"http://123.57.175.202:8087/IMG/5ebc077b-3331-4644-97d4-e1fba3e5ee89.jpg\",\"InternationalCode\":\"8X6749A5JXF1425\"},{\"order\":1,\"url\":\"http://123.57.175.202:8087/IMG/5ebc077b-3331-4644-97d4-e1fba3e5ee89.jpg\",\"InternationalCode\":\"8X6749A5JXF1425\"},{\"order\":2,\"url\":\"http://123.57.175.202:8087/IMG/5ebc077b-3331-4644-97d4-e1fba3e5ee89.jpg\",\"InternationalCode\":\"8X6749A5JXF1425\"},{\"order\":3,\"url\":\"http://123.57.175.202:8087/IMG/5ebc077b-3331-4644-97d4-e1fba3e5ee89.jpg\",\"InternationalCode\":\"8X6749A5JXF1425\"},{\"order\":4,\"url\":\"http://123.57.175.202:8087/IMG/5ebc077b-3331-4644-97d4-e1fba3e5ee89.jpg\",\"InternationalCode\":\"8X6749A5JXF1425\"},{\"order\":5,\"url\":\"http://123.57.175.202:8087/IMG/5ebc077b-3331-4644-97d4-e1fba3e5ee89.jpg\",\"InternationalCode\":\"8X6749A5JXF1425\"},{\"order\":6,\"url\":\"http://123.57.175.202:8087/IMG/5ebc077b-3331-4644-97d4-e1fba3e5ee89.jpg\",\"InternationalCode\":\"8X6749A5JXF1425\"},{\"order\":7,\"url\":\"http://123.57.175.202:8087/IMG/5ebc077b-3331-4644-97d4-e1fba3e5ee89.jpg\",\"InternationalCode\":\"8X6749A5JXF1425\"},{\"order\":8,\"url\":\"http://123.57.175.202:8087/IMG/5ebc077b-3331-4644-97d4-e1fba3e5ee89.jpg\",\"InternationalCode\":\"8X6749A5JXF1425\"},{\"order\":9,\"url\":\"http://123.57.175.202:8087/IMG/5ebc077b-3331-4644-97d4-e1fba3e5ee89.jpg\",\"InternationalCode\":\"8X6749A5JXF1425\"},{\"order\":10,\"url\":\"http://123.57.175.202:8087/IMG/5ebc077b-3331-4644-97d4-e1fba3e5ee89.jpg\",\"InternationalCode\":\"8X6749A5JXF1425\"},{\"order\":11,\"url\":\"http://123.57.175.202:8087/IMG/5ebc077b-3331-4644-97d4-e1fba3e5ee89.jpg\",\"InternationalCode\":\"8X6749A5JXF1425\"},{\"order\":12,\"url\":\"http://123.57.175.202:8087/IMG/5ebc077b-3331-4644-97d4-e1fba3e5ee89.jpg\",\"InternationalCode\":\"8X6749A5JXF1425\"},{\"order\":13,\"url\":\"http://123.57.175.202:8087/IMG/5ebc077b-3331-4644-97d4-e1fba3e5ee89.jpg\",\"InternationalCode\":\"8X6749A5JXF1425\"},{\"order\":14,\"url\":\"http://123.57.175.202:8087/IMG/5ebc077b-3331-4644-97d4-e1fba3e5ee89.jpg\",\"InternationalCode\":\"8X6749A5JXF1425\"},{\"order\":15,\"url\":\"http://123.57.175.202:8087/IMG/5ebc077b-3331-4644-97d4-e1fba3e5ee89.jpg\",\"InternationalCode\":\"8X6749A5JXF1425\"},{\"order\":16,\"url\":\"http://123.57.175.202:8087/IMG/5ebc077b-3331-4644-97d4-e1fba3e5ee89.jpg\",\"InternationalCode\":\"8X6749A5JXF1425\"}]",
     * "DetailsImgs":"[{\"order\":0,\"url\":\"http://123.57.175.202:8087/IMG/e337e713-9056-4649-8ee8-35af5d56f3a2.jpg\"},{\"order\":1,\"url\":\"http://123.57.175.202:8087/IMG/3de217aa-fa7c-43d5-b50d-bed2a253f12c.jpg\"},{\"order\":2,\"url\":\"http://123.57.175.202:8087/IMG/e842dd5f-e534-4bfe-bfff-251a97231728.jpg\"},{\"order\":3,\"url\":\"http://123.57.175.202:8087/IMG/a95c76f9-9ee8-4c96-bbdd-93b9fd178749.jpg\"},{\"order\":4,\"url\":\"http://123.57.175.202:8087/IMG/390d5a10-1803-48cc-9f18-e073b1978a5f.jpg\"},{\"order\":5,\"url\":\"http://123.57.175.202:8087/IMG/fef00577-2a34-4bb1-a661-0090ea65e7c5.jpg\"},{\"order\":13,\"url\":\"http://123.57.175.202:8087/IMG/9cec3540-3737-4b8c-aec2-faebb7ff19fe.jpg\"},{\"order\":6,\"url\":\"http://123.57.175.202:8087/IMG/8756df2a-3eaa-47a7-9677-8c51e58a0efe.jpg\"},{\"order\":7,\"url\":\"http://123.57.175.202:8087/IMG/3464b41f-ffd6-458e-a7f6-caf5dbeeec5b.jpg\"},{\"order\":8,\"url\":\"http://123.57.175.202:8087/IMG/7233162d-605c-4766-b41e-af3fcc87acce.jpg\"},{\"order\":9,\"url\":\"http://123.57.175.202:8087/IMG/2143e75e-7d87-49d2-afe3-eddc4c768687.jpg\"},{\"order\":10,\"url\":\"http://123.57.175.202:8087/IMG/fd04cc12-a2a3-4577-83a3-7bd783a258b3.jpg\"},{\"order\":11,\"url\":\"http://123.57.175.202:8087/IMG/469e44ad-e907-4230-b47a-307cef963a92.jpg\"},{\"order\":12,\"url\":\"http://123.57.175.202:8087/IMG/7c6149e6-7feb-40cb-a8b8-518ba1d21217.jpg\"}]",
     * "SpecItems":[
     * {
     * "ProductId":0,
     * "Sku":"8X6749A5JXF1425|34",
     * "StockNum":0,
     * "CreatTime":"2020-05-14T03:05:52.4027332Z",
     * "UpdateTime":null,
     * "CustomsChannelId":35,
     * "HsCode":"",
     * "CountryId":307,
     * "CountryName":"意大利",
     * "UnitId":"025",
     * "UnitName":"双",
     * "WrapId":"5H4",
     * "WrapName":"塑料薄膜袋",
     * "VATRate":0.13,
     * "ConsumptionTaxRate":0.0,
     * "TradeType":2,
     * "Published":0,
     * "AttrComb":"[{\"k\":\"颜色\",\"v\":\"棕色\"},{\"k\":\"尺码\",\"v\":\"34\"}]",
     * "Gtin":"",
     * "Price":0.0,
     * "CiqCountry":380,
     * "InternationalCode":"8X6749A5JXF1425"
     * },
     * {
     * "ProductId":0,
     * "Sku":"8X6749A5JXF1425|34.5",
     * "StockNum":0,
     * "CreatTime":"2020-05-14T03:05:52.4027332Z",
     * "UpdateTime":null,
     * "CustomsChannelId":35,
     * "HsCode":"",
     * "CountryId":307,
     * "CountryName":"意大利",
     * "UnitId":"025",
     * "UnitName":"双",
     * "WrapId":"5H4",
     * "WrapName":"塑料薄膜袋",
     * "VATRate":0.13,
     * "ConsumptionTaxRate":0.0,
     * "TradeType":2,
     * "Published":0,
     * "AttrComb":"[{\"k\":\"颜色\",\"v\":\"棕色\"},{\"k\":\"尺码\",\"v\":\"34.5\"}]",
     * "Gtin":"",
     * "Price":0.0,
     * "CiqCountry":380,
     * "InternationalCode":"8X6749A5JXF1425"
     * }
     * ],
     * "Gtin":null,
     * "CiqCountry":380,
     * "InternationalCode":"0ae7f024-941c-4a1c-b4dc-b148049ff484",
     * "Material":"橡胶,牛皮",
     * "ProductionCompany":"",
     * "OutCode":null,
     * "ErrorMessage":null,
     * "GoodsOnShelvesStatus":0,
     * "PushType":0,
     * "WarehouseId":0,
     * "StoreId":0,
     * "SwiftNumber":null,
     * "CategoryId":57
     * }],
     * "ClientGuid":"59496713-49ed-40e6-aabf-a42f8345f306",
     * "ClientName":"OUPAI-ERP"
     * }
     *
     * @return mixed
     */
    function updateAction()
    {
        // 逻辑
        // 首先接收传送过来的 $ProductItems, 因为前台只允许单个产品上新，所以只会有一个 productid
        if (!$ProductItems = json_decode($this->request->getPost('params'), true)) {
            echo $this->error('参数错误');
            exit();
        }
        // 获取 token 配置项
        $config_token = $this->getOmsConfig();
        // 待传递的完整参数
        $params = [
            // 客户端id
            'ClientGuid'   => $config_token->ClientGuid,
            // 客户端名称
            'ClientName'   => $config_token->ClientName,
            // 商品详情，里面是数组格式
            'ProductItems' => [$ProductItems],
        ];
        // 记录下待发送给 oms 的参数，json格式, 便于查找问题所在
        error_log("updateAction待传递的参数json格式是 = " . json_encode($params));
        // 发送 application/x-www-form-urlencoded POST请求需要传入 form_params 数组参数，数组内指定POST的字段。
        $response = $this->getClient()->post($config_token->Inventory_update->remote_url, [
            'form_params' => $params,
        ]);
        // 解析结果
        $body = $response->getBody()->getContents();
        $res = json_decode($body, true);
        // 记录下返回值
        error_log("updateAction的返回值是：" . print_r($res, true));
        // 返回数组数据
        echo json_encode($res);
        exit();
    }

    /**
     * 库存更新接口，通过监控 stock 的变化，直接在程序中完成
     *
     * @param array StockInOutDetail 库存更新明细
     */
    function stockupdateAction($StockInOutDetail = [])
    {
        // 逻辑
        // 获取 token 配置项
        $config_token = $this->getOmsConfig();
        // 待传递的完整参数
        $params = [
            // 客户端id
            'ClientGuid' => $config_token->ClientGuid,
            // 客户端名称
            'ClientName' => $config_token->ClientName,
            // 库存更新详情
            'StockIn'    => [
                // 出入库类型，默认传0
                'InOutType'        => $config_token->stock->stockupdate->InOutType,
                // 供应商Id，传OMS指定值
                'SupplierId'       => $config_token->VendorId,
                // 来源仓库Id，传OMS指定值
                'FromWareHoseID'   => $config_token->stock->stockupdate->FromWareHoseID,
                // 仓库Id，传OMS指定值
                'WareHoseId'       => $config_token->stock->stockupdate->WareHoseId,
                // 发货人Id，传OMS指定值
                'ConsignorId'      => $config_token->stock->stockupdate->ConsignorId,
                // 库存更新明细
                'StockInOutDetail' => $StockInOutDetail,
            ],
        ];
        // 记录下待发送给 oms 的参数，json格式, 便于查找问题所在
        error_log("stockupdateAction待传递的参数json格式是 = " . json_encode($params));
        // 发送 application/x-www-form-urlencoded POST请求需要传入 form_params 数组参数，数组内指定POST的字段。
        $response = $this->getClient()->post($config_token->stock->stockupdate->remote_url, [
            'form_params' => $params,
        ]);
        // 解析结果
        $body = $response->getBody()->getContents();
        $res = json_decode($body, true);
        // 记录下返回值
        error_log("stockupdateAction的返回值是：" . print_r($res, true));
        // 返回数组数据
        echo json_encode($res);
        exit();
    }

    /**
     * 接收订单接口
     *
     * @param array StockInOutDetail 库存更新明细
     */
    function orderAction()
    {
        // 逻辑
        // 需要从外部接收 post 请求，但是必须有数据，否则直接报错返回
        if (!$post = @file_get_contents("php://input")) {
            // 非法数据
            echo $this->jsonOmsError($this->getValidateMessage(1001));
            exit();
        }
        // 把这个新订单推送到任务队列
        if ($queue = $this->queue) {
            $queue->choose('oms_get_order');
            // 只把必要的参数传递给队列即可，剩下的逻辑交给Beanstalk吧。
            $queue->put($post, $this->config->queue->toArray());
            // 返回成功
            echo $this->jsonOmsSuccess();
            exit();
        }
        // 否则返回失败
        echo $this->jsonOmsError($this->getValidateMessage(1002));
        exit();
    }

    /**
     * 发货接口
     */
    function deliveryAction()
    {
        // 逻辑
        // 接收 post 的值
        if (!$post = json_decode($this->request->getPost('params'), true)) {
            echo $this->error('参数错误');
            exit();
        }

        // 是否拒绝发货为必填
        if (is_null($post['isRefuse'])) {
            // 模拟错误
            echo $this->jsonOmsError($this->getValidateMessage('is-refuse-delivery', 'template', 'required'));
            exit();
        }

        // 获取 token 配置项
        $config_token = $this->getOmsConfig();
        // 待传递的完整参数
        $params = [
            // 客户端id
            'ClientGuid'   => $config_token->ClientGuid,
            // 客户端名称
            'ClientName'   => $config_token->ClientName,
            // 确认发货详情
            'ShipmentInfo' => [
                // 供应商Id，必填
                'VendorId'        => $config_token->VendorId,
                // 供应商Guid，必填
                'VendorGuid'      => $config_token->VendorGuid,
                // 订单号，oms传过来，必填
                'OrderNo'         => $post['orderNo'],
                // 快递公司代码，oms传过来，如果是虚拟物流，则非必填；如果是爱莎之外的发送到银丰仓库，则需要填写物流信息，如果不填写，默认填空
                'ShipmentCopCode' => $post['shipmentCopCode'] ?? null,
                // 快递单号，oms传过来，非必填，如果是虚拟物流，则非必填；如果是爱莎之外的发送到银丰仓库，则需要填写物流信息单号，如果不填写，默认填空
                'TrackingNumber'  => $post['trackingNumber'] ?? null,
                // 是否拒绝发货, 0：正常发货; 1：拒绝发货
                'IsRefuse'        => $post['isRefuse'],
                // 是否无需物流, 0：正常发货; 1：自行送货
                'IsNoExpress'     => $post['isNoExpress'],
                // 如果 IsRefuse 的值是 1 也就是拒绝发货；或者 IsNoExpress 的值是 1，也就是不需要物流，则必传 Note 字段
            ],
        ];

        // 判断是否需要加 Note
        if ($params['ShipmentInfo']['IsRefuse'] == 1 || $params['ShipmentInfo']['IsNoExpress'] == 1) {
            // 必须加 Note，如果 Note 为空，则报错
            if (empty($post['note'])) {
                // 模拟错误
                echo $this->jsonOmsError($this->getValidateMessage('note', 'template', 'required'));
                exit();
            }
            // 如果没有错误，则进行 Note 赋值
            $params['ShipmentInfo']['Note'] = $post['note'];
        }

        // 可以把 post 的值记录到数据库中了
        if ($model = TbOmsOrder::findFirst("id=" . $post['id'])) {
            // 是否拒绝发货
            $model->isRefuse = $post['isRefuse'];
            // 是否无需物流
            $model->isNoExpress = $post['isNoExpress'];
            // 快递公司代码
            $model->shipmentCopCode = $post['shipmentCopCode'];
            // 快递单号
            $model->trackingNumber = $post['trackingNumber'];
            // 备注
            $model->note = $post['note'];
            // 更新时间
            $model->updated_at = date('Y-m-d H:i:s');
            // 更新所有字段
            $model->update();
        }

        // 记录下待发送给 oms 的参数，json格式, 便于查找问题所在
        error_log("deliveryAction待传递的参数json格式是 = " . json_encode($params));
        // 发送 application/x-www-form-urlencoded POST请求需要传入 form_params 数组参数，数组内指定POST的字段。
        $response = $this->getClient()->post($config_token->order->delivery->remote_url, [
            'form_params' => $params,
        ]);
        // 解析结果
        $body = $response->getBody()->getContents();
        $res = json_decode($body, true);
        // 记录下返回值
        error_log("deliveryAction的返回值是：" . print_r($res, true));
        // 返回数组数据
        echo json_encode($res);
        exit();
    }

    /**
     * 测试路由，仅仅是测试，暂时没什么用
     */
    function updatesAction()
    {
        echo $this->jsonOmsSuccess();
        $this->view->disable();
    }

    /**
     * 从 OMS 系统获取 token
     *
     * 最后返回的结果被转换为数组，格式为：
     * Array
     * (
     * [access_token] => EfR5ur_PbbYeKzH-3mL8wH2rwoW2uAmGoCkm6D_Y0solXi-vIEPjSdFPds4LlCAdqa20015mdJJpgk9jwmotv-iGgUaNhCixQdRlzRbUrVfcVIz7iPL_x786v1efeqefh8-SVfFrCd48oK1oZNwUz6M4TdLrkuTSb3uolSZZ5rOqDqvZtmRCtXcK0gcIUTmBLHJ__2PpthI11-yk9xUFp4VPAbXEkmodmIoOsUHwcemU4b5L1DM-6boVTe_m0MvtoJE8bnlpZVukPc4XROoBVdXawqSaZ2HLcIFHq0_NH2HYdPLhwgLZVqGS0m84_CQmXBQnbB7nP6a-nKxcfi627X5zZzrVF30NbgmaSrCGnreNdHCfFHVH5iAOJkPArB77-Kj0SN38t91btxQ-S1PauctTgibHjAJcuWyE_j5bRi78pKsW8-skXVPUe5HI8wFp6DhBrmS9DhThIcKpApji5Sz_MNoirRu9Hy7RrzVtn8Q
     * [token_type] => bearer
     * [expires_in] => 1209599
     * [userName] => testerp@erp.com
     * [.issued] => Tue, 14 Jul 2020 08:17:47 GMT
     * [.expires] => Tue, 28 Jul 2020 08:17:47 GMT
     * )
     */
    function tokenAction()
    {
        // 获取 token 配置项
        $config_token = $this->config->oms->token;
        // 使用 Client 请求数据
        $client = new Client();
        // 发送 application/x-www-form-urlencoded POST请求需要传入 form_params 数组参数，数组内指定POST的字段。
        $response = $client->post($config_token->remote_url, [
            'form_params' => [
                'grant_type' => $config_token->grant_type,
                'username'   => $config_token->username,
                'password'   => $config_token->password,
            ],
        ]);
        // 解析结果
        $body = $response->getBody()->getContents();
        $res = json_decode($body, true);
        // 为了减轻 OMS 的负担，需要把结果缓存起来，如果判断在有效期之内，就无需重新请求新的接口
        $this->session->set('oms_token', $res);
        // 返回最终的 access_token
        return $res['access_token'];
    }

    /**
     *  OMS 请求成功
     *
     * @return false|string
     */
    function jsonOmsSuccess()
    {
        return json_encode([
            'success' => true,
            'code'    => 200,
            'msg'     => $this->getValidateMessage('success'),
            'data'    => '',
        ]);
    }

    /**
     * OMS 请求失败
     *
     * @param string $msg
     * @return false|string
     */
    function jsonOmsError($msg = '')
    {
        return json_encode([
            'success' => false,
            'code'    => 200,
            'msg'     => $msg,
            'data'    => [
                'ErpProductSpecItem' => [],
                'Sku'                => '',
                'ErrorMsg'           => $msg,
            ],
        ]);
    }
}
