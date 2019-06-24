<?php
include_once('configg.php');
session_start();

if(isset($_POST['user_id'])) {
    
    $query = "SELECT * FROM login where id = '".$_POST["user_id"]."'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

?>