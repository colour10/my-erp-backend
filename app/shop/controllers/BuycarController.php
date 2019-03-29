<?php

namespace Multiple\Shop\Controllers;

use Phalcon\Mvc\Controller;

use Asa\Erp\TbBuycar;

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
			
			if(!$cars){
				return false;
			}

			// 数据整合
			$cars_arr = [];
			$totalpay = 0;
			foreach ($cars as $k => $car) {
				$car_arr = $car->toArray();
				$cars_arr[$k]['id'] = $car->id;
				$cars_arr[$k]['number'] = $car->number;
				$cars_arr[$k]['product'] = $car->product->toArray();
				$cars_arr[$k]['member'] = $car->member->toArray();
				$temp_product = $car->product->toArray();
				$temp_num = $car->number;
				$totalpay += round(sprintf("%.2f", $temp_product['realprice'] * $temp_num),2);
				var_dump(sprintf("%.2f", $temp_num));exit;
			}
			var_dump($totalpay);exit;
			echo json_encode(['code' => '200', 'auth' =>$cars_arr, 'messages' => []]);
    	}else{
    		if($rs = $this->session->get('buycar')){
    			echo json_encode(['code' => '200', 'auth' =>$rs, 'messages' => []]);
    		}else{
    			return false;
    		}
    	}
    }
}
