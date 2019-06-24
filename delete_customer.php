<?php
ini_set("display_errors",1);
error_reporting(-1);


include_once('config.php');
include_once('records.php');
//$id = $row['id'];
$id = (isset($_GET['id'])) && !empty($_GET['id'])? $_GET['id']:"";
$DELETEDB = "DELETE FROM customers WHERE id= '$id'";
//echo $DELETEDB; die();
$result = mysqli_query($connect,$DELETEDB);




?>