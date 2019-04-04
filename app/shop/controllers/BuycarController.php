<?php

namespace Multiple\Shop\Controllers;

use Phalcon\Mvc\Controller;

use Asa\Erp\TbBuycar;

use Asa\Erp\TbProduct;

class BuycarController extends AdminController
{

    public function initialize()
    {
    	
    }



	function indexAction()
    {	
		if(!$rs = $this->session->get('member')){
			$this->response->redirect('buycar/index_null');
		}
    }


	function index_nullAction()
    {
    	
    }
    
    function getListAction()
    {	
        if($rs = $this->session->get('member')){
    		// 当前登录用户id
			$member_id = $this->session->get('member')['id'];
			// 当前登录用户的购物车模型
			$cars = TbBuycar::find('member_id='.$member_id);
			
			if(!$cars->toArray()){
				return false;
			}
			// 数据整合
			$cars_arr = [];
			$totalprice = 0;
			$totalnum = 0;
			foreach ($cars as $k => $car) {
				$car_arr = $car->toArray();
				$cars_arr[$k]['id'] = $car->id;
				$cars_arr[$k]['product_id'] = $car->product_id;
				$cars_arr[$k]['product_name'] = $car->product_name;
				$cars_arr[$k]['size_id'] = $car->size_id;
				$cars_arr[$k]['color_id'] = $car->color_id;
				$cars_arr[$k]['size_name'] = $car->size_name;
				$cars_arr[$k]['color_name'] = $car->color_name;
				$cars_arr[$k]['number'] = $car->number;
				$cars_arr[$k]['price'] = $car->price;
				$cars_arr[$k]['total_price'] = $car->total_price;
				$cars_arr[$k]['product'] = $car->product->toArray();
				$cars_arr[$k]['member'] = $car->member->toArray();
				$temp_product = $car->product->toArray(); 
				$temp_num = $car->number;
				$totalprice = sprintf("%.2f",$totalprice + sprintf("%.2f", $car->total_price));
				$totalnum += $temp_num;
			}
			$cars_arr[0]['totalprice'] = $totalprice;
			$cars_arr[0]['totalnum'] = $totalnum;
			echo json_encode(['code' => '200', 'auth' =>$cars_arr, 'messages' => []]);
    	}else{
    		if($rs = $this->session->get('buycar')){
    			echo json_encode(['code' => '200', 'auth' =>$rs, 'messages' => []]);
    		}else{
    			return false;
    		}
    	}
    }
    
