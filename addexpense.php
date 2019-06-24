<?php
include_once('configg.php');
session_start();

if(isset($_POST['expense_id'])) {
    
    $query = "SELECT * FROM expenses where id = '".$_POST["expense_id"]."'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

?>