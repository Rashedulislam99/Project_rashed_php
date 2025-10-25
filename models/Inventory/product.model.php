<?php
class Product extends Model implements JsonSerializable{
	public $id;
	public $name;
	public $category;
	public $uom_id;
	public $description;
	public $brand;
	public $price;
	public $purchase_price;
	public $image;
	public $created_at;
	public $updated_at;

	public function __construct(){
	}
	public function set($id,$name,$category,$uom_id,$description,$brand,$price,$purchase_price,$image,$created_at,$updated_at){
		$this->id=$id;
		$this->name=$name;
		$this->category=$category;
		$this->uom_id=$uom_id;
		$this->description=$description;
		$this->brand=$brand;
		$this->price=$price;
		$this->purchase_price=$purchase_price;
		$this->image=$image;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}products(name,category,uom_id,description,brand,price,purchase_price,image,created_at,updated_at)values('$this->name','$this->category','$this->uom_id','$this->description','$this->brand','$this->price','$this->purchase_price','$this->image','$this->created_at','$this->updated_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}products set name='$this->name',category='$this->category',uom_id='$this->uom_id',description='$this->description',brand='$this->brand',price='$this->price',purchase_price='$this->purchase_price',image='$this->image',created_at='$this->created_at',updated_at='$this->updated_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}products where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function GetAll(){
		global $db,$tx;
		$result=$db->query("select id,name,category,uom_id,description,brand,price,purchase_price,image,created_at,updated_at from {$tx}products");
		$data=[];
		while($product=$result->fetch_object()){
			$data[]=$product;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,category,uom_id,description,brand,price,purchase_price,image,created_at,updated_at from {$tx}products $criteria limit $top,$perpage");
		$data=[];
		while($product=$result->fetch_object()){
			$data[]=$product;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}products $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,category,uom_id,description,brand,price,purchase_price,image,created_at,updated_at from {$tx}products where id='$id'");
		$product=$result->fetch_object();
			return $product;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}products");
		$product =$result->fetch_object();
		return $product->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		Category:$this->category<br> 
		Uom Id:$this->uom_id<br> 
		Description:$this->description<br> 
		Brand:$this->brand<br> 
		Price:$this->price<br> 
		Purchase Price:$this->purchase_price<br> 
		Image:$this->image<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbProduct"){
		global $db,$tx;
		$html="<select class='form-select' id='$name' name='$name'> ";
		$html.="<option value =''>Select Product</option>";
		$result =$db->query("select id,name,vat from {$tx}products");
		while($product=$result->fetch_object()){
			$html.="<option data-vat='$product->vat' value ='$product->id'>$product->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}products $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,name,category,uom_id,description,brand,price,purchase_price,image,created_at,updated_at from {$tx}products $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"product/create","text"=>"New Product"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Name</th><th>Category</th><th>Uom Id</th><th>Description</th><th>Brand</th><th>Price</th><th>Purchase Price</th><th>Image</th><th>Created At</th><th>Updated At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th><th>Category</th><th>Uom Id</th><th>Description</th><th>Brand</th><th>Price</th><th>Purchase Price</th><th>Image</th><th>Created At</th><th>Updated At</th></tr>";
		}
		while($product=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"product/show/$product->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"product/edit/$product->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"product/confirm/$product->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$product->id</td><td>$product->name</td><td>$product->category</td><td>$product->uom_id</td><td>$product->description</td><td>$product->brand</td><td>$product->price</td><td>$product->purchase_price</td><td>$product->image</td><td>$product->created_at</td><td>$product->updated_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,name,category,uom_id,description,brand,price,purchase_price,image,created_at,updated_at from {$tx}products where id={$id}");
		$product=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Product Show</th></tr>";
		$html.="<tr><th>Id</th><td>$product->id</td></tr>";
		$html.="<tr><th>Name</th><td>$product->name</td></tr>";
		$html.="<tr><th>Category</th><td>$product->category</td></tr>";
		$html.="<tr><th>Uom Id</th><td>$product->uom_id</td></tr>";
		$html.="<tr><th>Description</th><td>$product->description</td></tr>";
		$html.="<tr><th>Brand</th><td>$product->brand</td></tr>";
		$html.="<tr><th>Price</th><td>$product->price</td></tr>";
		$html.="<tr><th>Purchase Price</th><td>$product->purchase_price</td></tr>";
		$html.="<tr><th>Image</th><td>$product->image</td></tr>";
		$html.="<tr><th>Created At</th><td>$product->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$product->updated_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
