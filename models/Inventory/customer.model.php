<?php
class Customer extends Model implements JsonSerializable{
	public $id;
	public $name;
	public $email;
	public $phone;
	public $address;
	public $created_at;
	public $updated_at;
	public $password;

	public function __construct(){
	}
	public function set($id,$name,$email,$phone,$address,$created_at,$updated_at,$password){
		$this->id=$id;
		$this->name=$name;
		$this->email=$email;
		$this->phone=$phone;
		$this->address=$address;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;
		$this->password=$password;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}customers(name,email,phone,address,created_at,updated_at,password)values('$this->name','$this->email','$this->phone','$this->address','$this->created_at','$this->updated_at','$this->password')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}customers set name='$this->name',email='$this->email',phone='$this->phone',address='$this->address',created_at='$this->created_at',updated_at='$this->updated_at',password='$this->password' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}customers where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name,email,phone,address,created_at,updated_at,password from {$tx}customers");
		$data=[];
		while($customer=$result->fetch_object()){
			$data[]=$customer;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,email,phone,address,created_at,updated_at,password from {$tx}customers $criteria limit $top,$perpage");
		$data=[];
		while($customer=$result->fetch_object()){
			$data[]=$customer;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}customers $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,email,phone,address,created_at,updated_at,password from {$tx}customers where id='$id'");
		$customer=$result->fetch_object();
			return $customer;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}customers");
		$customer =$result->fetch_object();
		return $customer->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		Email:$this->email<br> 
		Phone:$this->phone<br> 
		Address:$this->address<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
		Password:$this->password<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbCustomer"){
		global $db,$tx;
		$html="<select class=\"form-select\" id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}customers");
		while($customer=$result->fetch_object()){
			$html.="<option value ='$customer->id'>$customer->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}customers $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,name,email,phone,address,created_at,updated_at,password from {$tx}customers $criteria limit $top,$perpage");
		$html="<table class='table table-striped'>";
			$html.="<tr ><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"customer/create","text"=>"New Customer"])."</th></tr>";
		if($action){
			$html.="<tr class=\"table-danger\"><th>Id</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Created At</th><th>Updated At</th><th>Password</th><th>Action</th></tr>";
		}else{
			$html.="<tr class=\"table-danger\"><th>Id</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Created At</th><th>Updated At</th><th>Password</th></tr>";
		}
		while($customer=$result->fetch_object()){
			$action_buttons = "";
			if($action){
    $action_buttons = "
    <td>
      <div class='d-flex justify-content-center gap-2'>
        " . Event::button([
          "name" => "show",
          "value" => "<i class='bi bi-eye'></i>",
          "class" => "btn btn-outline-info btn-sm rounded-circle",
          "route" => "product/show/$customer->id"
        ]) . "
        " . Event::button([
          "name" => "edit",
          "value" => "<i class='bi bi-pencil-square'></i>",
          "class" => "btn btn-outline-primary btn-sm rounded-circle",
          "route" => "product/edit/$customer->id"
        ]) . "
        " . Event::button([
          "name" => "delete",
          "value" => "<i class='bi bi-trash'></i>",
          "class" => "btn btn-outline-danger btn-sm rounded-circle",
          "route" => "product/confirm/$customer->id"
        ]) . "
      </div>
    </td>
    ";
}

			$html.="<tr><td>$customer->id</td><td>$customer->name</td><td>$customer->email</td><td>$customer->phone</td><td>$customer->address</td><td>$customer->created_at</td><td>$customer->updated_at</td><td>$customer->password</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,name,email,phone,address,created_at,updated_at,password from {$tx}customers where id={$id}");
		$customer=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Customer Show</th></tr>";
		$html.="<tr><th>Id</th><td>$customer->id</td></tr>";
		$html.="<tr><th>Name</th><td>$customer->name</td></tr>";
		$html.="<tr><th>Email</th><td>$customer->email</td></tr>";
		$html.="<tr><th>Phone</th><td>$customer->phone</td></tr>";
		$html.="<tr><th>Address</th><td>$customer->address</td></tr>";
		$html.="<tr><th>Created At</th><td>$customer->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$customer->updated_at</td></tr>";
		$html.="<tr><th>Password</th><td>$customer->password</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
