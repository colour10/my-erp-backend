// 统计类js逻辑代码
// 首先进行必要的逻辑填充
$(function () {
    // 填充部门
    fillinDom('departmentid');
    // 填充年代
    fillinDom('ageseasonid');
});

/**
 * 获得form表单的formdata值
 * @param {string} formid form的id值
 * @return {object} 获得form表单的formdata值
 */
function getFormDataById(formid) {
    let form = document.getElementById(formid);
    return new FormData(form);
}

/**
 * 封装的ajax-post方法
 * 几乎每个页面都要用，所以进行了封装
 * @param {string} type 数据请求的方式(get/post)
 * @param {string} url 数据接收的地址
 * @param {object} fd 当前表单的FormData对象，或者是表单对象集合
 * @param {string} successFunctionName 页面执行成功后续的操作逻辑
 * @return {bool}
 */
function ajax(type = 'post', url = '', fd, successFunctionName) {
    // 处理逻辑
    $.ajax({
        type: type,
        url: url,
        data: fd,
        dataType: 'json',
        timeout: 99999,
        // 下面两个和delete方法冲突，但是post还是需要的
        // processData只对post有效
        processData: false,
        contentType: false,
        beforeSend: function () {
            index = layer.open({type: 2});
        },
        complete: function () {
            layer.close(index);
        },
        success: function (result) {
            // 判断逻辑
            // 判断是否有错误
            if (result.messages.length > 0) {
                layer.open({
                    content: result.messages[0],
                    btn: '我知道了'
                });
            } else {
                // 如果成功了之后的后续操作
                if (typeof (eval(successFunctionName)) == 'function') {
                    eval(successFunctionName + "(result);");
                }
            }
            // 返回假，禁止自动跳转
            return false;
        },
        // 如果出错了
        error: function () {
            layer.open({
                content: '程序内部错误，请联系管理员！',
                btn: '我知道了'
            });
            return false;
        },
    });
}

/**
 * 查询销售统计后续的操作
 * @param result
 */
function ajax_sales(result) {
    // 关闭模态框
    $('#myModal').modal('hide');

    // 开始填入数据
    // 导出按钮增加数据
    $('#button-export').before("<input type=\"hidden\" name=\"datas\" value='" + JSON.stringify(result.data) + "'>");

    // 取消表格隐藏
    let datas = $('.datas');
    // 初始化一个变量
    let html = '';
    // 统计列表
    let items = result.data.items;
    // 合计字段
    let total = result.data.total;
    // 表格表头
    html += '<tr><th>&nbsp;</th><th>件数</th><th>应收合计</th><th>实收金额</th><th>本币金额</th><th>折扣率</th><th>合计成本</th><th>毛利率</th><th>本币利润</th><th>件数占</th><th>金额占</th></tr>';
    // 循环获得表格内部内容
    for (let i = 0; i < items.length; i++) {
        html += "<tr>" +
            "<td>" +
            "<a href=\"javascript:void(0);\" data-id='" + items[i].id + "' data-value='" + JSON.stringify(items[i].details) + "' onclick=\"showSailDetail(this);\">" + items[i].name + "</a>" +
            "</td>" +
            "<td>" + items[i].sum_number + "</td>" +
            "<td>应收合计</td>" +
            "<td>" + items[i].sum_realprice + "</td>" +
            "<td>本币金额</td>" +
            "<td>折扣率</td>" +
            "<td>合计成本</td>" +
            "<td>毛利率</td>" +
            "<td>本币利润</td>" +
            "<td>" + items[i].rate_number + "</td>" +
            "<td>" + items[i].rate_price + "</td>" +
            "</tr>";
    }
    // 加入合计
    html += '<tr><td>合计</td><td>' + total.total_number + '</td><td>应收合计</td><td>' + total.total_realprice + '</td><td>本币金额</td><td>折扣率</td><td>合计成本</td><td>毛利率</td><td>本币利润</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
    // 开始填充
    datas.html(html);
    // 取消表格隐藏
    datas.show();
}

// 表单提交逻辑
function add_info() {
    // 开始提交
    $("#myModal").on("hidden.bs.modal", function () {
        $(this).removeData("bs.modal");
    });
    let form = getFormDataById('updateform');
    ajax('post', '/statistics/sales', form, 'ajax_sales');
}

// 选择销售起始和截止日期
function DatePicker(beginSelector, endSelector) {
    // 仅选择日期
    $(beginSelector).datepicker(
        {
            language: "zh-CN",
            autoclose: true,
            startView: 0,
            format: "yyyy-mm-dd",
            clearBtn: true,
            todayBtn: false,
            endDate: new Date()
        }).on('changeDate', function (ev) {
        if (ev.date) {
            $(endSelector).datepicker('setStartDate', new Date(ev.date.valueOf()));
        } else {
            $(endSelector).datepicker('setStartDate', null);
        }
    });

    $(endSelector).datepicker(
        {
            language: "zh-CN",
            autoclose: true,
            startView: 0,
            format: "yyyy-mm-dd",
            clearBtn: true,
            todayBtn: false,
            endDate: new Date()
        }).on('changeDate', function (ev) {
        if (ev.date) {
            $(beginSelector).datepicker('setEndDate', new Date(ev.date.valueOf()));
        } else {
            $(beginSelector).datepicker('setEndDate', new Date());
        }
    });
}

