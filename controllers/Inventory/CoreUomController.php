<?php
class CoreUomController extends Controller{
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

*/
		if(count($errors)==0){
			$coreuom=new CoreUom();

			$coreuom->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Inventory",CoreUom::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*

*/
		if(count($errors)==0){
			$coreuom=new CoreUom();
			$coreuom->id=$data["id"];

		$coreuom->update();
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
		CoreUom::delete($id);
		redirect();
	}
	public function show($id){
		view("Inventory",CoreUom::find($id));
	}
}
?>
