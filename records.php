<?php
// AUTHOR: OLAYIOYE IBRAHIM OLUWAFEMI
//YEAR: 2018


include_once('config.php');
class records extends configure {
    protected $day;
    protected $type;
    protected $velocity;
    protected $many;
    protected $group;
    protected $bill;
    protected $cash;
    protected $debt;
    protected $details;
    public $page_no;
    public $total_pages;
    
    function setter($date, $nature_of_job, $rate, $copies, $categories, $amount, $total, $balance) {
        $this->day = $date;
        $this->type = $nature_of_job;
        $this->velocity = $rate;
        $this->many = $copies;
        $this->group = $categories;
        $this->bill = $amount;
        $this->cash = $total;
        $this->debt = $balance;
        $this->details = array('date'=>$this->day, 'nature'=>$this->type, 'rate'=>$this->velocity, 'copies'=>$this->many, 
                                'categories'=>$this->group,'amount'=>$this->bill, 'total'=>$this->cash, 'balance'=>$this->debt);
                                
    }
    
    function getter() {
        return $this->details;
    }
    
    function add_records($date, $nature_of_job, $rate, $copies, $categories, $amount, $total, $balance) {
        $this->setter($date, $nature_of_job, $rate, $copies, $categories, $amount, $total, $balance);
        $this->getter();
        
        
        
             $insert_qry = "INSERT INTO records (date,nature_of_job,rate,copies,category,amount,total,balance)
                    VALUES('{$this->details['date']}','{$this->details['nature']}','{$this->details['rate']}',
                    '{$this->details['copies']}', '{$this->details[categories]}', '{$this->details['amount']}','{$this->details['total']}',
                    '{$this->details['balance']}')"; 
             $result = mysqli_query($this->connect(),$insert_qry);
             
                         
             if ($result) {
                echo "<script>alert('Your records was safe sucessfully')</script>";
                header ('location: dashboard.php');
              }      else {
                echo "<script>alert('There was an error while submitting your records \n please try again.')</script>";
              
              } 
             
        
        
    }//$date = date("Y-m-d")
    
