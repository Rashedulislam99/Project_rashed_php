<?php
class TransactionTypeController extends Controller{
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
	if(!preg_match("/^[\s\S]+$/",$data["factor"])){
		$errors["factor"]="Invalid factor";
	}
	if(!preg_match("/^[\s\S]+$/",$data["warehouse_id"])){
		$errors["warehouse_id"]="Invalid warehouse_id";
	}

*/
		if(count($errors)==0){
			$transactiontype=new TransactionType();
		$transactiontype->name=$data["name"];
		$transactiontype->factor=$data["factor"];
		$transactiontype->warehouse_id=$data["warehouse_id"];
		$transactiontype->created_at=$now;
		$transactiontype->updated_at=$now;

			$transactiontype->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Inventory",TransactionType::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["factor"])){
		$errors["factor"]="Invalid factor";
	}
	if(!preg_match("/^[\s\S]+$/",$data["warehouse_id"])){
		$errors["warehouse_id"]="Invalid warehouse_id";
	}

*/
		if(count($errors)==0){
			$transactiontype=new TransactionType();
			$transactiontype->id=$data["id"];
		$transactiontype->name=$data["name"];
		$transactiontype->factor=$data["factor"];
		$transactiontype->warehouse_id=$data["warehouse_id"];
		$transactiontype->created_at=$now;
		$transactiontype->updated_at=$now;

		$transactiontype->update();
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
		TransactionType::delete($id);
		redirect();
	}
	public function show($id){
		view("Inventory",TransactionType::find($id));
	}
}
?>
