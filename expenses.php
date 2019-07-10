<?php
include_once('config.php');
include_once('exp_class.php');
include_once('configg.php');

//include_once('action.php');

session_start();
//Start our session.
//session_start();
 
//Expire the session if user is inactive for 30
//minutes or more.
$expireAfter = 300;
 
//Check to see if our "last action" session
//variable has been set.
if(isset($_SESSION['last_action'])){
    
    //Figure out how many seconds have passed
    //since the user was last active.
    $secondsInactive = time() - $_SESSION['last_action'];
    
    //Convert our minutes into seconds.
    $expireAfterSeconds = $expireAfter * 60;
    
    //Check to see if they have been inactive for too long.
    if($secondsInactive >= $expireAfterSeconds){
        //User has been inactive for too long.
        //Kill their session.
        session_unset();
        session_destroy();
      //  echo "<script>console.log('Your Session has expired. Please re-login to continue')</script>";
        header('location: index.htm');
    }
    
}

//Assign the current timestamp as the user's
//latest activity
$_SESSION['last_action'] = time();

$db_class        =   new configure();
//$bold_expenses   =   new expenses();
$user = $_SESSION['user'];
if(isset($_SESSION['user'])) {


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
    $month_expenses_total = "SELECT SUM(cost) FROM expenses WHERE date BETWEEN '$start_date[$i]' AND '$end_date[$i]'";
    //echo "qry = $month_expenses_total";
    $result     = mysqli_query($connect, $month_expenses_total);
    $row1a[$i]  = mysqli_fetch_row($result); 
    $expenses = $row1a[$i];
    if($this_month == $i) break;
}

$db_class    = new configure();
//$my_class    = new action;
$new_recs = "";  

$result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `todos` WHERE task = 'Incomplete'");

$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];

$result = mysqli_query($connect,"SELECT * FROM `todos` WHERE task = 'Incomplete' ORDER BY id DESC");  
?>
 





<!DOCTYPE HTML>
<html>
<head>
<style>

</style>
<!--<link rel="stylesheet" href="css/mystyle.css"/>-->

    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/bat.css" rel="stylesheet"/>
    <link href="css/moi.css" rel="stylesheet"/>
    <link href="css/bootstrap-grid.css" rel="stylesheet"/>
    <link href="css/bootstrap-grid.min.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>
    
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/script.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class=" row ab ">
    <div class="col-md-12" class="text-center">
        <h1><a href="expenses.php" style="color: white;">MANAGE EXPENSES</a></h1>
    </div>

        <ul id="nalo">
        	<li><a href="logout.php">Logout</a></li>
        	<li><a href="home.php">Dashboard</a></li>
        </ul>
    <div style="float:left"><h4 id="mirror_of_model"> </h4></div>
    <div style="float:right; margin-left:300px;"><h4 id="mirror_of_grand"> </h4></div>
  </div>
    
<div class="row">

     <?php if($_SESSION['role'] == 'super-admin')  { ?>
    <div class="col-md-3 navo">
        

        <div>
            <p style="color: red; margin-left: 5px; text-align: center;"><b>Monthly Expenses</b></p>
        </div>
        <table class="table table-striped table-bordered" style="text-align: center; margin-left: 5px;">
            <tr>
                <th>Month</th>
                <th>Revenue</th>
            
            </tr>
            <tr>
            <?php
            if(is_array($expenses) && !empty($expenses)){
              $last_index_of_expenses = count($expenses)-1;
              for($j=1;$j<=12; $j++){
                   // 
                    echo "<th>".getMonthString($j)."</th>";//die;
              ?>    <td> <?php
                   if ($expenses[0] == '') { 
                        echo "<span style = 'color:brown'>No record</span>";
                   } else {
                        echo "$expenses[0]";
                   }
                ?>   </td><?php
               if($expenses[$last_index_of_expenses]+1 == ltrim(date('m'), '0')); break;
              }
            }
            ?>
            </tr>
            
        </table>
        
</div>
<?php } else { ?>
    <div class="col-md-3 navo">
        
        <div>
            <h5 style="color: red; margin-left: 5px;"><b>You have (<?php echo $total_records; ?>) incomple task(s)</b></h5>
            <ul>
            <?php while($row = mysqli_fetch_array($result)){ ?>
                <li><b><?php echo $row['todo']; ?></b></li>
                <?php } ?>
            </ul>
        </div>
        </div>
        <?php } ?>


 <div class="col-md-8 section"> 

