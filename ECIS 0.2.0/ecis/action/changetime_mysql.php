<?php
if (isset($_COOKIE["user"]) and $_COOKIE["type"] == "checkuser")
{
    date_default_timezone_set("Asia/Shanghai");
    //date_default_timezone_set('PRC');
    $y = $_GET["year"];
    $m = $_GET["month"];
    $d = $_GET["day"];
    $h = $_GET["hour"];
    $min = $_GET["minute"];
    $q = $_GET["condi"];
    $time_change_t = mktime($h,$min,0,$m,$d,$y);
    $user = $_COOKIE["user"];
    //$time_change_st = "@" + $time_change_t;
    //$date = new DateTime($time_change_st);
    $sql_date=date("Y-m-d H:i:s", $time_change_t);
    if ($q=="1")
    {
        $condi = "checkin";
    }
    if ($q == "2")
    {
        $condi = "checkout";
    }
    $sql_chandata="UPDATE activities SET $condi='$sql_date' WHERE checkin_user='$user'";
    $user = $_COOKIE["user"];
    $con = mysqli_connect('localhost','root','Zcy123456');
    if (!$con)
    {
        die('Could not connect: ' . mysqli_error($con));
        echo "<a> SQL connect error </a>";
    }
    // 选择数据库
    mysqli_select_db($con,"sample_data");
    // 设置编码，防止中文乱码
    mysqli_set_charset($con, "utf8");
    
    $sql="SELECT * FROM activities WHERE checkin_user = '$user'";

    //echo $q;
    date_default_timezone_set('PRC');
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    $activity = $row["activity_name"];
    $act_time = new DateTime($row[$condi]);
    $act_time_s = $act_time->format("Y-m-d H:i:s");
    echo "原定时间：";
    echo $act_time_s;
    mysqli_query($con,$sql_chandata);
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    $activity = $row["activity_name"];
    $act_time = new DateTime($row[$condi]);
    $act_time_s = $act_time->format("Y-m-d H:i:s");
    if ($act_time_s == $sql_date)
    {
        echo "时间跟新成功";
        echo $act_time_s;
    }
    else
    {
        echo "更新失败，请重试";
        echo $act_time_s;
    }
    //mysql_close($con);
}