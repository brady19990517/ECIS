<?php
header("Content-Type: text/html; charset=utf8");
if (isset($_COOKIE["user"]) and $_COOKIE["type"]=="admin")
{
    include 'sql_connect.php';
    $newUser = $_GET["user"];
    $passwd = $_GET["passwd"];
    $type = $_GET["type"];
    echo '$newUser';
    $sql = "INSERT INTO account (username,password,usertype) VALUE ('$newUser','$passwd','$type')";
    mysqli_query($con,$sql);
}
else
{
    echo "
<script>
        setTimeout(function(){window.location.href='/ecis/login.php';},0);
</script>
";
}
?>