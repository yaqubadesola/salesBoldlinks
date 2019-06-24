<?php
error_reporting("on");
include_once('config.php');
include_once('configg.php');
$db_class = new configure();

session_start();

if(!empty($_POST))  {
    
    $output = '';  
    $message = '';  
    
    $date = date("Y-m-d");
    $nature_of_job = mysqli_real_escape_string($db_class->connect(), $_POST['nature_of_job']);
    $rate = mysqli_real_escape_string($db_class->connect(), $_POST['rate']);
    $copies = mysqli_real_escape_string($db_class->connect(), $_POST['copies']);
    $category = mysqli_real_escape_string($db_class->connect(), $_POST['category']);
    $amount = mysqli_real_escape_string($db_class->connect(), $_POST['amount']);
    $total = mysqli_real_escape_string($db_class->connect(), $_POST['total']);
    $balance = mysqli_real_escape_string($db_class->connect(), $_POST['balance']);
    $sales_id = mysqli_real_escape_string($db_class->connect(), $_POST['sales_id']);   
    $user = $_SESSION['user'];
  //  echo $user;
    
    if($_POST['sales_id'] != "") {
    //echo $_POST['customer_id'];
    $query = "UPDATE records
                SET nature_of_job = '$nature_of_job',
                    rate = '$rate',
                    copies = '$copies',
                    category = '$category',
                    amount = '$amount',
                    total = '$total',
                    balance = '$balance'
                WHERE id = '$sales_id'";
                $message = "Record updated";
    $result = mysqli_query($db_class->connect(), $query);
    //echo $query;
    }
    //$result= mysqli_query($db_class->connect(), $query);
    else {
        
        $query = "  
           INSERT INTO records(date, nature_of_job, rate, copies, category, amount, total, balance, user)  
           VALUES('$date', '$nature_of_job', '$rate', '$copies', '$category', '$amount', '$total', '$balance', '$user');  
           ";  
           $message = 'Record Inserted';
    }
    
    if (mysqli_query($db_class->connect(), $query)) {
        $output .= '<label class="text-success">' . $message . '</label>'; 
        
        if($_SESSION['role'] == 'super-admin') {
            
        $sel_qry = "SELECT * FROM records ORDER BY id DESC LIMIT 12";
        
        } else {
           
           $sel_qry = "SELECT * FROM records WHERE user = '$user' ORDER BY id DESC LIMIT 12"; 
            
        }
            
        
        $exp_res = mysqli_query($db_class->connect(), $sel_qry);
        
        ?>
        
              
         <html>
   <head>
   
   </head>
   <body>

            
               <table class='table table-hover' style='width: 70%; margin-left: 17%;' id='customers_table'>     
           
  
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
  <?php  while($row = mysqli_fetch_array($exp_res)) { ?>
        
        <tr>
            <td><?php echo $row['date']?></td>
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
        </table>
  </body>   
  </html>
  
  <?php
        
    }
    
  
        
    } 
    

    
}
?>