<?php
class Warehouses {
    public $id;
    public $name;
    public $phone;
    public $email;
    public $address;
    public $created_at;
    public $updated_at;

    public function __construct($id, $name, $phone, $email, $address, $created_at, $updated_at) {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function GetAll() {
        global $db, $tx;
        $warehouses = $db->query("select * from {$tx}warehouses");
        return $warehouses->fetch_all(MYSQLI_ASSOC);
    }

    public function save() {
        global $db, $tx;
        $data = $db->query("INSERT INTO {$tx}warehouses (name, phone, email, address) 
        VALUES ('$this->name', '$this->phone', '$this->email', '$this->address')");
        return $data;
    }

    public function update() {
        global $db, $tx;
        $data = $db->query("update {$tx}warehouses set 
        name= '$this->name',
        phone= '$this->phone',
        email= '$this->email',
        address= '$this->address'
        where id= $this->id");
        return $data;
    }

    public static function find($id) {
        global $db, $tx;
        $data = $db->query("select * from {$tx}warehouses where id=$id ");
        return $data->fetch_assoc();
    }

    public static function search($data) {
        global $db, $tx;
        $data = $db->query("select * from {$tx}warehouses where 
        id like '%$data%' or 
        name like '%$data%' or 
        phone like '%$data%' or 
        email like '%$data%' or 
        address like '%$data%' ");
        return $data->fetch_all(MYSQLI_ASSOC);
    }

    public static function delete($id) {
        global $db, $tx;
        $data = $db->query("delete from {$tx}warehouses where id= $id ");
        return $data;
    }
}
?>
