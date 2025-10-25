<?php
echo Page::title(["title"=>"Show PurchaseDetail"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"purchasedetail", "text"=>"Manage PurchaseDetail"]);
echo Page::context_open();
echo PurchaseDetail::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
