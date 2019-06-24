<?php
include_once('configg.php');
include_once('config.php');
include_once('action.php');
include_once('records.php');
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

$this_month = date("m");
$this_year = date("Y");

for($i = 1; $i <= 12; $i++) {
    
    if($i == $this_month) {
        
        $start_date[] = date("Y-$i-01");
        $end_date[] = date("Y-m-d");
        
    } elseif($i == 1 or $i == 3 or $i == 5 or $i == 7 or $i == 8 or $i == 10 or $i == 12  ) {
    
        $start_date[] = date("Y-$i-01");
        $end_date[] = date("Y-$i-31");
    
    } elseif($i == 2 and $this_year/4 != 0) {
            
        $start_date[] = date("Y-$i-01");
        $end_date[] = date("Y-$i-28");
    
    } elseif($i == 2 and $this_year/4 == 0) {
        
        $start_date[] = date("Y-$i-01");
        $end_date[] = date("Y-$i-29");
    
    } else {
        
        $start_date[] = date("Y-$i-01");
        $end_date[] = date("Y-$i-30"); 
    }
    

}

$date1a = $start_date[0];
$date2a = $end_date[0];

$january_month_sales_total = "SELECT SUM(total) FROM records WHERE category = 'Web Projects' AND date BETWEEN '$date1a' AND '$date2a'";
$january_result = mysqli_query($connect, $january_month_sales_total);
$row1a = mysqli_fetch_row($january_result); 
$sales_january = $row1a[0];

$date1b = $start_date[1];
$date2b = $end_date[1];

$february_month_sales_total = "SELECT SUM(total) FROM records WHERE category = 'Web Projects' AND date BETWEEN '$date1b' AND '$date2b'";
$february_result = mysqli_query($connect, $february_month_sales_total);
$row1b = mysqli_fetch_row($february_result); 
$sales_february = $row1b[0];

$date1c = $start_date[2];
$date2c = $end_date[2];

$march_month_sales_total = "SELECT SUM(total) FROM records WHERE category = 'Web Projects' AND date BETWEEN '$date1c' AND '$date2c'";
$march_result = mysqli_query($connect, $march_month_sales_total);
$row1c = mysqli_fetch_row($march_result); 
$sales_march = $row1c[0];

$date1d = $start_date[3];
$date2d = $end_date[3];

$april_month_sales_total = "SELECT SUM(total) FROM records WHERE category = 'Web Projects' AND date BETWEEN '$date1d' AND '$date2d'";
$april_result = mysqli_query($connect, $april_month_sales_total);
$row1d = mysqli_fetch_row($april_result); 
$sales_april = $row1d[0];

$date1e = $start_date[4];
$date2e = $end_date[4];

$may_month_sales_total = "SELECT SUM(total) FROM records WHERE category = 'Web Projects' AND date BETWEEN '$date1e' AND '$date2e'";
$may_result = mysqli_query($connect, $may_month_sales_total);
$row1e = mysqli_fetch_row($may_result); 
$sales_may = $row1e[0];

$date1f = $start_date[5];
$date2f = $end_date[5];

$june_month_sales_total = "SELECT SUM(total) FROM records WHERE category = 'Web Projects' AND date BETWEEN '$date1f' AND '$date2f'";
$june_result = mysqli_query($connect, $june_month_sales_total);
$row1f = mysqli_fetch_row($june_result); 
$sales_june = $row1f[0];

$date1g = $start_date[6];
$date2g = $end_date[6];

$july_month_sales_total = "SELECT SUM(total) FROM records WHERE category = 'Web Projects' AND date BETWEEN '$date1g' AND '$date2g'";
$july_result = mysqli_query($connect, $july_month_sales_total);
$row1g = mysqli_fetch_row($july_result); 
$sales_july = $row1g[0];

$date1h = $start_date[7];
$date2h = $end_date[7];

$august_month_sales_total = "SELECT SUM(total) FROM records WHERE category = 'Web Projects' AND date BETWEEN '$date1h' AND '$date2h'";
$august_result = mysqli_query($connect, $august_month_sales_total);
$row1h = mysqli_fetch_row($august_result); 
$sales_august = $row1h[0];

$date1i = $start_date[8];
$date2i = $end_date[8];

