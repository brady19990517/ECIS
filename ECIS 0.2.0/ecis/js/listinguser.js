function list_user(str)
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
    xmlhttp.open("GET","action/list_user.php?user="+str,true);
    xmlhttp.send();
    //document.getElementById("passwd").value="";
}

function list_activity_admin(str)
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
    xmlhttp.open("GET","action/list_activity_admin.php?user="+str,true);
    xmlhttp.send();
    //document.getElementById("passwd").value="";
}

function deleteActivityAdmin(str,username)
{
    if(confirm("确定要删除该活动吗？删除后将无法恢复"))
    {
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('GET', 'action/deleteAction.php?actvity='+str+'&user='+username, true);
        httpRequest.send();
        alert("该活动已经删除");
        setTimeout(function(){window.location.href='/ecis/manageact.php';},0);
    }
}

function deleteUserAdmin(username)
{
    if(confirm("确定要删除该用户吗？删除后将同时删除其所有活动且无法恢复"))
    {
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('GET', 'action/deleteUser.php?user='+username, true);
        httpRequest.send();
        alert("该用户已经删除");
        setTimeout(function(){window.location.href='/ecis/console.php';},0);
    }
}

function createUser()
{
    var x; 
    var user=prompt("请输入新建的用户",""); 
    if (user!=null && user!=""){ 
        password=prompt("请输入希望创建的密码","");
        type=prompt("用户类型","checkuser");
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('GET', 'action/createUser.php?user='+ user + '&passwd='+ password + '&type=' + type, true);
        httpRequest.send();
        alert("该用户已经创建");
        setTimeout(function(){window.location.href='/ecis/console.php';},0);
    } 
}

function changepasswd(str)
{
    var passwd=prompt("请输入新的用户密码","");
    if(confirm("确定要强制重置该用户密码么"))
    {
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('GET', 'action/changepasswd.php?user='+ str + '&passwd='+ passwd, true);
        httpRequest.send();
        alert("密码已经修改");
        setTimeout(function(){window.location.href='/ecis/console.php';},0);
    }
}