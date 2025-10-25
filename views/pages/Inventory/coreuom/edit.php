<?php
echo Page::title(["title"=>"Edit CoreUom"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"coreuom", "text"=>"Manage CoreUom"]);
echo Page::context_open();
echo Form::open(["route"=>"coreuom/update"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
