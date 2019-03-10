<?php
header("Content-Type: text/html; charset=utf8");
//echo $_COOKIE["user"];
//if ($_COOKIE["user"] == "checkuser")
//{
    $user=$_COOKIE["user"];
    include 'sql_connect.php';
    $sql="SELECT * FROM activities WHERE check_username = '$user'";
    //echo $q;
    date_default_timezone_set('PRC');
    $result = mysqli_query($con,$sql);
    //$result = $con->query($sql);
    //$row = mysqli_fetch_array($result);
    //print_r ($row);

    if (mysqli_num_rows($result) >= 1) {
        // 输出数据
        //print_r($row);
        //$cou = count($row,COUNT_NORMAL);
        //$row = mysqli_fetch_array($result);
        //print_r ($row);
        //echo "<br>";
        $length = mysqli_num_rows($result);
        $i = 1;
        echo "<a>Activity number : <a>";
        echo $length;
        echo "<br>";
        echo <<<EOF
        <table>
        <thead>
            <td>No.</td> <td>Name</td> <td>Download Link</td> <td>Action</td>
        </thead>
EOF;
        if ($length > 1){
        while($row=mysqli_fetch_row($result)) {
        //while($row = mysqli_fetch_assoc($result)) {
        //    echo "1";
            //print_r ($row);
            //echo "<br>";
            $activity_name = $row[1];
            $time=$row[3];
            //echo $i;
            $i = $i + 1;
            $j = $i - 1;
            echo <<<EOF
            <tr>
            <td><a>$j</a></td>
            <td><a href="checkpage.php?activity=$activity_name">$activity_name</a></td>
            <td><a href="action/download.php?activity=$activity_name">download</a></td>
            <td onClick="deleteActivity('$activity_name');"><a>delete</a></td>
            </tr>
EOF;
        }
        }
        else
	{
	    $row = mysqli_fetch_array($result);
            $activity_name = $row["act_name"];
            $time=$row['checkin_time'];
            echo <<<EOF
            <tr>            
            <td><a>1</a></td>
	        <td><a href="checkpage.php?activity=$activity_name">$activity_name</a></td>
	        <td><a href="action/download.php?activity=$activity_name">download</a></td>
            <td onClick="deleteActivity('$activity_name');"><a>delete</a></td>
            <tr>
EOF;
        }
    echo "</table>";
    }
    else {
        echo "No activity";
    }
//}
//else
//    echo "
//<script>
//        setTimeout(function(){window.location.href='/ecis/login.php';},1000);
//</script>
//";
//    echo '<a href="login.php">未登陆</a>';
?>
