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
 * 删除指定商品的购物车
 * @param obj 当前节点
 * @param id 当前购物车的对应id
 */
function delheadergoods(obj, id) {
    // 逻辑
    $.post('/buycar/deletecar/' + id, function (response) {
        // 判断是否成功
        if (response.messages.length > 0) {
            // 有错误信息，失败了
            layer.open({
                content: result.messages[0],
                btn: '我知道了'
            });
        } else {
            // 没有错误信息，成功
            // 直接删除原来的节点即可，同时添加动画效果
            var li = $(obj).parent();
            // 取出当前线的总价格
            li.fadeTo("slow", 0.01, function () {
                $(this).slideUp("slow", function () {
                    // 执行删除
                    $(this).remove();
                });
            });
        }
    }, 'json');
}

/**
 * 取消指定id的订单
 * @param id
 */
function cancle_order(id) {
    // 询问框
    layer.open({
        content: '您真的要取消这个订单吗？取消不可逆，请三思而后行！',
        btn: ['是', '否'],
        yes: function (index) {
            // ajax取消订单
            $.post('/order/cancle/' + id, {}, function (response) {
                // 判断是否有错误
                if (response.messages.length > 0) {
                    layer.open({
                        content: response.messages[0],
                        btn: '我知道了'
                    });
                } else {
                    //提示
                    layer.open({
                        content: '成功取消订单',
                        btn: '2秒后自动跳转',
                        time: 2, //2秒后自动跳转
                    });
                    // 1秒后跳转
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                }
            }, 'json');
            // 关闭弹出层
            layer.close(index);
        }
    });
}

/**
 * 指定id的订单申请退款
 * @param id
 */
function refund_order(id) {
    // 询问框
    layer.open({
        content: '您真的要申请退款吗？',
        btn: ['是', '否'],
        yes: function (index) {
            // ajax取消订单
            $.post('/order/refund/' + id, {}, function (response) {
                // 判断是否有错误
                if (response.messages.length > 0) {
                    layer.open({
                        content: response.messages[0],
                        btn: '我知道了'
                    });
                } else {
                    //提示
                    layer.open({
                        content: '操作成功',
                        btn: '2秒后自动跳转',
                        time: 2, //2秒后自动跳转
                    });
                    // 1秒后跳转
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                }
            }, 'json');
            // 关闭弹出层
            layer.close(index);
        }
    });
}

/**
 * 重置密码
 * @returns {boolean}
 */
function reset_password() {
    // ajax提交
    $.ajax({
        type: "post",
        url: "/member/resetpassword",
        async: true,
        dataType: 'json',
        data: {
            'old_password': $('#old-password').val(),
            'new_password': $('#new-password').val(),
            'repeat_password': $('#repeat-password').val(),
        },
        beforeSend: function () {
            // 禁用按钮防止重复提交
            $("#button-reset-password").attr({disabled: "disabled"});
        },
        success: function (response) {
            // 判断是否有错误
            if (response.messages.length > 0) {
                layer.open({
                    content: response.messages[0],
                    btn: '我知道了'
                });
            } else {
                //提示
                layer.open({
                    content: '密码重置成功',
                    btn: '3秒后自动跳转',
                    time: 3, // 3秒后自动跳转
                });
                // 3秒后跳转
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }
        },
        complete: function () {
            $("#button-reset-password").removeAttr("disabled");
        },
    });
    // 禁止自动跳转
    return false;
}

/**
 * 添加地址
 * @returns {boolean}
 */
function address_add() {
    // ajax提交
    $.ajax({
        type: "post",
        url: "/memberaddress/add",
        async: true,
        dataType: 'json',
        data: {
            'username': $('#username').val(),
            'mobile': $('#mobile').val(),
            'address': $('#address').val(),
        },
        beforeSend: function () {
            // 禁用按钮防止重复提交
            $("#button-address-add").attr({disabled: "disabled"});
        },
        success: function (response) {
            // 判断是否有错误
            if (response.messages.length > 0) {
                layer.open({
                    content: response.messages[0],
                    btn: '我知道了'
                });
            } else {
                //提示
                layer.open({
                    content: '地址添加成功',
                    btn: '3秒后自动跳转',
                    time: 3, // 3秒后自动跳转
                });
                // 3秒后跳转
                setTimeout(function () {
                    window.location.href = '/memberaddress';
                }, 1000);
            }
        },
        complete: function () {
            $("#button-address-add").removeAttr("disabled");
        },
    });
    // 禁止自动跳转
    return false;
}


