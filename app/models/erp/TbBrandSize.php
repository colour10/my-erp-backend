<?php
namespace Asa\Erp;
use Phalcon\Mvc\Model\Relation;

class TbBrandSize extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_brand_size');

        $this->belongsTo(
            'brandgroup_id',
            '\Asa\Erp\TbBrandgroup',
            'id',
            [
                'alias' => 'brandgroup'
            ]
        );
        $this->belongsTo(
            'brandgroupchild_id',
            '\Asa\Erp\TbBrandgroupchild',
            'id',
            [
                'alias' => 'brandgroupchild'
            ]
        );
        $this->belongsTo(
            'sizetop_id',
            '\Asa\Erp\TbSizetop',
            'id',
            [
                'alias' => 'sizetop'
            ]
        );
    }

    public function getBrandgroup()
    {
        $lang = $this->getDI()->get("session")->get("language");
        return $this->brandgroup->{'name_' . $lang};
    }

    public function getBrandgroupchild()
    {
        $lang = $this->getDI()->get("session")->get("language");
        return $this->brandgroupchild->{'name_' . $lang};
    }

    public function getGender()
    {
        $language = $this->getDI()->get("session")->get("language");
        $lang = new \Phalcon\Config\Adapter\Php(APP_PATH . "/app/config/languages/{$language}.php");

        return isset($lang['list']['gender'][$this->gender]) ? $lang['list']['gender'][$this->gender] : '';
    }

    public function getSizetop()
    {
        $lang = $this->getDI()->get("session")->get("language");
        return $this->sizetop->{'name_' . $lang};
    }

    public function getSizecontents()
    {
        if ($this->sizecontent_ids) {
            $rows = TbSizecontent::find("id in ({$this->sizecontent_ids})");
            $array = [];
            foreach ($rows as $row) {
                $array[] = $row->name;
            }

            return implode(',', $array);
        } else {
            return '';
        }
    }
}