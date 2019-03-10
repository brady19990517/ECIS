<?php
class SqlDB{  
    public function sql($link, $activity, $mode, $username){
        switch ($mode) {
            
            case '0':
            $mysql = "CREATE TABLE $activity (
                    id int,
                    Starttime datetime,
                    Endtime datetime,
                    
                );";
            
    		$result = mysqli_query($link, $mysql);
            break;

            case '1':
            $mysql = "SELECT COUNT(*) FROM activities
                WHERE check_username='$username' AND act_name = '$activity'";
            $result = mysqli_query($link, $mysql);
            $myrow = mysqli_fetch_array($result);
            //echo $myrow[0];
            if($myrow[0]  == 0){
                $mysql = "INSERT INTO activities (act_name, check_username)
                VALUES ('$activity','$username')";
    		    $result = mysqli_query($link, $mysql);
                echo 1;
            }else{
                echo 0;
            }
            break;
            

            
        }
    }
}
?>
        