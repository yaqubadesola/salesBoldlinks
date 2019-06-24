<?php
session_start();
include_once('action.php');
include_once('records.php');
include_once('exp_class.php');
//include_once('dashboard.php');



if (isset($_POST['login'])) {
    $actioned = new action();
    echo $actioned->login($_POST['username'], $_POST['password']);
}

if (isset($_POST['login'])) {
    $actioned = new action();
    echo $actioned->isnotlogin($_POST['username'], $_POST['password']);
}


$date = date("Y-m-d");

if (isset($_POST['add'])) {
    $recorded = new records();
    echo $recorded->add_records($date, $_POST['nature_of_job'], $_POST['rate'], 
    $_POST['copies'], $_POST['categories'], $_POST['amount'], $_POST['total'], 
    $_POST['balance']);
}

$id = (isset($_GET['id'])) && !empty($_GET['id'])? $_GET['id']:"";

if (isset($_POST['update'])) {
    $recorded = new records();
    echo $recorded->update_records($_POST);
}
/*$date, $_POST['nature_of_job'], $_POST['rate'], 
    $_POST['copies'], $_POST['amount'], $_POST['total'], 
    $_POST['balance']
*/
 
if (isset($_POST['logout'])) {
   // echo "i reach  here"; die;
    $logout = new action;
    echo $logout->logout($user);   
}

if (isset($_POST['add_exp'])) {
    
    $spend = new expenses();
    echo $spend->add_expenses($date, $_POST['item'], $_POST['quantity'], $_POST['cost']);
}

if (isset($_POST['edit_exp'])) {
    $edit = new expenses();
    echo $edit->edit_expenses($_POST);
}
    



    
?>