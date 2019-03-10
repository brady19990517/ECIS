<?php
session_start();
if ( isset($_POST["act"] ) ) {
    include_once 'connect.php';
    $connectDBS = new connectDataBase();
    $action = $connectDBS->test_input($_POST["act"]);
   
    switch ($action) {
        
        /*case 'createTB':
        include_once 'sqlDB.php';
        $activity = $connectDBS->test_input($_POST["activity"]);
        $sqlDB= new SqlDB();
        $sqlDB->sql($connectDBS->link, $activity, 1);
        break;*/
            /*case 'login':
            if (isset($_POST["username"]) && isset($_POST["password"])) {
                // 获取提交的账号和密码
                $username = $connectDBS->test_input($_POST["username"]);
                $password = $connectDBS->test_input($_POST["password"]);
                include_once 'checklogin.php';
                $checklogin = new checkLogin();
                
                if($checklogin->checkuser($connectDBS->link,$username) == false) {
                    echo 'usernamewrong';
                } elseif($checklogin->checkpassword($connectDBS->link,$username,$password) == false) {
                    echo 'passwordwrong';
                } else{
                    echo 'success';
                }
                
            }
            break;*/
                case 'insertAct':
                include_once 'sqlDB.php';
                $activity = $connectDBS->test_input($_POST["activity"]);
                $sqlDB= new SqlDB();
                $sqlDB->sql($connectDBS->link, $activity, 1, $_COOKIE["user"]);
		//include "csvTOsql.php";
		//csvTOsql('uploaded_file.csv',$_POST['activity']);
                break;
          
    }
}
?>
