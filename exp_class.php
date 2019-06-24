<?php
include_once('config.php');
class expenses extends configure {
    
    protected $when;
    protected $what;
    protected $qty;
    protected $price;
    protected $all;
    
    
    
    function set_expenses($date, $item, $quantity, $cost){
    
        $this->when      =   $time;
        $this->what      =   $item;
        $this->qty       =   $quantity;
        $this->price     =   $cost;
        $this->all       =   array('date'=>$date, 'item'=>$item, 'quantity'=>$quantity, 'cost'=>$cost);        
        
    }
    
    
    function get_expenses() {
        
        return $this->all;
    }
    
    
    function add_expenses($date, $item, $quantity, $cost) {
        
        $this->set_expenses($date, $item, $quantity, $cost);
        $this->get_expenses();
        
        $add_qry = "INSERT INTO expenses (date, item, quantity, cost)
                    VALUES ('{$this->all[date]}', '{$this->all[item]}', '{$this->all[quantity]}', '{$this->all[cost]}') ";
                    
        $add_result = mysqli_query($this->connect(), $add_qry);
        
        if($add_result) {
            
            header("location: expenses.php");
        } else {
            
            echo "There was an error while saving your records, lease try again";
        }
    }
    
    
    function edit_expenses($edit_arr) {
        
        $this->all['id']          =      isset($edit_arr['id'])               ?     $edit_arr['id']          :     "";
        $this->all['date']        =      isset($edit_arr['date'])             ?     $edit_arr['date']        :     "";
        $this->all['item']        =      isset($edit_arr['item'])             ?     $edit_arr['item']        :     "";
        $this->all['quantity']    =      isset($edit_arr['quantity'])         ?     $edit_arr['quantity']    :     "";
        $this->all['cost']        =      isset($edit_arr['item'])             ?     $edit_arr['cost']        :     "";
        
        
        $edit_qry = "UPDATE expenses SET date='{$this->all['date']}', item='{$this->all['item']}', 
                    quantity='{$this->all['quantity']}', cost='{$this->all['cost']}' WHERE id='{$this->all['id']}' ";
                    
        $edit_result = mysqli_query($this->connect(), $edit_qry);
        
        
        if($edit_result) {
            
            header("location: expenses.php");
        } else {
            
            echo "There was a problem editting your records";
        }
        
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
        
        $SELECTDB = "SELECT * FROM expenses WHERE (1=1) $date_from_filter $date_filter_to 
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
    