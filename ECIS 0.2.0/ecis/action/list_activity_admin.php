<?php
header("Content-Type: text/html; charset=utf8");
if (isset($_COOKIE["user"]) and $_COOKIE["type"]=="admin")
{
    $user=$_COOKIE["user"];
    include 'sql_connect.php';
    $sql="SELECT * FROM activities";
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
        echo "<a>User numbers : <a>";
        echo $length;
        echo "<br>";
        echo <<<EOF
        <table>
        <thead>
            <td>No.</td> <td>ActivityName</td> <td>User</td> <td>action</td>
        </thead>
EOF;
        if ($length > 1){
        while($row=mysqli_fetch_row($result)) {
        //while($row = mysqli_fetch_assoc($result)) {
        //    echo "1";
            //print_r ($row);
            //echo "<br>";
            $username = $row[2];
            $activityname=$row[1];
            //echo $i;
            $i = $i + 1;
            $j = $i - 1;
            echo <<<EOF
            <tr>
            <td><a>$j</a></td>
            <td><a>$activityname</a></td>
            <td><a>$username</a></td>
            <td onClick="deleteActivityAdmin('$activityname','$username');"><a>delete<a></td>
            </tr>
EOF;
        }
        }
        else
	{
	    $row = mysqli_fetch_array($result);
            $username = $row["username"];
            $type = $row['usertype'];
            echo <<<EOF
            <tr>            
            <td><a>1</a></td>
	        <td><a>$activityname</a></td>
	        <td><a>$username</a></td>
            <td onClick="deleteActivityAdmin('$activityname','$username');"><a>delete</a></td>
            <tr>
EOF;
        }
    echo "</table>";
    }
    else {
        echo "No activity";
    }
}