<?php
class TransactionType extends Model implements JsonSerializable{
	public $id;
	public $name;
	public $factor;
	public $warehouse_id;
	public $created_at;
	public $updated_at;

	public function __construct(){
	}
	public function set($id,$name,$factor,$warehouse_id,$created_at,$updated_at){
		$this->id=$id;
		$this->name=$name;
		$this->factor=$factor;
		$this->warehouse_id=$warehouse_id;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}transaction_types(name,factor,warehouse_id,created_at,updated_at)values('$this->name','$this->factor','$this->warehouse_id','$this->created_at','$this->updated_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}transaction_types set name='$this->name',factor='$this->factor',warehouse_id='$this->warehouse_id',created_at='$this->created_at',updated_at='$this->updated_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}transaction_types where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name,factor,warehouse_id,created_at,updated_at from {$tx}transaction_types");
		$data=[];
		while($transactiontype=$result->fetch_object()){
			$data[]=$transactiontype;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,factor,warehouse_id,created_at,updated_at from {$tx}transaction_types $criteria limit $top,$perpage");
		$data=[];
		while($transactiontype=$result->fetch_object()){
			$data[]=$transactiontype;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}transaction_types $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,factor,warehouse_id,created_at,updated_at from {$tx}transaction_types where id='$id'");
		$transactiontype=$result->fetch_object();
			return $transactiontype;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}transaction_types");
		$transactiontype =$result->fetch_object();
		return $transactiontype->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		Factor:$this->factor<br> 
		Warehouse Id:$this->warehouse_id<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbTransactionType"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}transaction_types");
		while($transactiontype=$result->fetch_object()){
			$html.="<option value ='$transactiontype->id'>$transactiontype->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}transaction_types $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,name,factor,warehouse_id,created_at,updated_at from {$tx}transaction_types $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"transactiontype/create","text"=>"New TransactionType"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Name</th><th>Factor</th><th>Warehouse Id</th><th>Created At</th><th>Updated At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th><th>Factor</th><th>Warehouse Id</th><th>Created At</th><th>Updated At</th></tr>";
		}
		while($transactiontype=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"transactiontype/show/$transactiontype->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"transactiontype/edit/$transactiontype->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"transactiontype/confirm/$transactiontype->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$transactiontype->id</td><td>$transactiontype->name</td><td>$transactiontype->factor</td><td>$transactiontype->warehouse_id</td><td>$transactiontype->created_at</td><td>$transactiontype->updated_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,name,factor,warehouse_id,created_at,updated_at from {$tx}transaction_types where id={$id}");
		$transactiontype=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">TransactionType Show</th></tr>";
		$html.="<tr><th>Id</th><td>$transactiontype->id</td></tr>";
		$html.="<tr><th>Name</th><td>$transactiontype->name</td></tr>";
		$html.="<tr><th>Factor</th><td>$transactiontype->factor</td></tr>";
		$html.="<tr><th>Warehouse Id</th><td>$transactiontype->warehouse_id</td></tr>";
		$html.="<tr><th>Created At</th><td>$transactiontype->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$transactiontype->updated_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
