<?php

class StocksController1 {

  public function index($data) {
    if (isset($data["search"])) {
      $data = Stocks::search($data["search"]);
    } else {
      $data = Stocks::getAll();
    }
    view("Inventory", $data);
  }

  public function create() {
    view("Inventory");
  }

  public function save($data) {
    if (isset($_POST['create'])) {
      $product_id     = $_POST['product_id'];
      $qty            = $_POST['qty'];
      $date           = $_POST['date'];
      $transaction_id = $_POST['transaction_id'];
      $warehouse_id   = $_POST['warehouse_id'];

      $stocks = new Stocks(
        null, 
        $product_id, 
        $qty, 
        $date, 
        $transaction_id, 
        $warehouse_id, 
        null, 
        null
      );
      $stocks->save();
      redirect();
    }
  }

  public function edit($id) {
    $stocks = Stocks::find($id);
    view("Inventory", $stocks);
  }

  public function update($data) {
    if (isset($_POST['update'])) {
      $id             = $_POST['id'];
      $product_id     = $_POST['product_id'];
      $qty            = $_POST['qty'];
      $date           = $_POST['date'];
      $transaction_id = $_POST['transaction_id'];
      $warehouse_id   = $_POST['warehouse_id'];

      $stocks = new Stocks(
        $id, 
        $product_id, 
        $qty, 
        $date, 
        $transaction_id, 
        $warehouse_id, 
        null, 
        null
      );
      $stocks->update();
      redirect();
    }
  }

  public function delete($id) {
    Stocks::delete($id);
    redirect();
  }
}

?>
