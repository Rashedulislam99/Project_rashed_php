<?php

 class TransactionsController{

  public function index($data){
     if(isset($data["search"])){
      $data= Transactions::search($data["search"]);
     }else{
       $data= Transactions::getAll();
     }
    
     view("Inventory", $data);
  }



  public function create(){
      view("Inventory");
  }
  public function save($data){

//   print_r($data);
    
     if(isset($_POST['create'])){
      
       $name= $_POST['name'];
       $factor= $_POST['factor'];
       $warehouse_id= $_POST['warehouse_id'];
       $transactions= new Transactions(null, $name, $factor,$warehouse_id, null,null);
       $transactions->save();
       redirect();
     }


  }


  public function edit($id){
     $transactions= transactions::find($id);
    view("Inventory", $transactions);
  }
  public function update($data){
   //   print_r($data);
    
     if(isset($_POST['update'])){
       $id= $_POST['id'];
       $name= $_POST['name'];
       $factor= $_POST['factor'];
       $warehouse_id= $_POST['warehouse_id'];

       $transactions= new Transactions($id, $name,$factor,$warehouse_id,null,null);
       $transactions->update();
       redirect();
     }

  }
  public function delete($id){
     Transactions::delete($id);
      redirect();
  }

 }
?>