$september_month_sales_total = "SELECT SUM(total) FROM records WHERE category = 'Web Projects' AND date BETWEEN '$date1i' AND '$date2i'";
$september_result = mysqli_query($connect, $september_month_sales_total);
$row1i = mysqli_fetch_row($september_result); 
$sales_september = $row1i[0];

$date1j = $start_date[9];
$date2j = $end_date[9];

$october_month_sales_total = "SELECT SUM(total) FROM records WHERE category = 'Web Projects' AND date BETWEEN '$date1j' AND '$date2j'";
$october_result = mysqli_query($connect, $october_month_sales_total);
$row1j = mysqli_fetch_row($october_result); 
$sales_october = $row1j[0];

$date1k = $start_date[10];
$date2k = $end_date[10];

$november_month_sales_total = "SELECT SUM(total) FROM records WHERE category = 'Web Projects' AND date BETWEEN '$date1k' AND '$date2k'";
$november_result = mysqli_query($connect, $november_month_sales_total);
$row1k = mysqli_fetch_row($november_result); 
$sales_november = $row1k[0];

$date1l = $start_date[11];
$date2l = $end_date[11];

$december_month_sales_total = "SELECT SUM(total) FROM records WHERE category = 'Web Projects' AND date BETWEEN '$date1l' AND '$date2l'";
$december_result = mysqli_query($connect, $december_month_sales_total);
$row1l = mysqli_fetch_row($december_result); 
$sales_december = $row1l[0];




$date1a = $start_date[0];
$date2a = $end_date[0];

$january_month_sales_training_total = "SELECT SUM(total) FROM records WHERE category = 'Training' AND date BETWEEN '$date1a' AND '$date2a'";
$january_result_training = mysqli_query($connect, $january_month_sales_training_total);
$row1a = mysqli_fetch_row($january_result_training); 
$sales_training_january = $row1a[0];

$date1b = $start_date[1];
$date2b = $end_date[1];

$february_month_sales_training_total = "SELECT SUM(total) FROM records WHERE category = 'Training' AND date BETWEEN '$date1b' AND '$date2b'";
$february_result_training = mysqli_query($connect, $february_month_sales_training_total);
$row1b = mysqli_fetch_row($february_result_training); 
$sales_training_february = $row1b[0];

$date1c = $start_date[2];
$date2c = $end_date[2];

$march_month_sales_training_total = "SELECT SUM(total) FROM records WHERE category = 'Training' AND date BETWEEN '$date1c' AND '$date2c'";
$march_result_training = mysqli_query($connect, $march_month_sales_training_total);
$row1c = mysqli_fetch_row($march_result_training); 
$sales_training_march = $row1c[0];

$date1d = $start_date[3];
$date2d = $end_date[3];

$april_month_sales_training_total = "SELECT SUM(total) FROM records WHERE category = 'Training' AND date BETWEEN '$date1d' AND '$date2d'";
$april_result_training = mysqli_query($connect, $april_month_sales_training_total);
$row1d = mysqli_fetch_row($april_result_training); 
$sales_training_april = $row1d[0];

$date1e = $start_date[4];
$date2e = $end_date[4];

$may_month_sales_training_total = "SELECT SUM(total) FROM records WHERE category = 'Training' AND date BETWEEN '$date1e' AND '$date2e'";
$may_result_training = mysqli_query($connect, $may_month_sales_training_total);
$row1e = mysqli_fetch_row($may_result_training); 
$sales_training_may = $row1e[0];

$date1f = $start_date[5];
$date2f = $end_date[5];

$june_month_sales_training_total = "SELECT SUM(total) FROM records WHERE category = 'Training' AND date BETWEEN '$date1f' AND '$date2f'";
$june_result_training = mysqli_query($connect, $june_month_sales_training_total);
$row1f = mysqli_fetch_row($june_result_training); 
$sales_training_june = $row1f[0];

$date1g = $start_date[6];
$date2g = $end_date[6];

$july_month_sales_training_total = "SELECT SUM(total) FROM records WHERE category = 'Training' AND date BETWEEN '$date1g' AND '$date2g'";
$july_result_training = mysqli_query($connect, $july_month_sales_training_total);
$row1g = mysqli_fetch_row($july_result_training); 
$sales_training_july = $row1g[0];

$date1h = $start_date[7];
$date2h = $end_date[7];

