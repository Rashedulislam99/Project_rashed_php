<?php
 //var_dump($data);
//  var_dump($product);
//  var_dump($bag);
//print_r($data);
?>



<body class="bg-light">

<div class="container py-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Purchases Details Table</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Purchase ID</th>
              <th>Product ID</th>
              <th>QTY</th>
              <th>Unit Price</th>
              <th>Discount</th>
              <th>Created at</th>
              <th>Updated at</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
                   <!-- Example row, PHP দিয়ে লুপ করবে -->
            
           <?php
        $html = "";
        foreach ($data as $row) {
            $html .= "
                <tr>
                <th scope='row'>{$row['id']}</th>
                <td>{$row['purchase_id']}</td>
                <td>{$row['product_id']}</td>
                <td>{$row['qty']}</td>
                <td>{$row['unit_price']}</td>
                <td>{$row['discount']}</td>
                <td>{$row['created_at']}</td>
                <td>{$row['updated_at']}</td>
                <td>
                 
                <a class=\"btn btn-info\" href='$base_url/product/edit/{$row['id']}'>Edit</a>
                <a class=\"btn btn-danger\" href='$base_url/product/delete/{$row['id']}'>Delete</a>
                
                </td>
                
                </tr>
          ";
        }

        echo $html;
        ?> 

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

</body>