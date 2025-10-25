

 

<div class="container my-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Supplier List</h3>

    <!-- Search Form -->
    <form class="d-flex" method="post" action="<?= $base_url?>/suppliers/index">
      <input type="text" name="search" class="form-control me-2" placeholder="Find Supplier...">
      <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Add Supplier Button -->
    <a href="<?= $base_url?>/suppliers/create" class="btn btn-success" type="button" id="showAddFormBtn">
      + Add Supplier
</a>
  </div>

  <!-- Add Supplier Form (Hidden by default) -->
  <div id="addSupplierForm" class="card mb-4" style="display:none;">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
      <span>Add New Supplier</span>
      <button type="button" class="btn-close btn-close-white" id="closeAddFormBtn"></button>
    </div>
    <div class="card-body">
      <form method="POST" action="<?= $base_url ?>/suppliers/store">
        <div class="row g-3">
          <div class="col-md-6">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter supplier name" required>
          </div>
          <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter supplier email">
          </div>
          <div class="col-md-6">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter supplier phone">
          </div>
          <div class="col-md-6">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" id="address" class="form-control" rows="2" placeholder="Enter supplier address"></textarea>
          </div>
        </div>
        <div class="text-end mt-3">
          <button type="submit" class="btn btn-success">Save Supplier</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Supplier Table -->
  <table class="table table-bordered table-striped text-center align-middle">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if (!empty($suppliers)) {
          foreach ($suppliers as $value) {
            echo "
              <tr>
                <td>{$value->id}</td>
                <td>{$value->name}</td>
                <td>{$value->email}</td>
                <td>{$value->phone}</td>
                <td>{$value->address}</td>
                <td>{$value->created_at}</td>
                <td>{$value->updated_at}</td>
                <td class='btn-group'>
                  <a class='btn btn-sm btn-info' href='$base_url/suppliers/edit/{$value->id}'>Edit</a>
                  <a class='btn btn-sm btn-danger' href='$base_url/suppliers/delete/{$value->id}' 
                     onclick=\"return confirm('Are you sure you want to delete this supplier?')\">Delete</a>
                </td>
              </tr>
            ";
          }
        } else {
          echo "<tr><td colspan='8' class='text-muted'>No suppliers found.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<!-- Show/Hide Form Script -->
<script>
  const showBtn = document.getElementById('showAddFormBtn');
  const closeBtn = document.getElementById('closeAddFormBtn');
  const formDiv = document.getElementById('addSupplierForm');

  showBtn.addEventListener('click', () => {
    formDiv.style.display = 'block';
    showBtn.style.display = 'none';
  });

  closeBtn.addEventListener('click', () => {
    formDiv.style.display = 'none';
    showBtn.style.display = 'inline-block';
  });
</script>
