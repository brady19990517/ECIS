<?php
header("Content-Type: text/html; charset=utf8");
if (isset($_COOKIE["user"]) and $_COOKIE["type"]=="checkuser")
{
    $user = $_COOKIE["user"];
    include "action/version.php";
    echo <<<EOF
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <title>UNNC Sign</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="css/public.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/componient.css" />
        <script type="text/javascript" src="js/listingactivity.js"></script>
        <script type="text/javascript" src="js/componient.js"></script>
        <script type="text/javascript" src="js/changepasswd.js"></script>
    </head>
    <body onload='list_activity("$user");'>
        <div class="top-bar">
            <img class="top-bar__logo" src="img/logo.png" />
            <div class="top-bar__right">
                <div class="drop-list--hover">
                    <button class="drop-list__button">$user</button>
                    <div class="drop-list__menu">
                        <a class="drop-list__item" onClick="changepasswdUser();">password</a>
                        <a class="drop-list__item" href="logout.php">Log off</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="side-bar">
            <a class="side-bar__link" onClick="setTimeout(function(){window.location.href='/ecis/upload.php';},0);">New Activity</a>
            <a class="side-bar__link--chosen">Record</a>
            <a class="side-bar__link">Long Long Long Long Long Text</a>
        </div>    
        <div class="main-area">
            
            <h1>Welcome to the UNNC Sign System</h1>
            <h2>Test Version $version</h2>
            <h3>Powered by ECIS Program</h3>
            <h4>Activity List</h4>
                <div id="txtHint"></div>
            <p>
                Our Student Service Centres offer support, guidance and information, access to online services through the availability of workstations and signposting to other specialist services to help you make the most of your time at The University of Nottingham.
            </p>
            <p> 
                The University has a wide range of specialist services available to support you during your time with us such as welfare support in each school, counselling, finance, visas and immigration, careers and more. 
            </p>
            <p>
                Specialist Advisers in Accessibility - Academic and Disability Support, Funding, Immigration and Sponsor Relations offer face to face ‘drop-in’ sessions and appointments in Cherry Tree Lodge, University Park and Service Centres. For more information and details on how to contact us please visit our  <a href="#"> Specialist Services 2018/19 page here. </a>
            </p>
    
            <button>Normal</button> <button class="button--prime">Prime</button> <button class="button--second">Second</button>
    
        </div>
    </body>
    </html>
EOF;
}
else
{
    echo "
<script>
        setTimeout(function(){window.location.href='/ecis/login.php';},0);
</script>
";
}
