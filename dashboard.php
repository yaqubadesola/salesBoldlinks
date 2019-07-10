<?php
// AUTHOR: OLAYIOYE IBRAHIM OLUWAFEMI
//YEAR: 2018

include_once('configg.php');
include_once('config.php');
include_once('action.php');
include_once('records.php');

//echo "Yes oooooooooo"; die;
 
session_start();

//echo "Yes oooooooooo"; die;
 
//Start our session
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
        echo "<script>console.log('Your Session has expired. Please re-login to continue')</script>";
        header('location: index.htm');
    }
    
}

if(isset($_SESSION['user'])) {
 
//Assign the current timestamp as the user's
//latest activity
$_SESSION['last_action'] = time();

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


//Training
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
   // echo "qry = $month_training_total"; die;
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



//print_r($start_date); echo '<br>'; print_r($end_date); echo '<br>'; print_r($sales); die('stop herydyghe');
$balance_query =  "SELECT SUM(balance) FROM records";
$balance_result = mysqli_query($connect, $balance_query);
$row1a = mysqli_fetch_row($balance_result);
$balance = $row1a[0]; 


$db_class    = new configure();
$my_class    = new action;
$new_recs = "";

$user = $_SESSION['user'];
//echo $user; die;

$result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `todos` WHERE task = 'Incomplete'");

$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];

$result = mysqli_query($connect,"SELECT * FROM `todos` WHERE task = 'Incomplete' ORDER BY id DESC");


?>
 





<!DOCTYPE HTML>
<html>
<head>

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
    
<style>
    .short th, td {
    padding: 0px;
}
    
</style>
</head>
<body>

<div class=" row ab ">
    <div class="col-md-12" class="text-center">
        <h1><a href="dashboard.php" style="color: white;">MANAGE SALES RECORD</a></h1>
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
    <div class="col-md-2 navo">
    
        
        <div>
            <p style="color: red; margin-left: 11px; text-align: center;"><b>Oustanding Balance: <?php echo $balance;  ?></b></p>
        </div>

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
 <div class="col-md-8 section text-center justify-content-center">  

<table style="width: 100%;" >
<thead>
<tr>

<form action="dashboard.php" method="get">
<div id="form">