<table  style="width: 80%; ">
    <thead>
        <tr>
            <form>
                <div id="form">
                    <th colspan="1"> 
                        <div id="date" class="form-group">
                        <b><span style="color: red; padding: 5px; margin: 7px;">Filter by date</span></b>
                            <?php


                            if (isset($_GET["date_from"]) && $_GET["date_from"] != "") {

                            ?>
                            <input type="checkbox" onclick="myFunction()" id="show" checked="checked"/>
                                <?php
                            }else{

                            ?>
                            <input type="checkbox" onclick="myFunction()" id="show"/>
                                <?php
                            }
                            ?>
                            <div id="hide" onload="hidden">
                                <label>From</label>
                                <input type="date" name="date_from" class="form-control" value="<?php  echo $date_from; ?>"/>
                                <label>To </label>
                                <input type="date" name="date_to" class="form-control" value="<?php echo $date_to; ?>"/>
                            </div>
                        </div>
                    </th>
                    <th colspan="1"> <div id="items" class="form-group">
                        <b><span style="color: red; padding: 5px; margin: 7px;">Filter by Item</span></b>
                            <?php


                            if(isset($_GET["item"]) && $_GET["item"]!=""){

                            ?>
                            <input type="checkbox" onclick="myFunctionb()" id="see" checked="checked"/>
                                <?php
                            }else{

                            ?>
                            <input type="checkbox" onclick="myFunctionb()" id="see"/>
                                <?php
                            }
                            ?>
                            <div  id="blind" >
                                <input type="text" name="item" class="form-control" />
                            </div>
                        </div> 
                    </th>
                    <th colspan="1"> <div id="costs" class="form-group">
                        <b><span style="color: red; padding: 5px; margin: 7px;">Filter by Cost</span></b>
                            <?php


                            if(isset($_GET["cost"]) && $_GET["cost"]!=""){

                            ?>
                            <input type="checkbox" onclick="myFunctionc()" id="watch" checked="checked"/>
                                <?php
                            }else{

                            ?>
                            <input type="checkbox" onclick="myFunctionc()" id="watch"/>
                                <?php
                            }
                            ?>
                            <div  id="pretend" >
                                <input type="text" name="cost" class="form-control"/>
                            </div>
                        </div> 
                    </th>
                    <th  colspan="1"><input class='btn btn-success btn-sm' type="submit" name="search" value="SEARCH"/></th>
                </div>
            </form>
        </tr>
    </thead>