/**
 * 修改地址
 * @returns {boolean}
 */
function address_edit(id) {
    // ajax提交
    $.ajax({
        type: "post",
        url: "/memberaddress/edit/" + id,
        async: true,
        dataType: 'json',
        data: {
            'username': $('#username').val(),
            'mobile': $('#mobile').val(),
            'address': $('#address').val()
        },
        beforeSend: function () {
            // 禁用按钮防止重复提交
            $("#button-address-edit").attr({disabled: "disabled"});
        },
        success: function (response) {
            // 判断是否有错误
            if (response.messages.length > 0) {
                layer.open({
                    content: response.messages[0],
                    btn: '我知道了'
                });
            } else {
                //提示
                layer.open({
                    content: '地址修改成功',
                    btn: '3秒后自动跳转',
                    time: 3, // 3秒后自动跳转
                });
                // 3秒后跳转
                setTimeout(function () {
                    window.location.href = '/memberaddress';
                }, 1000);
            }
        },
        complete: function () {
            $("#button-address-edit").removeAttr("disabled");
        },
    });
    // 禁止自动跳转
    return false;
}


/**
 * 删除地址
 * @returns {boolean}
 */
function address_del(id) {
    // 询问框
    layer.open({
        content: '您真的要删除这个地址吗？删除不可逆，请三思而后行！',
        btn: ['是', '否'],
        yes: function (index) {
            // ajax提交
            $.post('/memberaddress/del/' + id, {}, function (response) {
                // 判断是否有错误
                if (response.messages.length > 0) {
                    layer.open({
                        content: response.messages[0],
                        btn: '我知道了'
                    });
                } else {
                    //提示
                    layer.open({
                        content: '地址删除成功',
                        btn: '3秒后自动跳转',
                        time: 3, // 3秒后自动跳转
                    });
                    // 3秒后跳转
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                }
            }, 'json');
            // 关闭弹出层
            layer.close(index);
        }
    });
}


/**
 * 地址设置为默认
 * @returns {boolean}
 */
function address_set_default(id) {
    // 询问框
    layer.open({
        content: '您真的要设置当前地址为默认吗？',
        btn: ['是', '否'],
        yes: function (index) {
            // ajax提交
            $.post('/memberaddress/setdefault/' + id, {}, function (response) {
                // 判断是否有错误
                if (response.messages.length > 0) {
                    layer.open({
                        content: response.messages[0],
                        btn: '我知道了'
                    });
                } else {
                    //提示
                    layer.open({
                        content: '设置默认地址成功',
                        btn: '3秒后自动跳转',
                        time: 3, // 3秒后自动跳转
                    });
                    // 3秒后跳转
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                }
            }, 'json');
            // 关闭弹出层
            layer.close(index);
        }
    });
}


/**
 * 加入购物车函数
 * @param obj 当前节点
 * @param id 操作id
 * @returns {boolean}
 */
function addbuycar(obj, id) {
    // 首先拿到所有的尺码input值
    var objParent = $(obj).parent().parent();
    var inputParent = objParent.next().next();
    var inputs = inputParent.find('input');
    // 保存最后的参数数组
    var sizecontentids = [];
    // 遍历获取值
    inputs.each(function () {
        sizecontentids[$(this).attr('data-id')] = $(this).val();
    });

    // ajax提交
    $.ajax({
        type: "post",
        url: "/buycar/add",
        async: true,
        dataType: 'json',
        data: {
            'sizecontentids': sizecontentids,
            'product_id': id,
        },
        success: function (result) {
            // 判断是否有错误
            if (result.messages.length > 0) {
                layer.open({
                    content: result.messages[0],
                    btn: '我知道了'
                });
            } else {
                // 提示
                layer.open({
                    content: '成功添加到购物车',
                    btn: "2秒后自动跳转",
                    time: 2, //2秒后自动跳转
                });
                // 3秒后跳转
                setTimeout(function () {
                    window.location.href = '/buycar';
                }, 1000);
            }
        }
    });

    // 禁止后续操作
    return false;
}

/**
 * 地址智能解析
 */
function smart() {
    let value = $('textarea').val();
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