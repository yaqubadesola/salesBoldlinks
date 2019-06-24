<?php  session_start(); 

include_once('configg.php');


//Start our session.
//session_start();
 
//Expire the session if user is inactive for 30
//minutes or more.
$expireAfter = 300;
 
//Check to see if our "last action" session
//variable has been set.
if(isset($_SESSION['last_action'])){
    
    //Figure out how many seconds have passed
    //since the user was last active.
    $secondsInactive = time() - $_SESSION['last_action'];
    
    //Convert our minutes into seconds.
    $expireAfterSeconds = $expireAfter * 60;
    
    //Check to see if they have been inactive for too long.
    if($secondsInactive >= $expireAfterSeconds){
        //User has been inactive for too long.
        //Kill their session.
        session_unset();
        session_destroy();
        echo "<script>console.log('Your Session has expired. Please re-login to continue')</script>";
        header('location: index.htm');
    }
    
}
 

if(isset($_SESSION['user'])) {
//echo "<h1>WELCOME <i>{$_SESSION['fullname']}</i></h1>";

$result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `todos` WHERE task = 'Incomplete'");

$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];

$result = mysqli_query($connect,"SELECT * FROM `todos` WHERE task = 'Incomplete' ORDER BY id DESC");

?>



<!DOCTYPE HTML>
<html>
<head>
    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/bootstrap-grid.css" rel="stylesheet"/>
    <link href="css/bat.css" rel="stylesheet"/>
    <link href="css/moi.css" rel="stylesheet"/>
    <link href="css/bootstrap-grid.min.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>
    
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/todo.js"></script>
    <script src="js/script.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    
	<title>INVENTORY TODO</title>

<style>
.miss {
  margin: 0;
  min-width: 250px;
}

/* Include the padding and border in an element's total width and height */
* {
  box-sizing: border-box;
}



/* Style the header */
.meader {
  background-color: #0e1a35;
  padding: 30px 40px;
  color: white;
  text-align: center;
}

/* Clear floats after the header */
.meader:after {
  content: "";
  display: table;
  clear: both;
}

/* Style the input */
.maq {
  margin: 0;
  border: none;
  border-radius: 0;
  width: 75%;
  padding: 10px;
  float: left;
  font-size: 16px;
}

/* Style the "Add" button */
.addBtn {
  padding: 10px;
  width: 25%;
  background: #d9d9d9;
  color: #555;
  float: left;
  text-align: center;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
  border-radius: 0;
 
}

.addBtn:hover {
  background-color: #bbb;
} 

 </style>
 
   
 
 

</head>

<body class="miss">

<div id="myDIV" class="meader">
    <ul id="nalo" style="margin-top: -20px;">
        	<li><a href="logout.php">Logout</a></li>
        	<li><a href="home.php">Dashboard</a></li>
        </ul>
  <h2 style="margin:5px">My To Do List</h2>
  <form name="dform" id="todol">
  <input class="maq" type="text" name="myInput" id="myInput" placeholder="Enter your todo"/>
  <input name="tod_id" id="tod_id" style="display: none;"/>
  <input type="submit" name="todo" value="Add" id="todo" class="addBtn"/>
  </form>
</div>


<div class="row">
    <div class="col-md-3 navo">
        
        <div>
            <h5 style="color: red; margin-left: 5px;"><b>You have (<?php echo $total_records; ?>) incomple task(s)</b></h5>
            <ul>
            <?php while($row = mysqli_fetch_array($result)){ ?>
                <li><b><?php echo $row['todo']; ?></b></li>
                <?php } ?>
            </ul>
        </div>
</div>


 <div class="col-md-8 section"> 


