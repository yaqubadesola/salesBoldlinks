<?php
// AUTHOR: OLAYIOYE IBRAHIM OLUWAFEMI
//YEAR: 2018


session_start();
include_once('configg.php');
//include_once("action.php");


if(isset($_SESSION['user'])) {
    
$user = $_SESSION['user'];

//echo $user; die;
   
    
if($_SESSION['role'] == 'super-admin') {

$sales_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `records`");
$sales_records = mysqli_fetch_array($sales_count);
$sales_records = $sales_records['total_records'];

$expenses_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `expenses`");
$expenses_records = mysqli_fetch_array($expenses_count);
$expenses_records = $expenses_records['total_records'];

$todo_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `todos`");
$todo_records = mysqli_fetch_array($todo_count);
$todo_records = $todo_records['total_records'];

$custumers_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `customers`");
$customers_records = mysqli_fetch_array($custumers_count);
$customers_records = $customers_records['total_records'];


$result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `todos` WHERE task = 'Incomplete'");

$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];

$result = mysqli_query($connect,"SELECT * FROM `todos` WHERE task = 'Incomplete' ORDER BY id DESC");
/*$date1 = '2019-01-01';//date("Y-m-01") ."<br><br>";
$date2 = '2019-01-31';//date("Y-m-d") ."<br><br>";   */ 
$date1 = date("Y-m-01") ."<br><br>";
$date2 = date("Y-m-d") ."<br><br>";
$monthNum  = date("m");
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = $dateObj->format('F');
//echo $monthName;

$last_month_sales_total = "SELECT SUM(total) FROM records WHERE date BETWEEN '$date1' AND '$date2'";
$result_lastmonth = mysqli_query($connect, $last_month_sales_total);
$row = mysqli_fetch_row($result_lastmonth); 
$sales_lastmonth = $row[0];
//echo $sales_lastmonth;

$last_month_expenses_total = "SELECT SUM(cost) FROM expenses WHERE date BETWEEN '$date1' AND '$date2'";
$result_lastmonth_expenses = mysqli_query($connect, $last_month_expenses_total);
$row2 = mysqli_fetch_row($result_lastmonth_expenses); 
$expenses_lastmonth = $row2[0];

$customer_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `customers` WHERE date BETWEEN '$date1' AND '$date2'");

$total_customer = mysqli_fetch_array($customer_count);
$total_customer = $total_customer['total_records'];

$customer_result = mysqli_query($connect,"SELECT * FROM `customers` WHERE date BETWEEN '$date1' AND '$date2' ORDER BY id DESC LIMIT 5");



} else {
    
$sales_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `records` WHERE user = '$user'");
//echo $sales_count; die;
$sales_records = mysqli_fetch_array($sales_count);
$sales_records = $sales_records['total_records'];

$expenses_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `expenses` WHERE user = '$user'");
$expenses_records = mysqli_fetch_array($expenses_count);
$expenses_records = $expenses_records['total_records'];

$todo_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `todos`");
$todo_records = mysqli_fetch_array($todo_count);
$todo_records = $todo_records['total_records'];

$custumers_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `customers` WHERE user = '$user' ");
$customers_records = mysqli_fetch_array($custumers_count);
$customers_records = $customers_records['total_records'];


$result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `todos` WHERE task = 'Incomplete'");

$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];

$result = mysqli_query($connect,"SELECT * FROM `todos` WHERE task = 'Incomplete' ORDER BY id DESC");
    
$date1 = date("Y-m-01") ."<br><br>";
$date2 = date("Y-m-d") ."<br><br>";
$monthNum  = date("m");
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = $dateObj->format('F');
//echo $monthName;

$last_month_sales_total = "SELECT SUM(total) FROM records WHERE user = '$user' AND date BETWEEN '$date1' AND '$date2'";
$result_lastmonth = mysqli_query($connect, $last_month_sales_total);
$row = mysqli_fetch_row($result_lastmonth); 
$sales_lastmonth = $row[0];
//echo $sales_lastmonth;

$last_month_expenses_total = "SELECT SUM(cost) FROM expenses WHERE user = '$user' And date BETWEEN '$date1' AND '$date2'";
$result_lastmonth_expenses = mysqli_query($connect, $last_month_expenses_total);
$row2 = mysqli_fetch_row($result_lastmonth_expenses); 
$expenses_lastmonth = $row2[0];

$customer_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `customers` WHERE user = '$user' And date BETWEEN '$date1' AND '$date2'");

$total_customer = mysqli_fetch_array($customer_count);
$total_customer = $total_customer['total_records'];

$customer_result = mysqli_query($connect,"SELECT * FROM `customers` WHERE user = '$user' And date BETWEEN '$date1' AND '$date2' ORDER BY id DESC LIMIT 5");
    
}
?>
<html>
<head>
<link  rel="stylesheet" href="css/boots.min.css"/>
 <link href="js/metisMenu/metisMenu.min.css" rel="stylesheet">
 <link href="css/sb-admin-2.css" rel="stylesheet">
