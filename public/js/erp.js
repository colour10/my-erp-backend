var $ASA = (function(){
    var language = 'zh-cn';
    
    var submit = function(path, params, callback) {
        var self = this;        
        
        $.post(path, params, function(res){            
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
                
                if(callback) {
                    callback(res)
                }
            }
        },"json")
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
    
    var languages = {
        "zh-cn":{
            success:"操作成功",
            error_tip:"错误提示",
            ok:"确定"
        },
        "en-us":{
            success:"Operation Success.",
            error_tip:"Errors",
            ok:"OK"
        }    
    }
    
    return {submit:submit, setLanguage:setLanguage}    
})()