// 日期赋值
DatePicker("#start_salesdate", "#end_salesdate");
DatePicker("#start_stockdate", "#end_stockdate");

// 选择按钮统一封装方法
// 当第一次点击之后，生成总的节点，从而节约性能
function selectButtons(nodename) {
    // 解绑按钮，禁止重复点击
    $(this).unbind('click');
    // 先清空html dom
    let contentNode = $('#modal-tbody-' + nodename);
    contentNode.empty();
    // 取出已经选中的data-value列表
    let selectedNodename = $('#' + nodename).attr('data-value');
    // 如果有值，则转成对象
    if (selectedNodename) {
        selectedNodename = JSON.parse(selectedNodename);
    } else {
        selectedNodename = [];
    }
    // 名词加s变成复数形式
    let nodenames = nodename + 's';
    // 开始执行列表查询
    let result = getListByAjax(nodename);
    // 初始化
    let data = '';
    // 选择按钮
    if (result) {
        // 开始遍历
        // 交集添加checked
        let intersection = array_intersection(result, selectedNodename);
        for (let i = 0; i < intersection.length; i++) {
            data += '<tr><td><input name="' + nodenames + '[]" class="checkbox" type="checkbox" checked data-name="' + intersection[i].name + '" value="' + intersection[i].id + '"></td><td>' + intersection[i].name + '</td></tr>';
        }

        // 差集
        let diff = array_diff(result, selectedNodename);
        for (let j = 0; j < diff.length; j++) {
            data += '<tr><td><input name="' + nodenames + '[]" class="checkbox" type="checkbox" data-name="' + diff[j].name + '" value="' + diff[j].id + '"></td><td>' + diff[j].name + '</td></tr>';
        }

        // 赋值
        contentNode.html(data);
    }

    // 查询完毕显示模态框
    $('#modal-' + nodename).modal('show');
}

// 确认选择统一封装方法
function confirmButtons(nodename) {
    // 单击确认之后
    let nodeObj = $('#' + nodename);
    // id列表节点
    let ids = [];
    let values = [];
    // 确认逻辑
    // 开始遍历
    $("input[name='" + nodename + "s[]']:checked").each(function () {
        // 添加到数组
        ids.push($(this).val());
        values.push({
            "id": $(this).val(),
            "name": $(this).attr('data-name'),
        });
    });
    // 赋值
    nodeObj.val(JSON.stringify(ids));
    nodeObj.attr('data-value', JSON.stringify(values));
    // 关闭子窗口
    $('#modal-' + nodename).modal('hide');
}


/**
 * 通过ajax获取列表
 * @returns {boolean}
 */
function getListByAjax(nodename) {
    // 列表名称
    let nodelist = nodename + 'list';
    // 初始化一个变量
    let result = false;
    // 同步处理
    $.ajaxSetup({async: false});
    // 开始执行品牌列表查询
    $.get('/statistics/' + nodelist, function (response) {
        // 判断messages是否为空
        if (response.messages.length !== 0) {
            result = false;
        } else {
            result = response.data;
        }
    }, 'json');
    // 返回
    return result;
}

/**
 * 数组求交集
 * @param a 数组
 * @param b 数组
 * @returns {*} 新数组
 */
function array_intersection(a, b) {
    var result = [];
    for (let i = 0; i < a.length; i++) {
        var temp = a[i];
        for (let j = 0; j < b.length; j++) {
            if (JSON.stringify(temp) === JSON.stringify(b[j])) {
                result.push(b[j]);
                break;
            }
        }
    }
    return result;
}

/**
 * 数组求并集
 * @param a 数组
 * @param b 数组
 * @returns {*} 新数组
 */
function array_union(a, b) {
    // 逻辑
    // 定义临时变量
    let result = [];
    // 然后把数组合并
    for (let i = 0; i < a.length; i++) {
        result.push(a[i]);
    }
    for (let j = 0; j < b.length; j++) {
        result.push(b[j]);
    }
    // 返回
    return array_unique(result);
}

/**
 * 数组去重
 * @param a 数组
 * @returns {*} 去重之后的新数组
 */
function array_unique(a) {
    // 逻辑
    // 临时变量
    let result = [];
    // 最终返回
    let finalResult = [];
    for (let i = 0; i < a.length; i++) {
        // 定义临时变量
        let temp = a[i];
        if (!result[temp]) {
            result[temp] = temp;
        }
    }
    // 数组重新排列键名
    for (let j = 0; j < result.length; j++) {
        if (!isEmpty(result[j])) {
            finalResult.push(result[j]);
        }
    }
    // 最终返回
    return finalResult;
}

