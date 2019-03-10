<?php
header("Content-Type: text/html; charset=utf8");
if (isset($_COOKIE["user"]) and $_COOKIE["type"]=="admin")
{
    $username = $_GET["user"];
    $passwd = $_GET["passwd"];
    $sql = "UPDATE account SET password = '$passwd' WHERE username = '$username'";
    include 'sql_connect.php';
    mysqli_query($con,$sql);
}
if (isset($_COOKIE["user"]) and $_COOKIE["type"]=="checkuser")
{
    $username = $_COOKIE["user"];
    $passwd = $_GET["passwd"];
    $sql = "UPDATE account SET password = '$passwd' WHERE username = '$username'";
    include 'sql_connect.php';
    mysqli_query($con,$sql);
}