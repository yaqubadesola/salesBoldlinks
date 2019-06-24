<?php
include_once("configg.php");

$record_per_page = 4;
$page = '';
$output = '';

if(isset($_POST['page'])) {
    
    $page = $_POST['page'];
} else {
    
    $page = 1;
}

$start_from = ($page - 1) * $record_per_page;

$query = 'SELECT * FROM customers ORDER BY id DESC LIMIT $start_from, $record_per_page';
$result = mysqli_query($connect, $query);

?>

    <table class="table table-hover" id="customers_table"> 
     
    <thead>

    <tr>
        <th>NAME</th>
        <th>PHONE</th>
        <th>EMAIL</th>
        <th>ADDRESS</th>                                                                                       
        <th>ACTIONS &nbsp; <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-info btn-sm">+ Add</button></th>
       <!-- <th>ADDRESS &nbsp; <a class="btn btn-info btn-sm" href="expenses.htm">+ Add</a></th>-->
    </tr>
    
    </thead>
    
    <?php while($row = mysqli_fetch_array($result)) { ?>
        
        <tbody>
    <tr>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['phone'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo $row['address'] ?></td>
        <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-sm edit_data" />
         <a onclick="window.open('custom_comment.php?id=<?=$row['id']?>','', 'width=700px, height=300px')" class="btn btn-primary btn-sm text-centre">Comment</a>
        <input type="button" name="delete" value="X" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm delete_data" /></td>
        </tr>
        
   <?php     
      
    }

?>

        </tbody> 
      </table>  
<?php

$page_query = 'SELECT * FROM customers ORDER BY id DESC';
$page_result = mysqli_query($connect, $page_query);

$total_records = mysqli_num_rows($page_result);
$total_pages = ceil($total_records/$record_per_page);

for($i = 1; $i <= $total_pages; $i++) { ?>

    <span class="pagination_link" style="cursor: pointer; padding: 6px; border: 1px solid #ccc;" id="blind<?php echo $i; ?>"><?php echo $i; ?></span>
    
<?php    
}
?>