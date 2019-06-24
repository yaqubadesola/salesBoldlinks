<?php
ini_set("display_errors",1);
include_once('config.php');
//include_once('records.php');

$id = (isset($_GET['id'])) && !empty($_GET['id'])? $_GET['id']:"";
$db_class = new configure(); 
$SELECTDB = "SELECT * FROM records WHERE id='$id'";
//echo $SELECTDB;
$result = mysqli_query($db_class->connect(), $SELECTDB);

if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        
        $date =($row['date']!="" )?$row['date']:"";      
        $nature_of_job = ($row['nature_of_job']!="" )?$row['nature_of_job']:"";
        $rate = ($row['rate']!="" )?$row['rate']:"";
        $copies =($row['copies']!="" )?$row['copies']:"";      
        $amount = ($row['amount']!="" )?$row['amount']:"";
        $total = ($row['total']!="" )?$row['total']:"";
        $balance = ($row['balance']!="" )?$row['balance']:"";
      //  echo $nature_of_job;(die);
        }
}


?>

<html>
<head>
<style>
input[type=text], select {
    width: 60%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 60%;
    background-color: #0e1a35;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: blueviolet;
}

.form {
    text-align: center;
    width: 40%;
    padding: 10px;
    margin-left: 30%;

    
}
</style>
</head>

<body>
<h2 style="text-align: center; color: #0e1a35;;">EDIT RECORDS AND UPDATE</h2>

    <form method="post"  action="call.php" >
        <div class="form">
        <input type="hidden" name="id" value="<?php echo $id ?>"/>
        <input type="text" name="date" value="<?php echo $date?>"/><br/><br />
        <input type="text" name="nature_of_job" value="<?php echo $nature_of_job ?>"/><br/><br />
      <!--  <input type="text" name="rate" value="<?php // echo $rate ?>"/><br/><br />
        <input type="text" name="copies" value="<?php //echo $copies ?>"/><br/><br />
        <input type="text" name="amount" value="<?php //echo $amount ?>"/><br/><br />-->
        <select name="categories"><br/><br />
        <option value="select" >Choose Category</option>
        <option value="Web Projects">Web Projects</option>
        <option value="Training">Training</option>
        <option value="Graphics/Printing">Graphics/Printing</option>
        <option value="Other Services">Other Services</option>
        </select>
        <input type="text" name="total" value="<?php echo $total ?>"/><br/><br />
        <input type="text" name="balance" value="<?php echo $balance ?>"/><br/><br />
        <input type="submit" name="update" value="UPDATE" />
        </div>
    </form>

</body>
</html>
