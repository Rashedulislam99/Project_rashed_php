<?php
echo Page::title(["title"=>"Show TransactionType"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"transactiontype", "text"=>"Manage TransactionType"]);
echo Page::context_open();
echo TransactionType::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
