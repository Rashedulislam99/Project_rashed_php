







<?php


 //print_r($stock);



?>


<div class="container my-5">
  <div class="table-card p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="mb-0 text-primary"><i class="bi bi-box-seam me-2"></i>Transaction Records By Product</h4>
      <a href="<?= $base_url?>/stock/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle me-1"></i> Add New</a>
    </div>

    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Transaction Type</th>
           
            <th>Updated At</th>
           
          </tr>
        </thead>
        <tbody>
          <?php

         // $stocks= Stock::getAllStocks();
         // print_r($stock);

          foreach ($stock as $key => $value) {
            $ttn= TransactionType::find($value->transaction_type_id)->name;
            $pn= Product::find($value->product_id)->name;
            echo "
            
            <tr>
            <td>$value->id</td>
            <td>$pn</td>
            <td>$value->qty</td>
            <td>$ttn</td>
        
            <td>$value->created_at</td>

            
          
          </tr>
            
            
            
            ";
          }
          ?>
          
         
        </tbody>
      </table>
    </div>
  </div>
</div>