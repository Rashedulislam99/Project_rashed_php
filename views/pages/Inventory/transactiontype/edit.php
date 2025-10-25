<?php
echo Page::title(["title"=>"Edit TransactionType"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"transactiontype", "text"=>"Manage TransactionType"]);
echo Page::context_open();
echo Form::open(["route"=>"transactiontype/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$transactiontype->id"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name","value"=>"$transactiontype->name"]);
	echo Form::input(["label"=>"Factor","type"=>"textarea","name"=>"factor","value"=>"$transactiontype->factor"]);
	echo Form::input(["label"=>"Warehouse","name"=>"warehouse_id","table"=>"warehouses","value"=>"$transactiontype->warehouse_id"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
