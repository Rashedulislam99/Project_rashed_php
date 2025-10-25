

<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Add New Transaction</h4>
        </div>

        <div class="card-body">
            <!-- Add Form -->
            <form action="<?= $base_url ?>/transactions/save" method="POST" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-semibold">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter transaction name" required>
                    </div>

                    <div class="col-md-6">
                        <label for="factor" class="form-label fw-semibold">Factor</label>
                        <input type="text" name="factor" id="factor" class="form-control" placeholder="Enter factor">
                    </div>

                    <div class="col-md-6">
                        <label for="warehouse_id" class="form-label fw-semibold">Warehouse ID</label>
                        <input type="text" name="warehouse_id" id="warehouse_id" class="form-control" placeholder="Enter warehouse ID">
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" name="create" value="create" class="btn btn-primary px-4">
                        <i class="bi bi-plus-circle me-1"></i> Submit
                    </button>
                </div>
            </form>

            <div>
                <a href="<?= $base_url ?>/transactions" class="text-secondary text-decoration-none">
                    ← Back to list
                </a>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card mt-4 shadow-sm border-0">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Transaction List</h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0 text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Factor</th>
                            <th>Warehouse Id</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // ধরো $transactions নামে ডাটা আসছে
                        if (!empty($transactions)) {
                            foreach ($transactions as $value) {
                                echo "
                                <tr>
                                    <td>{$value->id}</td>
                                    <td>{$value->name}</td>
                                    <td>{$value->factor}</td>
                                    <td>{$value->warehouse_id}</td>
                                    <td>{$value->created_at}</td>
                                    <td>{$value->updated_at}</td>
                                    <td>
                                        <div class='btn-group' role='group'>
                                            <a class='btn btn-sm btn-info text-white' href='$base_url/transactions/edit/{$value->id}'>
                                                <i class='bi bi-pencil-square'></i> Edit
                                            </a>
                                            <a class='btn btn-sm btn-danger' href='$base_url/transactions/delete/{$value->id}'
                                               onclick=\"return confirm('Are you sure you want to delete this transaction?')\">
                                                <i class='bi bi-trash'></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                ";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-muted py-4'>No transactions found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons (optional but nice) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
