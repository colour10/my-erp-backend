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

			// 数据整合
			$cars_arr = [];
			foreach ($cars as $k => $car) {
				$car_arr = $car->toArray();
				$cars_arr[$k]['id'] = $car->id;
				$cars_arr[$k]['number'] = $car->number;
				$cars_arr[$k]['product'] = $car->product->toArray();
				$cars_arr[$k]['member'] = $car->member->toArray();
			}
			echo json_encode(['code' => '200', 'auth' =>$cars_arr, 'messages' => []]);
    	}else{
    		
    	}
    }
}
