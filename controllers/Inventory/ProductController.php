<?php
class ProductController extends Controller{
	public function __construct(){
	}
	public function index(){
		view("Inventory");
	}
	public function create(){
		view("Inventory");
	}
public function save($data,$file){
	global $now;
	if(isset($data["create"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtCategory"])){
		$errors["category"]="Invalid category";
	}
	if(!preg_match("/^[\s\S]+$/",$data["uom_id"])){
		$errors["uom_id"]="Invalid uom_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["description"])){
		$errors["description"]="Invalid description";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtBrand"])){
		$errors["brand"]="Invalid brand";
	}
	if(!preg_match("/^[\s\S]+$/",$data["price"])){
		$errors["price"]="Invalid price";
	}
	if(!preg_match("/^[\s\S]+$/",$data["purchase_price"])){
		$errors["purchase_price"]="Invalid purchase_price";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtImage"])){
		$errors["image"]="Invalid image";
	}

*/
		if(count($errors)==0){
			$product=new Product();
		$product->name=$data["name"];
		$product->category=$data["category"];
		$product->uom_id=$data["uom_id"];
		$product->description=$data["description"];
		$product->brand=$data["brand"];
		$product->price=$data["price"];
		$product->purchase_price=$data["purchase_price"];
		$product->image=$data["image"];
		$product->created_at=$now;
		$product->updated_at=$now;

			$product->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Inventory",Product::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtCategory"])){
		$errors["category"]="Invalid category";
	}
	if(!preg_match("/^[\s\S]+$/",$data["uom_id"])){
		$errors["uom_id"]="Invalid uom_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["description"])){
		$errors["description"]="Invalid description";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtBrand"])){
		$errors["brand"]="Invalid brand";
	}
	if(!preg_match("/^[\s\S]+$/",$data["price"])){
		$errors["price"]="Invalid price";
	}
	if(!preg_match("/^[\s\S]+$/",$data["purchase_price"])){
		$errors["purchase_price"]="Invalid purchase_price";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtImage"])){
		$errors["image"]="Invalid image";
	}

*/
		if(count($errors)==0){
			$product=new Product();
			$product->id=$data["id"];
		$product->name=$data["name"];
		$product->category=$data["category"];
		$product->uom_id=$data["uom_id"];
		$product->description=$data["description"];
		$product->brand=$data["brand"];
		$product->price=$data["price"];
		$product->purchase_price=$data["purchase_price"];
		$product->image=$data["image"];
		$product->created_at=$now;
		$product->updated_at=$now;

		$product->update();
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
		Product::delete($id);
		redirect();
	}
	public function show($id){
		view("Inventory",Product::find($id));
	}
}
?>
