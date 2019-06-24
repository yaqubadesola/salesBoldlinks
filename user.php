<?php

include_once('config.php');
//include_once('exp_class.php');
include_once('action.php');
include_once('configg.php');

$db_class        =   new configure();

session_start();

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
 
//Assign the current timestamp as the user's
//latest activity
$_SESSION['last_action'] = time();
 
if(isset($_SESSION['user'])) {
//echo "<h1>WELCOME <i>{$_SESSION['fullname']}</i></h1>


    
        

?>

<html>
<head>
<style>

</style>
<!--<link rel="stylesheet" href="css/mystyle.css"/>-->

    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/bootstrap-grid.css" rel="stylesheet"/>
    <link href="css/bat.css" rel="stylesheet"/>
    <link href="css/moi.css" rel="stylesheet"/>
    <link href="css/bootstrap-grid.min.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>
    
     <script src="js/jquery-3.3.1.js"></script>
    <script src="js/script.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    
    
    
</head>
<body>

<?php if (isset($_SESSION['user'])) {}?>
<div class=" row ab ">
    <div class="col-md-12" class="text-center">
        <h1><a href="user.php" style="color: white;">MANAGE USERS</a></h1>
    </div>

        <ul id="nalo">
        	<li><a href="logout.php">Logout</a></li>
        	<li><a href="home.php">Dashboard</a></li>
        </ul>
  </div>

<div class="row">
    
<div class="container">
 <div class="col-md-12 section"> 





    <table class="table table-striped table-bordered" id="user_table">
           
  
    <thead>

    <tr>
        <th>DATE</th>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>USERNAME</th>
        <th>PASSWORD</th>
        <th>ROLE</th>
        <th>ACTIONS &nbsp; <button type='button' name='add' id='add' data-toggle='modal' data-target='#add_data_Modal' class='btn btn-info btn-sm'>+ Add</button></th>
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

	$result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `login` ORDER BY id DESC");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($connect,"SELECT * FROM `login` ORDER BY id DESC LIMIT $offset, $total_records_per_page ");
    while($row = mysqli_fetch_array($result)){ ?>
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

    <?php
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
</div>




    <!--Add modal-->
    <div id="add_data_Modal" class="modal fade" role="dialog" style="height: 500px;">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                    <h4 class="modal-title">USER</h4>
                </div>
                <div class="modal-body">
                    <form name="customer" id="insert_form" method="post">
                            <input type="text" placeholder="Enter user's fullname" name="name" id="name"/>
                            <input type="text" placeholder="Enter user's email" name="email" id="email"/>
                            <input type="text" placeholder="Enter user's username" name="username" id="username"/>
                            <input type="text" placeholder="Enter user's password" name="password" id="password"/>
                            <select name="role" id="role">
                                <option value="super-admin">super-admin</option>
                                <option value="admin">admin</option>
                             </select>
                            <input type="text" name="user_id" id="user_id" style="display: none;" />
                            <!--<input type="submit" name="insert" id="insert" value="Insert" style="background-color: #0e1a35; color: !important#fff; font-size: 25px; font-weight: bolder;" />-->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                    <button type="submit" class="add-project" form="insert_form" name="insert" id="insert" value="Insert">Insert</button>
            </div>

        </div>
    </div>
    </div>
        
        <!-- Delete Modal-->
         <div id="delete_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                    <h4 class="modal-title">Delete Customer Records</h4>
                </div>
                <div class="modal-body">
                <form name="deleteForm" id="deleteForm">
                <input type="text" name="users_id" id="users_id" style="display: none;"/>
                </form>
                <div class="deleteContent">
					<span>Are you sure you want to delete this user?</span>

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
 $(document).ready(function(){  

      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });
      
 $(document).on('click', '.edit_data', function(){  
           var user_id = $(this).attr("id");  
          // alert(customer_id);
           $.ajax({  
                url:"guser.php",  
                method:"POST",  
                data:{user_id:user_id},  
                dataType:"json",  
                success:function(data){  
                    
                $('#name').val(data.fullname);
                $('#email').val(data.email);
                $('#username').val(data.username);
                $('#password').val(data.password);
                $('#role').val(data.role);
                $('#user_id').val(data.id);
                $('#insert').val('Insert');
                $('#add_data_Modal').modal('show'); 
                }  
           });  
      }); 
      
 $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#name').val() == "")  
           {  
                alert("Name is required");  
           }    
           else  
           {  
                $.ajax({  
                     url:"the_user.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#user_table').html(data);  
                     }  
                });  
           }  
      }); 
      
      
      
 $(document).on('click', '.delete_data', function(){  
           var users_id = $(this).attr("id");  
               //alert(users_id);
                $.ajax({  
                     url:"the_users.php",  
                     method:"POST",  
                     data:{users_id:users_id},
                     dataType:"json",   
                     success:function(data){
                          $('#users_id').val(data.id);
                          $('#delete').val('Delete');
                          $('#delete_modal').modal('show');  
                     }  
                });             
      }); 
        
   $('#deleteForm').on("submit", function(event){  
           event.preventDefault();  
           if($('#users_id').val() == "")  
           {  
                alert("You can't delete");  
           }    

               $.ajax({  
                     url:"delete_user.php",  
                     method:"POST",  
                     data:$('#deleteForm').serialize(),  
                     beforeSend:function(){  
                          $('#delete').val("Deleting");  
                     },  
                     success:function(data){   
                          $('#delete_modal').modal('hide');  
                          $('#user_table').html(data);  
                     }  
                });  
                      
      }); 
 }); 
  
 </script>
 <script src="js/invent.js"></script>
 <?php } ?>
</body>

</html>
