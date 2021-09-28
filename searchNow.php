<?php

require("config.php");
$id=$_POST['contractID'];

$query = "SELECT query,type,value FROM traits where cID='".$id."'";
if (!$result = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
}

$users = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }

    header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename='.$id.'.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array( 'Query', 'Value', 'Type'));

if (count($users) > 0) {
    foreach ($users as $row) {
        fputcsv($output, $row);
    }
}
}
else{
    header("location: dashboard.php");
}


?>