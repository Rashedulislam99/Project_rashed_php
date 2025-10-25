<?php
class products{
    public $id;
    public $name ;
    public $category ;
    public $uom_id;
    public $brand;
    public $price;
    public $purchase_price;
    public $description;
    public $image;
    public $created_at;
    public $updated_at;
 
   
    

    public function __construct ($id, $name,$category,$uom_id,$brand,$price,$purchase_price,$description,$image,$created_at,$updated_at){
        $this->id = $id;
        $this->name= $name;
        $this->category = $category;
        $this->uom_id = $uom_id;
        $this->brand = $brand;
        $this->price = $price;
        $this->purchase_price = $purchase_price;
        $this->description = $description;
        $this->image = $image;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
      
    }



    public  function create (){
        global $db,$tx;
        $products = $db->query("insert into {$tx}products values (null,'$this->name','$this->category','$this->uom_id','$this->brand', '$this->price', '$this->purchase_price',$this->description',
        $this->image',$this->created_at','$this->updated_at')");
        return $db->insert_id;
    }






   public static function GetAll(){
   global $db, $tx; 
   $products= $db->query("select * from {$tx}products");
   return $products->fetch_all(MYSQLI_ASSOC);
}




}












?>