$august_month_sales_training_total = "SELECT SUM(total) FROM records WHERE category = 'Training' AND date BETWEEN '$date1h' AND '$date2h'";
$august_result_training = mysqli_query($connect, $august_month_sales_training_total);
$row1h = mysqli_fetch_row($august_result_training); 
$sales_training_august = $row1h[0];

$date1i = $start_date[8];
$date2i = $end_date[8];

$september_month_sales_training_total = "SELECT SUM(total) FROM records WHERE category = 'Training' AND date BETWEEN '$date1i' AND '$date2i'";
$september_result_training = mysqli_query($connect, $september_month_sales_training_total);
$row1i = mysqli_fetch_row($september_result_training); 
$sales_training_september = $row1i[0];

$date1j = $start_date[9];
$date2j = $end_date[9];

$october_month_sales_training_total = "SELECT SUM(total) FROM records WHERE category = 'Training' AND date BETWEEN '$date1j' AND '$date2j'";
$october_result_training = mysqli_query($connect, $october_month_sales_training_total);
$row1j = mysqli_fetch_row($october_result_training); 
$sales_training_october = $row1j[0];

$date1k = $start_date[10];
$date2k = $end_date[10];

$november_month_sales_training_total = "SELECT SUM(total) FROM records WHERE category = 'Training' AND date BETWEEN '$date1k' AND '$date2k'";
$november_result_training = mysqli_query($connect, $november_month_sales_training_total);
$row1k = mysqli_fetch_row($november_result_training); 
$sales_training_november = $row1k[0];

$date1l = $start_date[11];
$date2l = $end_date[11];

$december_month_sales_training_total = "SELECT SUM(total) FROM records WHERE category = 'Training' AND date BETWEEN '$date1l' AND '$date2l'";
$december_result_training = mysqli_query($connect, $december_month_sales_training_total);
$row1l = mysqli_fetch_row($december_result_training); 
$sales_training_december = $row1l[0];



$date1a = $start_date[0];
$date2a = $end_date[0];

$january_month_sales_printing_total = "SELECT SUM(total) FROM records WHERE category = Graphics/Printing AND date BETWEEN '$date1a' AND '$date2a'";
$january_result_printing = mysqli_query($connect, $january_month_sales_printing_total);
$row1a = mysqli_fetch_row($january_result_printing); 
$sales_printing_january = $row1a[0];

$date1b = $start_date[1];
$date2b = $end_date[1];

$february_month_sales_printing_total = "SELECT SUM(total) FROM records WHERE category = Graphics/Printing AND date BETWEEN '$date1b' AND '$date2b'";
$february_result_printing = mysqli_query($connect, $february_month_sales_printing_total);
$row1b = mysqli_fetch_row($february_result_printing); 
$sales_printing_february = $row1b[0];

$date1c = $start_date[2];
$date2c = $end_date[2];

$march_month_sales_printing_total = "SELECT SUM(total) FROM records WHERE category = Graphics/Printing AND date BETWEEN '$date1c' AND '$date2c'";
$march_result_printing = mysqli_query($connect, $march_month_sales_printing_total);
$row1c = mysqli_fetch_row($march_result_printing); 
$sales_printing_march = $row1c[0];

$date1d = $start_date[3];
$date2d = $end_date[3];

$april_month_sales_printing_total = "SELECT SUM(total) FROM records WHERE category = Graphics/Printing AND date BETWEEN '$date1d' AND '$date2d'";
$april_result_printing = mysqli_query($connect, $april_month_sales_printing_total);
$row1d = mysqli_fetch_row($april_result_printing); 
$sales_printing_april = $row1d[0];

$date1e = $start_date[4];
$date2e = $end_date[4];

$may_month_sales_printing_total = "SELECT SUM(total) FROM records WHERE category = Graphics/Printing AND date BETWEEN '$date1e' AND '$date2e'";
$may_result_printing = mysqli_query($connect, $may_month_sales_printing_total);
$row1e = mysqli_fetch_row($may_result_printing); 
$sales_printing_may = $row1e[0];

$date1f = $start_date[5];
$date2f = $end_date[5];

$june_month_sales_printing_total = "SELECT SUM(total) FROM records WHERE category = Graphics/Printing AND date BETWEEN '$date1f' AND '$date2f'";
$june_result_printing = mysqli_query($connect, $june_month_sales_printing_total);
$row1f = mysqli_fetch_row($june_result_printing); 
$sales_printing_june = $row1f[0];

