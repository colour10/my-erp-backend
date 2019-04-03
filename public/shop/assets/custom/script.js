// 填充节点
$(function() {

    // 申请跨域访问
    // 首先根据地址栏中的网址，判断是否存在本域名
    var host = window.location.host;
    var url = window.location.href;
    // 取出当前地址栏的相对地址
    var relativepath = GetUrlRelativePath();

    // 取出主域名，如果不存在就直接跳转
    var main_host = getmainhost();
    if (!main_host) {
        window.location.href = '/';
    }

    // 取出图片域名，如果不存在就直接跳转
    var file_prex = getfileprex();
    if (!file_prex) {
        window.location.href = '/';
    }

    // 默认效果
    Layout.init();
    if (relativepath != '/login/index') {
        Layout.initOWL();
        Layout.initImageZoom();
        Layout.initTouchspin();
    }

});

/**
 * 获取当前主域名
 * @returns {boolean}
 */
function getfileprex() {
    // 初始化
    var result = false;
    // 同步处理
    $.ajaxSetup({ async: false });
    // 逻辑
    $.post('/brandgroup/getfileprex', function(response) {
        if (response) {
            result = response;
        } else {
            result = false;
        }
    });
    // 返回
    return result;
}


/**
 * 获取图片域名
 * @returns {boolean}
 */
function getmainhost() {
    // 初始化
    var result = false;
    // 同步处理
    $.ajaxSetup({ async: false });
    // 逻辑
    $.post('/brandgroup/getmainhost', function(response) {
        if (response) {
            result = response;
        } else {
            result = false;
        }
    });
    // 返回
    return result;
}

/**
 * 获取当前页面的相对地址
 * @returns {string}
 * @constructor
 */
function GetUrlRelativePath() {
    var url = document.location.toString();
    var arrUrl = url.split("//");
    var start = arrUrl[1].indexOf("/");
    // stop省略，截取从start开始到结尾的所有字符
    var relUrl = arrUrl[1].substring(start);
    if(relUrl.indexOf("?") != -1) {
        relUrl = relUrl.split("?")[0];
    }
    return relUrl;
}
