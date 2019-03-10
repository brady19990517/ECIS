<?php
//if ($_COOKIE["type"] == "admin" or $_COOKIE["type"] == "checkuser")
//{
    $con = mysqli_connect('localhost','root','Zcy123456');
    if (!$con)
    {
        die('Could not connect: ' . mysqli_error($con));
        //echo "<a> SQL connect error </a>";
    }
    // 选择数据库
    mysqli_select_db($con,"ecis");
    // 设置编码，防止中文乱码
    mysqli_set_charset($con, "utf8");
//}
?>