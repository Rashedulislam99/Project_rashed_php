<?php
class Transactions{
    public $id;
    public $name;
    public $factor;
    public $warehouse_id;
    public $created_at;
    public $updated_at;

   

    public function __construct ($id, $name,$factor,$warehouse_id,$created_at,$updated_at){
        $this->id = $id;
        $this->name = $name;
        $this->factor = $factor;
        $this->warehouse_id = $warehouse_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
       
      
    }

   public static function GetAll(){
   global $db, $tx; 
   $transactions= $db->query("select * from {$tx}transactions");
   return $transactions->fetch_all(MYSQLI_ASSOC);
}



   public  function save()
    {
         global $db, $tx;
         $data= $db->query("INSERT INTO {$tx}transactions (name, factor, warehouse_id) 
        VALUES ('$this->name', '$this->factor', '$this->warehouse_id')");
         return $data;
    }


     public  function update()
    {
         global $db, $tx;
         $data= $db->query("update {$tx}transactions set 
         name= '$this->name',
         factor= '$this->factor',
          warehouse_id= '$this->warehouse_id'
          where id= $this->id");
         return $data;
    }

     public static  function find($id)
    {
         global $db, $tx;
         $data= $db->query("select * from {$tx}transactions where id=$id ");
         return $data->fetch_assoc();
    }


    public static  function search($data)
    {
         global $db, $tx;
         $data= $db->query("select * from {$tx}transactions where id like '%$data%' or name like '%$data%' or factor like '%$data%' ");
         return $data->fetch_all(MYSQLI_ASSOC);
    }

    
    public static  function delete($id)
    {
         global $db, $tx;
         $data= $db->query("delete from {$tx}transactions where id= $id ");
         return $data;
    }

    








}












?>