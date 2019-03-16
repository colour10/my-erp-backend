<?php

namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Db\Column;
use  Phalcon\Mvc\Model\Message;

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
        $this->view->disable();
    }

    function languageAction()
    {
        $config = $this->config;
        echo json_encode((array)$config["languages"]);
        $this->view->disable();
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
        //var_dump($auth);
        
        echo sprintf("\$ASAL = %s", json_encode((array)$lang), JSON_OBJECT_AS_ARRAY );
        $this->view->disable();
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
        
        $this->view->disable();
    }
}
