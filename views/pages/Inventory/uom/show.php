<?php
echo Page::title(["title"=>"Show Uom"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"uom", "text"=>"Manage Uom"]);
echo Page::context_open();
echo Uom::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