</table>




    
 <?php
 
  if (isset($_GET['search'])) {   ?>
    
    
    
           <table class="table table-striped table-bordered" id="expenses_table">
           
  
    <thead>

    <tr>
        <th>DATE</th>
        <th>ITEM</th>
        <th>QUANTITY</th>
        <th>COST</th>
        <th>ACTIONS &nbsp; <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-info btn-sm">+ Add</button></th>
    </tr>
    
    </thead>
   
     <tbody>
        
        <?php
       // echo 'cool'; die;
    //
            $recorded = new expenses();
            $new_recs = $recorded->get_records($_GET);//echo "jskvsjn";
            $page_no = $recorded->get_page_num();
            $new_totals = $recorded->get_total($_GET);

            $total_pages = $recorded->get_total_pages();
            
            //$result = mysqli_query($connect,"SELECT * FROM `records` ORDER BY id DESC");
            $page_total = 0;

            function currencyToNum($str){
            return  intval(preg_replace("/[^\d\.]/","", $str));
            };

            $grand_total = 0;
            if(is_array($new_totals)){
                foreach($new_totals as $new_total){
                $grand_total = $grand_total +  currencyToNum($new_total['cost']);
                }
            }
            
            if(is_array($new_recs)){  
                //
                   // echo"am here <br>"; die;
                    $result = $new_recs; //$new_recs;
                    $end_arr = end($result); //print_r($result);//die("EDFH");
                
                 if( $end_arr != "") {

                  //$result =     ;   
                  //print_r($result);die("EDFH");
                  $item     = isset($end_arr["item"]) &&     $end_arr["item"] != "" ?        $end_arr["item"] :"";
                  $date_from   = isset($end_arr["date_from"]) &&    $end_arr["date_from"] != "" ?      $end_arr["date_from"] :"";
                  $date_to     = isset($end_arr["date_to"]) &&      $end_arr["date_to"] != "" ?         $end_arr["date_to"] :"";
                  $cost = isset($end_arr["cost"]) &&  $end_arr["cost"] != "" ?     $end_arr["cost"] :"";
                  array_pop($result);
                }
                }   
                
               // print_r($new_recs); die;
                
               /* $total_records = count($new_recs) -1; 
                    
                    //echo $reco; die;
                
                
         if (isset($_GET['page_no']) && $_GET['page_no']!="") {
        	$page_no = $_GET['page_no'];
            
            
        	} else {
        		$page_no = 1;
                }
                
               // echo $page_no; die;
        
        	$total_records_per_page = 7;
            $offset = ($page_no-1) * $total_records_per_page;
            //echo $offset; die;
        	$previous_page = $page_no - 1;
        	$next_page = $page_no + 1;
        	$adjacents = "2"; 
        
            $total_no_of_pages = ceil($total_records / $total_records_per_page);
        	$second_last = $total_no_of_pages - 1; // total page minus 1   */
        
                
                
                foreach($new_recs as $row) {

                    if (isset($row['id'])) {
                        $page_total = $page_total + currencyToNum($row['cost']);
                        ?>


                        <tr>
                            <td><?php echo $row['date'] ?></td>
                            <td><?php echo $row['item'] ?></td>
                            <td><?php echo $row['quantity'] ?></td>
                            <td><?php echo $row['cost'] ?></td>
                            <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-sm edit_data" />
                                <a onclick="window.open('exp_comment.php?id=<?=$row['id']?>','', 'width=700px, height=300px')" class="btn btn-primary btn-sm text-centre">Comment</a>
                                <input type="button" name="delete" value="X" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm delete_data" /></td>
                        </tr>
                    <?php }
                }
    mysqli_close($connect);
    ?>
    
    
    </tbody>
    </table>

     <div><h4 class="model">Page Total: &#8358;<?= number_format($page_total, 2) ?> </h4></div>

     <div style="float:right; margin-top:-20px;"> <h4 class="grand">Grand Total: &#8358;<?= number_format($grand_total, 2) ?> </h4></div>

     <?php
     //echo $page_no;
     // echo "<br>";
     // echo  "hey";
     //           echo $total_pages;
     // echo "<br>";

     $h = "expenses.php?date_from=&date_to=&products=&product_cat=Web+Projects&search=SEARCH";

     // $urll = "";

     $url = "expenses.php?date_from=".$_GET['date_from']."&date_to=".$_GET['date_to']."&item=".$_GET['item']."&cost=".$_GET['cost']."&search=".$_GET['search'];

     $second_last = $total_pages - 1;
     $urll = $url;

     // echo $url . '<br>';
     //echo basename($_SERVER['REQUEST_URI']);
     //  echo $urll;
     ?>


     <ul class="pagination">
         <li><a href="<?php echo $urll."&page_no=" . 1;?>">First</a></li>
         <li class="<?php if($page_no <= 1){ echo 'disabled'; } ?>">
             <a href="<?php if($page_no <= 1){ echo '#'; } else { echo $urll."&page_no=".($page_no - 1); } ?>">Prev</a>
         </li>
         <li class="<?php if($page_no >= $total_pages){ echo 'disabled'; } ?>">
             <a href="<?php if($page_no >= $total_pages){ echo '#'; } else { echo $urll."&page_no=".($page_no + 1);} ?>">Next</a>
         </li>
         <li><a href="<?php echo $urll . '&page_no='. $total_pages; ?>">Last</a></li>
     </ul>

     <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
         <strong><span style="color: red;">Page <?php echo $page_no." of ".$total_pages; ?></span></strong>
     </div>

     <ul class="pagination">
         <li><a href="<?php echo $urll."&page_no=" . 1;?>">First</a></li>
         <li class="<?php if($page_no <= 1){ echo 'disabled'; } ?>">
             <a href="<?php if($page_no <= 1){ echo '#'; } else { echo $urll."&page_no=".($page_no - 1); } ?>">Prev</a>
         </li>
         <?php
         if ($total_pages <= 10){
             for ($counter = 1; $counter <= $total_pages; $counter++){
                 if ($counter == $page_no) {
                     echo "<li class='active'><a>$counter</a></li>";
                 }else{
                     echo "<li><a href=" . $urll . "&page_no=" . $counter . ">$counter</a></li>";
                 }
             }
         }
         elseif($total_pages > 10){

             if($page_no <= 4) {
                 for ($counter = 1; $counter < 8; $counter++){
                     if ($counter == $page_no) {
                         echo "<li class='active'><a>$counter</a></li>";
                     }else{
                         echo "<li><a href=" . $urll . "&page_no=" . $counter . ">$counter</a></li>";
                     }
                 }
                 echo "<li><a>...</a></li>";
                 echo "<li><a href=" . $urll . "&page_no=" . $second_last . ">$second_last</a></li>";
                 echo "<li><a href=" . $urll . "&page_no=" . $total_pages . ">$total_pages</a></li>";
             }

             elseif($page_no > 4 && $page_no < $total_pages - 4) {
                 $adjacents = 2;
                 echo "<li><a href=" . $urll . "&page_no=" . 1 . ">1</a></li>";
                 echo "<li><a href=" . $urll . "&page_no=" . 2 . ">2</a></li>";
                 echo "<li><a>...</a></li>";
                 for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                     if ($counter == $page_no) {
                         echo "<li class='active'><a>$counter</a></li>";
                     }else{
                         echo "<li><a href=" . $urll . "&page_no=" . $counter . ">$counter</a></li>";
                     }
                 }
                 echo "<li><a>...</a></li>";
                 echo "<li><a href=" . $urll . "&page_no=" . $second_last . ">$second_last</a></li>";
                 echo "<li><a href='?page_no=$total_pages'>$total_pages</a></li>";
             }

             else {
                 echo "<li><a href=" . $urll . "&page_no=" . 1 . ">1</a></li>";
                 echo "<li><a href=" . $urll . "&page_no=" . 2 . ">2</a></li>";
                 echo "<li><a>...</a></li>";

                 for ($counter = $total_pages - 6; $counter <= $total_pages; $counter++) {
                     if ($counter == $page_no) {
                         echo "<li class='active'><a>$counter</a></li>";
                     }else{
                         echo "<li><a href=" . $urll . "&page_no=" . $counter . ">$counter</a></li>";
                     }
                 }
             }
         }
         ?>

     </ul>
    <!--<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
    <strong><span style="color: red;">Page <?php //echo $page_no." of ".$total_no_of_pages; ?></span></strong>
    </div> 
    
    <ul class="pagination">
    <li <?php // if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a <?php // if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
	</li>-->
    
    <?php
    
    /*	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	} */
    
  ?>  
    
 <!-- <li <?php // if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a <?php // if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
	</li> -->
    
    <?php /* if($page_no < $total_no_of_pages){
		echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
		} */
  
        
        ?>
        
 <!--  </ul> -->
    
    
    
  <?php   } else { ?>
 
 
 
     <table class="table table-striped table-bordered " id="expenses_table">
           
  
    <thead>

    <tr>
        <th>DATE</th>
        <th>ITEM</th>
        <th>QUANTITY</th>
        <th>COST</th>
        <th>ACTIONS &nbsp; <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-info btn-sm">+ Add</button></th>
    </tr>
    
    </thead>
   
     <tbody>
 
 
 
 
 <?php

if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	$page_no = $_GET['page_no'];
    
    
	} else {
		$page_no = 1;
        }
        
       // echo $page_no; die;

	$total_records_per_page = 9;
    $offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2";
    $page_total = 0;

    function currencyToNum($str){
        return  intval(preg_replace("/[^\d\.]/","", $str));
    };


    if($_SESSION['role'] == 'super-admin') {
	$result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `expenses` ORDER BY id DESC");
    } else {
        $result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `expenses` WHERE user = '$user' ORDER BY id DESC");
    }
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1
    
    if($_SESSION['role'] == 'super-admin') {
    $result = mysqli_query($connect,"SELECT * FROM `expenses` ORDER BY id DESC LIMIT $offset, $total_records_per_page ");
        $page_sum = mysqli_query($connect,"SELECT cost FROM `expenses` ");
    } else {
        
        $result = mysqli_query($connect,"SELECT * FROM `expenses` WHERE user = '$user' ORDER BY id DESC LIMIT $offset, $total_records_per_page ");
        $page_sum = mysqli_query($connect,"SELECT cost FROM `expenses`  WHERE user = '$user'");
        
    }

    if ($page_sum) {
//
        while ($each_row = mysqli_fetch_assoc($page_sum)) {
            $sum_arrs[] = $each_row;
        }
     }

    //function currencyToNum($str){
        //return  intval(preg_replace("/[^\d\.]/","", $str));
    //};

    $grand_total = 0;

    foreach($sum_arrs as $sum_arr) {
        $grand_total = $grand_total + currencyToNum($sum_arr['cost']);
    }
    while($row = mysqli_fetch_array($result)){
        $page_total = $page_total + currencyToNum($row['cost']);
        ?>
    <tr>
		<td><?php echo $row['date'] ?></td>
        <td><?php echo $row['item'] ?></td>
        <td><?php echo $row['quantity'] ?></td>
        <td><?php echo $row['cost'] ?></td>
        <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-sm edit_data" />
        <a onclick="window.open('exp_comment.php?id=<?=$row['id']?>','', 'width=700px, height=300px')" class="btn btn-primary btn-sm text-centre">Comment</a>
        <input type="button" name="delete" value="X" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm delete_data" /></td>
    </tr>

    <?php
        }
	mysqli_close($connect);
 
 ?>
     </tbody>
    </table>
     <div style="float:right;"> <h4 class="grand">Grand Total: &#8358;<?= number_format($grand_total, 2) ?> </h4></div>
     <div><h4 class="model">Page Total: &#8358;<?= number_format($page_total, 2) ?> </h4></div>


     <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
