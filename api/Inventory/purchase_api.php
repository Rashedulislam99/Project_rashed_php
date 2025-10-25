<?php
class PurchaseApi
{
	public function __construct() {}
	function index()
	{
		echo json_encode(["purchases" => Purchase::all()]);
	}
	function pagination($data)
	{
		$page = $data["page"];
		$perpage = $data["perpage"];
		echo json_encode(["purchases" => Purchase::pagination($page, $perpage), "total_records" => Purchase::count()]);
	}
	function find($data)
	{
		echo json_encode(["purchase" => Purchase::find($data["id"])]);
	}
	function delete($data)
	{
		Purchase::delete($data["id"]);
		echo json_encode(["success" => "yes"]);
	}
	function save($data, $file = [])
	{
		$purchase = new Purchase();
		$purchase->supplier_id = $data["supplier_id"];
		$purchase->status_id = $data["status_id"];
		$purchase->created_at = $data["created_at"];
		$purchase->updated_at = $data["updated_at"];

		$purchase->save();
		echo json_encode(["success" => "yes"]);
	}
	function update($data, $file = [])
	{
		$purchase = new Purchase();
		$purchase->id = $data["id"];
		$purchase->supplier_id = $data["supplier_id"];
		$purchase->status_id = $data["status_id"];
		$purchase->created_at = $data["created_at"];
		$purchase->updated_at = $data["updated_at"];

		$purchase->update();



		echo json_encode(["success" => "yes"]);
	}



	function purchase_save($data)
	{

		$data = $data["data"];
		global $now;



		$purchase = new Purchase();
		$purchase->supplier_id = $data["supplier_id"] ?? "";
		$purchase->status_id = 4;
		$purchase->sub_total = $data["net_total"];
		$purchase->net_total = $data["net_total"];
		$purchase->discount_amount = $data["discount"];
		$purchase->created_at = date('Y-m-d H:i:s');
		$purchase->updated_at = date('Y-m-d H:i:s');

		$purchase_id = $purchase->save();
        $warehouse=  $data["warehouse"];

		foreach ($data['products'] as $key => $data) {
			$purchasedetail = new PurchaseDetail();
			$purchasedetail->purchase_id = $purchase_id;
			$purchasedetail->product_id = $data["id"];
			$purchasedetail->qty = $data["qty"];
			$purchasedetail->unit_price = $data["price"];
			//$purchasedetail->discount = $data["qty"];
			$purchasedetail->created_at = date('Y-m-d H:i:s');
			$purchasedetail->updated_at = date('Y-m-d H:i:s');
			$purchasedetail->save();



	    $stock=new Stock();
		$stock->product_id=$data["id"];
		$stock->qty=$data["qty"];
		$stock->transaction_type_id=1;
		$stock->remark= "Purchase";
		$stock->warehouse_id= $warehouse;
		$stock->updated_at=date('Y-m-d H:i:s');
		$stock->created_at=date('Y-m-d H:i:s');
		$stock->lot_id=15;

		$stock->save();




		}



	



		echo json_encode(["success" => $data]);
	}
}