<table  style="width: 80%; ">
    <thead>
        <tr>
            <form>
                <div id="form">
                    <th colspan="1"> 
                        <div id="date_created" class="form-group">
                        <b><span style="color: red; padding: 5px; margin: 7px;">Filter by date created</span></b><input type="checkbox" onclick="myFunction()" id="show"/>
                            <div id="hide" onload="hidden">
                                <label>From</label>
                                <input type="date" name="date_from_created" class="form-control" value="<?php // echo $date_from; ?>"/>
                                <label>To </label>
                                <input type="date" name="date_to_created" class="form-control" value="<?php //echo $date_to; ?>"/>
                            </div>
                        </div>
                    </th>
                    <th colspan="1"> 
                        <div id="task_option" class="form-group">
                        <b><span style="color: red; padding: 5px; margin: 7px;">Filter by Task Option</b></span><input type="checkbox" onclick="myFunctionc()" id="watch"/>
                            <div id="pretend" class="form-group">
                                <select name="tasky" class="form-control">
                                <option value="select" ><?php //echo $product_cat; ?></option>
                                    <option value="select" >Completed</option>
                                    <option value="select" >Inomplete</option>
                                </select>
                            </div>
                        </div>
                    </th>
                    <th colspan="1"> 
                        <div id="date_completed" class="form-group">
                        <b><span style="color: red; padding: 5px; margin: 7px;">Filter by date created</span></b><input type="checkbox" onclick="myFunctionb()" id="see"/>
                            <div id="blind" onload="hidden">
                                <label>From</label>
                                <input type="date" name="date_from_completed" class="form-control" value="<?php // echo $date_from; ?>"/>
                                <label>To </label>
                                <input type="date" name="date_to_completed" class="form-control" value="<?php //echo $date_to; ?>"/>
                            </div>
                        </div>
                    </th>
                    <th  colspan="1"><input class='btn btn-success btn-sm' type="submit" name="search" value="SEARCH"/></th>
                </div>
            </form>
        </tr>
    </thead>
</table>



    <table class="table table-striped table-bordered " id="todo_table">
           
  
    <thead>

    <tr>
        <th>Date</th>
        <th>Todo</th>
        <th>Task</th>
        <th>Completed at</th>
        <th>Actions</th>
    </tr>
    
    </thead>
   
     <tbody>
    
 <?php
 

if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	$page_no = $_GET['page_no'];
    
    
	} else {
		$page_no = 1;
        }
        
       // echo $page_no; die;

	$total_records_per_page = 7;
    $offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 

	$result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `todos` ORDER BY id DESC");
    
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
   // echo $total_records; die;
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($connect,"SELECT * FROM `todos` ORDER BY id DESC LIMIT $offset, $total_records_per_page ");
    while($row = mysqli_fetch_array($result)){
            if($row['task'] == "Incomplete") { ?>

        <tr>
            <td><?php echo $row['date'] ?></td>
            <td><?php echo $row['todo'] ?></td>
            <td><a href="#" class="tasking" id="<?php echo $row['id']; ?>" ><?php echo $row['task']; ?></a></td>
            <td><?php echo $row['completed_at']; ?></td>
            <td><a onclick="window.open('todo_comment.php?id=<?=$row['id']?>','', 'width=700px, height=300px')" class="btn btn-primary btn-sm text-centre">Comment</a>
        <input type="button" name="delete" value="X" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm delete_data" /></td>
        </tr>
        
  <?php  } else { ?>
        
        <tr>
            <td><?php echo $row['date'] ?> </td>
            <td><span style='text-decoration:line-through'><?php echo $row['todo'] ?></span></td>
            <td><i><?php echo $row['task']; ?></i></td>
            <td><?php echo $row['completed_at']; ?></td>
            <td><a onclick="window.open('todo_comment.php?id=<?=$row['id']?>','', 'width=700px, height=300px')" class="btn btn-primary btn-sm text-centre">Comment</a>
        <input type="button" name="delete" value="X" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm delete_data" /></td>
        </tr>
        
    <?php
        }
        }
	mysqli_close($connect);
 
 ?>
     </tbody>
    </table>

<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
<strong><span style="color: red;">Page <?php echo $page_no." of ".$total_no_of_pages; ?></span></strong>
</div>

<ul class="pagination">
	<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>
