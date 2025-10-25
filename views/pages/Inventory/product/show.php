<?php
echo Page::title(["title"=>"Show Product"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"product", "text"=>"Manage Product"]);
echo Page::context_open();
echo Product::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
