<?php

namespace Asa\Erp;

use Phalcon\Config\Adapter\Php;

/**
 * 品牌尺码表
 * Class TbBrandSize
 * @package Asa\Erp
 */
class TbBrandSize extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $brand_id;

    /**
     *
     * @var integer
     */
    public $brandgroup_id;

    /**
     *
     * @var integer
     */
    public $brandgroupchild_id;

    /**
     *
     * @var integer
     */
    public $gender;

    /**
     *
     * @var integer
     */
    public $sizetop_id;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_brand_size');

        // 品牌尺码-品类表，一对多反向
        $this->belongsTo(
            'brandgroup_id',
            TbBrandgroup::class,
            'id',
            [
                'alias' => 'brandgroup',
            ]
        );

        // 品牌尺码-子品类表，一对多反向
        $this->belongsTo(
            'brandgroupchild_id',
            TbBrandgroupchild::class,
            'id',
            [
                'alias' => 'brandgroupchild',
            ]
        );

        // 品牌尺码-尺码组表，一对多反向
        $this->belongsTo(
            'sizetop_id',
            TbSizetop::class,
            'id',
            [
                'alias' => 'sizetop',
            ]
        );
    }

    /**
     * 取出品类名称
     *
     * @return mixed
     */
    public function getBrandgroup()
    {
        $lang = $this->getDI()->get("session")->get("language");
        return $this->brandgroup->{'name_' . $lang};
    }

    /**
     * 取出子品类名称
     *
     * @return mixed
     */
    public function getBrandgroupchild()
    {
        $lang = $this->getDI()->get("session")->get("language");
        return $this->brandgroupchild->{'name_' . $lang};
    }

    /**
     * 取出性别名称
     *
     * @return string
     */
    public function getGender()
    {
        $language = $this->getDI()->get("session")->get("language");
        $lang = new Php(APP_PATH . "/app/config/languages/{$language}.php");

        return isset($lang['list']['gender'][$this->gender]) ? $lang['list']['gender'][$this->gender] : '';
    }

    /**
     * 取出尺码组名称
     *
     * @return mixed
     */
    public function getSizetop()
    {
        $lang = $this->getDI()->get("session")->get("language");
        return $this->sizetop->{'name_' . $lang};
    }

    /**
     * 取出尺码组
     *
     * @return string
     */
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