</div>
</div>



 
<div id="todo_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                    <h4 class="modal-title">Task Plane</h4>
                </div>
                <div class="modal-body">
                <form name="todoForm" id="todoForm">
                <input type="text" name="todo_id" id="todo_id" style="display: none;" />
                <input type="text" name="todoo" id="todoo" style="display: none;"/>
                <input type="text" name="task" id="task" style="display: none;" />
                </form>
                <div class="deleteContent">
					<span>Have you completed this task?</span>

				</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="add-project" form="todoForm" name="todol" id="todol" value="Yes">Yes</button>
                    <button type="button" class="cancel" data-dismiss="modal">No</button>
                </div>
            </div>

        </div>
    </div>
    
    <div id="delete_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                    <h4 class="modal-title">Delete Todo</h4>
                </div>
                <div class="modal-body">
                <form name="deleteForm" id="deleteForm">
                <input type="text" name="to_id" id="to_id" style="display: none;"/>
                </form>
                <div class="deleteContent">
					<span>Are you sure you want to delete this todo?</span>

				</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                    <button type="submit" class="add-project" form="deleteForm" name="delete" id="delete" value="Delete">Delete</button>
                </div>
            </div>

        </div>
    </div>
    
<script>
  //var try2 = document.getElementById("read").innerHTML;
  //console.log(try2);
//alert(try2); 

$(document).ready(function(){ 
 $(document).on('click', '.tasking', function(){  
           var todo_id = $(this).attr("id");  
           //alert(todo_id);
           $.ajax({  
                url:"todot.php",  
                method:"POST",  
                data:{todo_id:todo_id},  
                dataType:"json",  
                success:function(data){    
                $('#todo_id').val(data.id);
                $('#todoo').val(data.todo);
                $('#task').val(data.task);
                $('#todol').val('Yes');
                $('#todo_modal').modal('show'); 
                }  
           });  
      }); 
      
      
  $('#todoForm').on("submit", function(event){  
           event.preventDefault();  
          // alert("waoh")
           if($('#todo').val() == "")  
           {  
                alert("Enter Todo");  
           }    
           else  
           {  
                $.ajax({  
                     url:"todoload.php",  
                     method:"POST",  
                     data:$('#todoForm').serialize(),  
                     beforeSend:function(){  
                          $('#todol').val("Yes");  
                     },  
                     success:function(data){  
                          $('#todoForm')[0].reset();  
                          $('#todo_modal').modal('hide');  
                          $('#todo_table').html(data);  
                     }  
                });  
           }  
      }); 
      
      
  $('#todol').on("submit", function(event){  
           event.preventDefault();  
           if($('#myInput').val() == "")  
           {  
                alert("Enter Todo");  
           }    
           else  
           {  
                $.ajax({  
                     url:"addtodo.php",  
                     method:"POST",  
                     data:$('#todol').serialize(),  
                     beforeSend:function(){  
                          $('#todo').val("Add");  
                     },  
                     success:function(data){  
                          $('#todol')[0].reset();    
                          $('#todo_table').html(data);  
                     }  
                });  
           }  
      });
      
 $(document).on('click', '.delete_data', function(){  
           var to_id = $(this).attr("id");  
               // alert(custom_id);
                $.ajax({  
                     url:"todod.php",  
                     method:"POST",  
                     data:{to_id:to_id},
                     dataType:"json",   
                     success:function(data){
                          $('#to_id').val(data.id);
                          $('#delete').val('Delete');
                          $('#delete_modal').modal('show');  
                     }  
                });             
      }); 
        
   $('#deleteForm').on("submit", function(event){  
           event.preventDefault();  
           if($('#to_id').val() == "")  
           {  
                alert("You can't delete");  
           }    

               $.ajax({  
                     url:"delete_todo.php",  
                     method:"POST",  
                     data:$('#deleteForm').serialize(),  
                     beforeSend:function(){  
                          $('#delete').val("Deleting");  
                     },  
                     success:function(data){   
                          $('#delete_modal').modal('hide');  
                          $('#todo_table').html(data);  
                     }  
                });  
                      
      }); 
      
      
 }); 
</script>
<script src="js/invent.js"></script>
<?php } ?>
</body>
</html>