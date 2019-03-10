function keyLogin()
    {
        document.onkeydown=function mykeyDown(e){  
        //compatible IE and firefox because there is not event in firefox  
        e = e||event;  
        if(e.keyCode == 13) 
        { 
            document.getElementById("Submit1").click();
            }   
        return;  
    }
    }
    function showPredict(str)
    {
        if (str=="")
        {
            document.getElementById("timePredict").innerHTML="";
            return;
        } 
        if (window.XMLHttpRequest)
        {
            // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            // IE6, IE5 浏览器执行代码
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("timePredict").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","action/checktime_mysql.php?c="+str,true);
        xmlhttp.send();
    }
    function changetime(year,month,day,hour,minute,condi)
    {
        if (year=="")
        {
            document.getElementById("txtHint").innerHTML="";
            return;
        } 
        if (window.XMLHttpRequest)
        {
            // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            // IE6, IE5 浏览器执行代码
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","action/changetime_mysql.php?year="+year+"&month="+month+"&day="+day+"&hour="+hour+"&minute="+minute+"&condi="+condi,true);
        xmlhttp.send();
        document.getElementByType("text").value="";
    }