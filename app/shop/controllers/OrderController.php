<?php

namespace Multiple\Shop\Controllers;

use Phalcon\Mvc\Controller;

use Asa\Erp\TbShoporder;

use Asa\Erp\TbShoporderCommon;

use Asa\Erp\TbBuycar;

class OrderController extends AdminController
{

    public function initialize()
    {
    	
    }



	function indexAction()
    {	
		$model_common = new TbShoporderCommon;
    	if($rs = $this->session->get('member')){
    		$order = $model_common->findFirst(
    			"member_id = ".$rs['id'].' and order_status=1'
    		);
    		$data['common'] = $order;
    		$data['product'] = $order->shoporder;
    		$this->view->setVars([
	            'data' => $data,
	        ]);
    	}else{
    		return $this->response->redirect("index/index");
    	}
    }


    function addOrderAction()
    {	
    	$model_common = new TbShoporderCommon;
    	if($rs = $this->session->get('member')){
    		$order = $model_common->findFirst(
    			"member_id = ".$rs['id'].' and order_status=1'
    		);
    		if($order){
    			 // 如果存在，就删除
    			$model_product = new TbShoporder();
    			$product = TbShoporder::find(
	    			"order_commonid = ".$order->toArray()['id']
	    		);
	    		foreach($product as $record){
	    			$record->delete();
	    		}
    			$order->delete();
    		}
    			$model_common = new TbShoporderCommon;
   				$model_common->total_price = $_POST['data'][0]['total_price'];
   				$model_common->send_price = 0;
    			$model_common->final_price = $_POST['data'][0]['final_price'];
    			$model_common->create_time = date("Y-m-d H:i:s");
    			$model_common->member_id = $rs['id'];
    			$res_common = $model_common -> save();
    			if(!$res_common){
    				return false;
    			}
    			$model_product = new TbShoporder;
    			$clone = new TbShoporder;
    			$data_common = [];    			    			
    			
    			foreach($_POST['data'] as $key => $value){
    				$data_common = [
    					'order_commonid' => $model_common->id,
		    			'product_id' => $value['product_id'],
						'product_name' => $value['product_name'],
						'price' => $value['price'],
						'number' => $value['number'],
						'total_price' => $value['total_price'],
						'color_id' => $value['color_id'],
						'color_name' => $value['color_name'],
						'size_id' => $value['size_id'],
						'size_name' => $value['size_name'],
	    			];
	    			$clone = clone $model_product;
	    			$res_product = $clone -> create($data_common);
//	    			foreach ($clone->getMessages() as $message) {
//			            echo $message->getMessage();
//			        }
					echo json_encode(['code' => '200', 'auth' =>true, 'messages' => []]);
					
    			}
    	}else{
    		return $this->response->redirect("index/index");
    	}
    }
    
    //支付订单
    function submitAction(){
    	if($rs = $this->session->get('member')){
    		$model_common = new TbShoporderCommon;
    		$order = $model_common->findFirst(
    			"member_id = ".$rs['id'].' and order_status=1'
    		);
    		if($order){
    			$order->reciver_name = $_POST['reciver_name'];
   				$order->reciver_phone = $_POST['reciver_phone'];
    			$order->reciver_no = $_POST['reciver_no'];
    			$order->reciver_address = $_POST['reciver_address'];
    			$order->pay_time = date("Y-m-d H:i:s");
    			$order->order_status = 2;
    			$res_common = $order -> save();
    			foreach ($order->getMessages() as $message) {
		            echo $message->getMessage();
		        }
    			if($res_common){
    				$cars = TbBuycar::find('member_id='.$rs['id']);
		    		foreach($cars as $record){
		    			$record->delete();
		    		}
		    		echo json_encode(['code' => '200', 'auth' =>true, 'messages' => []]);
    			}else{
    				echo json_encode(['code' => '200', 'auth' =>false, 'messages' => ['结算失败']]);
    			}
    		}
    	}
    }
    
    function myorderAction(){
    	
    }
    
}
