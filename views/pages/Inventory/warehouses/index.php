<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Warehouses List</h3>

        <!-- Search Form -->
        <form class="d-flex" method="post" action="<?= $base_url ?>/warehouses/index">
            <input type="text" name="search" class="form-control me-2" placeholder="Find warehouses...">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Add Warehouses Button -->
        <button class="btn btn-success" type="button" id="showAddWarehousesBtn">
            + Add Warehouses
        </button>
    </div>

    <!-- Add Warehouses Form (Hidden by default) -->
    <div id="addWarehousesForm" class="card mb-4" style="display:none;">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span>Add New Warehouses</span>
            <button type="button" class="btn-close btn-close-white" id="closeAddWarehousesBtn"></button>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= $base_url ?>/warehouses/store">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter warehouses name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone number">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email address">
                    </div>
                    <div class="col-md-12">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter warehouses address"></textarea>
                    </div>
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success">Save Warehouses</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Warehouses Table -->
    <table class="table table-bordered table-striped text-center align-middle">
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
            <?php
            if (!empty($warehouses)) {
                foreach ($warehouses as $value) {
                    echo "
                    <tr>
                        <td>{$value->id}</td>
                        <td>{$value->name}</td>
                        <td>{$value->phone}</td>
                        <td>{$value->email}</td>
                        <td>{$value->address}</td>
                        <td>{$value->created_at}</td>
                        <td>{$value->updated_at}</td>
                        <td class='btn-group'>
                            <a class='btn btn-sm btn-info' href='$base_url/warehouses/edit/{$value->id}'>Edit</a>
                            <a class='btn btn-sm btn-danger' href='$base_url/warehouses/delete/{$value->id}'
                               onclick=\"return confirm('Are you sure you want to delete this warehouse?')\">Delete</a>
                        </td>
                    </tr>
                    ";
                }
            } else {
                echo "<tr><td colspan='8' class='text-muted'>No warehouses found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Show/Hide Form Script -->
<script>
const showBtn = document.getElementById('showAddWarehousesBtn');
const closeBtn = document.getElementById('closeAddWarehousesBtn');
const formDiv = document.getElementById('addWarehousesForm');

showBtn.addEventListener('click', () => {
    formDiv.style.display = 'block';
    showBtn.style.display = 'none';
});

closeBtn.addEventListener('click', () => {
    formDiv.style.display = 'none';
    showBtn.style.display = 'inline-block';
});
</script>
