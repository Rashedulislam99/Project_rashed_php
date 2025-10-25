<?php
class Suppliers{
    public $id;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $created_at;
    public $updated_at;

   

    public function __construct ($id, $name,$email,$phone,$address,$created_at,$updated_at){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
       
      
    }

   public static function GetAll(){
   global $db, $tx; 
   $suppliers= $db->query("select * from {$tx}suppliers");
   return $suppliers->fetch_all(MYSQLI_ASSOC);
}

    public  function save()
    {
         global $db, $tx;
         $now = time();
         $data= $db->query("insert into {$tx}suppliers(name, email,phone,address) values('$this->name','$this->email','$this->phone','$this->address')");
         return $data;
    }

    public  function update()
    {
         global $db, $tx;
         $data= $db->query("update {$tx}suppliers set 
         name= '$this->name',
         email= '$this->email',
          phone= '$this->phone', 
          address= '$this->address' 
          where id= $this->id");
         return $data;
    }
    public static  function find($id)
    {
         global $db, $tx;
         $data= $db->query("select * from {$tx}suppliers where id=$id ");
         return $data->fetch_assoc();
    }
    public static  function search($data)
    {
         global $db, $tx;
         $data= $db->query("select * from {$tx}suppliers where id like '%$data%' or name like '%$data%' or phone like '%$data%' ");
         return $data->fetch_all(MYSQLI_ASSOC);
    }
    public static  function delete($id)
    {
         global $db, $tx;
         $data= $db->query("delete from {$tx}suppliers where id= $id ");
         return $data;
    }









}












?>