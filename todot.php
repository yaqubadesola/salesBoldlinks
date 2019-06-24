<?php
include_once('configg.php');
//session_start();

if(isset($_POST['todo_id'])) {
    
    $query = "SELECT * FROM todos where id = '".$_POST["todo_id"]."'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

?>