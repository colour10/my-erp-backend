<?php

namespace Asa\Erp;

/**
 * 下载表
 *
 * App\Models\TbDownload
 * @package Asa\Erp
 * @property int $id 主键ID
 * @property int $user_id 下载者id
 * @property int $picture_id 下载图片id
 * @property null $created_at -创建时间
 * @property null $updated_at -更新时间
 * @property-read TbUser|null $user 用户
 * @property-read TbPicture|null $picture 图片
 */
class TbDownload extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_downloads');

        // 下载-用户表，一对多反向
        $this->belongsTo(
            'user_id',
            TbUser::class,
            'id',
            [
                'alias' => 'user',
            ]
        );

        // 下载-图片表，一对多反向
        $this->belongsTo(
            'picture_id',
            TbPicture::class,
            'id',
            [
                'alias' => 'picture',
            ]
        );
    }

}
