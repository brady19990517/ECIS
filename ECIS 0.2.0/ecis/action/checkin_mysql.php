<?php
include 'check_condition.php';
if (isset($_COOKIE["user"])){
$q = $_GET["q"];
$condi = $_GET["condi"];
//$real_condition = che_con();
//if ($real_condition == $condi){

$user = $_COOKIE["user"];
$activity = $_GET["activity"];
include 'sql_connect.php';

//$sql_act="SELECT * FROM activities WHERE checkin_user = '$user'";
//echo $sql_act;
//echo $q;
//$result = mysqli_query($con,$sql_act);
//if (!$result) {
//    printf("Error: %s\n", mysqli_error($con));
//    exit();
//   }
//$row = mysqli_fetch_array($result);
//$activity = $row["activity_name"];
$databar = $activity . $user;
 
$sql="SELECT * FROM $databar WHERE student_no = '$q'";
 
$result = mysqli_query($con,$sql);

if ($sql != NULL)
{
    //$result = mysqli_query($con,$sql);

    $row = mysqli_fetch_array($result);
    if ($row[$condi] != NULL)
    {
        mysqli_query($con,"UPDATE $databar SET $condi = 'already' WHERE student_no = '$q'");
        echo "<data><student_id>" . $row["student_id"] . "</student_id>"
        . "<student_name>" . $row["student_name"] . "</student_name>"
        . "<student_group>" . $row["student_group"] . "</student_group>"
        . "<status>"
        //当NA时返回success, 否则返回值与库中值相同（already, special）
        . ($row[$condi] == "NA" ? "success" : $row[$condi])
        . "</status></data>";
    }
    else
        echo "<data><status>fail</status></data>";
}
 
mysqli_close($con);
//}
//else
//{
//    echo "已超时，请刷新界面";
//    echo $condi;
//    echo $real_condition;
//}
}
else
    echo '<a href="/login.php">Not Sign IN</a>'
?>
