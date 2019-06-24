<?php

include_once('configg.php');
//session_start();

if(isset($_POST['to_id'])) {
    
    $query = "SELECT * FROM todos where id = '".$_POST["to_id"]."'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

?>