<?php
header("Content-Type: text/html; charset=utf8");
//if(!isset($_POST["submit"])){
//    exit("错误执行");
//}

include('sql_connect.php');
$name = $_POST['user'];
$passowrd = $_POST['password'];

if ($name =='' or $passowrd==''){
    echo "<h1>Please Input Username or password,Retuen to Login in 3s</h1>";
            echo "
                <script>
                        setTimeout(function(){window.location.href='/ecis/login.php';},3000);
                </script>

            ";//如果错误使用js 1秒后跳转到登录页面重试;
}
else{
if ($name && $passowrd){
         $sql = "select * from account where username = '$name' and password='$passowrd'";
         $result = mysqli_query($con,$sql);
         $rows = mysqli_fetch_array($result);
         if($rows){
               $usertype = $rows["usertype"];
               setcookie("user", $name, time()+3600, "/ecis");
               setcookie("type", $usertype, time()+3600, "/ecis");
               echo $usertype;
               if ($usertype == 'checkuser')
               {
                header("refresh:0;url=/ecis/index.php");
               }
               if ($usertype == "admin")
               {
                header("refresh:0;url=/ecis/console.php");
               }
               exit;
         }else{
            echo "<h1>Incorrect Username or password, Retuen to Login in 3s</h1>";
            echo "
                <script>
                        setTimeout(function(){window.location.href='/ecis/login.php';},3000);
                </script>

            ";//如果错误使用js 1秒后跳转到登录页面重试;
         }
        }
    }
?>