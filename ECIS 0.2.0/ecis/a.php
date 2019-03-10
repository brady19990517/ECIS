<?php
if (isset($_COOKIE["user"]) and $_COOKIE["type"] == "checkuser")
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

if ($condition == "checkin" or $condition == "checkout"){
    echo <<<EOF
    <!DOCTYPE html> 
    <html> 
    <head> 
    <meta charset="utf-8"> 
    <title>UNNC签到系统</title> 
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js">
    </script>
    <script src="js/checkin.js">
    </script>
    </head>
    <body onkeydown="keyLogin();">
    <h1>当前用户：$user</h1>
    <h1>当前活动：$activity</h1>
    <h1>当前状态：$condition</h1>
    <form>
    <input type="text" id="passwd" name="Password" autofocus="autofocus">
    <input type="text" id="condi" name="" style="display: none;" value="$condition"/>
    <input type="button" id="Submit1" onClick="checkIn(passwd.value,condi.value)" value="Submit"  style="display: none;">
    </form>
    <div id="txtHint"><h1>WAITING FOR CHECKING</h1></div>
    <a href="specialcondi.php">SpecialCondition</a>
    <br>
    <a href="logout.php">Logout</a>
    </body>
    </html>
EOF;
}
if ($condition != "checkin" and $condition != "checkout" and $time_period > 30)
{
    echo "<h1>当前不是签到时间</h1>";
    echo "<h1>当前用户：$user</h1>";
    echo "<h1>当前活动：$activity</h1>";
    echo "<h1>活动将于：$act_time_s 开始 还有$time_period 分钟 </h1>";
    echo '<a href="specialcondi.php">SpecialCondition</a>';
    echo "<br>";
    echo '<a href="logout.php">Logout</a>';
}
if ($condition != "checkin" and $condition != "checkout" and $time_period < -15 and $out_time_condition > 0)
{
    echo "<h1>迟到，签到失败</h1>";
    echo "<h1>当前用户：$user</h1>";
    echo "<h1>当前活动：$activity</h1>";
    echo '<a href="specialcondi.php">SpecialCondition</a>';
    echo "<br>";
    echo '<a href="logout.php">Logout</a>';
}
if ($condition != "checkin" and $condition != "checkout" and $out_time_condition < -60)
{
    echo "<h1>活动已经结束</h1>";
    echo "$out_time_condition";
    echo '<a href="specialcondi.php">SpecialCondition</a>';
    echo '<a href="logout.php">Logout</a>';
}
}
else
    echo '<a href="login.php">未登陆</a>';

?>