    function update_records($upd_arr) { 
        
        //print_r($upd_arr);die("stop here");
        //$date, $nature_of_job, $rate, $copies, $amount, $total, $balance
        $this->details['id']            = isset($upd_arr['id'])             ? $upd_arr['id']            : "";
        $this->details['date']          = isset($upd_arr['date'])           ? $upd_arr['date']          : "";
        $this->details['nature_of_job'] = isset($upd_arr['nature_of_job'])  ? $upd_arr['nature_of_job'] : "";
        $this->details['rate']          = isset($upd_arr['rate'])           ? $upd_arr['rate']          : "";
        $this->details['copies']        = isset($upd_arr['copies'])         ? $upd_arr['copies']        : "";
        $this->details['categories']    = isset($upd_arr['categories']) ? $upd_arr['categories']        : "";
        $this->details['amount']        = isset($upd_arr['amount'])         ? $upd_arr['amount']        : "";
        $this->details['total']         = isset($upd_arr['total'])          ? $upd_arr['total']         : "";
        $this->details['balance']       = isset($upd_arr['balance'])        ? $upd_arr['balance']       : "";
        //$this->details['rate'] = isset($upd_arr['id'])? $upd_arr['id'] : "";
        
        $update_qry = "UPDATE records SET date='{$this->details['date']}', nature_of_job='{$this->details['nature_of_job']}', 
        rate='{$this->details['rate']}', copies='{$this->details['copies']}', category='{$this->details[categories]}', amount='{$this->details['amount']}', 
        total='{$this->details['total']}', balance='{$this->details['balance']}' WHERE id='{$this->details['id']}'";
        
        //echo $update_qry; die();
        
        $upd_result = mysqli_query($this->connect(),$update_qry);
         
         if ($upd_result) {
            
            echo "<script>alert('Your records was updated sucessfully')</script>";
            header ('location: dashboard.php');  
            
         }  else {
            
            echo "<script>alert('There was an error while updating your records \n please try again.')</script>";
         
         }
    }
    /*
    

    
    */
    function get_records($recs_arr){ 
        
        //print_r($recs_arr);//die();
        //$date, $nature_of_job, $rate, $copies, $amount, $total, $balance
        $this->details['date_from']        = isset($recs_arr['date_from'])             ? $recs_arr['date_from']    : "";
        $this->details['date_to']          = isset($recs_arr['date_to'])               ? $recs_arr['date_to']      : "";
        $this->details['products']         = isset($recs_arr['products'])               ? $recs_arr['products']      : "";
        $this->details['product_cat']      =(isset($recs_arr['product_cat']) && $recs_arr['product_cat'] != "select")           ? $recs_arr['product_cat']  : "";
        $Seach_varrs = array();
        
        if (($this->details['date_from']) == ""){
            $this->details['date_from'] = date("Y")."-01-01";
        }
        if (($this->details['date_to']) == ""){
            $this->details['date_to'] = date("Y-m-d");
        }
        //date to filter checks database where date is greater than date supplied
        $date_from_filter = "";
        if($this->details['date_from']!= "" ){
        //
           $date_from_filter = " AND  date >= '{$this->details['date_from']}' ";
           $Seach_varrs["date_from"] = $this->details['date_from'];
        }
        
        //date to filter checks database where date is less than date supplied
        //$date_to_filter = "";
        $date_filter_to = "";
        if($this->details['date_to']!= "" ){
        //
           $date_filter_to = " AND  date <= '{$this->details['date_to']}' ";
           $Seach_varrs["date_to"] =  $this->details['date_to'];
        }
        
        //product filter checks database where nature of jobe is equal to product name supplied
        $product_filter = "";
        if($this->details['products']!= "" ){
        //
           $product_filter = " AND  nature_of_job LIKE '%{$this->details['products']}%' ";
            $Seach_varrs["products"] =  $this->details['products'];
        }
        
        //category filter checks database where nature of category is equal to job category supplied
        $category_filter = "";
        if($this->details['product_cat']!= "" ){
        //
        
           $category_filter = " AND  category = '{$this->details['product_cat']}' ";
           $Seach_varrs["product_cat"] = $this->details['product_cat'];
        }

        $no_of_records_per_page = 10;

        if (isset($_GET['page_no'])) {

            $this->page_no = $_GET['page_no'];
        } else {
            $this->page_no = 1;
        }

        $total_pages_sql = "SELECT COUNT(*) FROM records  WHERE (1=1) $date_from_filter $date_filter_to
                     $product_filter $category_filter";
        $page_result = mysqli_query($this->connect(),$total_pages_sql);
        $total_rows = mysqli_fetch_array($page_result)[0];
        $this->total_pages = ceil($total_rows / $no_of_records_per_page);
        //echo $this->total_pages; die();

        $offset = ($this->page_no - 1) * $no_of_records_per_page ;

       // $SELECTDB = "SELECT * FROM records WHERE (1=1) $date_from_filter $date_filter_to
                  //   $product_filter $category_filter ORDER BY id DESC";

        $SELECTDB = "SELECT * FROM records WHERE (1=1) $date_from_filter $date_filter_to
                     $product_filter $category_filter ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
        //$recs_qry = "SELECT * FROM records ORDER BY id DESC";
      //echo "qry = $SELECTDB";// die("stop jo");
      
      $SELECT = "SELECT COUNT(*) As total_records FROM records WHERE (1=1) $date_from_filter $date_filter_to 
      $product_filter $category_filter ORDER BY id DESC";

       // echo $SELECTDB;
      
      //echo $SELECT; die;
        $recs_result = array();
        $recs_result = mysqli_query($this->connect(),$SELECTDB);
         
         if ($recs_result) {
         //  
             while($each_row = mysqli_fetch_assoc($recs_result)){
                 $new_arr[] = $each_row; 
             } 
         $last_index = count($new_arr) + 1; 
        /* echo "<pre>";
         print_r($new_arr);
          echo "</pre>";echo "br search variables";
          echo "<pre>";
         print_r($Seach_varrs);
          echo "</pre>";
         
          echo "<pre>";
         print_r($new_arr2);
          echo "</pre>";*.
          //die("stop first");
             //echo "<br/>";
            /* $my_arr[] = $row;//print_r($my_arr);
             $my_arr2  = $new_arr2 = array();
             foreach($new_arr as $key => $value){
                $my_arr2[] = $value;
                if(!in_array($my_arr2, $new_arr2)){
                 $new_arr2 = array_merge($my_arr2,$value);   
                }
             }*/
             //$new_arr2 = array_merge($new_arr2,$my_arr);
        //  print_r($last_index);echo '<br/>';
          //print_r($Seach_varr;s);echo '<br/>';
       
          $last_index_arr = array($last_index => $Seach_varrs);
          $new_arr2 = array_merge($new_arr,$last_index_arr);
          //print_r($new_arr2);echo '<br/>';
          //die('stop');  
          return $new_arr2;
         }
    }