$date1g = $start_date[6];
$date2g = $end_date[6];

$july_month_sales_printing_total = "SELECT SUM(total) FROM records WHERE category = Graphics/Printing AND date BETWEEN '$date1g' AND '$date2g'";
$july_result_printing = mysqli_query($connect, $july_month_sales_printing_total);
$row1g = mysqli_fetch_row($july_result_printing); 
$sales_printing_july = $row1g[0];

$date1h = $start_date[7];
$date2h = $end_date[7];

$august_month_sales_printing_total = "SELECT SUM(total) FROM records WHERE category = Graphics/Printing AND date BETWEEN '$date1h' AND '$date2h'";
$august_result_printing = mysqli_query($connect, $august_month_sales_printing_total);
$row1h = mysqli_fetch_row($august_result_printing); 
$sales_printing_august = $row1h[0];

$date1i = $start_date[8];
$date2i = $end_date[8];

$september_month_sales_printing_total = "SELECT SUM(total) FROM records WHERE category = Graphics/Printing AND date BETWEEN '$date1i' AND '$date2i'";
$september_result_printing = mysqli_query($connect, $september_month_sales_printing_total);
$row1i = mysqli_fetch_row($september_result_printing); 
$sales_printing_september = $row1i[0];

$date1j = $start_date[9];
$date2j = $end_date[9];

$october_month_sales_printing_total = "SELECT SUM(total) FROM records WHERE category = Graphics/Printing AND date BETWEEN '$date1j' AND '$date2j'";
$october_result_printing = mysqli_query($connect, $october_month_sales_printing_total);
$row1j = mysqli_fetch_row($october_result_printing); 
$sales_printing_october = $row1j[0];

$date1k = $start_date[10];
$date2k = $end_date[10];

$november_month_sales_printing_total = "SELECT SUM(total) FROM records WHERE category = Graphics/Printing AND date BETWEEN '$date1k' AND '$date2k'";
$november_result_printing = mysqli_query($connect, $november_month_sales_printing_total);
$row1k = mysqli_fetch_row($november_result_printing); 
$sales_printing_november = $row1k[0];

$date1l = $start_date[11];
$date2l = $end_date[11];

$december_month_sales_printing_total = "SELECT SUM(total) FROM records WHERE category = Graphics/Printing AND date BETWEEN '$date1l' AND '$date2l'";
$december_result_printing = mysqli_query($connect, $december_month_sales_printing_total);
$row1l = mysqli_fetch_row($december_result_printing); 
$sales_printing_december = $row1l[0];

