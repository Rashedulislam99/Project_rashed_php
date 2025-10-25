<?php
class Purchases_details{
    public $id;
    public $purchase_id  ;
    public $product_id  ;
    public $qty;
    public $unit_price;
    public $discount;
    public $created_at;
    public $updated_at;
 
   
    

    public function __construct ($id, $purchase_id ,$product_id ,$qty,$unit_price,$discount,$created_at,$updated_at){
        $this->id = $id;
        $this->purchase_id = $purchase_id ;
        $this->product_id  = $product_id ;
        $this->qty = $qty;
        $this->unit_price = $unit_price;
        $this->discount = $discount;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
      
    }



    public  function create (){
        global $db,$tx;
        $purchases_details = $db->query("insert into {$tx}purchases_details values (null,'$this->purchase_id ','$this->product_id ','$this->qty','$this->unit_price', '$this->discount', '$this->created_at','$this->updated_at')");
        return $db->insert_id;
    }






   public static function GetAll(){
   global $db, $tx; 
   $purchases_details= $db->query("select * from {$tx}purchases_details");
   return $purchases_details->fetch_all(MYSQLI_ASSOC);
}




}












?>