var $ASA = (function(){
    
    var handelSubmitMessage = function(result, callback) {
        var self = this
        if(result.messages.length>0) {
            const h = self.$createElement;
            var message = h("ul", null, result.messages.map(function(v){
                return h("li",null,v)    
            }))
            
            self.$alert(message, getLabel("error_tip"), {
                confirmButtonText: getLabel("ok")
            });   
        }    
        else {
            self.$message({
                message: $ASAL.success,
                type: 'success'
            });            
            
            if(callback) {
                callback(result)
            }
        }
    }    
    
    var submit = function(path, form, callback) {
        var self = this;        
        
        $.post(path, form, function(res){
            handelSubmitMessage.call(self, res, function(){
                if(res.is_add=="1") {
                    form.id = res.id;
                }
                
                if(callback) {
                    callback(res)
                }
            })
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
                        message: $ASAL.delete_success,
                        type: 'success'
                    });
                    
                    callback(res)
                }
            },"json")
        }).catch(() => {
        });        
    }
    
        
    function getLabel(key) {
        return $ASAL[key]
    }
    
    function copyTo(fromObj, target) {
        Object.keys(target).forEach(function(key){
            if(typeof(target[key])!="undefined") {
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
    
    function empty(target) {
        var obj = {}
        Object.keys(target).forEach(function(key){
            target[key] =  ""  
        });
        
        return target;
    }
    
    function arrayMerge(arr) {
        for(var i=0;i<arr.length;i++) {
            this.push(arr[i])   
        }
    }
    
    function deleteObject(arr, obj) {
        for(var i=0;i<arr.length;i++) {
            if(arr[i]==obj) {
                arr.splice(i,1) 
                break;  
            }   
        }
        return arr
    }
    
    function findByKey(arr, keyName, keyValue) {
        for(var i=0;i<arr.length; i++) {
            if(arr[i][keyName]==keyValue) {
                return arr[i]   
            }   
        }
    }
    
    function round(num, length) {
        if(num>0) {
            var l = Math.pow(10,length)
            return Math.round(num*l)/l   
        }
        else {
            return '';   
        }
    }
    
    function filterNumber(num) {
        if(num>0) {
            return num   
        }
        else {
            return ''   
        }
    }
        
    return {
        handelSubmitMessage:handelSubmitMessage,
        submit:submit, 
        remove:remove, 
        copyTo:copyTo, 
        clone:clone, 
        empty:empty, 
        deleteObject:deleteObject, 
        post:$.post,
        get:$.get,
        arrayMerge:arrayMerge,
        findByKey:findByKey,
        round:round,
        filterNumber:filterNumber
    }    
})()