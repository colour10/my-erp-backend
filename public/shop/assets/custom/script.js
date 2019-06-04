// 填充节点
$(function () {
    // 取出当前地址栏的相对地址
    var relativepath = GetUrlRelativePath();

    // 取出主域名
    if (!window.localStorage.getItem('main_host')) {
        window.localStorage.setItem('main_host', getmainhost());
    }

    // 取出图片域名
    if (!window.localStorage.getItem('file_prex')) {
        window.localStorage.setItem('file_prex', getfileprex());
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
    $.ajaxSetup({async: false});
    // 逻辑
    $.post('/brandgroup/getfileprex', function (response) {
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
    $.ajaxSetup({async: false});
    // 逻辑
    $.post('/brandgroup/getmainhost', function (response) {
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
    if (relUrl.indexOf("?") != -1) {
        relUrl = relUrl.split("?")[0];
    }
    return relUrl;
}


/**
 * 地址智能解析
 */
function smart() {
    let value = $('textarea').val();
    // 如果地址栏为空，则不解析，防止覆盖之前正常填写的内容
    if (!value) {
        return;
    }
    let parse_list = parse(value);
    console.log(parse_list);
    let html = '';
    for (let key in parse_list) {
        if (parse_list[key]) {
            html += `<p>` + key + `:` + parse_list[key] + `</p>`;
        }
    }
    // 填写节点
    $('#username').val(parse_list['name']);
    // 判断是手机号还是座机号
    var phone_number = '';
    if (parse_list['mobile']) {
        phone_number = parse_list['mobile'];
    } else {
        phone_number = parse_list['phone'];
    }
    $('#mobile').val(phone_number);
    $('#address').val(parse_list['area'] + parse_list['addr']);
}

