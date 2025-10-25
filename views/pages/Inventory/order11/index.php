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
      <h4 class="mb-0">Order List</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>CustomerID</th>
              <th>Order Code</th>
              <th>Sub total</th>
              <th>Discount amount</th>
              <th>Net total</th>
              <th>Date</th>
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
                <td>{$row['customer_id']}</td>
                <td>{$row['order_code']}</td>
                <td>{$row['sub_total']}</td>
                <td>{$row['discount_amount']}</td>
                <td>{$row['net_total']}</td>
                <td>{$row['date']}</td>
                <td>{$row['created_at']}</td>
                <td>{$row['updated_at']}</td>
                <td>
                 
                <a class=\"btn btn-info\" href='$base_url/order/edit/{$row['id']}'>Edit</a>
                <a class=\"btn btn-danger\" href='$base_url/order/delete/{$row['id']}'>Delete</a>
                
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