<?php

session_start();


if($_SESSION['role'] == 'super-admin') {
    
    $res = array(0=>1);
    echo $myJSON = json_encode($res);
    die();
    
} 


if($_SESSION['role'] == 'admin') {

    $res = array(0=>0);
    echo $myJSON = json_encode($res);
    die();
}
?>