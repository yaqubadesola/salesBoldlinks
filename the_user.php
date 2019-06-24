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
    $email = mysqli_real_escape_string($db_class->connect(), $_POST['email']);
    $username = mysqli_real_escape_string($db_class->connect(), $_POST['username']);
    $password = mysqli_real_escape_string($db_class->connect(), $_POST['password']);
    $user_id = mysqli_real_escape_string($db_class->connect(), $_POST['user_id']);
    $role = mysqli_real_escape_string($db_class->connect(), $_POST['role']);   
    
    
    if($_POST['user_id'] != "") {
    //echo $_POST['customer_id'];
    $query = "UPDATE login
                SET fullname = '$name',
                    email = '$email',
                    username = '$username',
                    password = '$password',
                    role = '$role'
                WHERE id = '$user_id'";
                $message = "Record updated";
    $result = mysqli_query($db_class->connect(), $query);
    //echo $query;
    }
    //$result= mysqli_query($db_class->connect(), $query);
    else {
        
        $query = "  
           INSERT INTO login(date, fullname, email, username, password, role)  
           VALUES('$date', '$name', '$email', '$username', '$password', '$role');  
           ";  
           $message = 'Record Inserted';
    }
    
    if (mysqli_query($db_class->connect(), $query)) {
        $output .= '<label class="text-success">' . $message . '</label>'; 
        
        $sel_qry = "SELECT * FROM login ORDER BY id DESC LIMIT 7";
        $exp_res = mysqli_query($db_class->connect(), $sel_qry);
        
        ?>
        
   <html>
   <head>
   
   </head>
   <body>

            
               <table class='table table-hover' style='width: 70%; margin-left: 17%;' id='user_table'>     
           
  
    <thead>

    <tr>
        <th>Date</th>
        <th>NAME</th>
        <th>PHONE</th>
        <th>EMAIL</th>
        <th>ADDRESS</th>
        <th>ROLE</th>
        <th>ACTIONS &nbsp; <button type='button' name='add' id='add' data-toggle='modal' data-target='#add_data_Modal' class='btn btn-info btn-sm'>+ Add</button></th>
    </tr>
    </thead>
  <?php  while($row = mysqli_fetch_array($exp_res)) { ?>
        
        <tr>
            <td><?php echo $row['date']?></td>
            <td><?php echo $row['fullname']?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['username'] ?></td>
            <td><?php echo $row['password'] ?></td>
            <td><?php echo $row['role'] ?></td>
            <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-sm edit_data" />
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
