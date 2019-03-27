// 申请跨域访问
// 首先根据地址栏中的网址，判断是否存在本域名
var url = window.location.host;
$(function() {
    // 取出主域名，如果不存在就直接跳转
    var main_host = getmainhost();
    if (!main_host) {
        window.location.href = '/';
    }

    // 默认效果
    Layout.init();
    Layout.initOWL();
    Layout.initImageZoom();
    Layout.initTouchspin();

    // 导航部门实现跨域查询
    var navigations = $('.header-navigation').children('ul').eq(0);
    var html = '';
    $.getJSON('http://'+main_host+'/brandgroup/getlist?callback=?', function(response) {
        // 开始填充数据
        var len = response.length;
        if (len > 0) {
            for (var i=0; i<len; i++) {
                html += '<li><a href="/brandgroup/detail/'+response[i].id+'">'+response[i].name_cn+'</a></li>';
            }
            navigations.append(html);
        }
    });
});

/**
 * 获取当前主域名
 * @returns {boolean}
 */
function getmainhost() {
    // 初始化
    var result = false;
    // 同步处理
    $.ajaxSetup({ async: false });
    // 逻辑
    $.get('/brandgroup/getmainhost', function(response) {
        if (response) {
            result = response;
        } else {
            result = false;
        }
    });
    // 返回
    return result;
}