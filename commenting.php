<?php
error_reporting("off");
include_once('configg.php');
include_once('record.php');

session_start();


  function filter_inputs($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  
}

//print_r($_REQUEST); die();

   /* $sel_qry = "SELECT * FROM comment ORDER BY date DESC";
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
    }*/
    
    
    
        /*if($_REQUEST['comment'] !="") {
        $comment = filter_inputs($_REQUEST['comment']);
        $date = date("Y-m-d h:i:sa");
        
        $ins_qry = "INSERT INTO comment(comments,date) 
                    VALUES('$comment','$date')"; 
                    
                   // echo $ins_qry; die();               
        $ins_res = mysqli_query($connect, $ins_qry);
        
        
        if ($ins_res) {
            
            $sel_qry = "SELECT * FROM comment ORDER BY date DESC";
            $exp_res = mysqli_query($connect, $sel_qry);
            
            if ($exp_res) {
                
                $row = mysqli_fetch_array($exp_res);
            }
        
        
        }
        
        if(isset($_SESSION['user'])) {
            
            echo "<span style='color:blueviolet'><b>{$_SESSION['fullname']}</b></span>";
            echo "<span><b> @ {$row['date']}</b></span><br>" ;
            echo $row['comments']; echo "<br><br>";
        }
        
        }*/
        
        
   

$comment = filter_inputs($_REQUEST['comment']);
$date = date("Y-m-d h:i:sa");

$ins_qry = "INSERT INTO comment(comments,date) 
                    VALUES('$comment','$date')";                
$ins_res = mysqli_query($connect, $ins_qry);

if ($ins_qry) {
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
}
?>