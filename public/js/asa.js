!function(e){function t(o){if(n[o])return n[o].exports;var a=n[o]={i:o,l:!1,exports:{}};return e[o].call(a.exports,a,a.exports,t),a.l=!0,a.exports}var n={};t.m=e,t.c=n,t.d=function(e,n,o){t.o(e,n)||Object.defineProperty(e,n,{configurable:!1,enumerable:!0,get:o})},t.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,"a",n),n},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="/dist/",t(t.s=6)}([function(e,t){function n(e,t){var n=e[1]||"",a=e[3];if(!a)return n;if(t&&"function"==typeof btoa){var r=o(a);return[n].concat(a.sources.map(function(e){return"/*# sourceURL="+a.sourceRoot+e+" */"})).concat([r]).join("\n")}return[n].join("\n")}function o(e){return"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(e))))+" */"}e.exports=function(e){var t=[];return t.toString=function(){return this.map(function(t){var o=n(t,e);return t[2]?"@media "+t[2]+"{"+o+"}":o}).join("")},t.i=function(e,n){"string"==typeof e&&(e=[[null,e,""]]);for(var o={},a=0;a<this.length;a++){var r=this[a][0];"number"==typeof r&&(o[r]=!0)}for(a=0;a<e.length;a++){var l=e[a];"number"==typeof l[0]&&o[l[0]]||(n&&!l[2]?l[2]=n:n&&(l[2]="("+l[2]+") and ("+n+")"),t.push(l))}},t}},function(e,t,n){function o(e){for(var t=0;t<e.length;t++){var n=e[t],o=u[n.id];if(o){o.refs++;for(var a=0;a<o.parts.length;a++)o.parts[a](n.parts[a]);for(;a<n.parts.length;a++)o.parts.push(r(n.parts[a]));o.parts.length>n.parts.length&&(o.parts.length=n.parts.length)}else{for(var l=[],a=0;a<n.parts.length;a++)l.push(r(n.parts[a]));u[n.id]={id:n.id,refs:1,parts:l}}}}function a(){var e=document.createElement("style");return e.type="text/css",f.appendChild(e),e}function r(e){var t,n,o=document.querySelector("style["+v+'~="'+e.id+'"]');if(o){if(p)return b;o.parentNode.removeChild(o)}if(g){var r=m++;o=d||(d=a()),t=l.bind(null,o,r,!1),n=l.bind(null,o,r,!0)}else o=a(),t=i.bind(null,o),n=function(){o.parentNode.removeChild(o)};return t(e),function(o){if(o){if(o.css===e.css&&o.media===e.media&&o.sourceMap===e.sourceMap)return;t(e=o)}else n()}}function l(e,t,n,o){var a=n?"":o.css;if(e.styleSheet)e.styleSheet.cssText=_(t,a);else{var r=document.createTextNode(a),l=e.childNodes;l[t]&&e.removeChild(l[t]),l.length?e.insertBefore(r,l[t]):e.appendChild(r)}}function i(e,t){var n=t.css,o=t.media,a=t.sourceMap;if(o&&e.setAttribute("media",o),h.ssrId&&e.setAttribute(v,t.id),a&&(n+="\n/*# sourceURL="+a.sources[0]+" */",n+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(a))))+" */"),e.styleSheet)e.styleSheet.cssText=n;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(n))}}var s="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!s)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var c=n(10),u={},f=s&&(document.head||document.getElementsByTagName("head")[0]),d=null,m=0,p=!1,b=function(){},h=null,v="data-vue-ssr-id",g="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());e.exports=function(e,t,n,a){p=n,h=a||{};var r=c(e,t);return o(r),function(t){for(var n=[],a=0;a<r.length;a++){var l=r[a],i=u[l.id];i.refs--,n.push(i)}t?(r=c(e,t),o(r)):r=[];for(var a=0;a<n.length;a++){var i=n[a];if(0===i.refs){for(var s=0;s<i.parts.length;s++)i.parts[s]();delete u[i.id]}}}};var _=function(){var e=[];return function(t,n){return e[t]=n,e.filter(Boolean).join("\n")}}()},function(e,t){e.exports=function(e,t,n,o,a,r){var l,i=e=e||{},s=typeof e.default;"object"!==s&&"function"!==s||(l=e,i=e.default);var c="function"==typeof i?i.options:i;t&&(c.render=t.render,c.staticRenderFns=t.staticRenderFns,c._compiled=!0),n&&(c.functional=!0),a&&(c._scopeId=a);var u;if(r?(u=function(e){e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext,e||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),o&&o.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(r)},c._ssrRegister=u):o&&(u=o),u){var f=c.functional,d=f?c.render:c.beforeCreate;f?(c._injectStyles=u,c.render=function(e,t){return u.call(t),d(e,t)}):c.beforeCreate=d?[].concat(d,u):[u]}return{esModule:l,exports:i,options:c}}},function(e,t,n){"use strict";t.a={name:"simple-admin-page",props:["columns","buttons","labels","options","controller","base"],components:{},data:function(){for(var e={id:""},t=this.options||{},n=this.base||{},o=0;o<this.columns.length;o++)e[this.columns[o].name]="";return{dialogVisible:!1,form:e,rowIndex:"",formTitle:"",tableData:[],componenToptions:t,watchBase:n}},methods:{onSubmit:function(){var e=this;""==e.form.id?$ASA.submit.call(e,"/"+e.controller+"/add",e.form,function(){e.tableData.push($ASA.clone(e.form)),e.dialogVisible=!1}):$ASA.submit.call(e,"/"+e.controller+"/edit",e.form,function(){$ASA.copyTo(e.form,e.tableData[e.rowIndex]),e.dialogVisible=!1})},showFormToCreate:function(){var e=this;$ASA.empty(e.form),e.base&&Object.keys(e.base).forEach(function(t){e.form[t]=e.base[t]}),this.formTitle=this.labels.formTitleCreate,e.showDialog()},showFormToEdit:function(e,t){var n=this;n.rowIndex=e,$ASA.copyTo(t,this.form),this.formTitle=this.labels.formTitleUpdate,n.showDialog()},handleDelete:function(e,t){var n=this;n.rowIndex=e,$ASA.remove.call(this,"/"+n.controller+"/delete?id="+t.id,function(){n.$delete(n.tableData,e)})},showDialog:function(){var e=this;e.dialogVisible=!0,setTimeout(function(){for(var t=e.columns,n=0;n<t.length;n++){var o=t[n],a=e.$refs[o.name][0];if(o.is_focus&&!a.disabled){console.log(a),a.focus();break}}},50)},isFormDisabled:function(e){var t=this.form;return""==t.id&&!e.is_create||""!=t.id&&!e.is_update},convert:function(e,t,n){return"switch"==t.type?"1"==e[t.name]?this.labels.yes:this.labels.no:e[t.name]},loadList:function(){var e=this;e.tableData=[];var t={};e.base&&Object.keys(e.base).forEach(function(n){t[n]=e.base[n]}),$ASA.post("/"+e.controller+"/page",t,function(t){for(var n=0;n<t.length;n++)e.tableData.push(t[n])},"json")}},watch:{base:{handler:function(e,t){console.log("change",e,t),this.loadList()},deep:!0}},computed:{},mounted:function(){this.loadList()}}},function(e,t,n){"use strict";t.a={name:"multiple-admin-page",props:["columns","buttons","labels","options","controller","base","default_language","image_url_prex"],components:{},data:function(){for(var e={id:"",relateid:"",lang_code:""},t=this.options||{},n=(this.base,0);n<this.columns.length;n++)e[this.columns[n].name]="";return{dialogVisible:!1,form:e,rowIndex:"",formTitle:"",tableData:[],componenToptions:t,languages:[],loading:!0}},methods:{onSubmit:function(){var e=this;""==e.form.id?$ASA.submit.call(e,"/"+e.controller+"/add",e.form,function(){e.form.relateid?e.tableData[e.rowIndex].languages+=","+e.form.lang_code:(e.form.languages=e.form.lang_code,e.form.relateid=e.form.id,e.tableData.push($ASA.clone(e.form))),e.dialogVisible=!1,e.clearFiles()}):$ASA.submit.call(e,"/"+e.controller+"/edit",e.form,function(){e.form.lang_code==e.default_language&&$ASA.copyTo(e.form,e.tableData[e.rowIndex]),e.dialogVisible=!1,e.clearFiles()})},showFormToCreate:function(){var e=this;$ASA.empty(e.form),e.base&&Object.keys(e.base).forEach(function(t){e.form[t]=e.base[t]}),e.formTitle=e.labels.formTitleCreate,e.form.lang_code=e.default_language,e.showDialog()},showFormToUpdate:function(e,t,n,o){var a=this;a.rowIndex=e,t.lang_code==n?($ASA.copyTo(t,a.form),a.showDialog()):o?$ASA.post("/"+a.controller+"/load",{lang_code:n,relateid:t.relateid},function(e){$ASA.copyTo(e,a.form),a.showDialog()},"json"):($ASA.empty(a.form),console.log(a.form),a.columns.forEach(function(e){e.disable_change?a.form[e.name]=t[e.name]:a.form[e.name]=""}),console.log(a.form),a.form.relateid=t.relateid,a.form.lang_code=n,a.formTitle=a.labels.formTitleCreate,a.showDialog())},handleDelete:function(e,t){var n=this;n.rowIndex=e,$ASA.remove.call(this,"/"+n.controller+"/deleteGroup?id="+t.id,function(){n.$delete(n.tableData,e)})},getImageStyle:function(e){var t="";return e.image_width&&(t+="width:"+e.image_width+"px;"),e.image_height&&(t+="height:"+e.image_height+"px;"),t},getUploadSuccessCallback:function(e){var t=this;return e.success_callback||(console.log(e,"44"),e.success_callback=function(n,o,a){o.name=n.files[o.name],t.form[e.name]+=","+o.name,t.form[e.name]=t.form[e.name].replace(/^,/,"")}),e.success_callback},getRemoveUploadFileCallback:function(e){var t=this;return e.remove_callback||(e.remove_callback=function(n,o){console.log(t.form[e.name],n.name),t.form[e.name]=t.form[e.name].replace(n.name,"").replace(/^,/,"").replace(/,+/,",").replace(/,+$/,"")}),e.remove_callback},clearFiles:function(){var e=this;setTimeout(function(){for(var t=e.columns,n=0;n<t.length;n++){var o=t[n],a=e.$refs[o.name][0];"upload"==o.type&&a.clearFiles()}},50)},showDialog:function(){var e=this;e.dialogVisible=!0,setTimeout(function(){for(var t=e.columns,n=0;n<t.length;n++){var o=t[n],a=e.$refs[o.name][0];o.is_focus&&!a.disabled&&a.focus()}},50)},isSettingLanguage:function(e,t){return e.languages&&e.languages.indexOf(t)>=0},convert:function(e,t,n){return"switch"==t.type?"1"==e[t.name]?this.labels.yes:this.labels.no:e[t.name]},isFormDisabled:function(e){var t=this.form;return""==t.id&&!e.is_create||""!=t.id&&!e.is_update||e.disable_change&&t.lang_code!=this.default_language},loadList:function(e){var t=this;t.tableData=[];var n={};n.lang_code=t.default_language,t.base&&Object.keys(t.base).forEach(function(e){n[e]=t.base[e]}),$ASA.post("/"+t.controller+"/page",n,function(n){for(var o=0;o<n.length;o++)t.tableData.push(n[o]);e()},"json")}},watch:{base:{handler:function(e,t){this.loadList()},deep:!0}},computed:{},mounted:function(){var e=this,t=new Promise(function(e,t){$ASA.post("/common/language",{},function(t){e(t)},"json")}),n=new Promise(function(t,n){e.loadList(t)});Promise.all([t,n]).then(function(t){e.languages=t[0],e.loading=!1})}}},function(e,t,n){"use strict";t.a={name:"simple-admin-tablelist",props:["columns","controller","base","onclickupdate"],components:{},data:function(){this.base;return{rowIndex:"",tableData:[],caozuo:$ASAL.caozuo,bianji:$ASAL.bianji,shanchu:$ASAL.shanchu}},methods:{appendRow:function(e){this.tableData.push(e)},onClickDelete:function(e,t){var n=this;n.rowIndex=e,$ASA.remove.call(this,"/"+n.controller+"/delete?id="+t.id,function(){n.$delete(n.tableData,e)})},handleClickUpdate:function(e,t){this.onclickupdate&&this.onclickupdate(e,t)},convert:function(e,t,n){return"switch"==t.type?"1"==e[t.name]?$ASAL.yes:$ASAL.no:e[t.name]},loadList:function(){var e=this;e.tableData=[];var t={};e.base&&Object.keys(e.base).forEach(function(n){t[n]=e.base[n]}),$ASA.post("/"+e.controller+"/page",t,function(t){for(var n=0;n<t.length;n++)e.tableData.push(t[n])},"json")}},watch:{base:{handler:function(e,t){this.loadList()},deep:!0}},computed:{},mounted:function(){this.loadList()}}},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var o=n(7),a=n(12),r=n(16),l={install:function(e,t){e.component(o.a.name,o.a),e.component(a.a.name,a.a),e.component(r.a.name,r.a)}};"undefined"!=typeof window&&window.Vue&&window.Vue.use(l),t.default=l},function(e,t,n){"use strict";function o(e){n(8)}var a=n(3),r=n(11),l=n(2),i=o,s=l(a.a,r.a,!1,i,null,null);t.a=s.exports},function(e,t,n){var o=n(9);"string"==typeof o&&(o=[[e.i,o,""]]),o.locals&&(e.exports=o.locals);n(1)("d653e1c4",o,!0,{})},function(e,t,n){t=e.exports=n(0)(!1),t.push([e.i,"",""])},function(e,t){e.exports=function(e,t){for(var n=[],o={},a=0;a<t.length;a++){var r=t[a],l=r[0],i=r[1],s=r[2],c=r[3],u={id:e+":"+a,css:i,media:s,sourceMap:c};o[l]?o[l].parts.push(u):n.push(o[l]={id:l,parts:[u]})}return n}},function(e,t,n){"use strict";var o=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("el-row",[n("el-col",{attrs:{span:24}},[n("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.showFormToCreate()}}},[e._v(e._s(e.buttons.create.label))])],1)],1),e._v(" "),n("el-row",{attrs:{gutter:20}},[n("el-col",{attrs:{span:24}},[n("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tableData,stripe:"",border:""}},[e._l(e.columns,function(t){return t.is_show?n("el-table-column",{key:t.name,attrs:{prop:t.name,label:t.label,align:"center",width:t.width||180},scopedSlots:e._u([{key:"default",fn:function(n){return[e._v("\n            "+e._s(t.convert?t.convert(n.row,n.rowIndex,t):e.convert(n.row,t,e.rowIndex))+"\n          ")]}}],null,!0)}):e._e()}),e._v(" "),n("el-table-column",{attrs:{label:e.labels.action,width:"150",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[n("el-button",{attrs:{size:"mini"},on:{click:function(n){return e.showFormToEdit(t.$index,t.row)}}},[e._v(e._s(e.buttons.edit.label))]),e._v(" "),n("el-button",{attrs:{size:"mini",type:"danger"},on:{click:function(n){return e.handleDelete(t.$index,t.row)}}},[e._v(e._s(e.buttons.remove.label))])]}}])})],2)],1)],1),e._v(" "),n("el-dialog",{staticClass:"user-form",attrs:{title:e.formTitle,visible:e.dialogVisible,center:!0,width:e.componenToptions.dialogWidth||"40%",modal:!1},on:{"update:visible":function(t){e.dialogVisible=t}}},[n("el-form",{ref:"form",attrs:{model:e.form,"label-width":"100px"}},[e._l(e.columns,function(t){return t.is_hidden?e._e():n("el-form-item",{key:t.name,attrs:{label:t.label}},[t.type&&"input"!=t.type?e._e():n("el-input",{ref:t.name,refInFor:!0,attrs:{disabled:e.isFormDisabled(t)},nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.onSubmit(t)}},model:{value:e.form[t.name],callback:function(n){e.$set(e.form,t.name,n)},expression:"form[item.name]"}}),e._v(" "),"switch"==t.type?n("el-switch",{ref:t.name,refInFor:!0,attrs:{disabled:e.isFormDisabled(t),"active-value":"1","inactive-value":"0"},model:{value:e.form[t.name],callback:function(n){e.$set(e.form,t.name,n)},expression:"form[item.name]"}}):e._e(),e._v(" "),"select"==t.type?n("el-select",{ref:t.name,refInFor:!0,attrs:{placeholder:"choice"},model:{value:e.form[t.name],callback:function(n){e.$set(e.form,t.name,n)},expression:"form[item.name]"}},e._l(t.data_source,function(e,t){return n("el-option",{key:t,attrs:{label:e,value:t}})}),1):e._e()],1)}),e._v(" "),n("el-form-item",[n("el-button",{attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v(e._s(e.buttons.save.label))])],1)],2)],1)],1)},a=[],r={render:o,staticRenderFns:a};t.a=r},function(e,t,n){"use strict";function o(e){n(13)}var a=n(4),r=n(15),l=n(2),i=o,s=l(a.a,r.a,!1,i,null,null);t.a=s.exports},function(e,t,n){var o=n(14);"string"==typeof o&&(o=[[e.i,o,""]]),o.locals&&(e.exports=o.locals);n(1)("5df9fc5b",o,!0,{})},function(e,t,n){t=e.exports=n(0)(!1),t.push([e.i,"",""])},function(e,t,n){"use strict";var o=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("el-row",[n("el-col",{attrs:{span:24}},[n("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.showFormToCreate()}}},[e._v(e._s(e.buttons.create.label))])],1)],1),e._v(" "),n("el-row",{attrs:{gutter:20}},[n("el-col",{attrs:{span:24}},[n("el-table",{directives:[{name:"loading",rawName:"v-loading.fullscreen.lock",value:e.loading,expression:"loading",modifiers:{fullscreen:!0,lock:!0}}],staticStyle:{width:"100%"},attrs:{data:e.tableData,stripe:"",border:""}},[e._l(e.columns,function(t){return t.is_show?n("el-table-column",{key:t.name,attrs:{prop:e.name,label:t.label,align:"center",width:t.width||180},scopedSlots:e._u([{key:"default",fn:function(o){return[t.is_image?n("img",{style:e.getImageStyle(t),attrs:{src:e.image_url_prex+o.row[t.name]}}):e._e(),e._v(" "),t.is_image?e._e():n("span",[e._v(e._s(t.convert?t.convert(o.row,o.rowIndex,t):e.convert(o.row,t,e.rowIndex)))])]}}],null,!0)}):e._e()}),e._v(" "),n("el-table-column",{attrs:{prop:"lang_code",label:e.labels.language,width:"180",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return e._l(e.languages,function(o,a){return n("span",{key:o.code,attrs:{value:o.code}},[n("el-button",{attrs:{type:e.isSettingLanguage(t.row,o.code)?"primary":"info",circle:""},on:{click:function(n){e.showFormToUpdate(t.$index,t.row,o.code,t.row.languages.indexOf(o.code)>0)}}},[e._v(e._s(o.shortName))])],1)})}}])}),e._v(" "),n("el-table-column",{attrs:{label:e.labels.action,width:"150",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[n("el-button",{attrs:{size:"mini",type:"danger"},on:{click:function(n){return e.handleDelete(t.$index,t.row)}}},[e._v(e._s(e.buttons.remove.label))])]}}])})],2)],1)],1),e._v(" "),n("el-dialog",{staticClass:"user-form",attrs:{title:e.formTitle,visible:e.dialogVisible,center:!0,width:e.componenToptions.dialogWidth||"40%",modal:!1},on:{"update:visible":function(t){e.dialogVisible=t}}},[n("el-form",{ref:"form",attrs:{model:e.form,"label-width":"100px"}},[e._l(e.columns,function(t){return t.is_hidden?e._e():n("el-form-item",{key:t.name,attrs:{label:t.label}},[t.type&&"input"!=t.type&&"textarea"!=t.type?e._e():n("el-input",{ref:t.name,refInFor:!0,attrs:{type:t.type?t.type:"text",disabled:e.isFormDisabled(t)},nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.onSubmit(t)}},model:{value:e.form[t.name],callback:function(n){e.$set(e.form,t.name,n)},expression:"form[item.name]"}}),e._v(" "),"switch"==t.type?n("el-switch",{ref:t.name,refInFor:!0,attrs:{disabled:e.isFormDisabled(t),"active-value":"1","inactive-value":"0"},model:{value:e.form[t.name],callback:function(n){e.$set(e.form,t.name,n)},expression:"form[item.name]"}}):e._e(),e._v(" "),"select"==t.type?n("el-select",{ref:t.name,refInFor:!0,attrs:{placeholder:"choice"},model:{value:e.form[t.name],callback:function(n){e.$set(e.form,t.name,n)},expression:"form[item.name]"}},e._l(t.data_source,function(e,t){return n("el-option",{key:t,attrs:{label:e,value:t}})}),1):e._e(),e._v(" "),"upload"==t.type?n("el-upload",{ref:t.name,refInFor:!0,attrs:{action:"/common/upload?category="+e.controller,multiple:t.multiple||!1,limit:t.limit||1,"on-success":e.getUploadSuccessCallback(t),"on-remove":e.getRemoveUploadFileCallback(t),disabled:e.isFormDisabled(t)}},[n("el-button",{attrs:{size:"small",type:"primary"}},[e._v(e._s(e.labels.upload))])],1):e._e()],1)}),e._v(" "),n("el-form-item",{attrs:{label:e.labels.language}},[n("el-select",{attrs:{placeholder:e.labels.choice,disabled:""},model:{value:e.form.relateid?e.form.lang_code:e.default_language,callback:function(t){e.$set(e.form.relateid?e.form:e.default_language,"lang_code",t)},expression:"!form.relateid?default_language:form.lang_code"}},e._l(e.languages,function(e,t){return n("el-option",{key:e.code,attrs:{label:e.name,value:e.code}})}),1)],1),e._v(" "),n("el-form-item",[n("el-button",{attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v(e._s(e.buttons.save.label))])],1)],2)],1)],1)},a=[],r={render:o,staticRenderFns:a};t.a=r},function(e,t,n){"use strict";function o(e){n(17)}var a=n(5),r=n(19),l=n(2),i=o,s=l(a.a,r.a,!1,i,null,null);t.a=s.exports},function(e,t,n){var o=n(18);"string"==typeof o&&(o=[[e.i,o,""]]),o.locals&&(e.exports=o.locals);n(1)("71057be0",o,!0,{})},function(e,t,n){t=e.exports=n(0)(!1),t.push([e.i,"",""])},function(e,t,n){"use strict";var o=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tableData,stripe:"",border:""}},[e._l(e.columns,function(t){return t.is_show?n("el-table-column",{key:t.name,attrs:{prop:t.name,label:t.label,align:"center",width:t.width||180},scopedSlots:e._u([{key:"default",fn:function(n){return[e._v("\n        "+e._s(t.convert?t.convert(n.row,n.rowIndex,t):e.convert(n.row,t,e.rowIndex))+"\n      ")]}}],null,!0)}):e._e()}),e._v(" "),n("el-table-column",{attrs:{label:e.caozuo,width:"150",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[n("el-button",{attrs:{size:"mini"},on:{click:function(n){return e.handleClickUpdate(t.$index,t.row)}}},[e._v(e._s(e.bianji))]),e._v(" "),n("el-button",{attrs:{size:"mini",type:"danger"},on:{click:function(n){return e.onClickDelete(t.$index,t.row)}}},[e._v(e._s(e.shanchu))])]}}])})],2)],1)},a=[],r={render:o,staticRenderFns:a};t.a=r}]);
//# sourceMappingURL=asa.js.map