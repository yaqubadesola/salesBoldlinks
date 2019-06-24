<?php

class configure{
    
    public $dbhost = "localhost:3306";
    public $dbusername = "Boldlinks_Win";
    public $dbpass = "Admin@@2018.";
    public $dbname = "boldlinks_inventory";
    public  $dbcons;
    
    function connect(){
        return $this->dbcons = mysqli_connect($this->dbhost, $this->dbusername, $this->dbpass, $this->dbname);
    }
}



/*$dbhost = 'localhost';
$dbusername = 'root';
$dbpass = "";
$dbname = 'inventory';
//die("this is not me");
$connect = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);*/

?>