<?php
include_once('configg.php');
session_start();

if(isset($_POST['sale_id'])) {
    
    $query = "SELECT * FROM records where id = '".$_POST["sale_id"]."'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

?>