<?php
header("Content-Type: text/html; charset=utf8");
$user=$_COOKIE["user"];
if ($user <> NULL and $_COOKIE["type"] <> 'admin')
{
    include 'sql_connect.php';
    $activityName = $_GET["actvity"];
    $sql="DELETE FROM activities WHERE check_username = '$user' AND act_name = '$activityName'";
    mysqli_query($con,$sql);
    $tableName = $activityName.$user;
    $sqltable = "DROP TABLE $tableName";
    $retval = mysqli_query( $con, $sql );
    if(! $retval )
    {
    die('数据表删除失败: ' . mysqli_error($con));
    }
    echo "数据表删除成功\n";
}
elseif ($_COOKIE["type"] = 'admin')
{
    $actUser = $_GET["user"];
    include 'sql_connect.php';
    $activityName = $_GET["actvity"];
    $sql="DELETE FROM activities WHERE check_username = '$actUser' AND act_name = '$activityName'";
    mysqli_query($con,$sql);
    $tableName = $activityName.$actUser;
    $sqltable = "DROP TABLE $tableName";
    $retval = mysqli_query( $con, $sql );
    if(! $retval )
    {
    die('数据表删除失败: ' . mysqli_error($con));
    }
    echo "数据表删除成功\n";
}
?>