<?php
//print_r($_REQUEST);//die("hdghjfdshgfjkfgjk");
include_once('configg.php');
session_start();
;
//echo $_REQUEST['username']; die();
 $select_qry = "SELECT * FROM login WHERE username = '{$_REQUEST['username']}' AND password = '{$_REQUEST['password']}'";
 
 $result = mysqli_query($connect, $select_qry);  
 


 if($result){
                while ($row = mysqli_fetch_array($result)) {
                    if ($row['username'] == "{$_REQUEST['username']}" && $row['password'] == "{$_REQUEST['password']}") {
                        $_SESSION['user'] = $row['username'];
                       // echo $row['username']." is here"; die();
                        //echo $_SESSION['user']; die();
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['role'] = $row['role'];
                        //$_SESSION['role'] = $row['role'];
                        //echo $_SESSION['role']; die;
                        
                         
                        $res = array(0=>1 , 1 => "Login successful..Redirecting in 10 sec");
                        echo $myJSON = json_encode($res);
                        die();
                    }
                }
       
        
            }  
            
    
    
            
 if(mysqli_fetch_array($result)== false){
    
    $res = array(0=>false , 1 => "Invalid Username or Password");
    echo $myJSON = json_encode($res);
    die();

    }           
    


        
     
 

/*if($_REQUEST['username'] == "ibraphem" && $_REQUEST['password'] == "me")  {
    
    //echo  "Ajax is here";
    
    $res = array(0=>1 , 1 => "Login successful..Redirecting in 10 sec");
    echo $myJSON = json_encode($res);
    die();
} else {
    
  $res = array(0=>false , 1 => "Invalid Username or Password");
  echo $myJSON = json_encode($res);
  die();
}*/



?>