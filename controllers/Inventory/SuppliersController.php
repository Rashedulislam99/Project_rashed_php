<?php

 class SuppliersController{

  public function index($data){
     if(isset($data["search"])){
      $data= suppliers::search($data["search"]);
     }else{
       $data= suppliers::getAll();
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
       $email= $_POST['email'];
       $phone= $_POST['phone'];
       $address= $_POST['address'];
     

       $suppliers= new suppliers(null, $name, $email,$phone,$address, null,null);
       $suppliers->save();
       redirect();
     }


  }


  public function edit($id){
     $suppliers= suppliers::find($id);
    view("Inventory", $suppliers);
  }
  public function update($data){
     print_r($data);
    
     if(isset($_POST['update'])){
       $id= $_POST['id'];
       $name= $_POST['name'];
       $email= $_POST['email'];
       $phone= $_POST['phone'];
       $address= $_POST['address'];
      
       

       $suppliers= new suppliers($id, $name,$email,$phone,$address,null,null);
       $suppliers->update();
       redirect();
     }




  }
  public function delete($id){
     suppliers::delete($id);
      redirect();
  }
 

 }
?>