    function get_customs($recs_arr){

        //print_r($recs_arr);//die();
        //$date, $nature_of_job, $rate, $copies, $amount, $total, $balance
        $this->details['date_from']        = isset($recs_arr['date_from'])             ? $recs_arr['date_from']    : "";
        $this->details['date_to']          = isset($recs_arr['date_to'])               ? $recs_arr['date_to']      : "";
        $this->details['name']         = isset($recs_arr['name'])               ? $recs_arr['name']      : "";
        $this->details['address']      =(isset($recs_arr['address']) && $recs_arr['address'] != "select")           ? $recs_arr['address']  : "";
        $this->details['product_cat']      =(isset($recs_arr['product_cat']) && $recs_arr['product_cat'] != "select")           ? $recs_arr['product_cat']  : "";
        $Seach_varrs = array();

        
        if (($this->details['date_from']) == ""){
            $this->details['date_from'] = date("Y")."-01-01";
        }
        if (($this->details['date_to']) == ""){
            $this->details['date_to'] = date("Y-m-d");
        }
        //date to filter checks database where date is greater than date supplied
        $date_from_filter = "";
        if($this->details['date_from']!= "" ){
            //
            $date_from_filter = " AND  date >= '{$this->details['date_from']}' ";
            $Seach_varrs["date_from"] = $this->details['date_from'];
        }

        //date to filter checks database where date is less than date supplied
        //$date_to_filter = "";
        $date_filter_to = "";
        if($this->details['date_to']!= "" ){
            //
            $date_filter_to = " AND  date <= '{$this->details['date_to']}' ";
            $Seach_varrs["date_to"] =  $this->details['date_to'];
        }

        //product filter checks database where nature of jobe is equal to product name supplied
        $product_filter = "";
        if($this->details['name']!= "" ){
            //
            $product_filter = " AND  name LIKE '%{$this->details['name']}%' ";
            $Seach_varrs["name"] =  $this->details['name'];
        }
        
        //category filter checks database where nature of category is equal to job category supplied
        $category_filter = "";
        if($this->details['address']!= "" ){
            //

            $category_filter = " AND  address = '{$this->details['address']}' ";
            $Seach_varrs["address"] = $this->details['address'];
        }
        
        $prod_category_filter = "";
        if($this->details['product_cat']!= "" ){
            //

            $prod_category_filter = " AND  category = '{$this->details['product_cat']}' ";
            $Seach_varrs["product_cat"] = $this->details['product_cat'];
        }

        $no_of_records_per_page = 10;

        if (isset($_GET['page_no'])) {

            $this->page_no = $_GET['page_no'];
        } else {
            $this->page_no = 1;
        }

        $total_pages_sql = "SELECT COUNT(*) FROM customers  WHERE (1=1) $date_from_filter $date_filter_to
                     $product_filter $category_filter $prod_category_filter";
        $page_result = mysqli_query($this->connect(),$total_pages_sql);
        $total_rows = mysqli_fetch_array($page_result)[0];
        $this->total_pages = ceil($total_rows / $no_of_records_per_page);
        //echo $this->total_pages; die();

        $offset = ($this->page_no - 1) * $no_of_records_per_page ;

        // $SELECTDB = "SELECT * FROM records WHERE (1=1) $date_from_filter $date_filter_to
        //   $product_filter $category_filter ORDER BY id DESC";

        $SELECTDB = "SELECT * FROM customers WHERE (1=1) $date_from_filter $date_filter_to
                     $product_filter $category_filter $prod_category_filter ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
        //$recs_qry = "SELECT * FROM records ORDER BY id DESC";
        //echo "qry = $SELECTDB";// die("stop jo");

        $SELECT = "SELECT COUNT(*) As total_records FROM records WHERE (1=1) $date_from_filter $date_filter_to
      $product_filter $category_filter ORDER BY id DESC";

         //echo $SELECTDB; die();

        //echo $SELECT; die;
        $recs_result = array();
        $recs_result = mysqli_query($this->connect(),$SELECTDB);

        if ($recs_result) {
            //
            while($each_row = mysqli_fetch_assoc($recs_result)){
                $new_arr[] = $each_row;
            }
            $last_index = count($new_arr) + 1;
            /* echo "<pre>";
             print_r($new_arr);
              echo "</pre>";echo "br search variables";
              echo "<pre>";
             print_r($Seach_varrs);
              echo "</pre>";

              echo "<pre>";
             print_r($new_arr2);
              echo "</pre>";*.
              //die("stop first");
                 //echo "<br/>";
                /* $my_arr[] = $row;//print_r($my_arr);
                 $my_arr2  = $new_arr2 = array();
                 foreach($new_arr as $key => $value){
                    $my_arr2[] = $value;
                    if(!in_array($my_arr2, $new_arr2)){
                     $new_arr2 = array_merge($my_arr2,$value);
                    }
                 }*/
            //$new_arr2 = array_merge($new_arr2,$my_arr);
            //  print_r($last_index);echo '<br/>';
            //print_r($Seach_varr;s);echo '<br/>';

            $last_index_arr = array($last_index => $Seach_varrs);
            $new_arr2 = array_merge($new_arr,$last_index_arr);
            //print_r($new_arr2);echo '<br/>';
            //die('stop');
            return $new_arr2;
            //return $new_arr;
        }
    }
    
