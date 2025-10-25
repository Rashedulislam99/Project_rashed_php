<?php
class SupplierController extends Controller{
	public function __construct(){
	}
	public function index(){
		view("Inventory");
	}
	public function create(){
		view("Inventory");
	}
public function save($data,$file){
	if(isset($data["create"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!is_valid_email($data["email"])){
		$errors["email"]="Invalid email";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPhone"])){
		$errors["phone"]="Invalid phone";
	}
	if(!preg_match("/^[\s\S]+$/",$data["address"])){
		$errors["address"]="Invalid address";
	}

*/
		if(count($errors)==0){
			$supplier=new Supplier();
		$supplier->name=$data["name"];
		$supplier->email=$data["email"];
		$supplier->phone=$data["phone"];
		$supplier->address=$data["address"];
		$supplier->created_at=$now;
		$supplier->updated_at=$now;

			$supplier->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Inventory",Supplier::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!is_valid_email($data["email"])){
		$errors["email"]="Invalid email";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPhone"])){
		$errors["phone"]="Invalid phone";
	}
	if(!preg_match("/^[\s\S]+$/",$data["address"])){
		$errors["address"]="Invalid address";
	}

*/
		if(count($errors)==0){
			$supplier=new Supplier();
			$supplier->id=$data["id"];
		$supplier->name=$data["name"];
		$supplier->email=$data["email"];
		$supplier->phone=$data["phone"];
		$supplier->address=$data["address"];
		$supplier->created_at=$now;
		$supplier->updated_at=$now;

		$supplier->update();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
	public function confirm($id){
		view("Inventory");
	}
	public function delete($id){
		Supplier::delete($id);
		redirect();
	}
	public function show($id){
		view("Inventory",Supplier::find($id));
	}
}
?>
