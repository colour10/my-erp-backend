webpackJsonp([19],{313:function(e,t,i){"use strict";function n(e){i(440)}Object.defineProperty(t,"__esModule",{value:!0});var r=i(375),s=i(442),o=i(0),a=n,l=o(r.a,s.a,!1,a,null,null);t.default=l.exports},375:function(e,t,i){"use strict";var n=i(18),r=i.n(n),s=i(5),o=i.n(s),a=i(12),l=i.n(a),u=i(2),c=i(196);t.a={name:"sp-group",components:{"simple-admin-tablelist":c.a},data:function(){return{form:{id:"",companyid:"",group_name:"",group_memo:""},props:{columns:[{name:"group_name",label:Object(u.d)("zumingcheng"),is_focus:!0,width:200},{name:"group_memo",label:Object(u.d)("beizhu"),width:200,is_focus:!0}],controller:"group",authname:"group"},dialogVisible:!1,formTitle:"",rowIndex:"",row:"",group_list:[],user_list:[],permission_data:[],activeName:"info",dialogEditVisible:!1,dialogMultiEditVisible:!1,multipleSelection:[],currentUserId:"",currentUserIds:[],formLabelWidth:"120px",editPermissionTitle:Object(u.d)("quanxian"),multiEditPermissionTitle:Object(u.d)("quanxian"),editPermissionWidth:"30%"}},methods:{handleSelectionChange:function(e){this.multipleSelection=e},multiEdit:function(){var e=this;return l()(o.a.mark(function t(){var i,n,r;return o.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(i=e,0!==e.multipleSelection.length){t.next=3;break}return t.abrupt("return",e.$message.error(Object(u.d)("least-one-select")));case 3:return e.multipleSelection.forEach(function(t){e.currentUserIds.push(t.id)}),t.next=6,i._fetch("/user/currentpermissions",{user_id:e.currentUserIds[0]});case 6:n=t.sent,r=n.data.groupPermissions.map(function(e){return e.permissionid}),setTimeout(function(){i.$refs.tree.setCheckedKeys(r)},100),e.showMultiEditPermission();case 10:case"end":return t.stop()}},t,e)}))()},onMultiEditPermissionSavePermission:function(){var e=this,t=e.$refs.tree.getCheckedKeys(!0);e._submit("/user/multipermissionsetting",{userIds:this.currentUserIds.join(","),keys:t.join(",")}).then(function(t){e._log(t)}),this.currentUserIds=[],this.onMultiEditPermissionQuit()},showMultiEditPermission:function(){this.dialogMultiEditVisible=!0},onMultiEditPermissionQuit:function(){this.dialogMultiEditVisible=!1},handleEditUser:function(e,t){var i=this;return l()(o.a.mark(function e(){var n,r,s;return o.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return n=i,i.getPermissionData(),e.next=4,n._fetch("/user/currentpermissions",{user_id:t.id});case 4:r=e.sent,s=r.data.groupPermissions.map(function(e){return e.permissionid}),setTimeout(function(){n.$refs.tree.setCheckedKeys(s)},100),i.currentUserId=t.id,i.showDialogEditPermission();case 9:case"end":return e.stop()}},e,i)}))()},onEditPermissionQuit:function(){this.dialogEditVisible=!1},showDialogEditPermission:function(){this.dialogEditVisible=!0},onEditPermissionSavePermission:function(){var e=this,t=e.$refs.tree.getCheckedKeys(!0);e._submit("/user/permissionsetting",{userid:this.currentUserId,keys:t.join(",")}).then(function(t){e._log(t)}),this.onEditPermissionQuit()},onQuit:function(){this.dialogVisible=!1,this.multipleSelection=[]},handleDeleteUser:function(e,t){var i=this;i._remove("/user/deletegroup",{groupid:"",id:t.id}).then(function(t){t&&i.$delete(i.user_list,e)})},onTabClick:function(e){this.getGroupList()},getGroupList:function(){var e=this;e._fetch("/l/user",{groupid:e.form.id}).then(function(t){e.user_list=t.data})},onSavePermission:function(){var e=this,t=e.$refs.tree.getCheckedKeys(!0);e._submit("/group/setting",{groupid:e.form.id,keys:t.join(",")}).then(function(t){e._log(t)})},onSubmit:function(){var e=this;""==e.form.id?e._submit("/"+props.controller+"/add",e.form).then(function(){e.$refs.tablelist.appendRow(u.f.clone(e.form))}):e._submit("/"+props.controller+"/edit",e.form).then(function(){u.f.copyTo(e.form,e.row)})},showFormToCreate:function(){var e=this;u.f.empty(e.form),e.base&&r()(e.base).forEach(function(t){e.form[t]=e.base[t]}),e.formTitle=Object(u.d)("tianjiaxinxi"),e.activeName="info",e.showDialog()},showFormToEdit:function(e,t){var i=this;return l()(o.a.mark(function n(){var r,s,a;return o.a.wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return r=i,r.rowIndex=e,r.row=t,u.f.copyTo(t,i.form),i.formTitle=Object(u.d)("xiugaixinxi"),n.next=7,r._fetch("/group/getpermissions",{groupid:r.form.id});case 7:s=n.sent,r._log(s),a=s.data.map(function(e){return e.permissionid}),setTimeout(function(){r.$refs.tree.setCheckedKeys(a)},100),r.showDialog();case 12:case"end":return n.stop()}},n,i)}))()},showDialog:function(){var e=this;e.dialogVisible=!0,setTimeout(function(){for(var t=props.columns,i=0;i<t.length;i++){var n=t[i],r=e.$refs[n.name][0];if(n.is_focus&&!r.disabled){r.focus();break}}},50),e.getGroupList()},isFormDisabled:function(e){var t=this.form;return""===t.id&&!e.is_create||""!==t.id&&!e.is_update},getPermissionData:function(){var e=this;return l()(o.a.mark(function t(){var i,n;return o.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return i=e,t.next=3,i._fetch("/permission/tree",{});case 3:n=t.sent,i.permission_data=n.data;case 5:case"end":return t.stop()}},t,e)}))()}},mounted:function(){function e(){return t.apply(this,arguments)}var t=l()(o.a.mark(function e(){return o.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:this.getPermissionData();case 1:case"end":return e.stop()}},e,this)}));return e}()}},440:function(e,t,i){var n=i(441);"string"==typeof n&&(n=[[e.i,n,""]]),n.locals&&(e.exports=n.locals);i(75)("c6f8a6c8",n,!0,{})},441:function(e,t,i){t=e.exports=i(74)(!1),t.push([e.i,".el-date-editor.el-input__inner,.user-form .el-date-editor.el-input,.user-form .el-input__inner{width:200px}",""])},442:function(e,t,i){"use strict";var n=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",[i("el-row",[i("el-col",{attrs:{span:2}},[i("auth",{attrs:{auth:"group"}},[i("as-button",{attrs:{type:"primary"},on:{click:function(t){return e.showFormToCreate()}}},[e._v(e._s(e._label("xinjian")))])],1)],1)],1),e._v(" "),i("el-row",{attrs:{gutter:20}},[i("el-col",{attrs:{span:24}},[i("simple-admin-tablelist",e._b({ref:"tablelist",attrs:{onclickupdate:e.showFormToEdit}},"simple-admin-tablelist",e.props,!1))],1)],1),e._v(" "),i("el-dialog",{staticClass:"user-form",attrs:{title:e.formTitle,visible:e.dialogVisible,center:!0,width:"60%",modal:!1},on:{"update:visible":function(t){e.dialogVisible=t}}},[i("el-tabs",{attrs:{type:"border-card"},on:{"tab-click":e.onTabClick},model:{value:e.activeName,callback:function(t){e.activeName=t},expression:"activeName"}},[i("el-tab-pane",{attrs:{label:e._label("group-info"),name:"info"}},[i("el-form",{ref:"form",attrs:{model:e.form,"label-width":"100px"}},[e._l(e.props.columns,function(t){return t.is_hidden?e._e():i("el-form-item",{key:t.name,attrs:{label:t.label}},[t.type&&"input"!=t.type?e._e():i("el-input",{ref:t.name,refInFor:!0,nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.onSubmit(t)}},model:{value:e.form[t.name],callback:function(i){e.$set(e.form,t.name,i)},expression:"form[item.name]"}})],1)}),e._v(" "),i("el-form-item",[i("auth",{attrs:{auth:"group"}},[i("as-button",{attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v(e._s(e._label("baocun")))])],1),e._v(" "),i("as-button",{attrs:{type:"primary"},on:{click:e.onQuit}},[e._v(e._s(e._label("tuichu")))])],1)],2)],1),e._v(" "),i("el-tab-pane",{attrs:{label:e._label("quanxian"),disabled:!e.form.id}},[i("el-tree",{ref:"tree",attrs:{data:e.permission_data,"node-key":"id","show-checkbox":"","expand-on-click-node":!1}}),e._v(" "),i("auth",{attrs:{auth:"group"}},[i("as-button",{attrs:{type:"primary"},on:{click:e.onSavePermission}},[e._v(e._s(e._label("baocun")))])],1),e._v(" "),i("as-button",{attrs:{type:"primary"},on:{click:e.onQuit}},[e._v(e._s(e._label("tuichu")))])],1),e._v(" "),i("el-tab-pane",{attrs:{label:e._label("zuneirenyuan"),name:"user-list",disabled:!e.form.id}},[i("el-table",{staticStyle:{width:"100%"},attrs:{data:e.user_list,stripe:"",border:""},on:{"selection-change":e.handleSelectionChange}},[i("el-table-column",{attrs:{type:"selection",width:"55"}}),e._v(" "),i("el-table-column",{attrs:{prop:"login_name",label:e._label("dengluming"),align:"center",width:"180"}}),e._v(" "),i("el-table-column",{attrs:{prop:"real_name",label:e._label("xingming"),align:"center",width:"180"}}),e._v(" "),i("el-table-column",{attrs:{label:e._label("caozuo"),width:"150",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[i("auth",{attrs:{auth:"group"}},[i("as-button",{attrs:{size:"mini",type:"default"},on:{click:function(i){return e.handleEditUser(t.$index,t.row)}}},[e._v("\n                  "+e._s(e._label("bianji"))+"\n                ")])],1),e._v(" "),i("auth",{attrs:{auth:"group"}},[i("as-button",{attrs:{size:"mini",type:"danger"},on:{click:function(i){return e.handleDeleteUser(t.$index,t.row)}}},[e._v("\n                  "+e._s(e._label("shanchu"))+"\n                ")])],1)]}}])})],1),e._v(" "),i("el-row",[i("el-col",{staticStyle:{"text-align":"center","margin-top":"1em"},attrs:{span:24}},[i("as-button",{attrs:{type:"default"},on:{click:e.multiEdit}},[e._v(e._s(e._label("multiEdit")))]),e._v(" "),i("as-button",{attrs:{type:"primary"},on:{click:e.onQuit}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1)],1),e._v(" "),i("el-dialog",{attrs:{title:e.editPermissionTitle,visible:e.dialogEditVisible,width:e.editPermissionWidth,currentUserId:e.currentUserId},on:{"update:visible":function(t){e.dialogEditVisible=t}}},[i("el-tree",{ref:"tree",attrs:{data:e.permission_data,"node-key":"id","show-checkbox":"","expand-on-click-node":!1}}),e._v(" "),i("auth",{attrs:{auth:"group"}},[i("as-button",{attrs:{type:"primary"},on:{click:e.onEditPermissionSavePermission}},[e._v(e._s(e._label("baocun")))])],1),e._v(" "),i("as-button",{attrs:{type:"primary"},on:{click:e.onEditPermissionQuit}},[e._v(e._s(e._label("tuichu")))])],1),e._v(" "),i("el-dialog",{attrs:{title:e.multiEditPermissionTitle,visible:e.dialogMultiEditVisible,width:e.editPermissionWidth,currentUserIds:e.currentUserIds},on:{"update:visible":function(t){e.dialogMultiEditVisible=t}}},[i("el-tree",{ref:"tree",attrs:{data:e.permission_data,"node-key":"id","show-checkbox":"","expand-on-click-node":!1}}),e._v(" "),i("auth",{attrs:{auth:"group"}},[i("as-button",{attrs:{type:"primary"},on:{click:e.onMultiEditPermissionSavePermission}},[e._v(e._s(e._label("baocun")))])],1),e._v(" "),i("as-button",{attrs:{type:"primary"},on:{click:e.onMultiEditPermissionQuit}},[e._v(e._s(e._label("tuichu")))])],1)],1)},r=[],s={render:n,staticRenderFns:r};t.a=s}});