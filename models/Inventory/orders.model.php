<?php
class Orders{
    public $id;
    public $customer_id ;
    public $order_code ;
    public $sub_total;
    public $discount_amount;
    public $net_total;
    public $date;
    public $created_at;
    public $updated_at;
 
   
    

    public function __construct ($id, $customer_id,$order_code,$sub_total,$discount_amount,$net_total,$date,$created_at,$updated_at){
        $this->id = $id;
        $this->customer_id= $customer_id;
        $this->order_code = $order_code;
        $this->sub_total = $sub_total;
        $this->discount_amount = $discount_amount;
        $this->net_total = $net_total;
        $this->date = $date;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
      
    }



    public  function create (){
        global $db,$tx;
        $orders = $db->query("insert into {$tx}orders values (null,'$this->customer_id','$this->order_code','$this->sub_total','$this->discount_amount', '$this->net_total', '$this->date','$this->created_at','$this->updated_at')");
        return $db->insert_id;
    }






   public static function GetAll(){
   global $db, $tx; 
   $orders= $db->query("select * from {$tx}orders");
   return $orders->fetch_all(MYSQLI_ASSOC);
}


  public static function save(){
   global $db, $tx; 
   $orders= $db->query("insert into {$tx}orders values (null,customer_id.......");
   return $orders->fetch_all(MYSQLI_ASSOC);
}


 public function update(){
   global $db, $tx; 
   $orders= $db->query("insert into {$tx}orders values (null,customer_id.......");
   return $orders->fetch_all(MYSQLI_ASSOC);
}


 public static function find(){
   global $db, $tx; 
   $orders= $db->query("insert into {$tx}orders values (null,customer_id.......");
   return $orders->fetch_all(MYSQLI_ASSOC);
}
 public static function delete(){
   global $db, $tx; 
   $orders= $db->query("insert into {$tx}orders values (null,customer_id.......");
   return $orders->fetch_all(MYSQLI_ASSOC);
}

}









//probot create-mvc -m Inventory -px core_ -t stocks -d batch66


?>