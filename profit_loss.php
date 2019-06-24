<?php

include_once('configg.php');
session_start();

function getMonthString($m){
    if($m==1){
        return "January";
    }else if($m==2){
        return "February";
    }else if($m==3){
        return "March";
    }else if($m==4){
        return "April";
    }else if($m==5){
        return "May";
    }else if($m==6){
        return "June";
    }else if($m==7){
        return "July";
    }else if($m==8){
        return "August";
    }else if($m==9){
        return "September";
    }else if($m==10){
        return "October";
    }else if($m==11){
        return "November";
    }else if($m==12){
        return "December";
    }
}
 

if(isset($_SESSION['user'])) {
    
    
$this_month = date("m");
$this_year = date("Y");
$leap_months = array(1,3,5,7,8,10,12);
$sale = array();

// sales
for($i = 1; $i <= 12; $i++) {

    if($i < 10) $i = "0".$i;
    //print_r($leap_months); //die();
    if(in_array($i,$leap_months)) {
        
        $start_date[$i] = date("Y")."-$i"."-01";
        $end_date[$i] = date("Y-m-31");
        
        
    } 
    else{
        
        $start_date[$i] = date("Y-$i-01");
        $end_date[$i] = date("Y-$i-30");
        if($i == 2 and $this_year/4 != 0){
         $end_date[$i] = date("Y-$i-28");
        }
        else{
         $end_date[$i] = date("Y-$i-29");
        }
    
    }
   // echo "this is $i ..... {$start_date[$i]} ------ $end_date[$i]";echo '<br>';
    $month_sales_total = "SELECT SUM(total) FROM records WHERE category = 'Web Projects' AND date BETWEEN '$start_date[$i]' AND '$end_date[$i]'";
    //echo "qry = $month_sales_total";
    $result     = mysqli_query($connect, $month_sales_total);
    $row1a[$i]  = mysqli_fetch_row($result); 
    $sales = $row1a[$i];
    if($this_month == $i) break;
}


//expenses
for($i = 1; $i <= 12; $i++) {

    if($i < 10) $i = "0".$i;
    //print_r($leap_months); //die();
    if(in_array($i,$leap_months)) {
        
        $start_date[$i] = date("Y")."-$i"."-01";
        $end_date[$i] = date("Y-m-31");
        
        
    } 
    else{
        
        $start_date[$i] = date("Y-$i-01");
        $end_date[$i] = date("Y-$i-30");
        if($i == 2 and $this_year/4 != 0){
         $end_date[$i] = date("Y-$i-28");
        }
        else{
         $end_date[$i] = date("Y-$i-29");
        }
    
    }
   // echo "this is $i ..... {$start_date[$i]} ------ $end_date[$i]";echo '<br>';
    $month_training_total = "SELECT SUM(total) FROM records WHERE category = 'Training' AND date BETWEEN '$start_date[$i]' AND '$end_date[$i]'";
    //echo "qry = $month_training_total";
    $result     = mysqli_query($connect, $month_training_total);
    $row1a[$i]  = mysqli_fetch_row($result); 
    $training = $row1a[$i];
    if($this_month == $i) break;
}


//graphics AND printing

for($i = 1; $i <= 12; $i++) {

    if($i < 10) $i = "0".$i;
    //print_r($leap_months); //die();
    if(in_array($i,$leap_months)) {
        
        $start_date[$i] = date("Y")."-$i"."-01";
        $end_date[$i] = date("Y-m-31");
        
        
    } 
    else{
        
        $start_date[$i] = date("Y-$i-01");
        $end_date[$i] = date("Y-$i-30");
        if($i == 2 and $this_year/4 != 0){
         $end_date[$i] = date("Y-$i-28");
        }
        else{
         $end_date[$i] = date("Y-$i-29");
        }
    
    }
   // echo "this is $i ..... {$start_date[$i]} ------ $end_date[$i]";echo '<br>';
    $month_printing_total = "SELECT SUM(total) FROM records WHERE category = 'Graphics/Printing' AND date BETWEEN '$start_date[$i]' AND '$end_date[$i]'";
    //echo "qry = $month_printing_total";
    $result     = mysqli_query($connect, $month_printing_total);
    $row1a[$i]  = mysqli_fetch_row($result); 
    $printing = $row1a[$i];
    if($this_month == $i) break;
}

//other services

for($i = 1; $i <= 12; $i++) {

    if($i < 10) $i = "0".$i;
    //print_r($leap_months); //die();
    if(in_array($i,$leap_months)) {
        
        $start_date[$i] = date("Y")."-$i"."-01";
        $end_date[$i] = date("Y-m-31");
        
        
    } 
    else{
        
        $start_date[$i] = date("Y-$i-01");
        $end_date[$i] = date("Y-$i-30");
        if($i == 2 and $this_year/4 != 0){
         $end_date[$i] = date("Y-$i-28");
        }
        else{
         $end_date[$i] = date("Y-$i-29");
        }
    
    }
   // echo "this is $i ..... {$start_date[$i]} ------ $end_date[$i]";echo '<br>';
    $month_others_total = "SELECT SUM(total) FROM records WHERE category = 'Other Services' AND date BETWEEN '$start_date[$i]' AND '$end_date[$i]'";
    //echo "qry = $month_others_total";
    $result     = mysqli_query($connect, $month_others_total);
    $row1a[$i]  = mysqli_fetch_row($result); 
    $others = $row1a[$i];
    if($this_month == $i) break;
}


// Total sales

for($i = 1; $i <= 12; $i++) {

    if($i < 10) $i = "0".$i;
    //print_r($leap_months); //die();
    if(in_array($i,$leap_months)) {
        
        $start_date[$i] = date("Y")."-$i"."-01";
        $end_date[$i] = date("Y-m-31");
        
        
    } 
    else{
        
        $start_date[$i] = date("Y-$i-01");
        $end_date[$i] = date("Y-$i-30");
        if($i == 2 and $this_year/4 != 0){
         $end_date[$i] = date("Y-$i-28");
        }
        else{
         $end_date[$i] = date("Y-$i-29");
        }
    
    }
   // echo "this is $i ..... {$start_date[$i]} ------ $end_date[$i]";echo '<br>';
    $month_sale_total = "SELECT SUM(total) FROM records WHERE date BETWEEN '$start_date[$i]' AND '$end_date[$i]'";
    //echo "qry = $month_sale_total";
    $result     = mysqli_query($connect, $month_sale_total);
    $row1a[$i]  = mysqli_fetch_row($result); 
    $sale = $row1a[$i];
    if($this_month == $i) break;
}

// total expenditure

for($i = 1; $i <= 12; $i++) {

    if($i < 10) $i = "0".$i;
    //print_r($leap_months); //die();
    if(in_array($i,$leap_months)) {
        
        $start_date[$i] = date("Y")."-$i"."-01";
        $end_date[$i] = date("Y-m-31");
        
        
    } 
    else{
        
        $start_date[$i] = date("Y-$i-01");
        $end_date[$i] = date("Y-$i-30");
        if($i == 2 and $this_year/4 != 0){
         $end_date[$i] = date("Y-$i-28");
        }
        else{
         $end_date[$i] = date("Y-$i-29");
        }
    
    }
   // echo "this is $i ..... {$start_date[$i]} ------ $end_date[$i]";echo '<br>';
    $month_expenditure_total = "SELECT SUM(cost) FROM expenses WHERE date BETWEEN '$start_date[$i]' AND '$end_date[$i]'";
    //echo "qry = $month_expenditure_total";
    $result     = mysqli_query($connect, $month_expenditure_total);
    $row1a[$i]  = mysqli_fetch_row($result); 
    $expenditure = $row1a[$i];
    if($this_month == $i) break;
}
    
?>


<html>
<head>


 <link href="css/bootstrap.min.css" rel="stylesheet"/>
 <link href="css/moi.css" rel="stylesheet"/> 



  <script src="js/jquery.min.js" type="text/javascript"></script> 
  <script src="js/jquery-3.3.1.js"></script>
<style>
    .short th, td {
    padding: 0px;
}
    
</style>

</head>
<body>

<div class=" row ab ">
    <div class="col-md-12" class="text-center">
        <h1>PROFIT & LOSS</h1>
    </div>

        <ul id="nalo">
        	<li><a href="logout.php">Logout</a></li>
        	<li><a href="home.php">Dashboard</a></li>
        </ul>
</div>
<div class="row">
    <div class="col-md-2 navo">

        <div>
            <p style="color: blue; margin-left: 5px; text-align: center;"><b>Monthly sales from web projects</b></p>
        </div>
        <table class="table table-striped table-bordered" style="text-align: center; margin-left: 5px;">
            <tr>
                <th>Month</th>
                <th>Revenue</th>
            
            </tr>
            <tr>
            <?php
            if(is_array($sales) && !empty($sales)){
              $last_index_of_sales = count($sales)-1;
              for($j=1;$j<=12; $j++){
                   // 
                    echo "<th>".getMonthString($j)."</th>";//die;
              ?>    <td> <?php
                   if ($sales[0] == '') { 
                        echo "<span style = 'color:brown'>No record</span>";
                   } else {
                        echo "$sales[0]";
                   }
                ?>   </td><?php
               if($sales[$last_index_of_sales]+1 == ltrim(date('m'), '0')); break;
              }
            }
            ?>
            </tr>
            
        </table>
        
        <div>
            <p style="color: blue; margin-left: 5px; text-align: center;"><b>Monthly sales from Training</b></p>
        </div>
        
        <table class="table table-striped table-bordered" style="text-align: center; margin-left: 5px;">
            <tr>
                <th>Month</th>
                <th>Revenue</th>
            
            </tr>
            <tr>
            <?php
            if(is_array($training) && !empty($training)){
              $last_index_of_training = count($training)-1;
              for($j=1;$j<=12; $j++){
                   // 
                    echo "<th>".getMonthString($j)."</th>";//die;
              ?>    <td> <?php
                   if ($training[0] == '') { 
                        echo "<span style = 'color:brown'>No record</span>";
                   } else {
                        echo "$training[0]";
                   }
                ?>   </td><?php
               if($training[$last_index_of_training]+1 == ltrim(date('m'), '0')); break;
              }
            }
            ?>
            </tr>
            
        </table>
</div>

<div class="col-md-8 section">
        <h3 style="color: #5584ff;" class="text-center"><b></b>Profit & Loss Account for Year <?php echo $this_year;   ?></b></h3>
        <table class="table table-striped table-bordered" style="text-align: center; margin-left: 5px;">
            <tr>
        <th>MONTH</th>
        <th>REVENUE</th>
        <th>EXPENDITURE</th>
        <th>NET</th>
    </tr>
            <tr>
            <?php
            if(is_array($sale) && !empty($sale)){
              $last_index_of_sale = count($sale)-1;
              for($j=1;$j<=12; $j++){
                   // 
                    echo "<th>".getMonthString($j)."</th>";//die;
              ?>    <td> <?php
                   if ($sale[0] == '') { 
                        echo "<span style = 'color:brown'>No record</span>";
                   } else {
                        echo "$sale[0]";
                   }
                ?>   </td><?php
               if($sale[$last_index_of_sale]+1 == ltrim(date('m'), '0')); break;
              }
            }
            ?>
            
            <?php
            if(is_array($expenditure) && !empty($expenditure)){
              $last_index_of_expenditure = count($expenditure)-1;
              for($j=1;$j<=12; $j++){
                   // 
              
              ?>    <td> <?php
                   if ($expenditure[0] == '') { 
                        echo "<span style = 'color:brown'>No record</span>";
                   } else {
                        echo "$expenditure[0]";
                   }
                ?>   </td><?php
               if($expenditure[$last_index_of_expenditure]+1 == ltrim(date('m'), '0')); break;
              }
            }
            ?>
            <td><?php if($sale[0] == "" and $expenditure[0] == "") {
            
                    $net = "No record found";
                    echo '<span style = "color:brown"><b>' . $net . '</b></span';
            } elseif($sale[0] >= $expenditure[0]) {
    
                $net = $sale[0] - $expenditure[0];
                echo '<span style = "color:blue"><b>' . $net . '</b></span';
            } else {
                
                $net = $sale[0] - $expenditure[0];
                echo '<span style = "color:red"><b>' . $net . '</b></span';
            }  ?></td>
            </tr>
            
        </table>
        
    </div>
    <div class="col-md-2 navo">

        <div>
            <p style="color: blue; margin-left: 5px; text-align: center;"><b>Monthly sales from Graphics & Printing</b></p>
        </div>
        
        <table class="table table-striped table-bordered" style="text-align: center; margin-left: 5px;">
            <tr>
                <th>Month</th>
                <th>Revenue</th>
            
            </tr>
            <tr>
            <?php
            if(is_array($printing) && !empty($printing)){
              $last_index_of_printing = count($printing)-1;
              for($j=1;$j<=12; $j++){
                   // 
                    echo "<th>".getMonthString($j)."</th>";//die;
              ?>    <td> <?php
                   if ($printing[0] == '') { 
                        echo "<span style = 'color:brown'>No record</span>";
                   } else {
                        echo "$printing[0]";
                   }
                ?>   </td><?php
               if($printing[$last_index_of_printing]+1 == ltrim(date('m'), '0')); break;
              }
            }
            ?>
            </tr>
            
        </table>
        
        
        <div>
            <p style="color: blue; margin-left: 5px; text-align: center;"><b>Monthly sales from other services</b></p>
        </div>
        
        <table class="table table-striped table-bordered" style="text-align: center; margin-left: 5px;">
            <tr>
                <th>Month</th>
                <th>Revenue</th>
            
            </tr>
            <tr>
            <?php
            if(is_array($others) && !empty($others)){
              $last_index_of_others = count($others)-1;
              for($j=1;$j<=12; $j++){
                   // 
                    echo "<th>".getMonthString($j)."</th>";//die;
              ?>    <td> <?php
                   if ($others[0] == '') { 
                        echo "<span style = 'color:brown'>No record</span>";
                   } else {
                        echo "$others[0]";
                   }
                ?>   </td><?php
               if($others[$last_index_of_others]+1 == ltrim(date('m'), '0')); break;
              }
            }
            ?>
            </tr>
            
        </table>
</div>
    </div>
    <?php  } ?>
    </body>
    </html>