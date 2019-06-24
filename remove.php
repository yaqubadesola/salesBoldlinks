<?php
include_once('config.php');
include_once('exp_class.php');

$db_class = new configure;
$id = isset($_GET['id']) && ($_GET['id'] != "")  ?  $_GET['id']:"";

$del_qry = "DELETE FROM expenses WHERE id='$id'";
$del_res = mysqli_query($db_class->connect(), $del_qry);

if ($del_res) {
    
    echo "<h2 style='color:red'>DELETING....</h2>";
    header("Refresh:3, URL=expenses.php");
}


?>