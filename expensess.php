<?php
include_once('config.php');
class expensess extends configure {
    public $day;
    public $substance;
    public $amount;
    public $cash;
    
    function setter($date, $item, $quantity, $cost) {
        $this->day = $date;
        $this->$substance = $item;
        $this->$amount = $quantity;
        $this->$cash = $cost;
        $this->details = array('date'=>$this->day, 'item'=>$this->substance, 'cost'=>$this->amount, 'cost'=>$this->cash);
                                
    }
    
    function getter() {
        return $this->details;
    }
    
   
     function get_records($recs_arr){ 
        
        //print_r($recs_arr);//die();
        //$date, $nature_of_job, $rate, $copies, $amount, $total, $balance
        $this->details['date_from']   = isset($recs_arr['date_from'])             ? $recs_arr['date_from']    : "";
        $this->details['date_to']     = isset($recs_arr['date_to'])               ? $recs_arr['date_to']      : "";
        $this->details['item']        = isset($recs_arr['item'])                  ? $recs_arr['item']         : "";
        $this->details['cost']        = isset($recs_arr['cost'])                  ? $recs_arr['cost']         : "";
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
        
        //item filter checks database where nature of jobe is equal to product name supplied
        $item_filter = "";
        if($this->details['item']!= "" ){
        //
           $item_filter = " AND  item LIKE '%{$this->details['item']}%' ";
            $Seach_varrs["item"] =  $this->details['item'];
        }
        
        //cost filter checks database where nature of category is equal to job category supplied
        $cost_filter = "";
        if($this->details['cost']!= "" ){
        //
           $item_filter = " AND  cost LIKE '%{$this->details['cost']}%' ";
            $Seach_varrs["cost"] =  $this->details['cost'];
        }
        
        $SELECTDB = "SELECT * FROM expenses WHERE (1=1) $date_from_filter /**/$date_filter_to 
                     $item_filter $cost_filter ORDER BY id DESC";
        //$recs_qry = "SELECT * FROM records ORDER BY id DESC";
      //echo "qry = $SELECTDB";// die("stop jo");
        $recs_result = array();
        $recs_result = mysqli_query($this->connect(),$SELECTDB);
         
         
         $new_arr = array();
         if ($recs_result) {
            //echo "Cool"; die;
         //  
             while($each_row = mysqli_fetch_assoc($recs_result)){
                 $new_arr = $each_row;
                  
             } 
             
             print_r($new_arr); die();
         $last_index = count($new_arr) + 1; 
         
         

          $last_index_arr = array($last_index => $Seach_varrs);
          $new_arr2 = array_merge($new_arr,$last_index_arr);
            
          return $new_arr2;
         }
    }
    
}

?>