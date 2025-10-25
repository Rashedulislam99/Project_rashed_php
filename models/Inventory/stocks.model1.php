<?php
class Stocks1{
    public $id;
    public $product_id ;
    public $qty;
    public $date;
    public $transaction_id;
    public $warehouse_id;
    public $created_at;
    public $updated_at;
 
   
    

    public function __construct ($id, $product_id,$qty,$date,$transaction_id,$warehouse_id,$created_at,$updated_at){
        $this->id = $id;
        $this->product_id= $product_id;
        $this->qty = $qty;
        $this->date = $date;
        $this->transaction_id = $transaction_id;
        $this->warehouse_id = $warehouse_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
      
    }



   public static function GetAll(){
   global $db, $tx; 
   $stocks= $db->query("select * from {$tx}stocks");
   return $stocks->fetch_all(MYSQLI_ASSOC);
}

public function save ()
    {
        global $db, $tx;
        $data=$db->query("INSERT INTO {$tx}stocks (product_id,qty,date,transaction_id,warehouse_id) VALUES ('$this->product_id','$this->qty','$this->date','$this->transaction_id','$this->warehouse_id')");
        return $data;
    }



    public function update ()
    {
        global $db, $tx;
        $data=$db->query("update {$tx}stocks set 
        product_id='$this->product_id',
        qty='$this->qty',
        date='$this->date',
        transaction_id='$this->transaction_id',
        warehouse_id='$this->warehouse_id'
        where id=$this->id");
        return $data;
    }



       public static  function find($id)
    {
         global $db, $tx;
         $data= $db->query("select * from {$tx}stocks where id=$id ");
         return $data->fetch_assoc();
    }


    public static  function search($data)
    {
         global $db, $tx;
         $data= $db->query("select * from {$tx}stocks where id like '%$data%' or product_id like '%$data%' or qty like '%$data%'or date like '%$data%' or transaction_id like '%$data%' ");
         return $data->fetch_all(MYSQLI_ASSOC);
    }


    // public  function create (){
    //     global $db,$tx;
    //     $stocks = $db->query("insert into {$tx}stocks values (null,'$this->product_id','$this->qty','$this->date','$this->transaction_id', '$this->warehouse_id','$this->created_at','$this->updated_at')");
    //     return $db->insert_id;
    // }


  public static  function delete($id)
    {
         global $db, $tx;
         $data= $db->query("delete from {$tx}stocks where id= $id ");
         return $data;
    }





}












?>