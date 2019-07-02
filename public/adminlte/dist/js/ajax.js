/**
 * ajax提交封装函数
 * @param button jquery-button对象
 * @param url ajax处理的url地址
 * @param data ajax数据，对象
 * @param locationUrl 成功后的跳转
 */
function ajax(button, url, data, locationUrl = '') {
    // ajax提交
    $.ajax({
        type: "post",
        url: url,
        async: true,
        dataType: 'json',
        data: data,
        beforeSend: function () {
            // 更改文字
            button.html("请稍候...");
            // 禁用按钮防止重复提交
            button.attr({disabled: "disabled"});
        },
        complete: function () {
            // 更改文字
            button.html("确认");
            // 恢复提交
            button.removeAttr("disabled");
        },
        success: function (result) {
            // 判断是否有错误
            if (result.messages.length > 0) {
                layer.open({
                    content: result.messages[0],
                    btn: "我知道了"
                });
            } else {
                //提示
                layer.open({
                    content: "操作成功",
                    btn: "请稍候...",
                    time: 3, // 3秒后自动跳转
                });
                // 3秒后跳转
                setTimeout(function () {
                    window.location.href = locationUrl;
                }, 1000);
            }
        }
    });
    // 禁止自动跳转
    return false;
}


/**
 * 显示点击后的细节
 * @param obj 对象节点
 */
function showdetails(obj) {
    let _this = $(obj);
    let name = _this.attr('data-name');
    let _name = '#modal-' + name + 'detail';
    let _body = '#modal-tbody-' + name + 'detail';
    // 填充数据
    // 取出json字符串
    let json = _this.attr('data-value');
    // 转成json对象
    let detail = JSON.parse(json);
    console.log(detail);
    let length = detail.length;
    let html = '';
    for (let i = 0; i < length; i++) {
        // 如果是user
        if (name === 'user') {
            html +=
                '<tr>' +
                '<td>' + detail[i].id + '</td>' +
                '<td>' + detail[i].login_name + '</td>' +
                '<td>' + detail[i].departmentname + '</td>' +
                '<td>' + detail[i].groupname + '</td>' +
                '<td>' + detail[i].companyname + '</td>' +
                '<td>' + detail[i].sex + '</td>' +
                '<td>' + detail[i].mobilephone + '</td>' +
                '<td>' + detail[i].e_mail + '</td>' +
                '<td>' + detail[i].address + '</td>' +
                '</tr>'
            ;
        } else if (name === 'member') {
            html +=
                '<tr>' +
                '<td>' + detail[i].id + '</td>' +
                '<td>' + detail[i].login_name + '</td>' +
                '<td>' + detail[i].companyname + '</td>' +
                '<td>' + detail[i].gendername + '</td>' +
                '<td>' + detail[i].phoneno + '</td>' +
                '<td>' + detail[i].email + '</td>' +
                '<td>' + detail[i].address + '</td>' +
                '</tr>'
            ;
        } else if (name === 'product') {
            html +=
                '<tr>' +
                '<td>' + detail[i].id + '</td>' +
                '<td>' + detail[i].productname + '</td>' +
                '<td>' + detail[i].wordcode_1 + detail[i].wordcode_2 + detail[i].wordcode_3 + detail[i].wordcode_4 + '</td>' +
                '<td>' + detail[i].seriesname + '</td>' +
                '<td>' + detail[i].ageseasonname + '</td>' +
                '<td>' + detail[i].gendername + '</td>' +
                '<td>' + detail[i].brandname + '</td>' +
                '<td>' + detail[i].brandgroupname + '</td>' +
                '<td>' + detail[i].maketime + '</td>' +
                '</tr>'
            ;
        }
    }
    // 显示模态框
    $(_name).modal("show");
    // 把数据填充进去
    $(_body).html(html);
}