<?php
class Customers{
    public $id;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $created_at;
    public $updated_at;
    public $password;
   

    public function __construct ($id, $name,$email,$phone,$address,$created_at,$updated_at,$password){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->password = $password;
      
    }



    public  function create (){
        global $db,$tx;
        $customers = $db->query("insert into {$tx}customers values (null,'$this->name','$this->email','$this->phone',
        '$this->address','$this->created_at','$this->updated_at','$this->password')");
        return $db->insert_id;
    }






   public static function GetAll(){
   global $db, $tx; 
   $customers= $db->query("select * from {$tx}customers");
   return $customers->fetch_all(MYSQLI_ASSOC);
}

}












?>