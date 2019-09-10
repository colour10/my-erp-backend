<?php

namespace Asa\Erp;

/**
 * 使用gd库生成图像
 * Class CreateImg
 * @package Asa\Erp
 */
class CreateImg
{
    // 根目录
    public $rootdir;

    /**
     * 构造函数
     * CreateImg constructor.
     */
    public function __construct()
    {
        $this->rootdir = dirname(dirname(dirname(__DIR__)));
    }

    /**
     * 商品图片生成
     * @param array $gData 商品数据
     */
    public function createSharePng($gData)
    {
        // 创建画布
        $im = imagecreatetruecolor(1125, 1600);

        // 填充画布背景色
        $white = imagecolorallocate($im, 255, 255, 255);
        $black = imagecolorallocate($im, 0, 0, 0);
        $gray = imagecolorallocate($im, 229, 229, 229);
        // 填充白色背景
        imagefill($im, 0, 0, $white);

        // 字体文件
        // 标准体
        $font_file = $this->rootdir . '/public/assets/fonts/msyh.ttf';

        // 设定字体的颜色
        $font_color_1 = ImageColorAllocate($im, 5, 5, 5);
        $font_color_2 = ImageColorAllocate($im, 195, 195, 195);


        // 头部标题展示图
        list($l_w, $l_h) = getimagesize($this->rootdir . '/public/assets/img/top.png');
        $logoImg = @imagecreatefrompng($this->rootdir . '/public/assets/img/top.png');
        imagecopyresized($im, $logoImg, 0, 0, 0, 0, $l_w, $l_h, $l_w, $l_h);

        // 左侧列表-各项商品参数
        $brandname = isset($gData['brandname']) ? $gData['brandname'] : '';
        $countryname = isset($gData['countryname']) ? $gData['countryname'] : '';
        $materialname = isset($gData['materialname']) ? $gData['materialname'] : '';
        $whitename = isset($gData['colorname']) ? $gData['colorname'] : '';
        $model = isset($gData['model']) ? $gData['model'] : '';
        imagettftext($im, 32, 0, 67, 280, $font_color_1, $font_file, $brandname);
        imagettftext($im, 32, 0, 67, 320, $font_color_2, $font_file, '—————————');
        imagettftext($im, 32, 0, 67, 360, $font_color_1, $font_file, $countryname);
        imagettftext($im, 32, 0, 67, 400, $font_color_2, $font_file, '—————————');
        imagettftext($im, 32, 0, 67, 440, $font_color_1, $font_file, $materialname);
        imagettftext($im, 32, 0, 67, 480, $font_color_2, $font_file, '—————————');
        imagettftext($im, 32, 0, 67, 520, $font_color_1, $font_file, $whitename);
        imagettftext($im, 32, 0, 67, 560, $font_color_2, $font_file, '—————————');
        imagettftext($im, 32, 0, 67, 600, $font_color_1, $font_file, $model);
        imagettftext($im, 32, 0, 67, 640, $font_color_2, $font_file, '—————————');

        // 右侧图片
        list($g_w, $g_h) = getimagesize($this->rootdir . '/public' . $gData['pic']);
        $goodImg = $this->createImageFromFile($this->rootdir . '/public' . $gData['pic']);
        imagecopyresized($im, $goodImg, 620, 230, 0, 0, $g_w, $g_h, $g_w, $g_h);

        // 循环输出
        // 如果属性值不为空，则输出
        if ($count = count($gData['properties'])) {
            // 填充一个矩形背景，颜色选择黑色
            imagefilledrectangle($im, 67, 665, 1060, 741, $black);
            $i = 1;
            // 先写入尺码
            imagettftext($im, 32, 0, 63 + 998 / ($count + 1) / 4, 720, $white, $font_file, '尺码');
            // 再写入剩下的属性
            foreach ($gData['properties'] as $property) {
                imagettftext($im, 32, 0, 63 + 998 / ($count + 1) * $i + 998 / ($count + 1) / $this->getWriteLocation(mb_strlen($property['name'])), 720, $white, $font_file, $property['name']);
                $i++;
            }
        }

        // 写入尺码列表值，并循环显示
        $j = 0;
        foreach ($gData['lists'] as $key => $list) {
            // 先要填充一个灰色背景，每条数据都要添加1个矩形区域
            imagefilledrectangle($im, 67, 760 + $j * 95, 1060, 836 + $j * 95, $gray);
            // 需要判断尺码是几位数，写入的位置不同
            imagettftext($im, 32, 0, 63 + 998 / ($count + 1) / $this->getWriteLocation(mb_strlen($key)), 813 + $j * 95, $font_color_1, $font_file, $key);
            // 开始写接下来的属性
            $s = 1;
            foreach ($list as $item) {
                imagettftext($im, 32, 0, 63 + 998 / ($count + 1) * $s + 998 / ($count + 1) / $this->getWriteLocation(mb_strlen($item)), 813 + $j * 95, $font_color_1, $font_file, $item);
                $s++;
            }
            // 循环一次之后累加，进入下一次循环
            $j++;
        }

        // 输出图片
        // 保留在public下面的thumb里
        $thumbFolder = $this->rootdir . '/public/upload/thumb/';
        if (!file_exists($thumbFolder)) {
            mkdir($thumbFolder);
        }
        // 输出
        if (!imagepng($im, $thumbFolder . $gData['productid'] . '.png')) {
            echo json_encode(['code' => '200', 'messages' => ['缩略图生成失败']]);
            exit;
        }

        //释放空间
        imagedestroy($im);
        imagedestroy($goodImg);

        // 返回成功
        echo json_encode(['code' => '200', 'messages' => []]);
        exit;
    }

    /**
     * 获取写入的位置
     * @param $count
     * @return float|int
     */
    public function getWriteLocation($count)
    {
        if ($count == 1) {
            return 3.5;
        } else if ($count == 2) {
            return 4;
        } else if ($count == 3) {
            return 5;
        } else {
            return 1;
        }
    }

    /**
     * 从图片文件创建Image资源
     * @param string $file 图片文件，支持url
     * @return bool|resource    成功返回图片image资源，失败返回false
     */
    public function createImageFromFile($file)
    {
        if (preg_match('/http(s)?:\/\//', $file)) {
            $fileSuffix = $this->getNetworkImgType($file);
        } else {
            $fileSuffix = pathinfo($file, PATHINFO_EXTENSION);
        }

        if (!$fileSuffix) return false;

        switch ($fileSuffix) {
            case 'jpeg':
                $theImage = @imagecreatefromjpeg($file);
                break;
            case 'jpg':
                $theImage = @imagecreatefromjpeg($file);
                break;
            case 'png':
                $theImage = @imagecreatefrompng($file);
                break;
            case 'gif':
                $theImage = @imagecreatefromgif($file);
                break;
            default:
                $theImage = @imagecreatefromstring(file_get_contents($file));
                break;
        }

        return $theImage;
    }

    /**
     * 获取网络图片类型
     * @param string $url 网络图片url,支持不带后缀名url
     * @return bool
     */
    public function getNetworkImgType($url)
    {
        $ch = curl_init(); //初始化curl
        curl_setopt($ch, CURLOPT_URL, $url); //设置需要获取的URL
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);//设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //支持https
        curl_exec($ch);//执行curl会话
        $http_code = curl_getinfo($ch);//获取curl连接资源句柄信息
        curl_close($ch);//关闭资源连接

        if ($http_code['http_code'] == 200) {
            $theImgType = explode('/', $http_code['content_type']);

            if ($theImgType[0] == 'image') {
                return $theImgType[1];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}