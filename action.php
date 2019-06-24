<?php
ini_set("display_errors",1);
error_reporting(1);
include_once('config.php');
session_start();

class action extends configure{
    var $name, $pword; 
    
    function setter($username, $password ) {
        $this->name = $username;
        $this->pword = $password;
        $this->array_details = array($this->name, $this->pword);
    }
    
    function getter() {
        return $this->array_details;
    }

    function login($username, $password) {
    //
            $this->setter($username, $password);
            $this->getter();
    
              if($this->name == "") {
                //echo "<script>alert('Enter your username')</script>";
                echo "Username field can't be empty";
                echo '<br>';
                echo "<a href = 'index.htm'>RETURN BACK</a>";
                die();
            }
            
            if($this->pword == "") {
               // echo "<script>alert('Enter your password')</script>";
                echo "Password field can't be empty";
                echo '<br>';
                echo "<a href = 'index.htm'>RETURN BACK</a>";
                die();
            }
            
            $select_qry = "SELECT * FROM login WHERE username = '$this->name' AND password = '$this->pword'";
            $result = mysqli_query($this->connect(), $select_qry);
    
            if($result){
                while ($row = mysqli_fetch_array($result)) {
                    if ($row['username'] == "$this->name" && $row['password'] == "$this->pword") {
                        $_SESSION['user'] = $row['username'];
                       // echo $row['username']." is here"; die();
                        //echo $_SESSION['user']; die();
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['fullname'] = $row['fullname'];
                        $_SESSION['role'] = $row['role'];
                        //echo $_SESSION['fullname']; die;
                        
                        header("location: dashboard.php");
                        die();
                    }
       
        
            }
        }
     }
        
        function isnotlogin($username, $password) {
            
            $this->setter($username, $password);
            $this->getter();
            
            $select_qry = "SELECT * FROM login WHERE username = '$this->name' AND password = '$this->pword'";
            $result = mysqli_query(new mysqli("localhost", "root", "", "inventories"), $select_qry);
            
            if(mysqli_fetch_array($result)== false){
                //echo "<script>alert('Invalid Username or Password')</script>";
                echo "<h3 style='color:red'>Invalid login details</h3>";
               // echo "<a href = 'login.htm'>RETURN BACK</a>";
               // header("location: index.htm");  
            }  
        }
        
        function logout ($username) {
            
                        
            $this->setter($username, $password);
            $this->getter();
            
            if($_SESSION['user'] = $row['username']) {
                    
                    unset($_SESSION['user']);
                    session_destroy();
                    header ('location: index.htm');
            }

            
        }
        

    }




?>