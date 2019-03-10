<?php
$user = $_COOKIE["type"];
if ($user = 'admin')
{
    $actUser = $_GET["user"];
    include 'sql_connect.php';
    $sql="DELETE FROM account WHERE username = '$actUser'";
    mysqli_query($con,$sql);
    $sqlact="SELECT * FROM activities WHERE check_username = '$actUser'";
    date_default_timezone_set('PRC');
    $result = mysqli_query($con,$sqlact);
    while($row=mysqli_fetch_row($result)){
            $activityName = $row[1];
            $tableName = $activityName.$actUser;
            $sqltable = "DROP TABLE $tableName";
            $retval = mysqli_query( $con, $sql );
            if(! $retval )
            {
            die('数据表删除失败: ' . mysqli_error($con));
            }
            echo "数据表删除成功\n";
        }
    $sqlList="DELETE FROM activities WHERE check_username = '$actUser'";
    mysqli_query($con,$sqlList);
}
?>