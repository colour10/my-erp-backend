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

    /**
     * 分行连续截取字符串
     * @param string $str 需要截取的字符串,UTF-8
     * @param int $row 截取的行数
     * @param int $number 每行截取的字数，中文长度
     * @param bool $suffix 最后行是否添加‘...’后缀
     * @return array    返回数组共$row个元素，下标1到$row
     */
    public function cn_row_substr($str, $row = 1, $number = 10, $suffix = true)
    {
        $result = [];
        for ($r = 1; $r <= $row; $r++) {
            $result[$r] = '';
        }

        $str = trim($str);
        if (!$str) return $result;

        $theStrlen = strlen($str);

        //每行实际字节长度
        $oneRowNum = $number * 3;
        for ($r = 1; $r <= $row; $r++) {
            if ($r == $row and $theStrlen > $r * $oneRowNum and $suffix) {
                $result[$r] = $this->mg_cn_substr($str, $oneRowNum - 6, ($r - 1) * $oneRowNum) . '...';
            } else {
                $result[$r] = $this->mg_cn_substr($str, $oneRowNum, ($r - 1) * $oneRowNum);
            }
            if ($theStrlen < $r * $oneRowNum) break;
        }

        return $result;
    }

    /**
     * 按字节截取utf-8字符串
     * 识别汉字全角符号，全角中文3个字节，半角英文1个字节
     * @param string $str 需要切取的字符串
     * @param string $len 截取长度[字节]
     * @param int $start 截取开始位置，默认0
     * @return string
     */
    public function mg_cn_substr($str, $len, $start = 0)
    {
        $q_str = '';
        $q_strlen = ($start + $len) > strlen($str) ? strlen($str) : ($start + $len);

        //如果start不为起始位置，若起始位置为乱码就按照UTF-8编码获取新start
        if ($start and json_encode(substr($str, $start, 1)) === false) {
            for ($a = 0; $a < 3; $a++) {
                $new_start = $start + $a;
                $m_str = substr($str, $new_start, 3);
                if (json_encode($m_str) !== false) {
                    $start = $new_start;
                    break;
                }
            }
        }

        //切取内容
        for ($i = $start; $i < $q_strlen; $i++) {
            //ord()函数取得substr()的第一个字符的ASCII码，如果大于0xa0的话则是中文字符
            if (ord(substr($str, $i, 1)) > 0xa0) {
                $q_str .= substr($str, $i, 3);
                $i += 2;
            } else {
                $q_str .= substr($str, $i, 1);
            }
        }
        return $q_str;
    }
}