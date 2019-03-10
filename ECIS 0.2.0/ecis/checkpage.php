<?php
header("Content-Type: text/html; charset=utf8");
if (isset($_COOKIE["user"]) and $_COOKIE["type"] == "checkuser")
{
    $user=$_COOKIE["user"];
    include 'action/sql_connect.php';
    $sql="SELECT * FROM activities WHERE check_username = '$user'";
    //echo $q;
    date_default_timezone_set('PRC');
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    //$activity = $row["activity_name"];
    $activity = $_GET['activity'];
    echo <<<EOF
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <title>UNNC Sign</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="css/public.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/componient.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/Checkin.css" />
        <script type="text/javascript" src="js/changepasswd.js"></script>
    </head>
    <body>
        <div class="top-bar">
            <img class="top-bar__logo" src="img/logo.svg" />
            <div class="top-bar__right">
                <div class="drop-list--hover">
                    <button class="drop-list__button">$user</button>
                    <div class="drop-list__menu">
                        <a class="drop-list__item"onClick="changepasswdUser();">password</a>
                        <a class="drop-list__item" href="logout.php">Log off</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="side-bar">
            <a class="side-bar__button" href="index.php"><img class="side-bar__button__icon" src="img/back.svg" alt="back"/></a>
            <a class="side-bar__button" href="index.php"><img class="side-bar__button__icon" src="img/home.svg" alt="home"/></a>
            <a class="side-bar__link">New Activity</a>
            <a class="side-bar__link--chosen">Record</a>
            <a class="side-bar__link">Long Long Long Long Long Text</a>
        </div>
        
    
        <div class="main-area">
            
            <h1>Check In</h1>
            <p style="text-align:center;">Please input student's id, and press "Enter" key</p>
            <select id="act" style="display:none">
            <option value = "$activity">$activity</option>
            </select>
            <input id="student-id__input"  autocomplete="off" placeholder="Click or press &quot;Shift&quot; to focus here" />
            <div id="msg-area"></div>
            <div id="info-area">
                <div>
                    <span>Emphasize: </span>
                    <select id="info-area__emphasize__chosen" value="Group" onchange="modifyEmphasize(event)">
                        <option value="group">Group</option>
                        <option value="name">Name</option>
                        <option value="id">ID</option>
                        <option value="none">(none)</option>
                    </select>
                </div>
                <div id="info-area__table"></div>
                <div id="info-area__emphasize__title"></div>
                <div id="info-area__emphasize__content"></div>
            </div>
    
        </div>
    </body>
    <script type="text/javascript" src="js/public.js"></script>
    <script type="text/javascript" src="js/componient.js"></script>
    <script type="text/javascript" src="js/Checkin.js"></script>
    </html>
EOF;
}
else{
    echo "
<script>
        setTimeout(function(){window.location.href='/ecis/login.php';},1000);
</script>
";
    echo '<a href="login.php">Not Sign In</a>';}
?>