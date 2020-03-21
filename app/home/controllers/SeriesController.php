<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbSeries;

/**
 * 品牌系列，品牌相关数据
 * Class SeriesController
 * @package Multiple\Home\Controllers
 */
class SeriesController extends CadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbSeries');
    }

    function before_page()
    {
        $_POST["__orderby"] = "displayindex asc";
    }

    function before_add()
    {
        $_POST["name_en"] = strtoupper($_POST["name_en"]);

        $object = TbSeries::findFirst(
            sprintf("companyid=%d and name_en='%s'", $this->companyid, addslashes($_POST["name_en"]))
        );

        if ($object) {
            throw new \Exception("/11040101/系列名称不能重复/");
        }

        $_POST["companyid"] = $this->companyid;
    }

    function before_edit($row)
    {
        $_POST["name_en"] = strtoupper($_POST["name_en"]);

        $object = TbSeries::findFirst(
            sprintf("companyid=%d and name_en='%s'", $this->companyid, addslashes($_POST["name_en"]))
        );

        if ($object && $object->id != $row->id) {
            throw new \Exception("/11040201/系列名称不能重复/");
        }
    }
}
