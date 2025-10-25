<?php
echo Page::title(["title"=>"Show CoreUom"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"coreuom", "text"=>"Manage CoreUom"]);
echo Page::context_open();
echo CoreUom::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
