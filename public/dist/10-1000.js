webpackJsonp([10],{277:function(e,t,n){"use strict";function r(e){n(392)}Object.defineProperty(t,"__esModule",{value:!0});var i=n(342),o=n(394),a=n(0),s=r,l=a(i.a,o.a,!1,s,null,null);t.default=l.exports},307:function(e,t){function n(e,t){var n=e[1]||"",i=e[3];if(!i)return n;if(t&&"function"==typeof btoa){var o=r(i);return[n].concat(i.sources.map(function(e){return"/*# sourceURL="+i.sourceRoot+e+" */"})).concat([o]).join("\n")}return[n].join("\n")}function r(e){return"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(e))))+" */"}e.exports=function(e){var t=[];return t.toString=function(){return this.map(function(t){var r=n(t,e);return t[2]?"@media "+t[2]+"{"+r+"}":r}).join("")},t.i=function(e,n){"string"==typeof e&&(e=[[null,e,""]]);for(var r={},i=0;i<this.length;i++){var o=this[i][0];"number"==typeof o&&(r[o]=!0)}for(i=0;i<e.length;i++){var a=e[i];"number"==typeof a[0]&&r[a[0]]||(n&&!a[2]?a[2]=n:n&&(a[2]="("+a[2]+") and ("+n+")"),t.push(a))}},t}},308:function(e,t,n){function r(e){for(var t=0;t<e.length;t++){var n=e[t],r=c[n.id];if(r){r.refs++;for(var i=0;i<r.parts.length;i++)r.parts[i](n.parts[i]);for(;i<n.parts.length;i++)r.parts.push(o(n.parts[i]));r.parts.length>n.parts.length&&(r.parts.length=n.parts.length)}else{for(var a=[],i=0;i<n.parts.length;i++)a.push(o(n.parts[i]));c[n.id]={id:n.id,refs:1,parts:a}}}}function i(){var e=document.createElement("style");return e.type="text/css",f.appendChild(e),e}function o(e){var t,n,r=document.querySelector("style["+v+'~="'+e.id+'"]');if(r){if(m)return h;r.parentNode.removeChild(r)}if(_){var o=p++;r=d||(d=i()),t=a.bind(null,r,o,!1),n=a.bind(null,r,o,!0)}else r=i(),t=s.bind(null,r),n=function(){r.parentNode.removeChild(r)};return t(e),function(r){if(r){if(r.css===e.css&&r.media===e.media&&r.sourceMap===e.sourceMap)return;t(e=r)}else n()}}function a(e,t,n,r){var i=n?"":r.css;if(e.styleSheet)e.styleSheet.cssText=g(t,i);else{var o=document.createTextNode(i),a=e.childNodes;a[t]&&e.removeChild(a[t]),a.length?e.insertBefore(o,a[t]):e.appendChild(o)}}function s(e,t){var n=t.css,r=t.media,i=t.sourceMap;if(r&&e.setAttribute("media",r),b.ssrId&&e.setAttribute(v,t.id),i&&(n+="\n/*# sourceURL="+i.sources[0]+" */",n+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(i))))+" */"),e.styleSheet)e.styleSheet.cssText=n;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(n))}}var l="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!l)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var u=n(309),c={},f=l&&(document.head||document.getElementsByTagName("head")[0]),d=null,p=0,m=!1,h=function(){},b=null,v="data-vue-ssr-id",_="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());e.exports=function(e,t,n,i){m=n,b=i||{};var o=u(e,t);return r(o),function(t){for(var n=[],i=0;i<o.length;i++){var a=o[i],s=c[a.id];s.refs--,n.push(s)}t?(o=u(e,t),r(o)):o=[];for(var i=0;i<n.length;i++){var s=n[i];if(0===s.refs){for(var l=0;l<s.parts.length;l++)s.parts[l]();delete c[s.id]}}}};var g=function(){var e=[];return function(t,n){return e[t]=n,e.filter(Boolean).join("\n")}}()},309:function(e,t){e.exports=function(e,t){for(var n=[],r={},i=0;i<t.length;i++){var o=t[i],a=o[0],s=o[1],l=o[2],u=o[3],c={id:e+":"+i,css:s,media:l,sourceMap:u};r[a]?r[a].parts.push(c):n.push(r[a]={id:a,parts:[c]})}return n}},342:function(e,t,n){"use strict";var r=n(5),i=n.n(r),o=n(10),a=n.n(o),s=n(18),l=n.n(s),u=n(2),c=n(186),f={columns:[{name:"group_name",label:Object(u.d)("zumingcheng"),is_focus:!0,width:200},{name:"group_memo",label:"备注",width:200,is_focus:!0}],controller:"group",authname:"group"};t.a={name:"sp-group",components:{"simple-admin-tablelist":c.a},data:function(){return{form:{id:"",companyid:"",group_name:"",group_memo:""},props:f,dialogVisible:!1,formTitle:"",rowIndex:"",row:"",group_list:[],user_list:[],permission_data:[],activeName:"info"}},methods:{onQuit:function(){this.dialogVisible=!1},handleDeleteUser:function(e,t){var n=this;n._remove("/user/deletegroup",{groupid:"",id:t.id}).then(function(){n.$delete(n.user_list,e)})},onTabClick:function(e){var t=this;t._fetch("/l/user",{groupid:t.form.id}).then(function(e){console.log(e),t.user_list=e.data})},onSavePermission:function(){var e=this,t=e.$refs.tree.getCheckedKeys(!0);e._submit("/group/setting",{groupid:e.form.id,keys:t.join(",")}).then(function(t){e._log(t)})},onSubmit:function(){var e=this;""==e.form.id?e._submit("/"+f.controller+"/add",e.form).then(function(){e.$refs.tablelist.appendRow(u.f.clone(e.form))}):e._submit("/"+f.controller+"/edit",e.form).then(function(){u.f.copyTo(e.form,e.row)})},showFormToCreate:function(){var e=this;u.f.empty(e.form),e.base&&l()(e.base).forEach(function(t){e.form[t]=e.base[t]}),e.formTitle=Object(u.d)("tianjiaxinxi"),e.activeName="info",e.showDialog()},showFormToEdit:function(e,t){var n=this;return a()(i.a.mark(function r(){var o,a,s;return i.a.wrap(function(r){for(;;)switch(r.prev=r.next){case 0:return o=n,o.rowIndex=e,o.row=t,u.f.copyTo(t,n.form),n.formTitle=Object(u.d)("xiugaixinxi"),r.next=7,o._fetch("/group/getpermissions",{groupid:o.form.id});case 7:a=r.sent,o._log(a),s=a.data.map(function(e){return e.permissionid}),setTimeout(function(){o.$refs.tree.setCheckedKeys(s)},100),o.showDialog();case 12:case"end":return r.stop()}},r,n)}))()},showDialog:function(){var e=this;e.dialogVisible=!0,setTimeout(function(){for(var t=f.columns,n=0;n<t.length;n++){var r=t[n],i=e.$refs[r.name][0];if(r.is_focus&&!i.disabled){i.focus();break}}},50)},isFormDisabled:function(e){var t=this.form;return""==t.id&&!e.is_create||""!=t.id&&!e.is_update}},mounted:function(){function e(){return t.apply(this,arguments)}var t=a()(i.a.mark(function e(){var t,n;return i.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return t=this,e.next=3,t._fetch("/permission/tree",{});case 3:n=e.sent,t.permission_data=n.data;case 5:case"end":return e.stop()}},e,this)}));return e}()}},392:function(e,t,n){var r=n(393);"string"==typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);n(308)("3017b688",r,!0,{})},393:function(e,t,n){t=e.exports=n(307)(!1),t.push([e.i,".el-date-editor.el-input__inner,.user-form .el-date-editor.el-input,.user-form .el-input__inner{width:200px}",""])},394:function(e,t,n){"use strict";var r=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("el-row",[n("el-col",{attrs:{span:2}},[n("auth",{attrs:{auth:"group"}},[n("as-button",{attrs:{type:"primary"},on:{click:function(t){return e.showFormToCreate()}}},[e._v(e._s(e._label("xinjian")))])],1)],1)],1),e._v(" "),n("el-row",{attrs:{gutter:20}},[n("el-col",{attrs:{span:24}},[n("simple-admin-tablelist",e._b({ref:"tablelist",attrs:{onclickupdate:e.showFormToEdit}},"simple-admin-tablelist",e.props,!1))],1)],1),e._v(" "),n("el-dialog",{staticClass:"user-form",attrs:{title:e.formTitle,visible:e.dialogVisible,center:!0,width:"60%",modal:!1},on:{"update:visible":function(t){e.dialogVisible=t}}},[n("el-tabs",{attrs:{type:"border-card"},on:{"tab-click":e.onTabClick},model:{value:e.activeName,callback:function(t){e.activeName=t},expression:"activeName"}},[n("el-tab-pane",{attrs:{label:e._label("group-info"),name:"info"}},[n("el-form",{ref:"form",attrs:{model:e.form,"label-width":"100px"}},[e._l(e.props.columns,function(t){return t.is_hidden?e._e():n("el-form-item",{key:t.name,attrs:{label:t.label}},[t.type&&"input"!=t.type?e._e():n("el-input",{ref:t.name,refInFor:!0,nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.onSubmit(t)}},model:{value:e.form[t.name],callback:function(n){e.$set(e.form,t.name,n)},expression:"form[item.name]"}})],1)}),e._v(" "),n("el-form-item",[n("auth",{attrs:{auth:"group"}},[n("as-button",{attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v(e._s(e._label("baocun")))])],1),e._v(" "),n("as-button",{attrs:{type:"primary"},on:{click:e.onQuit}},[e._v(e._s(e._label("tuichu")))])],1)],2)],1),e._v(" "),n("el-tab-pane",{attrs:{label:e._label("quanxian"),disabled:!e.form.id}},[n("el-tree",{ref:"tree",attrs:{data:e.permission_data,"node-key":"id","show-checkbox":"","expand-on-click-node":!1}}),e._v(" "),n("auth",{attrs:{auth:"group"}},[n("as-button",{attrs:{type:"primary"},on:{click:e.onSavePermission}},[e._v(e._s(e._label("baocun")))])],1),e._v(" "),n("as-button",{attrs:{type:"primary"},on:{click:e.onQuit}},[e._v(e._s(e._label("tuichu")))])],1),e._v(" "),n("el-tab-pane",{attrs:{label:e._label("zuneirenyuan"),name:"user-list",disabled:!e.form.id}},[n("el-table",{staticStyle:{width:"100%"},attrs:{data:e.user_list,stripe:"",border:""}},[n("el-table-column",{attrs:{prop:"login_name",label:e._label("dengluming"),align:"center",width:"180"}}),e._v(" "),n("el-table-column",{attrs:{prop:"real_name",label:e._label("xingming"),align:"center",width:"180"}}),e._v(" "),n("el-table-column",{attrs:{label:e._label("caozuo"),width:"150",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[n("auth",{attrs:{auth:"group"}},[n("as-button",{attrs:{size:"mini",type:"danger"},on:{click:function(n){return e.handleDeleteUser(t.$index,t.row)}}},[e._v(e._s(e._label("shanchu")))])],1)]}}])})],1),e._v(" "),n("el-row",[n("el-col",{staticStyle:{"text-align":"center"},attrs:{span:24}},[n("as-button",{attrs:{type:"primary"},on:{click:e.onQuit}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1)],1)],1)},i=[],o={render:r,staticRenderFns:i};t.a=o}});