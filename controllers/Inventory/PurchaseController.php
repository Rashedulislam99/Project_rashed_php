<?php
class PurchaseController extends Controller{
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
	if(!preg_match("/^[\s\S]+$/",$data["supplier_id"])){
		$errors["supplier_id"]="Invalid supplier_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["sub_total"])){
		$errors["sub_total"]="Invalid sub_total";
	}
	if(!preg_match("/^[\s\S]+$/",$data["discount_amount"])){
		$errors["discount_amount"]="Invalid discount_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["net_total"])){
		$errors["net_total"]="Invalid net_total";
	}
	if(!preg_match("/^[\s\S]+$/",$data["status_id"])){
		$errors["status_id"]="Invalid status_id";
	}

*/
		if(count($errors)==0){
			$purchase=new Purchase();
		$purchase->supplier_id=$data["supplier_id"];
		$purchase->sub_total=$data["sub_total"];
		$purchase->discount_amount=$data["discount_amount"];
		$purchase->net_total=$data["net_total"];
		$purchase->status_id=$data["status_id"];
		$now = date("Y-m-d H:i:s");

		$purchase->created_at=$now;
		$purchase->updated_at=$now;

			$purchase->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Inventory",Purchase::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["supplier_id"])){
		$errors["supplier_id"]="Invalid supplier_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["sub_total"])){
		$errors["sub_total"]="Invalid sub_total";
	}
	if(!preg_match("/^[\s\S]+$/",$data["discount_amount"])){
		$errors["discount_amount"]="Invalid discount_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["net_total"])){
		$errors["net_total"]="Invalid net_total";
	}
	if(!preg_match("/^[\s\S]+$/",$data["status_id"])){
		$errors["status_id"]="Invalid status_id";
	}

*/
		if(count($errors)==0){
			$purchase=new Purchase();
			$purchase->id=$data["id"];
		$purchase->supplier_id=$data["supplier_id"];
		$purchase->sub_total=$data["sub_total"];
		$purchase->discount_amount=$data["discount_amount"];
		$purchase->net_total=$data["net_total"];
		$purchase->status_id=$data["status_id"];
		$now = date("Y-m-d H:i:s");

		$purchase->created_at=$now;
		$purchase->updated_at=$now;

		$purchase->update();
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
		Purchase::delete($id);
		redirect();
	}
	public function show($id){
		view("Inventory",Purchase::find($id));
	}
}
?>
