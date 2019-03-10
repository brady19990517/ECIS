<?php
header("Content-Type: text/html; charset=utf8");
if (isset($_COOKIE["user"]) and $_COOKIE["type"]=="checkuser"){
    $user = $_COOKIE["user"];
}else{
    header("Location: 'login.php'"); 
}
?>
<html> 
<head> 
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
<meta charset="utf-8"> 
<title>UNNC签到系统</title> 
<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="js/listingactivity.js"></script>
<script src="js/index.js"></script>
<link href="css/checkin.css" rel="stylesheet" type="text/css">
</head>  

<body onkeydown="keyLogin();" onload='list_activity("<?php echo $user;?>")'>
<div style="background">
<img border="0" src="img/logo.png" alt="UNNC签到系统" width="232" height="99"></a></p>
</div>
<div class="lfloat" style="background-color:#000000;width:15%">

 <ul id="nav">

 <li class="aa" id="tb_1" onClick="x:hoverli(1);"><?php echo $user;?></li>

 <li class="aa" id="tb_2" onClick="i:hoverli(2);">Upload</li>

 <li class="aa" id="tb_3" onClick="setTimeout(function(){window.location.href='/ecis/index.php';},0);">Return</li>

 <li class="dd" id="tb_4"></li>

 </ul>

 </div>

 <div class="lfloat" style="width:85%;">

<div id="newinfo">
<div class="ctt list2">
<div class="undis" id="tbc_01" class = "hide";>
<a>当前用户：<?php echo $user;?></a><br/>
    具体说明扔在这
</div>
<div class="dis" id="tbc_02">
<div id="thirdPage" float=center;>

<form id="upload" action="upload.php" method="post">
Upload Activity:<br>
<div id="get_act_name">
Enter the name of the activity here:
<input type="text" id="activity" name="activity">
<input  type="submit" value="Submit">
</form>
</div>



<br>



<div id="file_section" style="display:none">
Upload the activity file here:
<form action="upload.php" method="post" enctype="multipart/form-data">
    
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
</div>
<?php
$target_dir = "temp/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$condition = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
if ($_POST["activity"] <> NULL and $condition == TRUE)
{
    include 'csvTOsql.php';
    csvTOsql($_POST["activity"],$target_file);
}
?>

<script type="text/javascript" src = "js/function.js"></script>
<script>
var activity = "<?php echo $_POST["activity"];?>";
insertAct(activity)
</script>  
  
		          
    	</div>

    </div>

    <div class="undis" id="tbc_03">

     <div id="thirdPage" class = "hide"; float=center;>
		<div id="txtHint"><h1>WAITING FOR CHECKING</h1></div>
		          
    	</div>
	</div>

    </div> 
    
    <a href="logout.php">Logout</a>   
    </div>
</body>
    </html>


