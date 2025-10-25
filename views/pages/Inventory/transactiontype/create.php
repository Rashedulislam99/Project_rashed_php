<?php
echo Page::title(["title"=>"Create TransactionType"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"transactiontype", "text"=>"Manage TransactionType"]);
echo Page::context_open();
echo Form::open(["route"=>"transactiontype/save"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name"]);
	echo Form::input(["label"=>"Factor","type"=>"textarea","name"=>"factor"]);
	echo Form::input(["label"=>"Warehouse","name"=>"warehouse_id","table"=>"warehouses"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
