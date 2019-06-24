<?php
error_reporting("on");
include_once('config.php');
//include_once("expenses.php");

$db_class = new configure();

session_start();

if(!empty($_POST))  {
    
    $output = '';  
    $message = '';  

    $item = mysqli_real_escape_string($db_class->connect(), $_POST['item']);
    $quantity = mysqli_real_escape_string($db_class->connect(), $_POST['quantity']);
    $cost = mysqli_real_escape_string($db_class->connect(), $_POST['cost']);
    $date = date("Y-m-d");
    $user = $_SESSION['user'];
    $expenses_id = mysqli_real_escape_string($db_class->connect(), $_POST['expenses_id']);   
    
    
    if($_POST['expenses_id'] != "") {
    //echo $_POST['customer_id'];
    $query = "UPDATE expenses
                SET date = '$date',
                    item = '$item',
                    quantity = '$quantity',
                    cost = '$cost'
                WHERE id = '$expenses_id'";
                
                $result = mysqli_query($db_class->connect(), $query);
                $message = "Expenses updated";
   
    //echo $query;
    }
    //$result= mysqli_query($db_class->connect(), $query);
    else {
        
        $query = "  
           INSERT INTO expenses(date, item, quantity, cost, user)  
           VALUES('$date', '$item', '$quantity', '$cost', '$user');  
           ";  
         $result = mysqli_query($db_class->connect(), $query);
         $message = 'Expenses recorded';
    }
    
    if ($result) { 

$output .= '<label class="text-success">' . $message . '</label>'; 

        if($_SESSION['role'] == 'super-admin') {
        
        $sel_qry = "SELECT * FROM expenses ORDER BY id DESC LIMIT 9";
        
        } else {
            
            $sel_qry = "SELECT * FROM expenses WHERE user = '$user' ORDER BY id DESC LIMIT 9";
        }
        $exp_res = mysqli_query($db_class->connect(), $sel_qry);
        
        ?>
        
        <html>
   <head>
   
   </head>
   <body>

            
               <table class="table table-striped table-bordered" id="expenses_table">    
           
  
    <thead>

    <tr>
        <th>DATE</th>
        <th>ITEM</th>
        <th>QUANTITY</th>
        <th>COST</th>
        <th>ACTIONS &nbsp; <button type='button' name='add' id='add' data-toggle='modal' data-target='#add_data_Modal' class='btn btn-info btn-sm'>+ Add</button></th>
    </tr>
    </thead>
  <?php  while($row = mysqli_fetch_array($exp_res)) { ?>
        
        <tr>
            <td><?php echo $row['date']?></td>
            <td><?php echo $row['item'] ?></td>
            <td><?php echo $row['quantity'] ?></td>
            <td><?php echo $row['cost'] ?></td>
            <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-sm edit_data" />
        <a onclick="window.open('exp_comment.php?id=<?=$row['id']?>','', 'width=700px, height=300px')" class="btn btn-primary btn-sm text-centre">Comment</a>
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