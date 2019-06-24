<?php

include_once('configg.php');
//session_start();

if(isset($_POST['custom_id'])) {
    
    $query = "SELECT * FROM customers where id = '".$_POST["custom_id"]."'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

?>