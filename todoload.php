<?php
error_reporting("on");
include_once('config.php');

$db_class = new configure();

//session_start();

if(!empty($_POST))  {
    //echo "cool";
    $output = '';  
    $message = '';  

    $todo = mysqli_real_escape_string($db_class->connect(), $_POST['todoo']);
    $task = mysqli_real_escape_string($db_class->connect(), $_POST['task']);
    $todo_id = $_POST['todo_id'];
    $completed_at = date("Y-m-d");
    $tasky= "Completed";
       
    
    
    if($_POST['todo_id'] != "") {
    //echo $_POST['customer_id'];
    $query = "UPDATE todos
                SET task = '$tasky',
                    completed_at = '$completed_at'
                WHERE id = '$todo_id'";
                $message = "Well Done";
                
               // echo $query;
    $result = mysqli_query($db_class->connect(), $query);
    //echo $query;
    }
    //$result= mysqli_query($db_class->connect(), $query);
    
           if ($result) {
               // echo 'yes';
                
        $output .= '<label class="text-success">' . $message . '</label>'; 
        
        $sel_qry = "SELECT * FROM todos ORDER BY id DESC LIMIT 7";
        $exp_res = mysqli_query($db_class->connect(), $sel_qry);
        
        ?>
        
<html>
<head>

</head>
<body>


               <table class='table table-hover' style='width: 70%; margin-left: 17%;' id='todo_table'>     
           
  
    <thead>

    <tr>
        <th>Date</th>
        <th>Todo</th>
        <th>Task</th>
        <th>Completed at</th>
        <th>Actions</th>
    </tr>
    </thead>
   <?php while($row = mysqli_fetch_array($exp_res)) { 
        
        if($row['task'] == "Incomplete") { ?>

        <tr>
            <td><?php echo $row['date'] ?></td>
            <td><?php echo $row['todo'] ?></td>
            <td><a href="#" class="tasking" id="<?php echo $row['id']; ?>" ><?php echo $row['task']; ?></a></td>
            <td><?php echo $row['completed_at']; ?></td>
            <td><a onclick="window.open('todo_comment.php?id=<?=$row['id']?>','', 'width=700px, height=300px')" class="btn btn-primary btn-sm text-centre">Comment</a>
        <input type="button" name="delete" value="X" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm delete_data" /></td>
        </tr>
    
    
    </table>
        
  <?php  } else { ?>
        
        <tr>
            <td><?php echo $row['date'] ?> </td>
            <td><span style='text-decoration:line-through'><?php echo $row['todo'] ?></span></td>
            <td><i><?php echo $row['task']; ?></i></td>
            <td><?php echo $row['completed_at']; ?></td>
            <td><a onclick="window.open('todo_comment.php?id=<?=$row['id']?>','', 'width=700px, height=300px')" class="btn btn-primary btn-sm text-centre">Comment</a>
        <input type="button" name="delete" value="X" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm delete_data" /></td>
        </tr>
</table>

</body>
</html>

<?php
    }
    }
    
}
    
    
    
}
?>