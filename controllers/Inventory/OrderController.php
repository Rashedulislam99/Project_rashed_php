<?php
class OrderController extends Controller{
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
	if(!preg_match("/^[\s\S]+$/",$data["customer_id"])){
		$errors["customer_id"]="Invalid customer_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["shipping_address"])){
		$errors["shipping_address"]="Invalid shipping_address";
	}
	if(!preg_match("/^[\s\S]+$/",$data["order_total"])){
		$errors["order_total"]="Invalid order_total";
	}
	if(!preg_match("/^[\s\S]+$/",$data["paid_amount"])){
		$errors["paid_amount"]="Invalid paid_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["remark"])){
		$errors["remark"]="Invalid remark";
	}
	if(!preg_match("/^[\s\S]+$/",$data["status_id"])){
		$errors["status_id"]="Invalid status_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["discount"])){
		$errors["discount"]="Invalid discount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["vat"])){
		$errors["vat"]="Invalid vat";
	}

*/
		if(count($errors)==0){
			$order=new Order();
		$order->customer_id=$data["customer_id"];
		$order->order_date=date("Y-m-d",strtotime($data["order_date"]));
		$order->delivery_date=date("Y-m-d",strtotime($data["delivery_date"]));
		$order->shipping_address=$data["shipping_address"];
		$order->order_total=$data["order_total"];
		$order->paid_amount=$data["paid_amount"];
		$order->remark=$data["remark"];
		$order->status_id=$data["status_id"];
		$order->discount=$data["discount"];
		$order->vat=$data["vat"];
		$order->created_at=$now;
		$order->updated_at=$now;

			$order->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Inventory",Order::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["customer_id"])){
		$errors["customer_id"]="Invalid customer_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["shipping_address"])){
		$errors["shipping_address"]="Invalid shipping_address";
	}
	if(!preg_match("/^[\s\S]+$/",$data["order_total"])){
		$errors["order_total"]="Invalid order_total";
	}
	if(!preg_match("/^[\s\S]+$/",$data["paid_amount"])){
		$errors["paid_amount"]="Invalid paid_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["remark"])){
		$errors["remark"]="Invalid remark";
	}
	if(!preg_match("/^[\s\S]+$/",$data["status_id"])){
		$errors["status_id"]="Invalid status_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["discount"])){
		$errors["discount"]="Invalid discount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["vat"])){
		$errors["vat"]="Invalid vat";
	}

*/
		if(count($errors)==0){
			$order=new Order();
			$order->id=$data["id"];
		$order->customer_id=$data["customer_id"];
		$order->order_date=date("Y-m-d",strtotime($data["order_date"]));
		$order->delivery_date=date("Y-m-d",strtotime($data["delivery_date"]));
		$order->shipping_address=$data["shipping_address"];
		$order->order_total=$data["order_total"];
		$order->paid_amount=$data["paid_amount"];
		$order->remark=$data["remark"];
		$order->status_id=$data["status_id"];
		$order->discount=$data["discount"];
		$order->vat=$data["vat"];
		$order->created_at=$now;
		$order->updated_at=$now;

		$order->update();
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
		Order::delete($id);
		redirect();
	}
	public function show($id){
		view("Inventory",Order::find($id));
	}




public function filter(){
    global $base_url;

    $criteria = "";
    if(isset($_POST["filter_type"])){

        $filter_type = $_POST["filter_type"];

        if($filter_type == "daily"){
            $today = date("Y-m-d");
            // Use DATE() in case order_date is DATETIME
            $criteria = "WHERE DATE(order_date) = '$today'";
        }
        elseif($filter_type == "monthly"){
            $month = date("m");
            $year = date("Y");
            $criteria = "WHERE MONTH(order_date) = '$month' AND YEAR(order_date) = '$year'";
        }
        elseif($filter_type == "custom"){
            $from = $_POST["from_date"];
            $to = $_POST["to_date"];
            // Include entire first and last day
            $criteria = "WHERE order_date >= '$from 00:00:00' AND order_date <= '$to 23:59:59'";
        }
    }

    // Fetch filtered data
    $orders = Order::filter($criteria);

    // Send data to view
    view("Inventory", ["orders" => $orders]);
}


}
?>
