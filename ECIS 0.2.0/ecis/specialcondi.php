<?php
if (isset($_COOKIE["user"]) and $_COOKIE["type"]=="checkuser")
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
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    $activity = $row["activity_name"];
    echo <<<EOF
    <!DOCTYPE html> 
    <html> 
    <head> 
    <meta charset="utf-8"> 
    <title>UNNC签到系统</title> 
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js">
    </script>
    <script src="js/get_time.js">
    </script>
    </head>
    <body>
    <h1>当前用户：$user</h1>
    <h1>当前活动：$activity</h1>
    <h1>原定</h1>
    <select id="optional" onchange="showPredict(this.value)">
    <option value="">请选择签到签退</option>
    <option value="1">签到</option>
    <option value="2">签退</option>
    </select>
    <h1>时间</h1>
    <div id="timePredict"><h1></h1></div>
    <form>
    <input type="text" id="year" name="year">年
    <input type="text" id="month" name="month">月
    <input type="text" id="day" name="day">日
    <input type="text" id="hour" name="hour">时
    <input type="text" id="minute" name="minute">分
    <input type="button" id="Submit1" onClick="changetime(year.value,month.value,day.value,hour.value,minute.value,optional.value)" value="Submit">
    </form>
    <div id="txtHint"><h1></h1></div>
    <br>
    <a href="logout.php">Logout</a>
    </body>
    </html>
EOF;
}
else
    echo '<a href="login.php">未登陆</a>';
?>
