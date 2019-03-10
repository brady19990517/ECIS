<?php
if (isset($_COOKIE["user"]) and $_COOKIE["type"] == "checkuser")
{
    $q = $_GET["c"];
    if ($q=="1")
    {
        $condi = "checkin";
    }
    if ($q == "2")
    {
        $condi = "checkout";
    }
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
    echo $act_time_s;
}