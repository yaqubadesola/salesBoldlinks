<?php
error_reporting("on");
include_once('config.php');

$db_class = new configure();

session_start();

if(!empty($_POST))  {
    
    $output = '';  
    $message = '';  
    
    $date = date("Y-m-d");
    $name = mysqli_real_escape_string($db_class->connect(), $_POST['name']);
    $phone = mysqli_real_escape_string($db_class->connect(), $_POST['phone']);
    $email = mysqli_real_escape_string($db_class->connect(), $_POST['email']);
    $address = mysqli_real_escape_string($db_class->connect(), $_POST['address']);
    $customer_id = mysqli_real_escape_string($db_class->connect(), $_POST['customer_id']);   
    
    
    if($_POST['customer_id'] != "") {
    //echo $_POST['customer_id'];
    $query = "UPDATE customers
                SET name = '$name',
                    phone = '$phone',
                    email = '$email',
                    address = '$address'
                WHERE id = '$customer_id'";
                $message = "Record updated";
    $result = mysqli_query($db_class->connect(), $query);
    //echo $query;
    }
    //$result= mysqli_query($db_class->connect(), $query);
    else {
        
        $query = "  
           INSERT INTO customers(date, name, phone, email, address)  
           VALUES('$date', '$name', '$phone', '$email', '$address');  
           ";  
           $message = 'Record Inserted';
    }
    
    if (mysqli_query($db_class->connect(), $query)) {
        $output .= '<label class="text-success">' . $message . '</label>'; 
        
        $sel_qry = "SELECT * FROM customers ORDER BY id DESC LIMIT 7";
        $exp_res = mysqli_query($db_class->connect(), $sel_qry);
        
        ?>
        
   <html>
   <head>
   
   </head>
   <body>

            
               <table class='table table-hover' style='width: 70%; margin-left: 17%;' id='customers_table'>     
           
  
    <thead>

    <tr>
        <th>Date</th>
        <th>NAME</th>
        <th>PHONE</th>
        <th>EMAIL</th>
        <th>ADDRESS</th>
        <th>ACTIONS &nbsp; <button type='button' name='add' id='add' data-toggle='modal' data-target='#add_data_Modal' class='btn btn-info btn-sm'>+ Add</button></th>
    </tr>
    </thead>
  <?php  while($row = mysqli_fetch_array($exp_res)) { ?>
        
        <tr>
            <td><?php echo $row['date']?></td>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['phone'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['address'] ?></td>
            <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-sm edit_data" />
         <a onclick="window.open('custom_comment.php?id=<?=$row['id']?>','', 'width=700px, height=300px')" class="btn btn-primary btn-sm text-centre">Comment</a>
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
