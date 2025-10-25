<?php
//  var_dump($data);
//  var_dump($product);
//  var_dump($bag);
?>



<body class="bg-light">

<div class="container py-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Warehouse Table</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Address</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Example row, PHP দিয়ে লুপ করে এখানে ডেটা বসাবে -->
            
            <?php
        $html = "";
        foreach ($data as $row) {
            $html .= "
                <tr>
                <th scope='row'>{$row['id']}</th>
                <td>{$row['name']}</td>
                 <td>{$row['phone']}</td>
                <td>{$row['email']}</td>
                <td>{$row['address']}</td>
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