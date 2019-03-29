<?php

namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Db\Column;
use  Phalcon\Mvc\Model\Message;
//use Asa\Erp\TbProduct;

class CommonController extends BaseController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
    }

    function currencyAction()
    {
        header('Access-Control-Allow-Origin:*');
        $lang = $this->language;

        echo json_encode((array)$lang["currency"]);
    }

    function languageAction()
    {
        $config = $this->config;
        echo json_encode((array)$config["languages"]);
    }
    
    function systemlanguageAction()
    {
        $config = $this->config;
        $lang = $this->language;
        $auth = $this->auth;
        
        $lang["_image_url_prex"] = $config->file_prex;
        $lang["list_languages"] = $config->languages;
        
        //$lang["gender"] = $config->gender;
        
        $lang["_datetime"] = date("Y-m-d H:i:s");
        $lang["_date"] = date("Y-m-d");
        $lang["_currentUsername"] = $auth['username'];
        $lang["_currentid"] = $auth['id'];
        //var_dump($auth);
        
        echo sprintf("\$ASAL = %s", json_encode((array)$lang), JSON_OBJECT_AS_ARRAY );
    }
    
    function uploadAction() {
        $result = array(
            "code" => 200,
            "files" => array()
        );
        
        $files = $result['files'];
        if ($this->request->hasFiles()) {
            $path = $this->config->upload_dir . $_GET["category"] ."/";
            if(!is_dir($path)) {
                mkdir($path);   
            }
            
            // Print the real file names and sizes
            foreach ($this->request->getUploadedFiles() as $file) {                
                $filename = sprintf(
                    "%s/%s.%s",
                    $_GET["category"],
                    md5(sprintf("%s_%s_%s", $_GET["category"], time(), rand(1,1000000))),
                    strtolower($file->getExtension())
                );
                
                // Move the file into the application
                $file->moveTo($this->config->upload_dir . $filename);
                $files[$file->getName()] = $filename;
            }
            
            $result["files"] = $files;
        }
        
        echo json_encode($result);        
    }

    function loadnameAction() {
        $services = [
            "product" => ["table"=>"Asa\\Erp\\TbProduct", "columns"=>["productname", "countries"]],
            "country" =>["table"=>"Asa\\Erp\\ZlCountry", "columns"=>["code", "name_cn"]],
            "warehouse" =>["table"=>"Asa\\Erp\\TbWarehouse", "columns"=>["code", "name"]],
            "user" =>["table"=>"Asa\\Erp\\TbUser", "columns"=>["login_name", "real_name"]],
            "goods" =>["table"=>"Asa\\Erp\\TbGoods", "columns"=>["price", "productid"]],
            "orderdetails" =>["table"=>"Asa\\Erp\\DdOrderdetails", "columns"=>[]],
        ];

        //new \Asa\Erp\TbProduct();

        $params = json_decode($_POST['params']);

        $output = [];
        foreach($params as $service_name=>$id_array) {
            if(count($id_array)>0 && isset($services[$service_name])) {
                $service_output = [];
                $idstring = implode(",", $id_array);
                if(!preg_match("#^\d+(,\d+)*$#", $idstring)) {
                    continue;
                }

                $findByIdString = new \ReflectionMethod($services[$service_name]['table'], 'findByIdString');
                $result = $findByIdString->invokeArgs(null, [$idstring]);

                
                foreach($result as $row) {
                    $line = [];
                    if(count($services[$service_name]['columns'])>0) {
                        foreach ($services[$service_name]['columns'] as $value) {
                            $line[$value] = $row->$value;
                        }
                    }
                    else {
                        $line = $row->toArray();
                    }
                    $service_output[$row->id] = $line;
                }

                $output[$service_name] = $service_output;
            }
        }

        echo json_encode($output);
    }
}
