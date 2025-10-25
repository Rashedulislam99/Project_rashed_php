<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Add New Warehouse</h4>
        </div>

        <div class="card-body">
            <!-- Add Warehouse Form -->
            <form action="<?= $base_url ?>/warehouses/save" method="POST" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-semibold">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter warehouse name" required>
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label fw-semibold">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone number">
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
                    </div>

                    <div class="col-md-6">
                        <label for="address" class="form-label fw-semibold">Address</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Enter address">
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" name="create" value="create" class="btn btn-primary px-4">
                        <i class="bi bi-plus-circle me-1"></i> Submit
                    </button>
                </div>
            </form>

            <div>
                <a href="<?= $base_url ?>/warehouses" class="text-secondary text-decoration-none">
                    ← Back to list
                </a>
            </div>
        </div>
    </div>

    <!-- Warehouse Table -->
    <div class="card mt-4 shadow-sm border-0">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Warehouse List</h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0 text-center">
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
                            foreach ($warehouses as $warehouse) {
                                echo "
                                <tr>
                                    <td>{$warehouse->id}</td>
                                    <td>{$warehouse->name}</td>
                                    <td>{$warehouse->phone}</td>
                                    <td>{$warehouse->email}</td>
                                    <td>{$warehouse->address}</td>
                                    <td>{$warehouse->created_at}</td>
                                    <td>{$warehouse->updated_at}</td>
                                    <td>
                                        <div class='btn-group' role='group'>
                                            <a class='btn btn-sm btn-info text-white' href='$base_url/warehouses/edit/{$warehouse->id}'>
                                                <i class='bi bi-pencil-square'></i> Edit
                                            </a>
                                            <a class='btn btn-sm btn-danger' href='$base_url/warehouses/delete/{$warehouse->id}'
                                               onclick=\"return confirm('Are you sure you want to delete this warehouse?')\">
                                                <i class='bi bi-trash'></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                ";
                            }
                        } else {
                            echo "<tr><td colspan='8' class='text-muted py-4'>No warehouses found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
