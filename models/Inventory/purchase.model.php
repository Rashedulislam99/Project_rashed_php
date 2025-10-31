<?php
class Purchase extends Model implements JsonSerializable{
	public $id;
	public $supplier_id;
	public $sub_total;
	public $discount_amount;
	public $net_total;
	public $status_id;
	public $created_at;
	public $updated_at;

	public function __construct(){
	}
	public function set($id,$supplier_id,$sub_total,$discount_amount,$net_total,$status_id,$created_at,$updated_at){
		$this->id=$id;
		$this->supplier_id=$supplier_id;
		$this->sub_total=$sub_total;
		$this->discount_amount=$discount_amount;
		$this->net_total=$net_total;
		$this->status_id=$status_id;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}purchases(supplier_id,sub_total,discount_amount,net_total,status_id,created_at,updated_at)values('$this->supplier_id','$this->sub_total','$this->discount_amount','$this->net_total','$this->status_id','$this->created_at','$this->updated_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}purchases set supplier_id='$this->supplier_id',sub_total='$this->sub_total',discount_amount='$this->discount_amount',net_total='$this->net_total',status_id='$this->status_id',created_at='$this->created_at',updated_at='$this->updated_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}purchases where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,supplier_id,sub_total,discount_amount,net_total,status_id,created_at,updated_at from {$tx}purchases");
		$data=[];
		while($purchase=$result->fetch_object()){
			$data[]=$purchase;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,supplier_id,sub_total,discount_amount,net_total,status_id,created_at,updated_at from {$tx}purchases $criteria limit $top,$perpage");
		$data=[];
		while($purchase=$result->fetch_object()){
			$data[]=$purchase;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}purchases $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,supplier_id,sub_total,discount_amount,net_total,status_id,created_at,updated_at from {$tx}purchases where id='$id'");
		$purchase=$result->fetch_object();
			return $purchase;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}purchases");
		$purchase =$result->fetch_object();
		return $purchase->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Supplier Id:$this->supplier_id<br> 
		Sub Total:$this->sub_total<br> 
		Discount Amount:$this->discount_amount<br> 
		Net Total:$this->net_total<br> 
		Status Id:$this->status_id<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbPurchase"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}purchases");
		while($purchase=$result->fetch_object()){
			$html.="<option value ='$purchase->id'>$purchase->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}purchases $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,supplier_id,sub_total,discount_amount,net_total,status_id,created_at,updated_at from {$tx}purchases $criteria limit $top,$perpage");
		$html="<table class='table table-striped'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"purchase/create","text"=>"New Purchase"])."</th></tr>";
		if($action){
			$html.="<tr class=\"table-primary\"><th>Id</th><th>Supplier Id</th><th>Sub Total</th><th>Discount Amount</th><th>Net Total</th><th>Status Id</th><th>Created At</th><th>Updated At</th><th>Action</th></tr>";
		}else{
			$html.="<tr class=\"table-primary\"><th>Id</th><th>Supplier Id</th><th>Sub Total</th><th>Discount Amount</th><th>Net Total</th><th>Status Id</th><th>Created At</th><th>Updated At</th></tr>";
		}
		while($purchase=$result->fetch_object()){
			$action_buttons = "";
			if($action){
    $action_buttons = "
    <td>
      <div class='d-flex justify-content-center gap-2'>
        " . Event::button([
          "name" => "show",
          "value" => "<i class='bi bi-eye'></i>",
          "class" => "btn btn-outline-info btn-sm rounded-circle",
          "route" => "purchase/show/$purchase->id"
        ]) . "
        " . Event::button([
          "name" => "delete",
          "value" => "<i class='bi bi-trash'></i>",
          "class" => "btn btn-outline-danger btn-sm rounded-circle",
          "route" => "purchase/confirm/$purchase->id"
        ]) . "
      </div>
    </td>
    ";
}

			$html.="<tr><td>$purchase->id</td><td>$purchase->supplier_id</td><td>$purchase->sub_total</td><td>$purchase->discount_amount</td><td>$purchase->net_total</td><td>$purchase->status_id</td><td>$purchase->created_at</td><td>$purchase->updated_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,supplier_id,sub_total,discount_amount,net_total,status_id,created_at,updated_at from {$tx}purchases where id={$id}");
		$purchase=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Purchase Show</th></tr>";
		$html.="<tr><th>Id</th><td>$purchase->id</td></tr>";
		$html.="<tr><th>Supplier Id</th><td>$purchase->supplier_id</td></tr>";
		$html.="<tr><th>Sub Total</th><td>$purchase->sub_total</td></tr>";
		$html.="<tr><th>Discount Amount</th><td>$purchase->discount_amount</td></tr>";
		$html.="<tr><th>Net Total</th><td>$purchase->net_total</td></tr>";
		$html.="<tr><th>Status Id</th><td>$purchase->status_id</td></tr>";
		$html.="<tr><th>Created At</th><td>$purchase->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$purchase->updated_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