<strong><span style="color: red;">Page <?php echo $page_no." of ".$total_no_of_pages; ?></span></strong>
</div>

<ul class="pagination">
	<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
		} 
        
        
  }
  ?>
        
        
</ul>
</div>

</div>


<!-- Add Modal-->
<div id="add_data_Modal" class="modal fade" role="dialog" style="height: 500px;">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                    <h4 class="modal-title">Expenses Entry Form</h4>
                </div>
                <div class="modal-body">
                    <form name="customer" id="insert_form" method="post">
                            <input type="text" name="item" placeholder="Enter the item bought" id="item" required="" />
                            <input type="text" name="quantity" placeholder="Enter the quantity" id="quantity" />
                            <input type="text" name="cost" placeholder="Enter purchase price" id="cost" />
                            <input type="text" name="expenses_id" id="expenses_id" style="display: none;" />
                            <!--<input type="submit" name="insert" id="insert" value="Insert" style="background-color: #0e1a35; color: !important#fff; font-size: 25px; font-weight: bolder;" />-->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                    <button type="submit" class="add-project" form="insert_form" name="insert" id="insert" value="Insert">Insert</button>
            </div>

        </div>
    </div>
    </div>
    
    <!-- Delete Modal-->
    <div id="delete_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                    <h4 class="modal-title">Delete Expenses</h4>
                </div>
                <div class="modal-body">
                <form name="deleteForm" id="deleteForm">
                <input type="text" name="expense_id" id="expense_id" style="display: none;"/>
                </form>
                <div class="deleteContent">
					<span>Are you sure you want to delete this record?</span>

				</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                    <button type="submit" class="add-project" form="deleteForm" name="delete" id="delete" value="Delete">Delete</button>
                </div>
            </div>

        </div>
    </div>