    function get_todos($recs_arr){ 
        
        //print_r($recs_arr);//die();
        //$date, $nature_of_job, $rate, $copies, $amount, $total, $balance
        $this->details['date_from_created']        = isset($recs_arr['date_from_created'])             ? $recs_arr['date_from_created']    : "";
        $this->details['date_to_created']          = isset($recs_arr['date_to+created'])               ? $recs_arr['date_to_created']      : "";
        $this->details['tasky']                 = isset($recs_arr['tasky'])               ? $recs_arr['tasky']      : "";
        $this->details['date_from_completed']      = isset($recs_arr['date_from_completed'])             ? $recs_arr['date_from_completed']    : "";
        $this->details['date_to_completed']        = isset($recs_arr['date_to_completed'])               ? $recs_arr['date_to_completed']      : "";
        $Seach_varrs = array();
        
        if (($this->details['date_from_created']) == ""){
            $this->details['date_from_created'] = date("Y")."-01-01";
        }
        if (($this->details['date_to_created']) == ""){
            $this->details['date_to_created'] = date("Y-m-d");
        }
        
        if (($this->details['date_from_completed']) == ""){
            $this->details['date_from_completed'] = date("Y")."-01-01";
        }
        if (($this->details['date_to_completed']) == ""){
            $this->details['date_to_completed'] = date("Y-m-d");
        }
        //date to filter checks database where date is greater than date supplied
        $date_from_created_filter = "";
        if($this->details['date_from_created']!= "" ){
        //
           $date_from_created_filter = " AND  date >= '{$this->details['date_from_created']}' ";
           $Seach_varrs["date_from_created"] = $this->details['date_from_created'];
        }
        
        //date to filter checks database where date is less than date supplied
        //$date_to_filter = "";
        $date_to_created_filter = "";
        if($this->details['date_to_created']!= "" ){
        //
           $date_to_created_filter = " AND  date <= '{$this->details['date_to_created']}' ";
           $Seach_varrs["date_to_created"] =  $this->details['date_to_created'];
        }
        
        //------
        $date_from_completed_filter = "";
        if($this->details['date_from_completed']!= "" ){
        //
           $date_from_completed_filter = " AND  completed_at >= '{$this->details['date_from_completed']}' ";
           $Seach_varrs["date_from_completed"] = $this->details['date_from_completed'];
        }
        
        //date to filter checks database where date is less than date supplied
        //$date_to_filter = "";
        $date_to_completed_filter = "";
        if($this->details['date_to_completed']!= "" ){
        //
           $date_to_completed_filter = " AND  completed_at <= '{$this->details['date_to_created']}' ";
           $Seach_varrs["date_to_completed"] =  $this->details['date_to_completed'];
        }
        
        if($this->details['tasky'] == 'Incomplete'){
            $date_from_completed_filter = null;
            $date_to_completed_filter = null;
        }
        //product filter checks database where nature of jobe is equal to product name supplied
        $tasky_filter = "";
        if($this->details['tasky']!= "" ){
        //
           $tasky_filter = " AND  task LIKE '%{$this->details['tasky']}%' ";
            $Seach_varrs["tasky"] =  $this->details['tasky'];
        }
        
        //category filter checks database where nature of category is equal to job category supplied
       

        $no_of_records_per_page = 10;

        if (isset($_GET['page_no'])) {

            $this->page_no = $_GET['page_no'];
        } else {
            $this->page_no = 1;
        }

        $total_pages_sql = "SELECT COUNT(*) FROM todos  WHERE (1=1) $date_from_created_filter $date_to_created_filter
                     $tasky_filter $date_from_completed_filter $date_to_completed_filter";
        $page_result = mysqli_query($this->connect(),$total_pages_sql);
        $total_rows = mysqli_fetch_array($page_result)[0];
        $this->total_pages = ceil($total_rows / $no_of_records_per_page);
        //echo $this->total_pages; die();

        $offset = ($this->page_no - 1) * $no_of_records_per_page ;

       // $SELECTDB = "SELECT * FROM records WHERE (1=1) $date_from_filter $date_filter_to
                  //   $product_filter $category_filter ORDER BY id DESC";

        $SELECTDB = "SELECT * FROM todos WHERE (1=1) $date_from_created_filter $date_to_created_filter
                     $tasky_filter $date_from_completed_filter $date_to_completed_filter ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
        //$recs_qry = "SELECT * FROM records ORDER BY id DESC";
      //echo "qry = $SELECTDB";// die("stop jo");
      
      //$SELECT = "SELECT COUNT(*) As total_records FROM records WHERE (1=1) $date_from_filter $date_filter_to 
      //$product_filter $category_filter ORDER BY id DESC";

       // echo $SELECTDB; die();
      
      //echo $SELECT; die;
        $recs_result = array();
        $recs_result = mysqli_query($this->connect(),$SELECTDB);
         
         if ($recs_result) {
         //  
             while($each_row = mysqli_fetch_assoc($recs_result)){
                 $new_arr[] = $each_row; 
             } 
         $last_index = count($new_arr) + 1; 
        /* echo "<pre>";
         print_r($new_arr);
          echo "</pre>";echo "br search variables";
          echo "<pre>";
         print_r($Seach_varrs);
          echo "</pre>";
         
          echo "<pre>";
         print_r($new_arr2);
          echo "</pre>";*.
          //die("stop first");
             //echo "<br/>";
            /* $my_arr[] = $row;//print_r($my_arr);
             $my_arr2  = $new_arr2 = array();
             foreach($new_arr as $key => $value){
                $my_arr2[] = $value;
                if(!in_array($my_arr2, $new_arr2)){
                 $new_arr2 = array_merge($my_arr2,$value);   
                }
             }*/
             //$new_arr2 = array_merge($new_arr2,$my_arr);
        //  print_r($last_index);echo '<br/>';
          //print_r($Seach_varr;s);echo '<br/>';
       
          $last_index_arr = array($last_index => $Seach_varrs);
          $new_arr2 = array_merge($new_arr,$last_index_arr);
          //print_r($new_arr2); die();echo '<br/>';
          //die('stop');  
          return $new_arr2;
         }
    }

