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
            "product" => ["table"=>"Asa\\Erp\\TbProduct", "columns"=>[]],
            "country" =>["table"=>"Asa\\Erp\\ZlCountry", "columns"=>["code", "name_cn"]],
            "warehouse" =>["table"=>"Asa\\Erp\\TbWarehouse", "columns"=>["code", "name"]],
            "user" =>["table"=>"Asa\\Erp\\TbUser", "columns"=>["login_name", "real_name"]],
            "goods" =>["table"=>"Asa\\Erp\\TbGoods", "columns"=>["price", "productid"]],
            "orderdetails" =>["table"=>"Asa\\Erp\\DdOrderdetails", "columns"=>[]],
            "warehousingdetails" =>["table"=>"Asa\\Erp\\TbWarehousingdetails", "columns"=>['number'], "key"=>"confirmorderdetailsid"],
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

                if(isset($services[$service_name]['method'])) {
                    $method = $services[$service_name]['method'];
                }
                else {
                    $method = "findByIdString";
                }

                if(isset($services[$service_name]['key'])) {
                    $key = $services[$service_name]['key'];
                }
                else {
                    $key = "id";
                }

                $findByIdString = new \ReflectionMethod($services[$service_name]['table'], $method);
                $result = $findByIdString->invokeArgs(null, [$idstring, $key]);

                
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
                    $service_output[$row->$key] = $line;
                }

                $output[$service_name] = $service_output;
            }
        }

        echo json_encode($output);
    }

    function listAction() {
        $maps = [
            "confirmorderdetails" => ["model"=>'Asa\Erp\DdConfirmorderdetails',"company"=>true],
            "confirmorder" => ["model"=>'Asa\Erp\DdConfirmorder',"company"=>true],
            "orderdetails" => ["model"=>'Asa\Erp\DdOrderdetails',"company"=>true],
            "order" => ["model"=>'Asa\Erp\DdOrder',"company"=>true],
            "buycar" => ["model"=>'Asa\Erp\TbBuycar',"company"=>true],
            "company" => ["model"=>'Asa\Erp\TbCompany',"company"=>false],
            "department" => ["model"=>'Asa\Erp\TbDepartment',"company"=>true],
            "goods" => ["model"=>'Asa\Erp\TbGoods',"company"=>true],
            "group" => ["model"=>'Asa\Erp\TbGroup',"company"=>true],
            "member_address" => ["model"=>'Asa\Erp\TbMemberAddress',"company"=>true],
            "member" => ["model"=>'Asa\Erp\TbMember',"company"=>true],
            "permission_group" => ["model"=>'Asa\Erp\TbPermissionGroup',"company"=>false],
            "permission_module" => ["model"=>'Asa\Erp\TbPermissionModule',"company"=>false],
            "permission" => ["model"=>'Asa\Erp\TbPermission',"company"=>false],
            "picture" => ["model"=>'Asa\Erp\TbPicture',"company"=>true],
            "product" => ["model"=>'Asa\Erp\TbProduct',"company"=>true],
            "productstock_log" => ["model"=>'Asa\Erp\TbProductstockLog',"company"=>true],
            "productstock" => ["model"=>'Asa\Erp\TbProductstock',"company"=>true],
            "productstock_snapshot" => ["model"=>'Asa\Erp\TbProductstockSnapshot',"company"=>true],
            "requisition_detail" => ["model"=>'Asa\Erp\TbRequisitionDetail',"company"=>true],
            "requisition" => ["model"=>'Asa\Erp\TbRequisition',"company"=>true],
            "saleport" => ["model"=>'Asa\Erp\TbSaleport',"company"=>true],
            "saleport_user" => ["model"=>'Asa\Erp\TbSaleportUser',"company"=>true],
            "salesdetails" => ["model"=>'Asa\Erp\TbSalesdetails',"company"=>true],
            "sales" => ["model"=>'Asa\Erp\TbSales',"company"=>true],
            "supplier" => ["model"=>'Asa\Erp\TbSupplier',"company"=>true],
            "user" => ["model"=>'Asa\Erp\TbUser',"company"=>true],
            "warehouse" => ["model"=>'Asa\Erp\TbWarehouse',"company"=>true],
            "warehouse_user" => ["model"=>'Asa\Erp\TbWarehouseUser',"company"=>true],
            "warehousingdetails" => ["model"=>'Asa\Erp\TbWarehousingdetails',"company"=>true],
            "warehousing" => ["model"=>'Asa\Erp\TbWarehousing',"company"=>true],
            "ageseason" => ["model"=>'Asa\Erp\ZlAgeseason',"company"=>false],
            "aliases" => ["model"=>'Asa\Erp\ZlAliases',"company"=>false],
            "brandgroup" => ["model"=>'Asa\Erp\ZlBrandgroup',"company"=>false],
            "brand" => ["model"=>'Asa\Erp\ZlBrand',"company"=>false],
            "brandremark" => ["model"=>'Asa\Erp\ZlBrandremark',"company"=>false],
            "businesstype" => ["model"=>'Asa\Erp\ZlBusinesstype',"company"=>false],
            "childproductgroup" => ["model"=>'Asa\Erp\ZlChildproductgroup',"company"=>false],
            "closedway" => ["model"=>'Asa\Erp\ZlClosedway',"company"=>false],
            "colortemplate" => ["model"=>'Asa\Erp\ZlColortemplate',"company"=>false],
            "country" => ["model"=>'Asa\Erp\ZlCountry',"company"=>false],
            "executioncategory" => ["model"=>'Asa\Erp\ZlExecutioncategory',"company"=>false],
            "materialnote" => ["model"=>'Asa\Erp\ZlMaterialnote',"company"=>false],
            "material" => ["model"=>'Asa\Erp\ZlMaterial',"company"=>false],
            "materialstatus" => ["model"=>'Asa\Erp\ZlMaterialstatus',"company"=>false],
            "occasionsstyle" => ["model"=>'Asa\Erp\ZlOccasionsstyle',"company"=>false],
            "productinnards" => ["model"=>'Asa\Erp\ZlProductinnards',"company"=>false],
            "productparts" => ["model"=>'Asa\Erp\ZlProductparts',"company"=>false],
            "producttemplate" => ["model"=>'Asa\Erp\ZlProducttemplate',"company"=>false],
            "securitycategory" => ["model"=>'Asa\Erp\ZlSecuritycategory',"company"=>false],
            "series2" => ["model"=>'Asa\Erp\ZlSeries2',"company"=>false],
            "series" => ["model"=>'Asa\Erp\ZlSeries',"company"=>false],
            "sizecontent" => ["model"=>'Asa\Erp\ZlSizecontent',"company"=>false],
            "sizetop" => ["model"=>'Asa\Erp\ZlSizetop',"company"=>false],
            "templatemanage" => ["model"=>'Asa\Erp\ZlTemplatemanage',"company"=>false],
            "ulnarinch" => ["model"=>'Asa\Erp\ZlUlnarinch',"company"=>false],
            "washinginstructions" => ["model"=>'Asa\Erp\ZlWashinginstructions',"company"=>false],
            "winterproofing" => ["model"=>'Asa\Erp\ZlWinterproofing',"company"=>false]
        ];
        $table = $this->dispatcher->getParam("table");
        $model = $maps[$table];

        if($model) {
            $doList = new \ReflectionMethod($model['model'], 'doList');
            $result = $doList->invokeArgs(null, [$_REQUEST]);
            echo $this->reportJson(array("data"=>$result) ); 
        }
        else {
            echo $this->error(["error"]);
        }
    }
}
