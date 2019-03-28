// 申请跨域访问
// 首先根据地址栏中的网址，判断是否存在本域名
// var url = window.location.host;

// 填充节点
$(function() {
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
    Layout.initOWL();
    Layout.initImageZoom();
    Layout.initTouchspin();

    // 导航部门实现跨域查询
    var navigations = $('.header-navigation').children('ul').eq(0);
    // 如果存在则填充
    if (navigations.length > 0) {
        var html = '';
        $.getJSON('http://'+main_host+'/brandgroup/getlist?callback=?', function(response) {
            // 开始填充数据
            var len = response.length;
            if (len > 0) {
                for (let i=0; i<len; i++) {
                    html += '<li><a href="/brandgroup/detail/'+response[i].id+'">'+response[i].name_cn+'</a></li>';
                }
                // 填充
                navigations.append(html);
            }
        });
    }


    // 首页推荐产品列表，跨域
    var Recommend_products = $('.Recommend_products_content');
    // 如果存在则填充
    if (Recommend_products.length > 0) {
        var productlist = '';
        $.getJSON('http://'+main_host+'/product/getindexrec?callback=?', function(response) {
            // 开始填充数据
            var len = response.length;
            if (len > 0) {
                for (let i=0; i<len; i++) {
                    productlist += '<div class="col-xs-12 col-sm-6 col-md-3">';
                    productlist += '   <div class="thumbnail">';
                    productlist += '       <a href="/product/detail/'+response[i].id+'"><img src="'+file_prex+response[i].picture+'" alt="'+response[i].productname+'" /></a>';
                    productlist += '       <div class="caption">';
                    productlist += '           <h3 class="text-center"><a href="/product/detail/'+response[i].id+'">'+response[i].productname+'</a></h3>';
                    productlist += '           <p>$29.00</p>';
                    productlist += '        </div>';
                    productlist += '    </div>';
                    productlist += '</div>';
                }
                // 填充
                Recommend_products.html(productlist);
            }
        });
    }

    // 侧边sidebar
    var sidebar_menu = $('.sidebar-menu');
    if (sidebar_menu.length > 0) {
        var sitebarlist = '';
        $.getJSON('http://'+main_host+'/brandgroup/getalllist?callback=?', function(response) {
            // 开始填充数据
            var first_len = response.length;
            if (first_len > 0) {
                for (let i=0; i<first_len; i++) {
                    // 如果有子节点
                    var children_length = response[i].children.length;
                    var children_node = response[i].children;
                    if (children_length > 0) {
                        sitebarlist += '<li class="list-group-item clearfix dropdown">';
                        sitebarlist += '    <a href="javascript:void(0);" class="collapsed"><i class="fa fa-angle-right"></i>'+response[i].name_cn+'</a>';
                        sitebarlist += '    <ul class="dropdown-menu" style="display:block;">';
                        // 继续遍历子节点
                        for (let i=0; i<children_length; i++) {
                            sitebarlist += '<li><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> '+children_node[i].name_cn+'</a></li>';
                        }
                        sitebarlist += '    </ul>';
                        sitebarlist += '</li>';
                    } else {
                        sitebarlist += '<li class="list-group-item clearfix"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> '+response[i].name_cn+'</a></li>';
                    }
                }
                // 填充
                sidebar_menu.html(sitebarlist);
            }
        });
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
    $.get('/brandgroup/getfileprex', function(response) {
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
