  <?php
include_once('config.php');
//include_once('exp_class.php');
include_once('action.php');
include_once('configg.php');
  include_once('records.php');

$db_class        =   new configure();

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
        echo "<script>console.log('Your Session has expired. Please re-login to continue')</script>";
        header('location: index.htm');
    }
    
}
 
//Assign the current timestamp as the user's
//latest activity
$_SESSION['last_action'] = time();

  //echo $_SESSION['user'];
 
if(isset($_SESSION['user'])) {
  //echo "<h1>WELCOME <i>{$_SESSION['fullname']}</i></h1>";


  /*$sql = "SELECT COUNT(id) FROM customers";
        $query = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($query);
        $rows = $row[0];
        $page_rows = 4;
        $last = ceil($rows/$page_rows);
        if($last < 1) {
            $last = 1;
        }
        $page_num = 1;
        if(isset($_GET['pn'])) {
            $page_num = preg_replace('#[^0-9]#', '', $_GET['pn']);
        }
        if ($page_num < 1) {
            $page_num - 1;
        } elseif ($page_num > $last) {
            $page_num = $last;
        }
        $limit = 'limit' . ($page_num - 1) * $page_rows . ',' . $page_rows;
        $sql = "SELECT * FROM customers ORDER BY id DESC";
        $query = mysqli_query($connect, $sql);
        $textline1 = 'Customers' . '(<b>' .$rows.'</b>)' . 'page';
        $textline2 = '<b>' . $page_num . '</b>' . 'of <b>' .$last . '</b>';
        $paginationctrls = "";
          if ($last != 1) {
            if ($page_num > 1) {
                $previous = $page_num - 1;
                $paginationctrls .= '<a href ="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a> &nbsp; &nbsp;';
                for($i = $page_num - 4; $i < $page_num; $i++) {
                    if($i > 0) {
                      $paginationctrls .= '<a href ="'.$_SERVER['PHP_SELF'].'?pn=' .$i.'" >'.$i.'</a> &nbsp;';  
                    }
                }
                
            }
            
            $paginationctrls .= ''. $page_num . ' &nbsp; ';
            for ($i = $page_num + 1; $i < $last; $i++) {
                $paginationctrls .= '<a href ="'.$_SERVER['PHP_SELF'].'?pn=' .$i.'" >'.$i.'</a> &nbsp;';
                if($i > $page_num+4) {
                    break;
                }
                
            }
            
            if ($page_num != $last) {
                $next = $page_num + 1;
                $paginationctrls .= ' &nbsp; &nbsp; <a href ="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a>';
                
                }
        }
        
        while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            
            $name = $row['name'];
            $phone = $row['phone'];
            $email = $row['email'];
            $address = $row['address'];
        }
  
  
        mysqli_close($connect);*/


  $SELECTDB = "SELECT * FROM customers WHERE id='$id'";
  //echo $SELECTDB;
  $result = mysqli_query($db_class->connect(), $SELECTDB);

  if ($result) {
      while ($row = mysqli_fetch_array($result)) {

          $name = ($row['name'] != "") ? $row['name'] : "";
          $phone = ($row['phone'] != "") ? $row['phone'] : "";
          $email = ($row['email'] != "") ? $row['email'] : "";
          $address = ($row['address'] != "") ? $row['address'] : "";
      }
  }


  ?>

  <html>
  <head>
      <style>

      </style>
      <!--<link rel="stylesheet" href="css/mystyle.css"/>-->

      <link href="css/bootstrap.css" rel="stylesheet"/>
      <link href="css/bootstrap.min.css" rel="stylesheet"/>
      <link href="css/bootstrap-grid.css" rel="stylesheet"/>
      <link href="css/bat.css" rel="stylesheet"/>
      <link href="css/moi.css" rel="stylesheet"/>
      <link href="css/bootstrap-grid.min.css" rel="stylesheet"/>
      <link href="css/style.css" rel="stylesheet"/>

      <script src="js/jquery-3.3.1.js"></script>
      <script src="js/script.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>


  </head>
  <body>

  <?php if (isset($_SESSION['user'])) {
  } ?>

  <div class=" row ab ">
      <div class="col-md-12" class="text-center">
          <h1>MANAGE CUSTOMERS' RECORD</h1>
      </div>

      <ul id="nalo">
          <li><a href="logout.php">Logout</a></li>
          <li><a href="home.php">Dashboard</a></li>
      </ul>
  </div>

  <div class="row">

      <div class="container">
          <div class="col-md-12 section">

              <table style="width: 80%; ">
                  <thead>
                  <tr>
                      <form>
                          <div id="form">
                              <th colspan="2">
                                  <div id="date" class="form-group">
                                      <b><span style="color: red; padding: 5px; margin: 7px;">Filter by date</span></b>
                                      <?php


                                      if (isset($_GET["date_from"]) && $_GET["date_from"] != "") {

                                          ?>
                                          <input type="checkbox" onclick="myFunction()" id="show" checked="checked"/>
                                          <?php
                                      } else {

                                          ?>
                                          <input type="checkbox" onclick="myFunction()" id="show"/>
                                          <?php
                                      }
                                      ?>

                                      <div id="hide" onload="hidden">
                                          <label>From</label>
                                          <input type="date" name="date_from" class="form-control"
                                                 value="<?php echo $date_from; ?>"/>
                                          <label>To </label>
                                          <input type="date" name="date_to" class="form-control"
                                                 value="<?php echo $date_to; ?>"/>
                                      </div>
                                  </div>
                              </th>

                              <th colspan="1">
                                  <div id="items" class="form-group">

                                      <b><span style="color: red; padding: 5px; margin: 7px;">Filter by Name</span></b>
                                      <?php


                                      if (isset($_GET["name"]) && $_GET["name"] != "") {

                                          ?>
                                          <input type="checkbox" onclick="myFunctionb()" id="see" checked="checked"/>
                                          <?php
                                      } else {
                                       ?>
                                      <input type="checkbox" onclick="myFunctionb()" id="see" />
                                      <?php
                                      }
                            ?>
                            <div  id="blind" >
                                <input type="text" name="name" class="form-control" value="<?php //echo $item; ?>"/>
                            </div>
                        </div> 
                    </th>
                    <th colspan="1"> <div id="costs" class="form-group">
                        <b><span style="color: red; padding: 5px; margin: 7px;">Filter by Address</span></b>
                            <?php


                            if(isset($_GET["address"]) && $_GET["address"]!="") {

                                ?>
                                <input type="checkbox" onclick="myFunctionc()" id="watch" checked="checked"/>
                                <?php
                            }
                            else {
                                ?>
                                <input type="checkbox" onclick="myFunctionc()" id="watch"/>
                                <?php
                            }
                            ?>
                            <div  id="pretend" >
                                <input type="text" name="address" class="form-control" value="<?php //echo $cost; ?>"/>
                            </div>
                        </div> 
                    </th>
                    <th colspan="2"> <div>
                            <b><span style="color: red; padding: 5px; margin: 7px;">Filter by category</b></span>
                            <?php


                            if(isset($_GET["product_cat"]) && $_GET["product_cat"]!=""){

                                ?>
                                <input type="checkbox" onclick="myFunctiond()" id="watch_cat" checked="checked"/>
                                <?php
                            }else{

                                ?>
                                <input type="checkbox" onclick="myFunctiond()" id="watch_cat"/>
                                <?php
                            }
                            ?>
                            <div id="pretend_cat" class="form-group" style="display:none;">
                                <select name="product_cat" class="form-control">
                                   <!-- <option value="select" ><?php echo $product_cat; ?></option> -->
                                    <option value="" >Choose Category</option>
                                    <option value="Web Projects">Web Projects</option>
                                    <option value="Training">Training</option>
                                    <option value="Graphics/Printing">Graphics/Printing</option>
                                    <option value="Other Services">Other Services</option>
                                </select>
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
     /*
       $amount_charged = 0.0;
       $amount_paid = 0.0;
       $to_balance = 0.0;

     // if(isset($_SESSION['user'])) {


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



         <table class="table table-striped table-bordered" id="customers_table">


             <thead>

             <tr>
                 <th>DATE</th>
                 <th>NAME</th>
                 <th>PHONE</th>
                 <th>EMAIL</th>
                 <th>ADDRESS</th>
                 <th>CATEGORY</th>
                 <th>ACTIONS &nbsp; <button type='button' name='add' id='add' data-toggle='modal' data-target='#add_data_Modal' class='btn btn-info btn-sm'>+ Add</button></th>
             </tr>

             </thead>

             <tbody>

             <?php
             // echo 'cool'; die;
             //
             $recorded = new records();
             $new_recs = $recorded->get_customs($_GET);//echo "jskvsjn";
             //$new_totals = $recorded->get_customs($_GET);

             $page_no = $recorded->get_page_no();

             $total_pages = $recorded->get_total_pages();


             /*function currencyToNum($str){
                 return  intval(preg_replace("/[^\d\.]/","", $str));
             };

             if(is_array($new_totals)){
                 foreach($new_totals as $new_total){
                     $grand_total = $grand_total +  currencyToNum($new_total['total']);
                 }
             }*/

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
                 $end_arr = end($result);
                  //print_r($result);die("EDFH");

                 if( $end_arr != "") {

                     //$result =     ;
                     //print_r($result);die("EDFH");
                     $product     = isset($end_arr["name"]) &&     $end_arr["name"] != "" ?        $end_arr["name"] :"";
                     $date_from   = isset($end_arr["date_from"]) &&    $end_arr["date_from"] != "" ?      $end_arr["date_from"] :"";
                     $date_to     = isset($end_arr["date_to"]) &&      $end_arr["date_to"] != "" ?         $end_arr["date_to"] :"";
                     $product_cat = isset($end_arr["address"]) &&  $end_arr["address"] != "" ?     $end_arr["address"] :"";
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

                 //$page_total = $page_total + currencyToNum($rows['total']);

                 // echo $page_total; die();
                 if ($rows['id']) {

                     ?>


                     <tr>
                         <td><?php echo $rows['date'] ?></td>
                         <td><?php echo $rows['name'] ?></td>
                         <td><?php echo $rows['phone'] ?></td>
                         <td><?php echo $rows['email'] ?></td>
                         <td><?php echo $rows['address'] ?></td>
                         <td><?php echo $rows['category'] ?></td>
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

         <?php
         //echo $page_no;
         // echo "<br>";
         // echo  "hey";
         //           echo $total_pages;
         // echo "<br>";

         $h = "custom.php?date_from=&date_to=&products=&product_cat=Web+Projects&search=SEARCH";

         // $urll = "";

         $url = "custom.php?date_from=".$_GET['date_from']."&date_to=".$_GET['date_to']."&products=".$_GET['products']."&product_cat=".$_GET['product_cat']."&search=".$_GET['search'];

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

    <table class="table table-striped table-bordered" id="customers_table">
           
  
    <thead>

    <tr>
        <th>DATE</th>
        <th>NAME</th>
        <th>PHONE</th>
        <th>EMAIL</th>
        <th>ADDRESS</th>
        <th>CATEGORY</th>
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

	$total_records_per_page = 7;
    $offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 

	$result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `customers` ORDER BY id DESC");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($connect,"SELECT * FROM `customers` ORDER BY id DESC LIMIT $offset, $total_records_per_page ");
    while($row = mysqli_fetch_array($result)){ ?>
    <tr>
            <td><?php echo $row['date']?></td>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['phone'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['address'] ?></td>
            <td><?php echo $row['category'] ?></td>
            <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-sm edit_data" />
         <a onclick="window.open('custom_comment.php?id=<?=$row['id']?>','', 'width=700px, height=300px')" class="btn btn-primary btn-sm text-centre">Comment</a>
        <input type="button" name="delete" value="X" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm delete_data" /></td>
        </tr>

    <?php
        }
	mysqli_close($connect);
 
 ?>
     </tbody>
    </table>

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
		} ?>
</ul>
</div>
</div>
</div>


<?php
}


?>

    <!--Add modal-->
    <div id="add_data_Modal" class="modal fade" role="dialog" style="height: 500px;">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                    <h4 class="modal-title">Customer Records Form</h4>
                </div>
                <div class="modal-body">
                    <form name="customer" id="insert_form" method="post">
                            <input type="text" placeholder="Enter customer's name" name="name" id="name">
                            <input type="text" placeholder="Enter customer's phone number" name="phone" id="phone">
                            <input type="text" placeholder="Enter customer's email" name="email" id="email">
                            <select name="product_cat"  id="prod_category">
                            <option value="" >Choose Product Category</option>
                            <option value="Web Projects">Web Projects</option>
                            <option value="Training">Training</option>
                            <option value="Graphics/Printing">Graphics/Printing</option>
                            <option value="Other Services">Other Services</option>
                            </select>
                            <textarea placeholder="Enter customer's address " id="address" name="address" style="height: 100px;"></textarea>
                            <input type="text" name="customer_id" id="customer_id" style="display: none;" />
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
                    <h4 class="modal-title">Delete Customer Records</h4>
                </div>
                <div class="modal-body">
                <form name="deleteForm" id="deleteForm">
                <input type="text" name="custom_id" id="custom_id" style="display: none;"/>
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
 $(document).ready(function(){  

      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });
      
 $(document).on('click', '.edit_data', function(){  
           var customer_id = $(this).attr("id");  
          // alert(customer_id);
           $.ajax({  
                url:"edit_customer.php",  
                method:"POST",  
                data:{customer_id:customer_id},  
                dataType:"json",  
                success:function(data){
               //complete:function(data){
                    $('#name').val(data.name);
                $('#phone').val(data.phone);
                $('#email').val(data.email);
                $('#address').val(data.address);
                $('#customer_id').val(data.id);
                $('#insert').val('Insert');
                $('#add_data_Modal').modal('show');
                   //console.log(data);
                }
           });  
      }); 
      
 $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#name').val() == "")  
           {  
                alert("Name is required");  
           }    
           else  
           {  
                $.ajax({  
                     url:"customers.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#customers_table').html(data);  
                     }  
                });  
           }  
      }); 
      
      
      
 $(document).on('click', '.delete_data', function(){  
           var custom_id = $(this).attr("id");  
               // alert(custom_id);
                $.ajax({  
                     url:"addcustomer.php",  
                     method:"POST",  
                     data:{custom_id:custom_id},
                     dataType:"json",   
                     success:function(data){
                          $('#custom_id').val(data.id);
                          $('#delete').val('Delete');
                          $('#delete_modal').modal('show');  
                     }  
                });             
      }); 
        
   $('#deleteForm').on("submit", function(event){  
           event.preventDefault();  
           if($('#custom_id').val() == "")  
           {  
                alert("You can't delete");  
           }    

               $.ajax({  
                     url:"delete_data.php",  
                     method:"POST",  
                     data:$('#deleteForm').serialize(),  
                     beforeSend:function(){  
                          $('#delete').val("Deleting");  
                     },  
                     success:function(data){   
                          $('#delete_modal').modal('hide');  
                          $('#customers_table').html(data);  
                     }  
                });  
                      
      }); 
 }); 
  
 </script>
 <script src="js/invent.js"></script>
 <?php } ?>
</body>

</html>