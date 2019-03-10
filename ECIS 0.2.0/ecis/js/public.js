var ajax = {
    get: function(url, callback) {
        var xhr = this.newXhr();
        this.setonreadystatechange(xhr, callback);
        xhr.open("GET", url, true);
        xhr.send();
    },

    post: function(url, data, callback, contentType) {
        var xhr = this.newXhr();
        this.setonreadystatechange(xhr, callback);
        xhr.setRequestHeader(
            "Content-Type", 
            contentType ? contentType : "application/x-www-form-urlencoded"
        )
        xhr.open("POST", url, true);
        xhr.send();
    },

    newXhr: function() {
        if(XMLHttpRequest)
            // 标准浏览器
            return new XMLHttpRequest();
        else
            //兼容IE6
            return new ActiveXObject("Microsoft.XMLHTTP");
            
    },
    setonreadystatechange: function(xhr, callback) {
        //方便闭包调用this
        var _this = this;
        xhr.onreadystatechange = function() {
            if(xhr.readyState == 4) {
                // 若成功，向回调函数返回结果
                if (_this.isSuccess(xhr.status)) 
                    callback(xhr.status, xhr);
                // 若失败，没有结果，返回状态码
                else
                    callback(xhr.status, null);
            }
        }
    }, 
    isSuccess: function(status) {
        return status >= 200 && status < 300 || status == 304;
    }
}

function stringToXml(string) {
    //对于标准浏览器
    if(DOMParser) 
        return (new DOMParser()).parseFromString(string, "text/xml");
    else if(window.DOMParser)
        return (new window.DOMParser()).parseFromString(string, "text/xml");
    //IE浏览器；
    else if (ActiveXObject) {
        var xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
        xmlDoc.async = false;
        xmlDoc.loadXML(string);
        return xmlDoc;
    } else
        throw new Error("No DOM Parser.");
}