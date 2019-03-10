<?php
function csvTOsql ($file,$activity){
    $user = $_COOKIE["user"];
    include 'sql_connect.php';
    $databar = $activity . $user;
    mysqli_query($con,"CREATE TABLE $databar (student_id VARCHAR(20) ,student_name VARCHAR(100) ,student_mail VARCHAR(100),student_group VARCHAR(100));");
    echo mysqli_error($con);
    $file_path = "/var/www/html/ecis/temp/$file";
    //echo $file_path;
    //echo "LOAD DATA INFILE '$file_path' INTO TABLE $activity FIELDS TERMINATED BY ',' ENCLOSED BY '\"' ESCAPED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 LINES;";
    mysqli_query($con,<<<EOF
    LOAD DATA infile '$file_path' into TABLE $databar 
    FIELDS TERMINATED BY ',' 
    ENCLOSED BY '"' ESCAPED BY '"' 
    LINES TERMINATED BY '\r\n' 
    IGNORE 1 LINES;
EOF
);
    echo mysqli_error($con);
    mysqli_query($con,"ALTER table $databar add column checkin varchar(20);");
    mysqli_query($con,"ALTER table $databar add column checkout varchar(20);");
    mysqli_query($con,"ALTER table $databar add column student_no varchar(100);");
    mysqli_query($con,"UPDATE $databar set student_no = student_id;");
    mysqli_query($con,"UPDATE $databar set checkin = 'NA';");
    mysqli_query($con,"UPDATE $databar set checkout = 'NA';");
    //echo "<h1>SUCCESS</h1>";
}
