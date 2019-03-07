var $ASA = (function(){
    var language = 'zh-cn';
    
    var submit = function(path, form, callback) {
        var self = this;        
        
        $.post(path, form, function(res){            
            if(res.messages.length>0) {
                const h = self.$createElement;
                var message = h("ul", null, res.messages.map(function(v){
                    return h("li",null,v)    
                }))
                
                self.$alert(message, getLabel("error_tip"), {
                    confirmButtonText: getLabel("ok")
                });   
            }    
            else {
                self.$message({
                    message: getLabel("success"),
                    type: 'success'
                });
                
                if(res.is_add=="1") {
                    form.id = res.id;
                }
                
                if(callback) {
                    callback(res)
                }
            }
        },"json")
    }    
    
    var remove = function(path,callback) {
        var self = this;
        self.$confirm(getLabel('delete_warning'), getLabel('tip'), {
            confirmButtonText: getLabel('ok'),
            cancelButtonText: getLabel('cancel'),
            type: 'warning'
        }).then(() => {
            $.get(path, function(res){
                if(res.messages.length>0) {
                    const h = self.$createElement;
                    var message = h("ul", null, res.messages.map(function(v){
                        return h("li",null,v)
                    }))

                    self.$alert(message, getLabel("error_tip"), {
                        confirmButtonText: getLabel("ok")
                    });
                }
                else {                    
                    self.$message({
                        message: getLabel("delete_success"),
                        type: 'success'
                    });
                    
                    callback(res)
                }
            },"json")
        }).catch(() => {
        });        
    }
    
    
    var setLanguage = function(lang) {
        if(languages[lang]) {
            language = lang; 
        }
    }
    
    function getLabel(key) {
        //console.log(languages)
        return languages[language][key]
    }
    
    function copyTo(fromObj, target) {
        Object.keys(target).forEach(function(key){
            if(fromObj[key] ) {
                target[key] =  fromObj[key]    
            } 
        });
    }
    
    function clone(target) {
        var obj = {}
        Object.keys(target).forEach(function(key){
            obj[key] =  target[key]    
        });
        return obj;
    }
    
    var languages = {
        "zh-cn":{
            success:"操作成功",
            delete_success:"删除成功",
            error_tip:"错误提示",
            ok:"确定",
            cancel:"取消",
            tip:'提示',
            delete_warning:"此操作将删除该记录, 是否继续?"
        },
        "en-us":{
            success:"Operation Success.",
            delete_success:"删除成功",
            error_tip:"Errors",
            ok:"OK",
            cancel:"Cancel",
            tip:'tip',
            delete_warning:"此操作将删除该记录, 是否继续?"
        }    
    }
    
    return {submit:submit, setLanguage:setLanguage, remove:remove, copyTo:copyTo, clone:clone}    
})()