webpackJsonp([15],{277:function(e,t,i){"use strict";function n(e){i(431)}Object.defineProperty(t,"__esModule",{value:!0});var r=i(365),s=i(433),o=i(0),a=n,u=o(r.a,s.a,!1,a,null,null);t.default=u.exports},309:function(e,t){function i(e,t){var i=e[1]||"",r=e[3];if(!r)return i;if(t&&"function"==typeof btoa){var s=n(r);return[i].concat(r.sources.map(function(e){return"/*# sourceURL="+r.sourceRoot+e+" */"})).concat([s]).join("\n")}return[i].join("\n")}function n(e){return"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(e))))+" */"}e.exports=function(e){var t=[];return t.toString=function(){return this.map(function(t){var n=i(t,e);return t[2]?"@media "+t[2]+"{"+n+"}":n}).join("")},t.i=function(e,i){"string"==typeof e&&(e=[[null,e,""]]);for(var n={},r=0;r<this.length;r++){var s=this[r][0];"number"==typeof s&&(n[s]=!0)}for(r=0;r<e.length;r++){var o=e[r];"number"==typeof o[0]&&n[o[0]]||(i&&!o[2]?o[2]=i:i&&(o[2]="("+o[2]+") and ("+i+")"),t.push(o))}},t}},310:function(e,t,i){function n(e){for(var t=0;t<e.length;t++){var i=e[t],n=c[i.id];if(n){n.refs++;for(var r=0;r<n.parts.length;r++)n.parts[r](i.parts[r]);for(;r<i.parts.length;r++)n.parts.push(s(i.parts[r]));n.parts.length>i.parts.length&&(n.parts.length=i.parts.length)}else{for(var o=[],r=0;r<i.parts.length;r++)o.push(s(i.parts[r]));c[i.id]={id:i.id,refs:1,parts:o}}}}function r(){var e=document.createElement("style");return e.type="text/css",d.appendChild(e),e}function s(e){var t,i,n=document.querySelector("style["+v+'~="'+e.id+'"]');if(n){if(m)return h;n.parentNode.removeChild(n)}if(_){var s=p++;n=f||(f=r()),t=o.bind(null,n,s,!1),i=o.bind(null,n,s,!0)}else n=r(),t=a.bind(null,n),i=function(){n.parentNode.removeChild(n)};return t(e),function(n){if(n){if(n.css===e.css&&n.media===e.media&&n.sourceMap===e.sourceMap)return;t(e=n)}else i()}}function o(e,t,i,n){var r=i?"":n.css;if(e.styleSheet)e.styleSheet.cssText=g(t,r);else{var s=document.createTextNode(r),o=e.childNodes;o[t]&&e.removeChild(o[t]),o.length?e.insertBefore(s,o[t]):e.appendChild(s)}}function a(e,t){var i=t.css,n=t.media,r=t.sourceMap;if(n&&e.setAttribute("media",n),b.ssrId&&e.setAttribute(v,t.id),r&&(i+="\n/*# sourceURL="+r.sources[0]+" */",i+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(r))))+" */"),e.styleSheet)e.styleSheet.cssText=i;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(i))}}var u="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!u)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var l=i(312),c={},d=u&&(document.head||document.getElementsByTagName("head")[0]),f=null,p=0,m=!1,h=function(){},b=null,v="data-vue-ssr-id",_="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());e.exports=function(e,t,i,r){m=i,b=r||{};var s=l(e,t);return n(s),function(t){for(var i=[],r=0;r<s.length;r++){var o=s[r],a=c[o.id];a.refs--,i.push(a)}t?(s=l(e,t),n(s)):s=[];for(var r=0;r<i.length;r++){var a=i[r];if(0===a.refs){for(var u=0;u<a.parts.length;u++)a.parts[u]();delete c[a.id]}}}};var g=function(){var e=[];return function(t,i){return e[t]=i,e.filter(Boolean).join("\n")}}()},312:function(e,t){e.exports=function(e,t){for(var i=[],n={},r=0;r<t.length;r++){var s=t[r],o=s[0],a=s[1],u=s[2],l=s[3],c={id:e+":"+r,css:a,media:u,sourceMap:l};n[o]?n[o].parts.push(c):i.push(n[o]={id:o,parts:[c]})}return i}},365:function(e,t,i){"use strict";var n=i(18),r=i.n(n),s=i(5),o=i.n(s),a=i(10),u=i.n(a),l=i(2),c=i(184),d={columns:[{name:"group_name",label:Object(l.d)("zumingcheng"),is_focus:!0,width:200},{name:"group_memo",label:"备注",width:200,is_focus:!0}],controller:"group",authname:"group"};t.a={name:"sp-group",components:{"simple-admin-tablelist":c.a},data:function(){return{form:{id:"",companyid:"",group_name:"",group_memo:""},props:d,dialogVisible:!1,formTitle:"",rowIndex:"",row:"",group_list:[],user_list:[],permission_data:[],activeName:"info",dialogEditVisible:!1,dialogMultiEditVisible:!1,multipleSelection:[],currentUserId:"",currentUserIds:[],formLabelWidth:"120px",editPermissionTitle:Object(l.d)("quanxian"),multiEditPermissionTitle:Object(l.d)("quanxian"),editPermissionWidth:"30%"}},methods:{handleSelectionChange:function(e){this.multipleSelection=e},multiEdit:function(){var e=this;return u()(o.a.mark(function t(){var i,n,r;return o.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(i=e,0!==e.multipleSelection.length){t.next=3;break}return t.abrupt("return",e.$message.error(Object(l.d)("least-one-select")));case 3:return e.multipleSelection.forEach(function(t){e.currentUserIds.push(t.id)}),t.next=6,i._fetch("/user/currentpermissions",{user_id:e.currentUserIds[0]});case 6:n=t.sent,r=n.data.groupPermissions.map(function(e){return e.permissionid}),setTimeout(function(){i.$refs.tree.setCheckedKeys(r)},100),e.showMultiEditPermission();case 10:case"end":return t.stop()}},t,e)}))()},onMultiEditPermissionSavePermission:function(){var e=this,t=e.$refs.tree.getCheckedKeys(!0);e._submit("/user/multipermissionsetting",{userIds:this.currentUserIds.join(","),keys:t.join(",")}).then(function(t){e._log(t)}),this.currentUserIds=[],this.onMultiEditPermissionQuit()},showMultiEditPermission:function(){this.dialogMultiEditVisible=!0},onMultiEditPermissionQuit:function(){this.dialogMultiEditVisible=!1},handleEditUser:function(e,t){var i=this;return u()(o.a.mark(function e(){var n,r,s;return o.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return n=i,i.getPermissionData(),e.next=4,n._fetch("/user/currentpermissions",{user_id:t.id});case 4:r=e.sent,s=r.data.groupPermissions.map(function(e){return e.permissionid}),setTimeout(function(){n.$refs.tree.setCheckedKeys(s)},100),i.currentUserId=t.id,i.showDialogEditPermission();case 9:case"end":return e.stop()}},e,i)}))()},onEditPermissionQuit:function(){this.dialogEditVisible=!1},showDialogEditPermission:function(){this.dialogEditVisible=!0},onEditPermissionSavePermission:function(){var e=this,t=e.$refs.tree.getCheckedKeys(!0);e._submit("/user/permissionsetting",{userid:this.currentUserId,keys:t.join(",")}).then(function(t){e._log(t)}),this.onEditPermissionQuit()},onQuit:function(){this.dialogVisible=!1,this.multipleSelection=[]},handleDeleteUser:function(e,t){var i=this;i._remove("/user/deletegroup",{groupid:"",id:t.id}).then(function(t){t&&i.$delete(i.user_list,e)})},onTabClick:function(e){var t=this;t._fetch("/l/user",{groupid:t.form.id}).then(function(e){t.user_list=e.data})},onSavePermission:function(){var e=this,t=e.$refs.tree.getCheckedKeys(!0);e._submit("/group/setting",{groupid:e.form.id,keys:t.join(",")}).then(function(t){e._log(t)})},onSubmit:function(){var e=this;""==e.form.id?e._submit("/"+d.controller+"/add",e.form).then(function(){e.$refs.tablelist.appendRow(l.f.clone(e.form))}):e._submit("/"+d.controller+"/edit",e.form).then(function(){l.f.copyTo(e.form,e.row)})},showFormToCreate:function(){var e=this;l.f.empty(e.form),e.base&&r()(e.base).forEach(function(t){e.form[t]=e.base[t]}),e.formTitle=Object(l.d)("tianjiaxinxi"),e.activeName="info",e.showDialog()},showFormToEdit:function(e,t){var i=this;return u()(o.a.mark(function n(){var r,s,a;return o.a.wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return r=i,r.rowIndex=e,r.row=t,l.f.copyTo(t,i.form),i.formTitle=Object(l.d)("xiugaixinxi"),n.next=7,r._fetch("/group/getpermissions",{groupid:r.form.id});case 7:s=n.sent,r._log(s),a=s.data.map(function(e){return e.permissionid}),setTimeout(function(){r.$refs.tree.setCheckedKeys(a)},100),r.showDialog();case 12:case"end":return n.stop()}},n,i)}))()},showDialog:function(){var e=this;e.dialogVisible=!0,setTimeout(function(){for(var t=d.columns,i=0;i<t.length;i++){var n=t[i],r=e.$refs[n.name][0];if(n.is_focus&&!r.disabled){r.focus();break}}},50)},isFormDisabled:function(e){var t=this.form;return""===t.id&&!e.is_create||""!==t.id&&!e.is_update},getPermissionData:function(){var e=this;return u()(o.a.mark(function t(){var i,n;return o.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return i=e,t.next=3,i._fetch("/permission/tree",{});case 3:n=t.sent,i.permission_data=n.data;case 5:case"end":return t.stop()}},t,e)}))()}},mounted:function(){function e(){return t.apply(this,arguments)}var t=u()(o.a.mark(function e(){return o.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:this.getPermissionData();case 1:case"end":return e.stop()}},e,this)}));return e}()}},431:function(e,t,i){var n=i(432);"string"==typeof n&&(n=[[e.i,n,""]]),n.locals&&(e.exports=n.locals);i(310)("5d47f5a0",n,!0,{})},432:function(e,t,i){t=e.exports=i(309)(!1),t.push([e.i,".el-date-editor.el-input__inner,.user-form .el-date-editor.el-input,.user-form .el-input__inner{width:200px}",""])},433:function(e,t,i){"use strict";var n=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",[i("el-row",[i("el-col",{attrs:{span:2}},[i("auth",{attrs:{auth:"group"}},[i("as-button",{attrs:{type:"primary"},on:{click:function(t){return e.showFormToCreate()}}},[e._v(e._s(e._label("xinjian")))])],1)],1)],1),e._v(" "),i("el-row",{attrs:{gutter:20}},[i("el-col",{attrs:{span:24}},[i("simple-admin-tablelist",e._b({ref:"tablelist",attrs:{onclickupdate:e.showFormToEdit}},"simple-admin-tablelist",e.props,!1))],1)],1),e._v(" "),i("el-dialog",{staticClass:"user-form",attrs:{title:e.formTitle,visible:e.dialogVisible,center:!0,width:"60%",modal:!1},on:{"update:visible":function(t){e.dialogVisible=t}}},[i("el-tabs",{attrs:{type:"border-card"},on:{"tab-click":e.onTabClick},model:{value:e.activeName,callback:function(t){e.activeName=t},expression:"activeName"}},[i("el-tab-pane",{attrs:{label:e._label("group-info"),name:"info"}},[i("el-form",{ref:"form",attrs:{model:e.form,"label-width":"100px"}},[e._l(e.props.columns,function(t){return t.is_hidden?e._e():i("el-form-item",{key:t.name,attrs:{label:t.label}},[t.type&&"input"!=t.type?e._e():i("el-input",{ref:t.name,refInFor:!0,nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.onSubmit(t)}},model:{value:e.form[t.name],callback:function(i){e.$set(e.form,t.name,i)},expression:"form[item.name]"}})],1)}),e._v(" "),i("el-form-item",[i("auth",{attrs:{auth:"group"}},[i("as-button",{attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v(e._s(e._label("baocun")))])],1),e._v(" "),i("as-button",{attrs:{type:"primary"},on:{click:e.onQuit}},[e._v(e._s(e._label("tuichu")))])],1)],2)],1),e._v(" "),i("el-tab-pane",{attrs:{label:e._label("quanxian"),disabled:!e.form.id}},[i("el-tree",{ref:"tree",attrs:{data:e.permission_data,"node-key":"id","show-checkbox":"","expand-on-click-node":!1}}),e._v(" "),i("auth",{attrs:{auth:"group"}},[i("as-button",{attrs:{type:"primary"},on:{click:e.onSavePermission}},[e._v(e._s(e._label("baocun")))])],1),e._v(" "),i("as-button",{attrs:{type:"primary"},on:{click:e.onQuit}},[e._v(e._s(e._label("tuichu")))])],1),e._v(" "),i("el-tab-pane",{attrs:{label:e._label("zuneirenyuan"),name:"user-list",disabled:!e.form.id}},[i("el-table",{staticStyle:{width:"100%"},attrs:{data:e.user_list,stripe:"",border:""},on:{"selection-change":e.handleSelectionChange}},[i("el-table-column",{attrs:{type:"selection",width:"55"}}),e._v(" "),i("el-table-column",{attrs:{prop:"login_name",label:e._label("dengluming"),align:"center",width:"180"}}),e._v(" "),i("el-table-column",{attrs:{prop:"real_name",label:e._label("xingming"),align:"center",width:"180"}}),e._v(" "),i("el-table-column",{attrs:{label:e._label("caozuo"),width:"150",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[i("auth",{attrs:{auth:"group"}},[i("as-button",{attrs:{size:"mini",type:"default"},on:{click:function(i){return e.handleEditUser(t.$index,t.row)}}},[e._v("\n                  "+e._s(e._label("bianji"))+"\n                ")])],1),e._v(" "),i("auth",{attrs:{auth:"group"}},[i("as-button",{attrs:{size:"mini",type:"danger"},on:{click:function(i){return e.handleDeleteUser(t.$index,t.row)}}},[e._v("\n                  "+e._s(e._label("shanchu"))+"\n                ")])],1)]}}])})],1),e._v(" "),i("el-row",[i("el-col",{staticStyle:{"text-align":"center"},attrs:{span:24}},[i("as-button",{attrs:{type:"default"},on:{click:e.multiEdit}},[e._v(e._s(e._label("multiEdit")))]),e._v(" "),i("as-button",{attrs:{type:"primary"},on:{click:e.onQuit}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1)],1),e._v(" "),i("el-dialog",{attrs:{title:e.editPermissionTitle,visible:e.dialogEditVisible,width:e.editPermissionWidth,currentUserId:e.currentUserId},on:{"update:visible":function(t){e.dialogEditVisible=t}}},[i("el-tree",{ref:"tree",attrs:{data:e.permission_data,"node-key":"id","show-checkbox":"","expand-on-click-node":!1}}),e._v(" "),i("auth",{attrs:{auth:"group"}},[i("as-button",{attrs:{type:"primary"},on:{click:e.onEditPermissionSavePermission}},[e._v(e._s(e._label("baocun")))])],1),e._v(" "),i("as-button",{attrs:{type:"primary"},on:{click:e.onEditPermissionQuit}},[e._v(e._s(e._label("tuichu")))])],1),e._v(" "),i("el-dialog",{attrs:{title:e.multiEditPermissionTitle,visible:e.dialogMultiEditVisible,width:e.editPermissionWidth,currentUserIds:e.currentUserIds},on:{"update:visible":function(t){e.dialogMultiEditVisible=t}}},[i("el-tree",{ref:"tree",attrs:{data:e.permission_data,"node-key":"id","show-checkbox":"","expand-on-click-node":!1}}),e._v(" "),i("auth",{attrs:{auth:"group"}},[i("as-button",{attrs:{type:"primary"},on:{click:e.onMultiEditPermissionSavePermission}},[e._v(e._s(e._label("baocun")))])],1),e._v(" "),i("as-button",{attrs:{type:"primary"},on:{click:e.onMultiEditPermissionQuit}},[e._v(e._s(e._label("tuichu")))])],1)],1)},r=[],s={render:n,staticRenderFns:r};t.a=s}});