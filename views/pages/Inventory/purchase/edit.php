<?php
echo Page::title(["title"=>"Edit Purchase"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"purchase", "text"=>"Manage Purchase"]);
echo Page::context_open();
echo Form::open(["route"=>"purchase/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$purchase->id"]);
	echo Form::input(["label"=>"Supplier","name"=>"supplier_id","table"=>"suppliers","value"=>"$purchase->supplier_id"]);
	echo Form::input(["label"=>"Sub Total","type"=>"text","name"=>"sub_total","value"=>"$purchase->sub_total"]);
	echo Form::input(["label"=>"Discount Amount","type"=>"text","name"=>"discount_amount","value"=>"$purchase->discount_amount"]);
	echo Form::input(["label"=>"Net Total","type"=>"text","name"=>"net_total","value"=>"$purchase->net_total"]);
	echo Form::input(["label"=>"Status","name"=>"status_id","table"=>"status","value"=>"$purchase->status_id"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