<th colspan="2"> 
<div id="date" class="form-group">
<b><span style="color: red; padding: 5px; margin: 7px;">Filter by date</span></b>
<?php


 if(isset($_GET["date_from"]) && $_GET["date_from"]!=""){
  
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
<input type="date" name="date_from" class="form-control" value="<?php echo $date_from; ?>"/>
<label>To </label>
<input type="date" name="date_to" class="form-control" value="<?php echo $date_to; ?>"/>
</div>
</div>
</th>  

<th colspan="1"> <div id="product" class="form-group">
<b><span style="color: red; padding: 5px; margin: 7px;">Filter by nature of job</span></b>
<?php


 if(isset($_GET["products"]) && $_GET["products"]!=""){
  
    ?>
<input type="checkbox" onclick="myFunctionb()" id="see" checked="checked" />
 <?php
    }else{ 
        
        ?>
 <input type="checkbox" onclick="myFunctionb()" id="see"/>
 <?php  
  }
?>
<div  id="blind" >
<input type="text" name="products" class="form-control" value="<?php echo $product; ?>"/>
</div>
</div> </th>
<th colspan="2"> <div>
<b><span style="color: red; padding: 5px; margin: 7px;">Filter by category</b></span>
<?php


 if(isset($_GET["product_cat"]) && $_GET["product_cat"]!=""){
  
    ?>
<input type="checkbox" onclick="myFunctionc()" id="watch" checked="checked"/>
<?php
    }else{ 
        
        ?>
<input type="checkbox" onclick="myFunctionc()" id="watch"/>
 <?php  
  }
?>
<div id="pretend" class="form-group">
<select name="product_cat" class="form-control">
<option value="select" ><?php echo $product_cat; ?></option>
<option value="select" >Choose Category</option>
<option value="Web Projects">Web Projects</option>
<option value="Training">Training</option>
<option value="Graphics/Printing">Graphics/Printing</option>
<option value="Other Services">Other Services</option>
</select>
</div>
</div>
</th>
<div></div>
<th  colspan ="1"><input class='btn btn-success btn-sm' type="submit" name="search" value="SEARCH"/></th>
</div> 


</tr>
</thead>
</form>
</table>



 
       
  <?php 
  /*
    $amount_charged = 0.0;
    $amount_paid = 0.0;
    $to_balance = 0.0; 
  
  // if(isset($_SESSION['user'])) {
    
   //
     //while($row = mysqli_fetch_assoc($result))
     //if (is_array($result)) array_pop($result);
     
     foreach($result as $row)
     { 
        //print_r($row);die();
        
       // $amount_charged += $row['amount'];
        $amount_paid += $row['total'];
        $to_balance += $row['balance'];
        
     }

    */
    
    if (isset($_GET['search'])) {  ?>
    
    
    
           <table class="table table-striped table-bordered" id="sales_table">
           
  
    <thead>

    <tr>
        <th>DATE</th>
        <th>JOB</th>
		<th>COPIES</th>
        <th>CATEGORY</th>
        <th>PAID</th>
        <th>ACTIONS &nbsp; <button type='button' name='add' id='add' data-toggle='modal' data-target='#add_data_Modal' class='btn btn-info btn-sm'>+ Add</button></th>
    </tr>
    
    </thead>
   
     <tbody>
        
        <?php
       // echo 'cool'; die;
    //
            $recorded = new records();
            $new_recs = $recorded->get_records($_GET);//echo "jskvsjn";
            $new_totals = $recorded->get_total($_GET);

            $page_no = $recorded->get_page_no();

            $total_pages = $recorded->get_total_pages();


            function currencyToNum($str){
                return  intval(preg_replace("/[^\d\.]/","", $str));
            };

            if(is_array($new_totals)){
                foreach($new_totals as $new_total){
                    $grand_total = $grand_total +  currencyToNum($new_total['total']);
                }
            }

           // echo $page_no;
           // echo "<br>";
            //echo $total_pages;
            //echo '<pre>';
            //echo "hey";
            //print_r($_GET);
            //echo '</pre>';
            
            //$result = mysqli_query($connect,"SELECT * FROM `records` ORDER BY id DESC");
           // echo $new_recs; die;
            
            
            if(is_array($new_recs)){  
                //
                    //echo"am here <br>"; die;
                    $result = $new_recs; //$new_recs;
                    $end_arr = end($result); //print_r($result);//die("EDFH");
                
                 if( $end_arr != "") {
                    
                  //$result =     ;   
                  //print_r($result);die("EDFH");
                  $product     = isset($end_arr["products"]) &&     $end_arr["products"] != "" ?        $end_arr["products"] :"";
                  $date_from   = isset($end_arr["date_from"]) &&    $end_arr["date_from"] != "" ?      $end_arr["date_from"] :"";
                  $date_to     = isset($end_arr["date_to"]) &&      $end_arr["date_to"] != "" ?         $end_arr["date_to"] :"";
                  $product_cat = isset($end_arr["product_cat"]) &&  $end_arr["product_cat"] != "" ?     $end_arr["product_cat"] :"";
                  array_pop($result);
                }
                }   
                
                
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

                $page_total = 0;
                
               // function currencyToNum($str){
                 //  return  intval(preg_replace("/[^\d\.]/","", $str));
                //};
        //echo "<pre>";
        //print_r($new_recs);
        //echo "</pre>";
                
                foreach($new_recs as $rows) {

                    $page_total = $page_total + currencyToNum($rows['total']);

                    // echo $page_total; die();
                    if ($rows['id']) {

                        ?>


                        <tr>
                            <td><?php echo $rows['date'] ?></td>
                            <td><?php echo $rows['nature_of_job'] ?></td>
                            <td><?php echo $rows['copies'] ?></td>
                            <td><?php echo $rows['category'] ?></td>
                            <td><?php echo $rows['total'] ?></td>
                            <td><input type="button" name="view" value="View" id="<?php echo $rows["id"]; ?>"
                                       class="view_data btn btn-default btn-sm"/>
                                <input type="button" name="edit" value="Edit" id="<?php echo $rows["id"]; ?>"
                                       class="btn btn-warning btn-sm edit_data"/>
                                <a onclick="window.open('each_comment.php?id=<?= $rows['id'] ?>','', 'width=700px, height=300px')"
                                   class="btn btn-primary btn-sm text-centre">Comment</a>
                                <input type="button" name="delete" value="X" id="<?php echo $rows["id"]; ?>"
                                       class="btn btn-danger btn-sm delete_data"/></td>
                        </tr>
                    <?php }
                        }
    
    mysqli_close($connect);
    ?>
    

    </tbody>

    </table>
      <div style="display:none;"><h4 class="model">Page Total: &#8358;<?= number_format($page_total, 2) ?> </h4></div>

      <div style="display:none;"> <h4 class="grand">Grand Total: &#8358;<?= number_format($grand_total, 2) ?> </h4></div>

      <?php 
      //echo $page_no;
     // echo "<br>";
     // echo  "hey";
     //           echo $total_pages;
     // echo "<br>";

      $h = "dashboard.php?date_from=&date_to=&products=&product_cat=Web+Projects&search=SEARCH";

     // $urll = "";

      $url = "dashboard.php?date_from=".$_GET['date_from']."&date_to=".$_GET['date_to']."&products=".$_GET['products']."&product_cat=".$_GET['product_cat']."&search=".$_GET['search'];
        
      $second_last = $total_pages - 1;
      $urll = $url;

     // echo $url . '<br>';
      //echo basename($_SERVER['REQUEST_URI']);
      //  echo $urll;
      ?>

      <div style="float:left"><h4 class="model">Page Total: &#8358;<?= number_format($page_total, 2) ?> </h4></div>
        <div style="float:right"> <h4 class="mirror_of_grand_two">Grand Total: &#8358;<?= number_format($grand_total, 2) ?> </h4></div>


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
    
    <!--<ul class="pagination">
    <li <?php// if($page_no <= 1){ echo "class='disabled'"; } ?>>
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
     
     
     <table class="table table-striped table-bordered" id="sales_table">
           
  
    <thead>

    <tr>
        <th>DATE</th>
        <th>JOB</th>
		<th>COPIES</th>
		<th>RATE</th>
        <th>CATEGORY</th>
        <th>PAID</th>
        <th>ACTIONS &nbsp; <button type='button' name='add' id='add' data-toggle='modal' data-target='#add_data_Modal' class='btn btn-info btn-sm'>+ Add</button></th>
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

	$total_records_per_page = 12;
    $offset = ($page_no-1) * $total_records_per_page;
    //echo $offset; die;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 

    if($_SESSION['role'] == 'super-admin') {
	$result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `records` ORDER BY id DESC");
    } else {
        $result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `records` WHERE user = '$user' ORDER BY id DESC");
    }
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
    //echo $total_records; die;
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1
    
    if($_SESSION['role'] == 'super-admin') {
        
        $result = mysqli_query($connect,"SELECT * FROM `records` ORDER BY id DESC LIMIT $offset, $total_records_per_page ");
        $page_sum = mysqli_query($connect,"SELECT total FROM `records` ");
        
    } else {

        $result = mysqli_query($connect,"SELECT * FROM `records` WHERE user = '$user' ORDER BY id DESC LIMIT $offset, $total_records_per_page ");
        $page_sum = mysqli_query($connect,"SELECT total FROM `records` WHERE user = '$user'");

        $page_total = 0;
    
    }

    if ($page_sum) {
//
        while ($each_row = mysqli_fetch_assoc($page_sum)) {
            $sum_arrs[] = $each_row;
        }
    }

    function currencyToNum($str){
        return  intval(preg_replace("/[^\d\.]/","", $str));
    };

    $grand_total = 0;

    foreach($sum_arrs as $sum_arr) {
        $grand_total = $grand_total + currencyToNum($sum_arr['total']);
    }
//print_r($sum_arr);
//while($row = mysqli_fetch_array($result)){
      foreach($result as $row)
     {
         $page_total = $page_total +  $row['total'];
        //print_r($row);die();
        
       // $amount_charged += $row['amount'];
        //$amount_paid += $row['total'];
        //$to_balance += $row['balance'];
        
     //}  
     // print_r($row); die;
        
        ?>
    <tr>
		<td><?php echo $row['date'] ?></td>
        <td><?php echo $row['nature_of_job'] ?></td>
		<td><?php echo $row['copies'] ?></td>
		<td><?php echo $row['rate'] ?></td>
        <td><?php echo $row['category'] ?></td>
        <td><?php echo $row['total'] ?></td>
        <td><input type="button" name="view" value="View" id="<?php echo $row["id"]; ?>" class="view_data btn btn-default btn-sm"/>
        <input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-sm edit_data" />
            <a onclick="window.open('each_comment.php?id=<?=$row['id']?>','', 'width=700px, height=300px')" class="btn btn-primary btn-sm text-centre">Comment</a>
            <input type="button" name="delete" value="X" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm delete_data" /></td>
    </tr>
    

    <?php
    
        }
        //}
	mysqli_close($connect);
 
 ?>
    
     </tbody>
    </table>
     <div style="display:none;"> <h4 class="grand">Grand Total: &#8358;<?= number_format($grand_total, 2) ?> </h4></div>
     <div style="float:right"><h4 class="model">Total: &#8358;<?= number_format($page_total, 2) ?> </h4></div>

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
<?php if($_SESSION['role'] == 'super-admin') { ?>
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
<?php } } ?>

</div>


 <!--Add modal-->
    <div id="add_data_Modal" class="modal fade" role="dialog" style="height: 500px;">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                    <h4 class="modal-title">Sales Records Form</h4>
                </div>
                <div class="modal-body">
                    <form name="customer" id="insert_form" method="post">
                             <input type="text" name="nature_of_job" placeholder="Enter the nature of the job" id="nature_of_job" />
                             <input type="text" name="rate" placeholder="Enter the rate per copy" id="rate" />
                             <input type="text" name="copies" placeholder="Enter the copies made" id="copies" />
                             <select name="category" id="category">
                                <option value="" >Choose Category</option>
                                <option value="Web Projects">Web Projects</option>
                                <option value="Training">Training</option>
                                <option value="Graphics/Printing">Graphics/Printing</option>
                                <option value="Other Services">Other Services</option>
                             </select>
                             <input type="text" name="amount" placeholder="Enter the amount charged" id="amount" />
                            <input type="text" name="total" placeholder="Enter the total amount paid" id="total"/>
                            <input type="text" name="balance" placeholder="Enter the amount to be balanced" id="balance"/>
                            <input type="text" name="sales_id" id="sales_id" style="display: none;" />
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
    
    
    
    
    <!--View modal-->
    <div id="dataModal" class="modal fade" style="height: 500px;">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                    <h4 class="modal-title">Full Records</h4>
                </div>
                <div class="modal-body" id="full_records">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
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
                    <h4 class="modal-title">Delete Customer Records</h4>
                </div>
                <div class="modal-body">
                <form name="deleteForm" id="deleteForm">
                <input type="text" name="sale_id" id="sale_id" style="display: none;" />
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
           var sales_id = $(this).attr("id");  
          // alert(sales_id);
           $.ajax({  
                url:"add.php",  
                method:"POST",  
                data:{sales_id:sales_id},  
                dataType:"json",  
                success:function(data){  
                    
                $('#nature_of_job').val(data.nature_of_job);
                $('#rate').val(data.rate);
                $('#copies').val(data.copies);
                $('#category').val(data.category);
                $('#amount').val(data.amount);
                $('#total').val(data.total);
                $('#balance').val(data.balance);
                $('#sales_id').val(data.id);
                $('#insert').val('Insert');
                $('#add_data_Modal').modal('show'); 
                }  
           });  
      }); 
      
 $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#total').val() == "")  
           {  
                alert("amount paid can not be empty");  
           }    
           else  
           {  
                $.ajax({  
                     url:"edit.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#sales_table').html(data);  
                     }  
                });  
           }  
      }); 
      
      
     $(document).on('click', '.view_data', function(){   
        
         var salid = $(this).attr("id");
         //alert(salid);
         
         $.ajax({
            url: "show.php",
            method: 'POST',
            data: {salid:salid},
            success: function(data) {
                //alert(data);
               $("#full_records").html(data);
                $("#dataModal").modal("show");
            }
         })
 
            
      });
      
      
 $(document).on('click', '.delete_data', function(){  
           var sale_id = $(this).attr("id");  
               // alert(custom_id);
                $.ajax({  
                     url:"deleter.php",  
                     method:"POST",  
                     data:{sale_id:sale_id},
                     dataType:"json",   
                     success:function(data){
                          $('#sale_id').val(data.id);
                          $('#delete').val('Delete');
                          $('#delete_modal').modal('show');  
                     }  
                });             
      }); 
      
      
        
   $('#deleteForm').on("submit", function(event){  
           event.preventDefault();  
           if($('#sale_id').val() == "")  
           {  
                alert("You can't delete");  
           }    

               $.ajax({  
                     url:"delete.php",  
                     method:"POST",  
                     data:$('#deleteForm').serialize(),  
                     beforeSend:function(){  
                          $('#delete').val("Deleting");  
                     },  
                     success:function(data){   
                          $('#delete_modal').modal('hide');  
                          $('#sales_table').html(data);  
                     }  
                });  
                      
      }); 
 }); 
  
 </script>

<script src="js/invent.js"></script>

</body>
</html>



