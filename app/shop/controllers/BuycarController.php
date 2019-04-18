<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbColortemplate;
use Asa\Erp\TbSizecontent;
use Asa\Erp\TbBuycar;
use Asa\Erp\TbProduct;

/**
 * 购物车操作类
 * Class BuycarController
 * @package Multiple\Shop\Controllers
 */
class BuycarController extends AdminController
{

    public function initialize()
    {
    	
    }


    /**
     * 购物车首页
     */
	public function indexAction()
    {	
		if(!$rs = $this->session->get('member')){
            return $this->dispatcher->forward([
                'controller' => 'buycar',
                'action' => 'index_null',
            ]);
		}
    }

    /**
     * 购物车为空
     */
	public function index_nullAction()
    {
    	
    }

    /**
     * 订单列表
     * @return bool|false|string
     */
    function getListAction()
    {	
        if($rs = $this->session->get('member')){
    		// 当前登录用户id
			$member_id = $this->session->get('member')['id'];
			// 当前登录用户的购物车模型
			$cars = TbBuycar::find('member_id='.$member_id);
			
			if(!$cars->toArray()){
				// return false;
                // 返回空数据
                return json_encode(['code' => '200', 'auth' =>[], 'messages' => []]);
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
			return json_encode(['code' => '200', 'auth' =>$cars_arr, 'messages' => []]);
    	}else{
    		if($rs = $this->session->get('buycar')){
                return json_encode(['code' => '200', 'auth' =>$rs, 'messages' => []]);
    		}else{
    			return false;
    		}
    	}
    }
    
    // 渲染用
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

    /**
     * 添加到购物车
     * @return bool|void
     */
    public function addAction() {
    	if ($rs = $this->session->get('member')) {
    		$cars = TbBuycar::findFirst(array(
    			"member_id = ".$rs['id']." and product_id = ".$_POST['product_id']." and color_id = ".$_POST['color_id']." and size_id = ".$_POST['size_id']
    		));

    		// 无此商品
            // 设置当前语言字段
            $name = $this->getlangfield('name');
            $content = $this->getlangfield('content');
    		if(!$cars){
    			$model = new TbBuycar;
   				$model->product_id = $_POST['product_id'];
   				$model->product_name = $_POST['product_name'];
   				$model->price = $_POST['price'];
   				$model->picture = $_POST['picture'];
    			$model->number = Intval($_POST['number']);
    			$model->total_price = $_POST['total_price'];
    			$model->color_id = Intval($_POST['color_id']);
    			$model->color_name = TbColortemplate::findFirstById($_POST['color_id'])->$name;
    			$model->size_id = Intval($_POST['size_id']);
    			$model->size_name = TbSizecontent::findFirstById($_POST['size_id'])->$content;
    			$model->member_id = $rs['id'];
    			$res = $model -> save();
    			if (!$res) {
    			    $errors = [];
                     foreach ($model->getMessages() as $message) {
                         $errors[] = $message->getMessage();
                    }
                    return json_encode(['code' => '200', 'auth' =>$errors, 'messages' => []]);
                } else {
                    return json_encode(['code' => '200', 'auth' =>$res, 'messages' => []]);
                }
 			   //  foreach ($model->getMessages() as $message) {
		        //     echo $message->getMessage();
		        // }
    		// 有则更新数量
			} else {
    			$cars->number = $cars->number + Intval($_POST['number']);
    			$cars->total_price = sprintf($cars->total_price + sprintf("%.2f",$_POST['total_price']));
    			$res = $cars -> save();
                if (!$res) {
                    $errors = [];
                    foreach ($cars->getMessages() as $message) {
                        $errors[] = $message->getMessage();
                    }
                    return json_encode(['code' => '200', 'auth' =>$errors, 'messages' => []]);
                } else {
                    return json_encode(['code' => '200', 'auth' =>$res, 'messages' => []]);
                }
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
            return json_encode(['code' => '200', 'auth' =>$rs, 'messages' => []]);
    		
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
            return json_encode(['code' => '200', 'auth' =>$rs, 'messages' => []]);
    	}
    }

    /**
     * 清空指定id的购物车
     * @return false|string
     */
    public function deletecarAction()
    {
        // 逻辑
        // 判断是否登录
        if (!$this->session->get('member')) {
            return $this->dispatcher->forward([
                'controller' => 'login',
                'action' => 'index',
            ]);
        }
        // 过滤
        $params = $this->dispatcher->getParams();
        if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
            exit('Params error!');
        }
        // 赋值
        $id = $params[0];
        // 判断购物车表是否有这个id
        $buycar = TbBuycar::findFirstById($id);
        if (!$buycar) {
            $msg = $this->getValidateMessage('buycar', 'template', 'notexist');
            return $this->error([$msg]);
        }
        // 开始删除
        if (!$buycar->delete()) {
            $msg = $this->getValidateMessage('buycar', 'db', 'delete-failed');
            return $this->error([$msg]);
        }
        // 成功返回
        return $this->success();
    }
}
