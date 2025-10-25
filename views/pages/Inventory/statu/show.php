<?php
echo Page::title(["title"=>"Show Statu"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"statu", "text"=>"Manage Statu"]);
echo Page::context_open();
echo Statu::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
