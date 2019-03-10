    function focus()
    {
        document.getElementById('passwd').focus(); 
    }
    function checkIn(str,condi,activity)
    {
        if (str=="")
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
                if (condi == 'checkin')
                {
                    document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
                }
                if (condi == 'checkout')
                {
                    document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
                }
            }
        }
        xmlhttp.open("GET","action/checkin_mysql.php?q="+str+"&condi="+condi+"&activity="+activity,true);
        xmlhttp.send();
        document.getElementById("passwd1").value="";
        document.getElementById("passwd2").value="";
    }
    function keyLogin()
    {
        document.onkeydown=function mykeyDown(e){  
        //compatible IE and firefox because there is not event in firefox  
        e = e||event;  
        if(e.keyCode == 13) 
        { 
            document.getElementById("Submit1").click();
            document.getElementById("Submit2").click();
            }   
        return;  
    }
    }