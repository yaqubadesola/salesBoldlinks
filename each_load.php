<?php


//echo "see your life"; die;
error_reporting("off");
include_once('configg.php');
include_once('record.php');

session_start();

$id = $_REQUEST['id'];

$sel_qry = "SELECT * FROM each_comment WHERE salesid = '$id' ORDER BY date DESC";

//echo $sel_qry; die;
$exp_res = mysqli_query($connect, $sel_qry);
    
    if ($exp_res) {
        
        $row = mysqli_fetch_array($exp_res);
    }
    
    if(isset($_SESSION['user'])) {
        
       
    
    
        foreach ($exp_res as $row) {
            
            echo "<span style='color:blueviolet'><b>{$row['user']}</b></span>";
            echo "<span><b> @ {$row['date']}</b></span><br>" ;
            echo $row['comment']; echo "<br><br>";
        }
    }


?>