    //渲染用
    function getListsAction()
    {	
        if($rs = $this->session->get('member')){
    		// 当前登录用户id
			$member_id = $this->session->get('member')['id'];
			// 当前登录用户的购物车模型
			$cars = TbBuycar::find('member_id='.$member_id);
			
			if(!$cars->toArray()){
				return false;
			}
			
			// 数据整合
			$cars_arr = [];
			$totalprice = 0;
			$totalnum = 0;
			foreach ($cars as $k => $car) {
				$car_arr = $car->toArray();
				$cars_arr[$k]['id'] = $car->id;
				$cars_arr[$k]['product_id'] = $car->product_id;
				$cars_arr[$k]['product_name'] = $car->product_name;
				$cars_arr[$k]['size_id'] = $car->size_id;
				$cars_arr[$k]['color_id'] = $car->color_id;
				$cars_arr[$k]['size_name'] = $car->size_name;
				$cars_arr[$k]['color_name'] = $car->color_name;
				$cars_arr[$k]['number'] = $car->number;
				$cars_arr[$k]['price'] = $car->price;
				$cars_arr[$k]['total_price'] = $car->total_price;
				$cars_arr[$k]['product'] = $car->product->toArray();
				$cars_arr[$k]['member'] = $car->member->toArray();
				$temp_product = $car->product->toArray(); 
				$temp_num = $car->number;
				$totalprice = sprintf("%.2f",$totalprice + sprintf("%.2f", $car->total_price));
				$totalnum += $temp_num;
			}
			$cars_arr[0]['totalprice'] = $totalprice;
			$cars_arr[0]['totalnum'] = $totalnum;
			return $cars_arr;
    	}else{
    		if($rs = $this->session->get('buycar')){
    			return $rs;
    		}else{
    			return false;
    		}
    	}
    }
    function addAction(){
    	if($rs = $this->session->get('member')){
    		$cars = TbBuycar::findFirst(array(
    			"member_id = ".$rs['id']." and product_id = ".$_POST['product_id']." and color_id = ".$_POST['color_id']." and size_id = ".$_POST['size_id']
    		));
    		//无此商品
    		if(!$cars){
    			$model = new TbBuycar;
   				$model->product_id = $_POST['product_id'];
   				$model->product_name = $_POST['product_name'];
   				$model->price = $_POST['price'];
    			$model->number = Intval($_POST['number']);
    			$model->total_price = $_POST['total_price'];
    			$model->color_id = Intval($_POST['color_id']);
    			$model->color_name = $_POST['color_name'];
    			$model->size_id = Intval($_POST['size_id']);
    			$model->size_name = $_POST['size_name'];
    			$model->member_id = $rs['id'];
    			$res = $model -> save();
    			echo json_encode(['code' => '200', 'auth' =>$res, 'messages' => []]);
//  			foreach ($model->getMessages() as $message) {
//		            echo $message->getMessage();
//		        }
    		//有则更新数量
			}else{
    			$cars->number = $cars->number + Intval($_POST['number']);
    			$cars->total_price = sprintf($cars->total_price + sprintf("%.2f",$_POST['total_price']));
    			$res = $cars -> save();
    			echo json_encode(['code' => '200', 'auth' =>$res, 'messages' => []]);
			}
    	}else if($rs = $this->session->get('buycar')){
    		//是否已存在同款商品
    		$is_sure = false;
    		
    		foreach($rs as $k=>$v){
    			if($rs[$k]['product']['id'] == $_POST['product_id']){
    				$rs[$k]['number'] += $_POST['number'];
    				$rs[0]['totalpay'] = sprintf("%.2f", $rs[0]['totalpay'] + sprintf("%.2f", $rs[$k]['product']['realprice'] * $_POST['number']));
    				$rs[0]['totalnum'] += $_POST['number'];
    				$is_sure = true;
    				break;
    			}
    		}
    		if($is_sure == false){
    			$cars = TbProduct::findFirst(array(
	    			"id = ".$_POST['product_id']
	    		));
	    		if(!$cars->toArray()){
	    			return false;
	    		}
	    		$temp_array = [];
				$temp_array['number'] = $_POST['number'];
				$temp_array['product'] = $cars->toArray();
				$temp_array['member'] = '';
				$rs[0]['totalpay'] = sprintf("%.2f", $rs[0]['totalpay'] + sprintf("%.2f", $rs[$k]['product']['realprice'] * $_POST['number']));;
				$rs[0]['totalnum'] += $_POST['number'];	  		
				$rs[] = $temp_array;
    		} 
    		$this->session->set('buycar',$rs);
    		echo json_encode(['code' => '200', 'auth' =>$rs, 'messages' => []]);
    		
    	}else{
    		// 数据整合
    		$cars_arr = [];
    		$totalpay = 0;
			$totalnum = 0;
			$cars = TbProduct::findFirst(array(
    			"id = ".$_POST['product_id']
    		));
    		if(!$cars->toArray()){
    			return false;
    		}
    		
			$car_arr = $cars->toArray();
			$cars_arr[0]['number'] = $_POST['number'];
			$cars_arr[0]['product'] = $car_arr;
			$cars_arr[0]['member'] = '';
			$totalpay = sprintf("%.2f", $car_arr['realprice'] * $_POST['number']);
			$totalnum = $_POST['number'];
			$cars_arr[0]['totalpay'] = $totalpay;
			$cars_arr[0]['totalnum'] = $totalnum;
			$this->session->set('buycar',$cars_arr);
			echo json_encode(['code' => '200', 'auth' =>$rs, 'messages' => []]);
    	}
    }
}
