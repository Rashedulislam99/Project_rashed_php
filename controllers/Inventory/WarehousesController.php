<?php

class WarehousesController {

  public function index($data) {
    if (isset($data["search"])) {
      $data = Warehouses::search($data["search"]);
    } else {
      $data = Warehouses::getAll();
    }
    
    view("Inventory", $data);
  }

  public function create() {
    view("Inventory");
  }

  public function save($data) {
    if (isset($_POST['create'])) {
      $name      = $_POST['name'];
      $phone     = $_POST['phone'];
      $email     = $_POST['email'];
      $address   = $_POST['address'];
      
      $warehouses = new Warehouses(null, $name, $phone, $email, $address, null, null);
      $warehouses->save();
      redirect();
    }
  }

  public function edit($id) {
    $warehouses = Warehouses::find($id);
    view("Inventory", $warehouses);
  }

  public function update($data) {
    if (isset($_POST['update'])) {
      $id        = $_POST['id'];
      $name      = $_POST['name'];
      $phone     = $_POST['phone'];
      $email     = $_POST['email'];
      $address   = $_POST['address'];

      $warehouses = new Warehouses($id, $name, $phone, $email, $address, null, null);
      $warehouses->update();
      redirect();
    }
  }

  public function delete($id) {
    Warehouses::delete($id);
    redirect();
  }
}

?>
