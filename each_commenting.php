<?php
error_reporting("on");
include_once('config.php');

$db_class = new configure();

session_start();


    
    $output = '';   

    $salesid = mysqli_real_escape_string($db_class->connect(), $_POST['id']);
    $comment = mysqli_real_escape_string($db_class->connect(), $_POST['comment']);
    $date = date("Y-m-d h:i:sa");
  
    
    
    if($_POST['id'] != "") {
    //echo $_POST['customer_id'];
    $query = "INSERT INTO sales_comment_table(user,date,comment,salesid) 
                    VALUES('{$_SESSION["fullname"]}','$date','$comment','$salesid')";  
    $result = mysqli_query($db_class->connect(), $query);
    //echo $query; die;
    }
    
    if ($result) {
        
         $sel_qry = "SELECT * FROM sales_comment_table WHERE salesid='$salesid' ORDER BY date DESC";
   
         $exp_res = mysqli_query($db_class->connect(), $sel_qry);
         
         
          $output .= "<div id='read' style='float: right; padding: 0px; margin-top:10px; width: 100%;'>";
                

            while($row = mysqli_fetch_array($exp_res)) {
                
         
         $output .= " 
                <span style='color:blueviolet'><b>" .$row['user']."</b></span>
                <span><b>" . '@' .$row['date']."</b></span><br>
                <span>".$row['comment']."<br><br>";
            }
    
                $output .= '</div>';
  }
  
    
   echo $output; 

?>