<link href="css/moi.css" rel="stylesheet"/>
 
 <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
   
  <script src="js/jquery-3.3.1.js"></script>
  
  <script>
  
 $(document).ready(function() {
   $(document).on('click', '.authorization', function(){  
           var role = 'role';  
                $.ajax({  
                     url:"authorization.php",  
                     method:"POST",  
                     data:{role:role}, 
                     dataType:"json",
                     success:function(data){
                        if(data == 1) {
                            
                            window.location.href = "http://sales.boldlinks.com.ng/profit_loss.php";
                        }
                        
                        if (data == 0) {
                            
                            document.getElementById('permission').innerHTML = 'Oops, you are not authorize to view this page';
                        }
                     }  
                });             
      }); 
      
      
         $(document).on('click', '.authorize', function(){  
           var role = 'role';  
                $.ajax({  
                     url:"authorization.php",  
                     method:"POST",  
                     data:{role:role}, 
                     dataType:"json",
                     success:function(data){
                        if(data == 1) {
                            
                            window.location.href = "http://sales.boldlinks.com.ng/user.php";
                        }
                        
                        if (data == 0) {
                            
                            document.getElementById('permit').innerHTML = 'Oops, you are not authorize to view this page';
                        }
                     }  
                });             
      }); 
  
 }); 
 
 
 
 
  </script>

     
    
     
     
  <style>
  
  
    
.section {
    margin-top: 50px;

}

  
  </style>

</head>
<body>

<div class=" row ab">
<h1>DASHBOARD</h1>
</div>
<div class="row">
    <div class="col-md-3 navo">
        <div>
            <h3 class="text-center" style="color: #0e1a35;"><b>  SUMMARY</b></h3>
        </div>
        <div>
            <h5 style="color: #5584ff; margin-left: 5px;"><b>You have (<?php echo $total_records; ?>) incomple task(s)</b></h5>
            <ul>
            <?php while($row = mysqli_fetch_array($result)){ ?>
                <li><b><?php echo $row['todo']; ?></b></li>
                <?php } ?>
            </ul>
        </div>
         <a href="todo.php">
        <div class="panel-footer">
                        <span class="pull-left text-center">View All Todos</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
        </a>
        <div class="row">
        <?php if($_SESSION['role'] == 'super-admin') { ?>
        <div>
            <h5 style="color: #5584ff; margin-left: 18px;"><b>Revenue and expenditure for this month</b></h5>
            <p style="margin-left: 18px;"
            ><b>Total Revenue for <?php echo $monthName . ' = ' . $sales_lastmonth; ?></b></p>
            <p style="margin-left: 18px;"><b>Total expenditure for <?php echo $monthName . ' = ' . $expenses_lastmonth; ?></b></p>
            
            <?php if ($sales_lastmonth >  $expenses_lastmonth) { ?>
            
            <p style="margin-left: 18px; color: blue;"><b>Net Profit = <?php echo $sales_lastmonth - $expenses_lastmonth; ?></b></p>
                
          <?php  } else { ?>
            
            <p style="margin-left: 18px; color: red;"><b>Net Loss = <?php echo $expenses_lastmonth - $sales_lastmonth; ?></b></p>
            
         <?php }?>
         <a href="profit_loss.php">
        <div class="panel-footer">
                        <span class="pull-left text-center">View details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
        </a>
        </div>
        <?php } ?>
        <div>
            <h5 style="color: #5584ff; margin-left: 18px;"><b>You have added (<?php echo $total_customer; ?>) customer(s) this month</b></h5>
            
            <ul>
            <?php while($row = mysqli_fetch_array($customer_result)){ ?>
                <li><b><?php echo $row['name']; ?></b></li>
                <?php } ?>
            </ul>
            <a href="custom.php">
        <div class="panel-footer">
                        <span class="pull-left text-center">View Customer Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
        </a>
        </div>
        </div>
        <div>
        
        </div>
    </div>
    </a>
    <div class="col-md-9 section">
    
  <!--  <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 
    </div>
    <!-- /.row -->
    <div class="row">
    
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-folder fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $sales_records; ?></div>
                            <div>Sales</div>
                        </div>
                    </div>
                </div>
                <a href="dashboard.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Records</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-book fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $expenses_records; ?></div>
                            <div>Expenses</div>
                        </div>
                    </div>
                </div>
                <a href="expenses.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Records</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
      <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $todo_records; ?></div>
                            <div>Tasks</div>
                        </div>
                    </div>
                </div>
                <a href="todo.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Todos</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        
        
        <div class="col-lg-3 col-md-6">
        
        </div>
        <div class="col-lg-3 col-md-6">
            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-files-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $customers_records; ?></div>
                            <div>Customers</div>
                        </div>
                    </div>
                </div>
                <a href="custom.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Records</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
       
       <div id="permission" style="color: red; font-weight: bold;"></div>
      <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-stumbleupon fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div>Profit & Loss</div>
                        </div>
                    </div>
                </div>
                
                <a href="#" class="authorization">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        
        <div id="permit" style="color: red; font-weight: bold;"></div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php //echo $numCustomers; ?></div>
                            <div>Users</div>
                        </div>
                    </div>
                </div>
                <a href="#" class="authorize">
                    <div class="panel-footer">
                        <span class="pull-left">View Users</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        
      </div>  
      <div class="col-md-9 text-center">
      <a href="logout.php"><button class="btn btn-primary btn-lg text-center" style="width: 200px;"><b>Logout</b></button></a>
      </div>
    </div>
    
    </div>
</div>

</div>
</body>
</html>



<!-- /#page-wrapper -->

<?php include_once('includes/footer.php');

} ?>


