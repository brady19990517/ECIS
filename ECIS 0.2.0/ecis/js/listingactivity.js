    function list_activity(str)
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
                document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","action/list_activity.php?user="+str,true);
        xmlhttp.send();
        //document.getElementById("passwd").value="";
    }

    function deleteActivity(str)
    {
        if(confirm("确定要删除该活动吗？删除后将无法恢复"))
        {
            var httpRequest = new XMLHttpRequest();
            httpRequest.open('GET', 'action/deleteAction.php?actvity='+str, true);
            httpRequest.send();
            alert("该活动已经删除");
            setTimeout(function(){window.location.href='/ecis/index.php';},0);
        }
    }