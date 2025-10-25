<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Transaction Table</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">-->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet"> 

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .table-card {
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      background: #fff;
    }
    .table thead {
      background: linear-gradient(90deg, #0d6efd, #0dcaf0);
      color: white;
    }
    .table-hover tbody tr:hover {
      background-color: #f1f5ff;
      transition: 0.3s;
    }
    .table th, .table td {
      vertical-align: middle;
      text-align: center;
    }
  </style>
</head>
<body>

<div class="container my-5">
  <div class="table-card p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="mb-0 text-primary"><i class="bi bi-box-seam me-2"></i>Transaction Records</h4>
      <a href="<?= $base_url?>/stock/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle me-1"></i> Add New</a>
    </div>

    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <!-- <th>Transaction Type</th> -->
            <!-- <th>Remark</th> -->
            <th>Updated At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $stocks= Stock::getAllStocks();
         // print_r($stocks);

          foreach ($stocks as $key => $value) {
            // $ttn= TransactionType::find($value->transaction_type_id)->name;
            echo "
            
            <tr>
            <td>$value->id</td>
            <td>$value->product</td>
            <td>$value->quantity</td>
        
            <td>$value->updated_at</td>

            
            <td>
              <a href='$base_url/stock/product_report/$value->product_id' class=\"btn btn-sm btn-outline-primary\"><i class=\"bi bi-pencil\"></i></a>
              <a href='$base_url/stock/show/$value->id' class=\"btn btn-sm btn-outline-danger\"><i class=\"bi bi-eye\"></i></a>
              <a href='$base_url/stock/confirm/$value->id' class=\"btn btn-sm btn-outline-danger\"><i class=\"bi bi-trash\"></i></a>
            </td>
          </tr>
            
            
            
            ";
          }
          ?>
          
         
        </tbody>
      </table>
    </div>
  </div>
</div>


<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->
