<?php
// Get filter dates from the form
$start_date = $_GET['start_date'] ?? null;
$end_date   = $_GET['end_date'] ?? null;

// Call filtered function with dates
$stocks = Stock::getFilteredStocks($start_date, $end_date);

// For debugging
// echo "<pre>"; print_r($stocks);
?>




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

  .table th,
  .table td {
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
        <a href="<?= $base_url ?>/stock/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle me-1"></i> Add New</a>
      </div>
      <!-- Filter Form -->
      <form method="GET" class="row g-3 mb-3">
        <div class="col-auto">
          <label for="start_date" class="form-label">Start Date</label>
          <input type="date" id="start_date" name="start_date" class="form-control" value="<?= $_GET['start_date'] ?? '' ?>">
        </div>
        <div class="col-auto">
          <label for="end_date" class="form-label">End Date</label>
          <input type="date" id="end_date" name="end_date" class="form-control" value="<?= $_GET['end_date'] ?? '' ?>">
        </div>
        <div class="col-auto align-self-end">
          <button type="submit" class="btn btn-primary">Filter</button>
          <a href="<?= $base_url ?>/stock" class="btn btn-secondary">Reset</a>
        </div>
      </form>


      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Product Name</th>
              <th>Quantity</th>
              <!-- <th>Transaction Type</th> -->
              <!-- <th>Remark</th> -->

              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <tbody>
            <?php
            foreach ($stocks as $key => $value) {
              echo "
    <tr>
        <td>$value->id</td>
        <td>$value->product</td>
        <td>$value->quantity</td>
        <td>
          <a href='$base_url/stock/product_report/$value->id' class=\"btn btn-sm btn-outline-primary\"><i class=\"bi bi-pencil\"></i></a>
          <a href='$base_url/stock/show/$value->id' class=\"btn btn-sm btn-outline-danger\"><i class=\"bi bi-eye\"></i></a>
          <a href='$base_url/stock/confirm/$value->id' class=\"btn btn-sm btn-outline-danger\"><i class=\"bi bi-trash\"></i></a>
        </td>
    </tr>
    ";
            }
            ?>
          </tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>


  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->