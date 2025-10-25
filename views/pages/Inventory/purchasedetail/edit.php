<?php
echo Page::title(["title"=>"Edit PurchaseDetail"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"purchasedetail", "text"=>"Manage PurchaseDetail"]);
echo Page::context_open();
echo Form::open(["route"=>"purchasedetail/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$purchasedetail->id"]);
	echo Form::input(["label"=>"Purchase","name"=>"purchase_id","table"=>"purchases","value"=>"$purchasedetail->purchase_id"]);
	echo Form::input(["label"=>"Product","name"=>"product_id","table"=>"products","value"=>"$purchasedetail->product_id"]);
	echo Form::input(["label"=>"Qty","type"=>"text","name"=>"qty","value"=>"$purchasedetail->qty"]);
	echo Form::input(["label"=>"Unit Price","type"=>"text","name"=>"unit_price","value"=>"$purchasedetail->unit_price"]);
	echo Form::input(["label"=>"Discount","type"=>"text","name"=>"discount","value"=>"$purchasedetail->discount"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
