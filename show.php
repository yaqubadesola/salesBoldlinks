<?php

include_once('configg.php');
//session_start();

if(isset($_POST['salid'])) {
    
   // echo 'Hurray'; die();
    
    $output = '';
    $query = "SELECT * FROM records where id = '".$_POST["salid"]."'";
    //echo $query; die;
    $result = mysqli_query($connect, $query);
    
    $output .= '
        <div class="table-responsive">
        <table class="table table-hover text-center" >';
    while($row = mysqli_fetch_array($result)) {
        
        $output .= '
                    <tr>
        <th style="width: 40%;">Nature Of Job</th>
        <td style="width: 60%;">'. $row["nature_of_job"] . '</td>
        </tr>
        
        <tr>
        <th style="width: 40%;">Rate</th>
        <td style="width: 60%;">'. $row["rate"] .'</td>
        </tr>
        
        <tr>
        <th style="width: 40%;">Copies</th>
        <td style="width: 60%;">' . $row["copies"] . '</td>
        </tr>
        
        <tr>
        <th style="width: 40%;">Category</th>
        <td style="width: 60%;">' .$row["category"] . '</td>
        </tr>
        
        <tr>
        <th style="width: 40%;">Amount Charged</th>
        <td style="width: 60%;">' .$row["amount"] .'</td>
        </tr>
        
        <tr>
        <th style="width: 40%;">Amount Paid</th>
        <td style="width: 60%;">' .$row["total"]  .'</td>
        </tr>
        
        <tr>
        <th style="width: 40%;">Balance</th>
        <td style="width: 60%;">' . $row["balance"] . '</td>
        </tr>
        
        
        ';
    }
    
    $output .= "</table></div>";
    echo $output;
    
}
    
    
?>




