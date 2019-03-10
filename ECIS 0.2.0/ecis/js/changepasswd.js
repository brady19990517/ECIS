function changepasswdUser()
{
    var passwd=prompt("请输入新的用户密码","");
    if(confirm("确定要强制重置当前用户密码么"))
    {
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('GET', 'action/changepasswd.php?&passwd='+ passwd, true);
        httpRequest.send();
        alert("密码已经修改");
        setTimeout(function(){window.location.href='/ecis/logout.php';},0);
    }
}