webpackJsonp([25],{288:function(o,s,t){"use strict";Object.defineProperty(s,"__esModule",{value:!0});var r=t(393),e=t(488),a=t(0),n=a(r.a,e.a,!1,null,null,null);s.default=n.exports},393:function(o,s,t){"use strict";s.a={name:"asapage-usermodifypassword",data:function(){return{form:{old_password:"",new_password:"",confirm_password:""}}},methods:{resetForm:function(){var o=this.form;o.old_password="",o.new_password="",o.confirm_password=""},submitForm:function(){var o=this;o._submit("/user/modifypassword",o.form).then(function(){})}},mounted:function(){this._setTitle(this._label("xiugaimima"))}}},488:function(o,s,t){"use strict";var r=function(){var o=this,s=o.$createElement,t=o._self._c||s;return t("el-form",{attrs:{"status-icon":"","label-width":"100px"}},[t("el-form-item",{attrs:{label:"旧密码",prop:"pass"}},[t("el-input",{attrs:{type:"password",autocomplete:"off"},model:{value:o.form.old_password,callback:function(s){o.$set(o.form,"old_password",s)},expression:"form.old_password"}})],1),o._v(" "),t("el-form-item",{attrs:{label:"新密码",prop:"pass"}},[t("el-input",{attrs:{type:"password",autocomplete:"off"},model:{value:o.form.new_password,callback:function(s){o.$set(o.form,"new_password",s)},expression:"form.new_password"}})],1),o._v(" "),t("el-form-item",{attrs:{label:"确认密码",prop:"checkPass"}},[t("el-input",{attrs:{type:"password",autocomplete:"off"},model:{value:o.form.confirm_password,callback:function(s){o.$set(o.form,"confirm_password",s)},expression:"form.confirm_password"}})],1),o._v(" "),t("el-form-item",[t("as-button",{attrs:{type:"primary"},on:{click:function(s){return o.submitForm()}}},[o._v("提交")]),o._v(" "),t("as-button",{on:{click:function(s){return o.resetForm()}}},[o._v("重置")])],1)],1)},e=[],a={render:r,staticRenderFns:e};s.a=a}});