<?php
include_once('configg.php');
session_start();

if(isset($_POST['sales_id'])) {
    
    $query = "SELECT * FROM records where id = '".$_POST["sales_id"]."'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

?>