/**
 * 数组求差集
 * @param a 数组
 * @param b 数组
 * @returns {*} a和b的差集
 */
function array_diff(a, b) {
    // 逻辑
    // 创建一个临时变量，不允许直接修改原来的数组
    let c = a.slice(0);
    for (let i = 0; i < b.length; i++) {
        for (let j = 0; j < c.length; j++) {
            if (JSON.stringify(b[i]) === JSON.stringify(c[j])) {
                c.splice(j, 1);
                break;
            }
        }
    }
    // 返回
    return c;
}

/**
 * 判断字符是否为空的方法
 * @param obj
 * @returns {boolean}
 */
function isEmpty(obj) {
    if (typeof obj == "undefined" || obj == null || obj == "") {
        return true;
    } else {
        return false;
    }
}

/**
 * 判断是否为json字符串
 * @param str
 * @returns {boolean}
 */
function isJson(str) {
    if (typeof str == 'string') {
        try {
            var obj = JSON.parse(data);
            if (typeof obj == 'object' && obj) {
                return true;
            } else {
                return false;
            }
        } catch (e) {
            return false;
        }
    }
}

/**
 * 填充dom节点，只适用于单选按钮及下拉框
 * @param nodename
 */
function fillinDom(nodename) {
    // 填充部门
    let lists = getListByAjax(nodename);
    let data = '<option value="">== 请选择 ==</option>';
    for (let i = 0; i < lists.length; i++) {
        data += '<option value="' + lists[i].id + '">' + lists[i].name + '</option>';
    }
    // 开始填充
    $('#' + nodename).html(data);
}

/**
 * 提示信息【美化处理】
 * @param {string} msg 提示信息
 * @return {null}
 */
function prompt(msg) {
    var prompt_box = document.getElementsByClassName("prompt_box")[0];
    if (!prompt_box) {
        var html = "<div class='prompt_box'><span>" + msg + "</span></div>";
        $("body").append(html);
    } else {
        prompt_box.innerHTML = "<span>" + msg + "</span>";
    }

    // 3秒钟显示隐藏
    let prompt_box_obj = $(".prompt_box");
    prompt_box_obj.fadeIn(3000);
    prompt_box_obj.fadeOut(3000);
}

/**
 * 查看销售表详情页面
 * @param obj
 */
function showSailDetail(obj) {
    // 取出json字符串
    let json = $(obj).attr('data-value');
    // 转成json对象
    let detail = JSON.parse(json);
    // 开始填充数据
    let length = detail.length;
    let html = '';
    for (let i = 0; i < length; i++) {
        html +=
            '<tr>' +
            '<td><img style="width:20px; height:auto;" src="/upload/' + detail[i].picture + '" alt="' + detail[i].name + '"></td>' +
            '<td>' + detail[i].makedate + '</td>' +
            '<td>' + detail[i].membername + '</td>' +
            '<td>' + detail[i].wordcode + '</td>' +
            '<td>' + detail[i].productname + '</td>' +
            '<td>' + detail[i].seriesname + '</td>' +
            '<td>' + detail[i].ageseasonname + '</td>' +
            '<td>入库时not found</td>' +
            '<td>销售类型not found</td>' +
            '<td>' + detail[i].sizecontentname + '</td>' +
            '<td>' + detail[i].number + '</td>' +
            '<td>' + detail[i].price + '</td>' +
            '<td>' + detail[i].discount + '</td>' +
            '<td>' + detail[i].realprice + '</td>' +
            '<td>' + detail[i].sum_realprice + '</td>' +
            '<td>汇率not found</td>' +
            '<td>本币余额not found</td>' +
            '<td>成本not found</td>' +
            '<td>毛利率not found</td>' +
            '<td>本币利润not found</td>' +
            '<td>' + detail[i].saleportname + '</td>' +
            '<td>' + detail[i].salesstaffname + '</td>' +
            '<td>' + detail[i].makestaffname + '</td>' +
            '<td>' + detail[i].orderno + '</td>' +
            '<td>' + detail[i].ordercode + '</td>' +
            '<td>' + detail[i].receive_maketime + '</td>' +
            '<td>' + detail[i].receive_is_back + '</td>' +
            '<td>' + detail[i].receive_memo + '</td>' +
            '<td>' + detail[i].saleportname + '</td>' +
            '<td>' + detail[i].makestaffname + '</td>' +
            '<td>' + detail[i].status + '</td>' +
            '<td>发货日期not found</td>' +
            '<td>' + detail[i].expressno + '</td>' +
            '</tr>'
        ;
    }
    // 显示模态框
    $('#modal-saildetail').modal("show");
    // 把数据填充进去
    $("#modal-tbody-saildetail").html(html);
    // 导出按钮增加数据，首先判断input是否存在
    $('#datas-details').val(json);
}
