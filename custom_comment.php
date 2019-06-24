

<!DOCTYPE HTML>
<html>
<head>


    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/bootstrap-grid.css" rel="stylesheet"/>
    <link href="css/bootstrap-grid.min.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>
    
     <script src="js/jquery-3.3.1.js"></script>
    <script src="js/script.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

<style>
    textarea{
    width: 80%;
    height: 100px;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    }
    
    input[type=submit] {
    width: 80%;
    background-color: blueviolet;
    color: white;
    padding: 12px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    }
    
    #read {
        float: right;
        padding: 50px;
        margin-top:-300px;
        width: 45%;
    }
    
    #area {
        width: 45%;
        padding: 30px;
    }
    </style>
	<title>COMMENTS</title>
    

</head>
<script>

 $(document).ready(function(){ 
     $('#custom_comm_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#comment').val() == "")  
           {  
                alert("Enter comment");  
           }    
           else  
           {  
                $.ajax({  
                     url:"customer_comment.php",  
                     method:"POST",  
                     data:$('#custom_comm_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Comment");  
                     },  
                     success:function(data){  
                          $('#custom_comm_form')[0].reset();    
                          $('#read').html(data);  
                     }  
                });  
           }  
      });
      
});

</script>
<?php
session_start();
include_once('configg.php');

$salesid = (isset($_GET['id'])) && !empty($_GET['id'])? $_GET['id']:"";

 ?>

<body>
<div id="area">
<form name="custom_comm_form" id="custom_comm_form" method="post">
<input type="text" name="id" id="id" value="<?php echo $salesid;  ?>" style="display: none;" />
<label>Write Your Comment</label><br />
<textarea name="comment" id="comment"></textarea><br />
<input type="submit" name="insert" id="insert" value="COMMENT"/>
</form>
</div>

<div id="read">
<?php
 $sel_qry = "SELECT * FROM customers_comment_table WHERE salesid='$salesid' ORDER BY date DESC";
   
         $exp_res = mysqli_query($connect, $sel_qry);
    
        if ($exp_res) {
            
            $row = mysqli_fetch_array($exp_res);
            
        }
        
        if(isset($_SESSION['user'])) {
foreach ($exp_res as $row) {
    
    echo "<span style='color:blueviolet'><b>{$row['user']}</b></span>";
    echo "<span><b> @ {$row['date']}</b></span><br>" ;
    echo $row['comment']; echo "<br><br>";
    }
}
?>


</div>




</body>
</html>