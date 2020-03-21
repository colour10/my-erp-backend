<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbCountry;

/**
 * 基础资料，国家及地区信息表
 * Class CountryController
 * @package Multiple\Home\Controllers
 */
class CountryController extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbCountry');
        $this->setLanguageFlag(true);
    }

    function before_page()
    {
        $_POST["__orderby"] = "name_en asc";
    }

    public function listAction()
    {
        $lang = $this->getDI()->get("session")->get("language");

        $result = [];
        $countries = TbCountry::find([
            "order" => "name_en ASC",
        ]);
        foreach ($countries as $country) {
            if ($lang != 'en') {
                $title = $country->name_en . ' / ' . $country->{'name_' . $lang};
            } else {
                $title = $country->name_en;
            }
            $result[] = [
                'id'    => (int)$country->id,
                'title' => $title,
            ];
        }

        return $this->success($result);
    }
}
