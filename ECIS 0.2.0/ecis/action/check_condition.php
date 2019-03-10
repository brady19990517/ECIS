<?php
function che_con()
{
    if (isset($_COOKIE["user"]))
{
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
    $act_time = new DateTime($row["checkin"]);
    $act_time_s = $act_time->format("Y-m-d H:i:s.u");
    //echo "<br>";
    $out_time = new DateTime($row["checkout"]);
    $time_now = new DateTime();
    $time_now_s = $time_now->format("Y-m-d H:i:s.u");
    //echo $time_now_s;
    //echo "<br>";
    $x1 = $time_now->diff($act_time);
    $a = $x1->format("%R");
    //echo $a;
    $time_period_m = $x1->i;
    $time_period_h = $x1->h;
    $time_period_d = $x1->d;
    if ($a == "+"){
        $time_period = $time_period_h * 60 + $time_period_m + $time_period_d * 60 * 24;
    }
    else
    {
        $time_period = -($time_period_h * 60 + $time_period_m + $time_period_d * 60 * 24);
    }
    //echo $time_period;
    //echo "<br>";
    $x2 = $time_now->diff($out_time);
    $b = $x2->format("%R");
    $out_time_condition_m = $x2->i;
    $out_time_condition_h = $x2->h;
    $out_time_condition_d = $x2->d;
    if ($b == "+")
    {
        $out_time_condition = $out_time_condition_d * 24 * 60 + $out_time_condition_h * 60 + $out_time_condition_m;
    }
    else
    {
        $out_time_condition = -($out_time_condition_d * 24 * 60 + $out_time_condition_h * 60 + $out_time_condition_m);
    }
    //echo $out_time_condition;
    $condition = "not";
    if ($time_period < 30 and $time_period > -15)
    {
        $condition = "checkin";
    }
    if ($time_now > $out_time and $out_time_condition > -60)
    {
        $condition = "checkout";
    }
    return $condition;
}

}