     function get_total($recs_arr){ 
        
        //print_r($recs_arr);//die();
        //$date, $nature_of_job, $rate, $copies, $amount, $total, $balance
        $this->details['date_from']        = isset($recs_arr['date_from'])             ? $recs_arr['date_from']    : "";
        $this->details['date_to']          = isset($recs_arr['date_to'])               ? $recs_arr['date_to']      : "";
        $this->details['products']         = isset($recs_arr['products'])               ? $recs_arr['products']      : "";
        $this->details['product_cat']      =(isset($recs_arr['product_cat']) && $recs_arr['product_cat'] != "select")           ? $recs_arr['product_cat']  : "";
        $Seach_varrs = array();
        
        if (($this->details['date_from']) == ""){
            $this->details['date_from'] = date("Y")."-01-01";
        }
        if (($this->details['date_to']) == ""){
            $this->details['date_to'] = date("Y-m-d");
        }
        //date to filter checks database where date is greater than date supplied
        $date_from_filter = "";
        if($this->details['date_from']!= "" ){
        //
           $date_from_filter = " AND  date >= '{$this->details['date_from']}' ";
           $Seach_varrs["date_from"] = $this->details['date_from'];
        }
        
        //date to filter checks database where date is less than date supplied
        //$date_to_filter = "";
        $date_filter_to = "";
        if($this->details['date_to']!= "" ){
        //
           $date_filter_to = " AND  date <= '{$this->details['date_to']}' ";
           $Seach_varrs["date_to"] =  $this->details['date_to'];
        }
        
        //product filter checks database where nature of jobe is equal to product name supplied
        $product_filter = "";
        if($this->details['products']!= "" ){
        //
           $product_filter = " AND  nature_of_job LIKE '%{$this->details['products']}%' ";
            $Seach_varrs["products"] =  $this->details['products'];
        }
        
        //category filter checks database where nature of category is equal to job category supplied
        $category_filter = "";
        if($this->details['product_cat']!= "" ){
        //
        
           $category_filter = " AND  category = '{$this->details['product_cat']}' ";
           $Seach_varrs["product_cat"] = $this->details['product_cat'];
        }

        $no_of_records_per_page = 10;

        if (isset($_GET['page_no'])) {

            $this->page_no = $_GET['page_no'];
        } else {
            $this->page_no = 1;
        }

        $total_pages_sql = "SELECT COUNT(*) FROM records  WHERE (1=1) $date_from_filter $date_filter_to
                     $product_filter $category_filter";
        $page_result = mysqli_query($this->connect(),$total_pages_sql);
        $total_rows = mysqli_fetch_array($page_result)[0];
        $this->total_pages = ceil($total_rows / $no_of_records_per_page);
        //echo $this->total_pages; die();

        $offset = ($this->page_no - 1) * $no_of_records_per_page ;

       // $SELECTDB = "SELECT * FROM records WHERE (1=1) $date_from_filter $date_filter_to
                  //   $product_filter $category_filter ORDER BY id DESC";

        $SELECTDB = "SELECT total FROM records WHERE (1=1) $date_from_filter $date_filter_to
                     $product_filter $category_filter";
        //$recs_qry = "SELECT * FROM records ORDER BY id DESC";
      //echo "$SELECTDB"; die("stop jo");
      
      $SELECT = "SELECT COUNT(*) As total_records FROM records WHERE (1=1) $date_from_filter $date_filter_to 
      $product_filter $category_filter ORDER BY id DESC";

       // echo $SELECTDB;
      
      //echo $SELECT; die;
        $recs_result = array();
        $recs_result = mysqli_query($this->connect(),$SELECTDB);
         
         if ($recs_result) {
         //  
             while($each_row = mysqli_fetch_assoc($recs_result)){
                 $new_arr[] = $each_row; 
             } 
             
             //print_r($new_arr);
         
          return $new_arr;
         }
    }
    function get_page_no(){
        return $this->page_no;
    }
    function get_total_pages(){
        return $this->total_pages;
    }
    function grand_total($qry){
        $res = msqli();
    }


}


?>