<?php
  /**
   *
   */
class checkLogin{

    function __construct()
    {

    }

    //验证该手机号是否存在
    public function checkuser($link,$username)
    {
      $mysql = "SELECT COUNT(*) FROM `account` WHERE `username` = '$username'";
      $arr_address =  mysqli_fetch_array(mysqli_query($link, $mysql));
      $number = $arr_address[0];
      if($number == 0){
        return false;
      }else{
        return true;
      }
    }

    //验证手机号验证码是否符合
    public function checkpassword($link,$username,$password)
    {
      $mysql = "SELECT * FROM `account` WHERE username = '$username'";
      $row =  mysqli_fetch_assoc(mysqli_query($link, $mysql));
      if($row['password'] == $password){
        $_SESSION['login'] = $row['username'];
        return true;
      }else{
        return false;
      }
    }
   
}
?>