?>
<html>
<head>
<!--<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/mystyle.css" rel="stylesheet"/>-->
    
    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/bat.css" rel="stylesheet"/>
    <link href="css/bootstrap-grid.min.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>
    <link href="css/moi.css" rel="stylesheet"/>
    
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
<?php 
if(isset($_SESSION['user'])) {
//echo "<h1>WELCOME <i>{$_SESSION['fullname']}</i></h1>";

?>
<div class=" row ab ">
    <div class="col-md-12" class="text-center">
        <h1>MANAGE SALES RECORDS</h1>
    </div>

        <ul id="nalo">
        	<li><a href="logout.php">Logout</a></li>
        	<li><a href="home.php">Dashboard</a></li>
        </ul>
  </div>   


<?php

$db_class    = new configure();
$my_class    = new action;
$new_recs = "";

if (isset($_GET['search'])) {
    //
   
    
    $recorded = new records();
    $new_recs = $recorded->get_records($_GET);//echo "jskvsjn";
}
//$id = (isset($_POST['id']) && !empty($_POST['id'])) ? $_POST['id'] : "";
$SELECTDB = "SELECT role FROM login WHERE username = '{$_SESSION['user']}' ";
//echo $_SESSION['user'];
$result = mysqli_query($db_class->connect(), $SELECTDB);

if (isset($_POST['update'])) {
    $recorded = new records();
    echo $recorded->update_records($_POST);
}
if($result) {
    while($row = mysqli_fetch_array($result)) { 
        if($row['role'] == 'admin') {?> 
    

<?php     
        }
    }
}

?>

<div class="row">
    <div class="col-md-2 navo">

        <div>
            <p style="color: #0e1a35; margin-left: 5px; text-align: center;"><b>Monthly sales from web projects</b></p>
        </div>
        <table class="table table-striped table-bordered short" style="text-align: center; margin-left: 5px;">
            <tr>
                <th>Month</th>
                <th>Revenue</th>
            
            </tr>
            <tr>
            <th>January</th>
            <th> <?php if (empty($sales_january)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_january</b>";
           } ?></th>
           </tr>
           <tr>
            <th>February</th>
            <th class="short"> <?php if (empty($sales_february)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_february</b>";
           } ?></th>
           </tr>
           <tr>
            <th>March</th>
            <th> <?php if (empty($sales_march)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_march</b>";
           } ?></th>
           </tr>
           <tr>
            <th>April</th>
            <th> <?php if (empty($sales_april)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_april</b>";
           } ?></th>
           </tr>
           <tr>
            <th>May</th>
            <th> <?php if (empty($sales_may)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_may</b>";
           } ?></th>
           </tr>
           <tr>
            <th>June</th>
            <th> <?php if (empty($sales_june)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_june</b>";
           } ?></th>
           </tr>
           <tr>
            <th>July</th>
            <th> <?php if (empty($sales_july)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_july</b>";
           } ?></th>
           </tr>
           <tr>
            <th>August</th>
            <th> <?php if (empty($sales_august)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_august</b>";
           } ?></th>
           </tr>
           <tr>
            <th>September</th>
            <th> <?php if (empty($sales_september)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_september</b>";
           } ?></th>
           </tr>
           <tr>
            <th>October</th>
            <th> <?php if (empty($sales_october)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_october</b>";
           } ?></th>
           </tr>
           <tr>
            <th>November</th>
            <th> <?php if (empty($sales_november)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_november</b>";
           } ?></th>
           </tr>
           <tr>
            <th>December</th>
            <th> <?php if (empty($sales_december)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_december</b>";
           } ?></th>
           </tr>
        </table>
        
        <div>
            <p style="color: #0e1a35; margin-left: 5px; text-align: center;"><b>Monthly sales from Training</b></p>
        </div>
        
        <table class="table table-striped table-bordered short" style="text-align: center; margin-left: 5px;">
            <tr>
                <th>Month</th>
                <th>Revenue</th>
            
            </tr>
            <tr>
            <th>January</th>
            <th> <?php if (empty($sales_training_january)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_training_january</b>";
           } ?></th>
           </tr>
           <tr>
            <th>February</th>
            <th class="short"> <?php if (empty($sales_training_february)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_training_february</b>";
           } ?></th>
           </tr>
           <tr>
            <th>March</th>
            <th> <?php if (empty($sales_training_march)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_training_march</b>";
           } ?></th>
           </tr>
           <tr>
            <th>April</th>
            <th> <?php if (empty($sales_training_april)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_training_april</b>";
           } ?></th>
           </tr>
           <tr>
            <th>May</th>
            <th> <?php if (empty($sales_training_may)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_training_may</b>";
           } ?></th>
           </tr>
           <tr>
            <th>June</th>
            <th> <?php if (empty($sales_training_june)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_training_june</b>";
           } ?></th>
           </tr>
           <tr>
            <th>July</th>
            <th> <?php if (empty($sales_training_july)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_training_july</b>";
           } ?></th>
           </tr>
           <tr>
            <th>August</th>
            <th> <?php if (empty($sales_training_august)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_training_august</b>";
           } ?></th>
           </tr>
           <tr>
            <th>September</th>
            <th> <?php if (empty($sales_training_september)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_training_september</b>";
           } ?></th>
           </tr>
           <tr>
            <th>October</th>
            <th> <?php if (empty($sales_training_october)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_training_october</b>";
           } ?></th>
           </tr>
           <tr>
            <th>November</th>
            <th> <?php if (empty($sales_training_november)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_training_november</b>";
           } ?></th>
           </tr>
           <tr>
            <th>December</th>
            <th> <?php if (empty($sales_training_december)) { 
                echo "<span style = 'color:brown'>No record found</span>";
           } else {
                echo "<b>$sales_training_december</b>";
           } ?></th>
           </tr>
        </table>
</div>



<?php


$SELECTDB = "SELECT * FROM records ORDER BY id DESC";
$result = mysqli_query($db_class->connect(), $SELECTDB);
//$product = $date_from = $date_to = $product_cat = "";

if(is_array($new_recs)){  
    //
        echo"am here <br>";
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
//echo $SELECTDB; die();



if($result){
    
   $row = mysqli_num_rows($result);
    
   
}

$count = 0;
foreach($result as $row) {
    
    $count++;
}

if  ($result) { 
    //echo $count . "rows have been fetched";

    ?>
 <!--<h3 style="margin-left: 16%; color: #0e1a35;"><?php //echo $count;  ?> rows fetched</h3>-->
 <div class="col-md-8 section">       
 <div>
 <div>
 <table style="width: 100%; ">
<thead>
<tr>

<form action="dashboard.php" method="get" style="70%">
<div id="form">


<th colspan="2"> 
<div id="date" class="form-group">
<b><span style="color: red; padding: 5px; margin: 7px;">Filter by date</span></b><input type="checkbox" onclick="myFunction()" id="show"/>
<div id="hide" onload="hidden">
<label>From</label>
<input type="date" name="date_from" class="form-control" value="<?php echo $date_from; ?>"/>
<label>To </label>
<input type="date" name="date_to" class="form-control" value="<?php echo $date_to; ?>"/>
</div>
</div>
</th>  

<th colspan="1"> <div id="product" class="form-group">
<b><span style="color: red; padding: 5px; margin: 7px;">Filter by nature of job</span></b><input type="checkbox" onclick="myFunctionb()" id="see"/>
<div  id="blind" >
<input type="text" name="products" class="form-control" value="<?php echo $product; ?>"/>
</div>
</div> </th>
<th colspan="2"> <div>
<b><span style="color: red; padding: 5px; margin: 7px;">Filter by category</b></span><input type="checkbox" onclick="myFunctionc()" id="watch"/>
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
</div>

</tr>
</thead>
</form>
</table>
 </div>       
       <!-- <tr>
         <th colspan="9">
            <h1 style="text-align: left color: blueviolet;"><a href="add.htm" style="text-decoration: none;"> Add New Record</a></h1>
        </th>
        </tr>-->
        
        <table class="table table-striped table-bordered" id="sales_table">
           
  
    <thead>

    <tr>
        <th>DATE</th>
        <th>JOB</th>
        <th>CATEGORY</th>
        <th>PAID</th>
        <th>BALANCE</th>
        <th>ACTIONS &nbsp; <button type='button' name='add' id='add' data-toggle='modal' data-target='#add_data_Modal' class='btn btn-info btn-sm'>+ Add</button></th>
    </tr>
    
    </thead>
   
     <tbody>
       
  <?php 
  
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

    
 

if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	$page_no = $_GET['page_no'];
    
    
	} else {
		$page_no = 1;
        }
        
       // echo $page_no; die;

	$total_records_per_page = 10;
    $offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 

	$result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `records` ORDER BY id DESC");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($connect,"SELECT * FROM `records` ORDER BY id DESC LIMIT $offset, $total_records_per_page ");
    while($row = mysqli_fetch_array($result)){ ?>
    <tr>
		<td><?php echo $row['date'] ?></td>
        <td><?php echo $row['nature_of_job'] ?></td>
        <td><?php echo $row['category'] ?></td>
        <td><?php echo $row['total'] ?></td>
        <td><?php echo $row['balance'] ?></td>
        <td><input type="button" name="view" value="View" id="<?php echo $row["id"]; ?>" class="view_data btn btn-default btn-sm"/>
        <input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-sm edit_data" />
            <a onclick="window.open('each_comment.php?id=<?=$row['id']?>','', 'width=700px, height=300px')" class="btn btn-primary btn-sm text-centre">Comment</a>
            <input type="button" name="delete" value="X" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm delete_data" /></td>
    </tr>
    

    <?php
        }
	mysqli_close($connect);
 
 ?>
    <tr>
                    <th colspan="3" style="font-size: 25px; text-align: left;">Total</th>
               
                    <th><?=$amount_paid?></th>
                    <th><?=$to_balance?></th>
                    <th></th>
            </tr>
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
      
      <div class="col-md-2 navo">
        
        <div>
            <h3 class="text-center" style="color: #0e1a35;"><b>SUMMARY</b></h3>
        </div>
</div>
      
      </div>
    
    
<?php
}

}
?>



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
                                <option value="select" >Choose Category</option>
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












