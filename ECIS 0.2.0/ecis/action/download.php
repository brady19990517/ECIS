<?php
if (isset($_COOKIE["user"]) and $_COOKIE["type"]=="checkuser"){
    $user = $_COOKIE["user"];
}else{
    header("Location: 'login.php'"); 
}
include 'connect.php';
$connectDBS = new connectDataBase();

$activity = $_GET['activity'];
$databar = $activity.$user;

// call export function
exportMysqlToCsv('export_csv.csv', $connectDBS->link, $databar);


// export csv
function exportMysqlToCsv($filename = 'export_csv.csv', $con, $databar)
{

  
// Check connection
    
    $sql_query = "SELECT * FROM $databar";

    // Gets the data from the database
    $result = mysqli_query($con, $sql_query);
    echo mysqli_error($con);
    $f = fopen('php://temp', 'wt');
    $first = true;
    while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        if ($first) {
            fputcsv($f, array_keys($row));
            $first = false;
        }
        fputcsv($f, $row);
    } // end while

    $size = ftell($f);
    rewind($f);

    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Length: $size");
    // Output to browser with appropriate mime type, you choose ;)
    header("Content-type: text/x-csv");
    header("Content-type: text/csv");
    header("Content-type: application/csv");
    header("Content-Disposition: attachment; filename=$filename");
    fpassthru($f);
    exit;

}




?>
