<?php
include_once('config.php');

$db_class = new configure();

$user = $_SESSION['user'];
session_start();

if(1 == 1) {
    
    $output = '';  
    $message = ''; 


if($_POST['expense_id'] != "") {  
    
    
    $query = "DELETE FROM expenses WHERE id = '".$_POST["expense_id"]."'";
    //echo $query;
    $result = mysqli_query($db_class->connect(), $query);
    $message = "Record Deleted";
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