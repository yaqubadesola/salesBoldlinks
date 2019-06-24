<?php
error_reporting("on");
include_once('config.php');
$db_class = new configure();

if(!empty($_POST))  {
    
    $output = '';  
    $message = '';  

    $myInput = mysqli_real_escape_string($db_class->connect(), $_POST['myInput']);
    $date = date("Y-m-d");
	$task = "Uncompleted";
    
    if($_POST['myInput'] != "") {
        
        $query = "INSERT INTO todos(date,todo,task) 
                    VALUES('$date','$myInput','$task')"; 
                    
        $result = mysqli_query($db_class->connect(), $query);
        $message = "Todo added";
    
    }
    
if ($result) {
               // echo 'yes';
                
        $output .= '<label class="text-success">' . $message . '</label>'; 
        
        $sel_qry = "SELECT * FROM todos ORDER BY id DESC";
        $exp_res = mysqli_query($db_class->connect(), $sel_qry);
        
        $output .= "
            
               <table class='table table-hover' style='width: 70%; margin-left: 17%;' id='todo_table'>     
           
  
    <thead>

    <tr>
        <th>Date</th>
        <th>Todo</th>
        <th>Task</th>
        <th>Completed at</th>
        <th>Actions</th>
    </tr>
    </thead>";
    while($row = mysqli_fetch_array($exp_res)) {
        
        if($row['task'] == "Incomplete") {
        
        $output .= "
        <tr>
            <td>" .$row['date'] ."</td>
            <td>" .$row['todo'] ."</td>
            <td><a href='#' id='".$row["id"]."' class='tasking'>" .$row['task'] ."</a></td>
            <td>" .$row['completed_at'] ."</td>
            <td><a onclick='window.open('#','', 'width=700px, height=300px')' class='btn btn-primary btn-sm text-centre'>Comment</a>
           <input type='button' name='delete' value='X' id='".$row["id"]."' class='btn btn-danger btn-sm delete_data' /></td>
        </tr>
        ";
    
    
    $output .= '</table>';
        
    } else {
        
                $output .= "
        <tr>
            <td>" .$row['date'] ."</td>
            <td><span style='text-decoration:line-through'>" .$row['todo'] ."</span></td>
            <td><i>" .$row['task'] ."</i></td>
            <td>" .$row['completed_at'] ."</td>
             <td><a onclick='window.open('#','', 'width=700px, height=300px')' class='btn btn-primary btn-sm text-centre'>Comment</a>
           <input type='button' name='delete' value='X' id='".$row["id"]."' class='btn btn-danger btn-sm delete_data' /></td>
        </tr>
        ";
    
    
    $output .= '</table>';
    }
    }
    
}
    
    
    echo $output;

}
?>