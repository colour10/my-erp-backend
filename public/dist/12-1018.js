webpackJsonp([12],{296:function(o,s,r){"use strict";Object.defineProperty(s,"__esModule",{value:!0});var t=r(334),e=r(380),a=r(0),n=a(t.a,e.a,!1,null,null,null);s.default=n.exports},334:function(o,s,r){"use strict";s.a={name:"asapage-usermodifypassword",components:{},data:function(){return{form:{old_password:"",new_password:"",confirm_password:""}}},methods:{resetForm:function(){var o=this.form;o.old_password="",o.new_password="",o.confirm_password=""},submitForm:function(){var o=this;o._submit("/user/modifypassword",o.form).then(function(){})}}}},380:function(o,s,r){"use strict";var t=function(){var o=this,s=o.$createElement,r=o._self._c||s;return r("el-form",{attrs:{"status-icon":"","label-width":"100px"}},[r("el-form-item",{attrs:{label:"旧密码",prop:"pass"}},[r("el-input",{attrs:{type:"password",autocomplete:"off"},model:{value:o.form.old_password,callback:function(s){o.$set(o.form,"old_password",s)},expression:"form.old_password"}})],1),o._v(" "),r("el-form-item",{attrs:{label:"新密码",prop:"pass"}},[r("el-input",{attrs:{type:"password",autocomplete:"off"},model:{value:o.form.new_password,callback:function(s){o.$set(o.form,"new_password",s)},expression:"form.new_password"}})],1),o._v(" "),r("el-form-item",{attrs:{label:"确认密码",prop:"checkPass"}},[r("el-input",{attrs:{type:"password",autocomplete:"off"},model:{value:o.form.confirm_password,callback:function(s){o.$set(o.form,"confirm_password",s)},expression:"form.confirm_password"}})],1),o._v(" "),r("el-form-item",[r("as-button",{attrs:{type:"primary"},on:{click:function(s){return o.submitForm()}}},[o._v("提交")]),o._v(" "),r("as-button",{on:{click:function(s){return o.resetForm()}}},[o._v("重置")])],1)],1)},e=[],a={render:t,staticRenderFns:e};s.a=a}});
//# sourceMappingURL=12-1018.js.map