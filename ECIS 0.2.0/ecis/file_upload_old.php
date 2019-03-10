
<?php

header("Content-Type: text/html; charset=utf8");
if (isset($_COOKIE["user"]) and $_COOKIE["type"]=="checkuser"){
    $user = $_COOKIE["user"];
}else{
    header("Location: login.php"); 
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


</div>



<br>



<div id="file_section" >
Upload the activity file here:
<form action="file_upload.php" method="post" enctype="multipart/form-data">
    
<input type="file" name="file" id="file" />
<input type="submit" name="submit" />
</form>
</div>
<?php
if ( isset($_POST["submit"]) ) {

    if ( isset($_FILES["file"])) {
 
             //if there was an error uploading the file
         if ($_FILES["file"]["error"] > 0) {
             echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
 
         }
         else {
                  //Print file details
              echo "Upload: " . $_FILES["file"]["name"] . "<br />";
              echo "Type: " . $_FILES["file"]["type"] . "<br />";
              echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
              echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
 
            
                //if file already exists
              if (file_exists("temp/" . $_FILES["file"]["name"])) {
             echo $_FILES["file"]["name"] . " already exists. ";
              }
              else {
                     //Store file in directory "upload" with the name of "uploaded_file.txt"
             $storagename = "uploaded_file.csv";
             move_uploaded_file($_FILES["file"]["tmp_name"], "temp/" . $storagename);
             echo "Stored in: " . "temp/" . $_FILES["file"]["name"] . "<br />";
             include "action/csvTOsql.php";
             csvTOsql("uploaded_file.csv",$_COOKIE["activity"]);
             unlink ( "temp/uploaded_file.csv");
             setcookie("activity", $_POST["activity"], time()-3600, "/ecis");
             }
         }
      } else {
              echo "No file selected <br />";
      }
 }
 
?>

  
		          
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