<script>

    if(document.getElementsByClassName("model")[0].innerText){
        document.getElementById("mirror_of_model").innerText = document.getElementsByClassName("model")[0].innerText;
    }

    if(document.getElementsByClassName("grand")[0].innerText){
        document.getElementById("mirror_of_grand").innerText = document.getElementsByClassName("grand")[0].innerText;
    }

    if(document.getElementsByClassName("grand")[0].innerText){
        document.getElementById("mirror_of_grand_two").innerText = document.getElementsByClassName("grand")[0].innerText;
    }



</script>

<script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });
      
 $(document).on('click', '.edit_data', function(){  
           var expenses_id = $(this).attr("id");  
          // alert(customer_id);
           $.ajax({  
                url:"edit_expenses.php",  
                method:"POST",  
                data:{expenses_id:expenses_id},  
                dataType:"json",  
                success:function(data){  
                    
                $('#item').val(data.item);
                $('#quantity').val(data.quantity);
                $('#cost').val(data.cost);
                $('#expenses_id').val(data.id);
                $('#insert').val('Insert');
                $('#add_data_Modal').modal('show'); 
                }  
           });  
      }); 
      
 $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#item').val() == "")  
           {  
                alert("Enter purchase item");  
           }    
           else  
           {  
                $.ajax({  
                     url:"expense.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#expenses_table').html(data);  
                     }  
                });  
           }  
      }); 
      
 $(document).on('click', '.delete_data', function(){  
           var expense_id = $(this).attr("id");  
               // alert(custom_id);
                $.ajax({  
                     url:"addexpense.php",  
                     method:"POST",  
                     data:{expense_id:expense_id},
                     dataType:"json",   
                     success:function(data){
                          $('#expense_id').val(data.id);
                          $('#delete').val('Delete');
                          $('#delete_modal').modal('show');  
                     }  
                });             
      }); 
        
   $('#deleteForm').on("submit", function(event){  
           event.preventDefault();  
           if($('#expense_id').val() == "")  
           {  
                alert("You can't delete");  
           }    

               $.ajax({  
                     url:"delete_expenses.php",  
                     method:"POST",  
                     data:$('#deleteForm').serialize(),  
                     beforeSend:function(){  
                          $('#delete').val("Deleting");  
                     },  
                     success:function(data){   
                          $('#delete_modal').modal('hide');  
                          $('#expenses_table').html(data);  
                     }  
                });  
                      
      }); 
 }); 
  
 </script>
<script src="js/invent.js"></script>
<?php } ?>
</body>

</html>

