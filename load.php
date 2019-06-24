<?php

error_reporting("off");
include_once('configg.php');
include_once('record.php');

session_start();

$sel_qry = "SELECT * FROM comment ORDER BY date DESC";
$exp_res = mysqli_query($connect, $sel_qry);
    
    if ($exp_res) {
        
        $row = mysqli_fetch_array($exp_res);
    }
    
    if(isset($_SESSION['user'])) {
        
       
    
    
        foreach ($exp_res as $row) {
            
            echo "<span style='color:blueviolet'><b>{$_SESSION['fullname']}</b></span>";
            echo "<span><b> @ {$row['date']}</b></span><br>" ;
            echo $row['comments']; echo "<br><br>";
        }
    }


?>