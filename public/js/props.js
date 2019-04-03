(function(context){
    const self = this;

    const props = {
        "ageseason":{
            columns:[
                {name:"sessionmark", label:$ASAL["fabuji"], is_hide:true, type:'select', source:"sessionmark"},
                {name:"name", label:$ASAL["nianfen"],is_focus:true, 
                    convert:function(row, rowIndex, column){
                        return row.sessionmark+ row.name
                    }
                }
            ],
            controller:"ageseason"
        },

        "ulnarinch":{
            columns:[
                {name:"name", label:$ASAL["chima"], is_multiple:true, is_focus:true}
            ],
            controller:"ulnarinch",
            key_column:"name"
        },

        "productparts":{
            columns:[            
                {name:"name", label:$ASAL["peijianmingcheng"], is_multiple:true, is_focus:true},
                {name:"partscode", label:$ASAL["peijiandaima"]},
                {name:"packflag", label:$ASAL["shifoubaozhuang"], type:"switch"}
            ],
            controller:"productparts",
            key_column:"name"
        },

        "productinnards":{
            columns:[
                {name:"name", label:$ASAL["jiegoumingcheng"], is_multiple:true, is_focus:true}
            ],
            controller:"productinnards",
            key_column:"name"
        },

        "warehouse":{
            columns:[
                {name:"name", label:$ASAL["cangkumingcheng"]},
                {name:"countryid", label:$ASAL["guojiadiqu"], is_hide:true, type:'select', source:"country"},
                {name:"city", label:$ASAL["chengshi"]},
                {name:"address", label:$ASAL["dizhi"]},
                {name:"zipcode", label:$ASAL["youbian"], is_hide:true}, 
                
                {name:"contact", label:$ASAL["lianxiren"]}, 
                {name:"mobile", label:$ASAL["yidongdianhua"], is_hide:true},
                {name:"fax", label:$ASAL["chuanzhen"], is_hide:true},
                {name:"code", label:$ASAL["bianhao"], is_hide:true},
                {name:"othercontact", label:$ASAL["qitalianxifangshi"], is_hide:true},
                {name:"is_real", label:$ASAL["shifoukeyong"], type:"switch"}
            ],
            controller:"warehouse"
        },

        "country":{
            columns:[
                {name:"name", label:$ASAL["guojiamingcheng"], is_multiple:true, is_focus:true},
                {name:"code", label:$ASAL["guojiadaima"]},                
                {name:"localcurrency", label:$ASAL["bizhong"], type:'select', source:"currency"}
            ],
            controller:"country",
            key_column:"name"
        },

        "materialnote":{
            columns:[
                {name:"content", label:$ASAL["caizhibeizhu"], is_multiple:true, is_focus:true}
            ],
            controller:"materialnote",
            key_column:"content"
        },

        "material":{
            columns:[
                {name:"code", label:$ASAL["caizhidaima"], is_focus:true},
                {name:"name", label:$ASAL["caizhimingcheng"], is_multiple:true, is_focus:true},
                {name:"englishname", label:$ASAL["yingwenmingcheng"]}
            ],
            controller:"material",
            key_column:"name"
        },

        "colortemplate":{
            columns:[            
                {name:"name", label:$ASAL["mingcheng"],is_multiple:true,is_focus:true},
                //{name:"color_name", label:$ASAL["mingcheng"]},
                {name:"code", label:$ASAL["asabianhao"]},
                //{name:"colortype", label:$ASAL["yansefenlei"]},
                {name:"picture", label:$ASAL["yanseseban"], type:"upload",multiple:false,limit:1,is_image:true, image_width:60,image_height:60}
            ],
            controller:"colortemplate",
            key_column:"name"
        },

        "supplier":{
            columns:[
                {name:"suppliercode", label:$ASAL["gonghuoshangbianma"], class:"width2"},
                {name:"countrycity", label:$ASAL["guojiachengshi"], class:"width2", type:"select", source:"country"},
                {name:"suppliername", label:$ASAL["gonghuoshangmingcheng"], class:"width1"},
                {name:"address", label:$ASAL["dizhi"], class:"width1", is_hide:true},
                {name:"englishname", label:$ASAL["yingwenmingcheng"], class:"width1", is_hide:true},
                {name:"english_address", label:$ASAL["gonghuoshangbianma"], class:"width1", is_hide:true},
                {name:"website", label:$ASAL["wangzhi"], class:"width2", is_hide:true},
                {name:"fax", label:$ASAL["chuanzhen"], class:"width2", is_hide:true},
                {name:"legal", label:$ASAL["faren"], class:"width2", is_hide:true},
                {name:"registeredcapital", label:$ASAL["zhuceziben"], class:"width2", is_hide:true},
                {name:"businesslicense", label:$ASAL["yingyezhizhaohao"], class:"width2", is_hide:true},
                {name:"heading", label:$ASAL["shuihao"], class:"width2", is_hide:true},
                {name:"registered", label:$ASAL["zhuceshijian"], class:"width2", is_hide:true},
                {name:"endtime", label:$ASAL["zhongzhishijian"], class:"width2", is_hide:true},
                {name:"type", label:$ASAL["leixing"], class:"width2"},
                {name:"phone", label:$ASAL["dianhua"], class:"width2"},
                {name:"memo", label:$ASAL["beizhu"], class:"width1", is_hide:true, type:"textarea"}
            ],
            options:{
                dialogWidth:'700px',
                formSize:'small',
                inline:true
            },
            controller:"supplier"
        },

        "saleport":{
            columns:[            
                {name:"name", label:$ASAL["xiaoshouduankou"], is_focus:true},
                {name:"discount", label:$ASAL["zhekou"], is_focus:true}
            ],
            controller:"saleport"
        }
    }

    context.getComponent = function(name) {
        return {
            data:function(){
                return {
                    props:props[name]
                }
            },
            template:'<multiple-admin-page v-bind="props" ref="page"></multiple-admin-page>'
        }
    }

    context.getComponentSimple = function(name) {
        return {
            data:function(){
                return {
                    props:props[name]
                }
            },
            template:'<simple-admin-page v-bind="props" ref="page"></simple-admin-page>'
        }
    }
})($ASA)