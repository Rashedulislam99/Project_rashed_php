<?php
echo Page::title(["title"=>"Show Purchase"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"purchase", "text"=>"Manage Purchase"]);
echo Page::context_open();
echo Purchase::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
