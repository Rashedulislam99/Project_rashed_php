<?php
echo Page::title(["title"=>"Show Warehouse"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"warehouse", "text"=>"Manage Warehouse"]);
echo Page::context_open();
echo Warehouse::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
