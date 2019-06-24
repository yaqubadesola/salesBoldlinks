<?php
include_once('config.php');

$db_class = new configure();

session_start();

$user = $_SESSION['user'];

if(1 == 1) {
    
    $output = '';  
    $message = ''; 


if($_POST['sale_id'] != "") {   
    
    $query = "DELETE FROM records WHERE id = '".$_POST["sale_id"]."'";
    //echo $query;
    $result = mysqli_query($db_class->connect(), $query);
    $message = "Record Deleted";
    } 
    if ($result) {
       // echo "Bosssss"; die;
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