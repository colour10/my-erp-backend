var $ASA = (function(){
    var submit = function(path, params, options, callback) {
        var self = this;
        $.post(path, params, function(res){
            //console.log(res)
            if(res.messages.length>0) {
                const h = self.$createElement;
                var message = h("ul", null, res.messages.map(function(v){
                    return h("li",null,v)    
                }))
                
                self.$alert(message, '错误提示', {
                    confirmButtonText: '确定'
                });   
            }    
            else {
                var message = options && options.success ? options.success : "操作成功"
                self.$message({
                    message: message,
                    type: 'success'
                });
                
                if(callback) {
                    callback(res)
                }
            }
        },"json")
    }
    
    return {submit:submit}    
})()