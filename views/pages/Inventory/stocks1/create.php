

<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Add New Stock</h4>
        </div>

        <div class="card-body">
            <!-- Add Form -->
            <form action="<?= $base_url ?>/stocks/save" method="POST" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="product_id" class="form-label fw-semibold">Product ID</label>
                        <input type="text" name="product_id" id="product_id" class="form-control" placeholder="Enter product ID" required>
                    </div>

                    <div class="col-md-6">
                        <label for="qty" class="form-label fw-semibold">Quantity</label>
                        <input type="number" name="qty" id="qty" class="form-control" placeholder="Enter quantity" required>
                    </div>

                    <div class="col-md-6">
                        <label for="date" class="form-label fw-semibold">Date</label>
                        <input type="datetime-local" name="date" id="date" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="transaction_id" class="form-label fw-semibold">Transaction ID</label>
                        <input type="text" name="transaction_id" id="transaction_id" class="form-control" placeholder="Enter transaction ID">
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
                <a href="<?= $base_url ?>/stocks" class="text-secondary text-decoration-none">
                    ← Back to list
                </a>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card mt-4 shadow-sm border-0">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Stock List</h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0 text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Product ID</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Transaction ID</th>
                            <th>Warehouse ID</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // ধরো $stocks নামে ডাটা আসছে
                        if (!empty($stocks)) {
                            foreach ($stocks as $value) {
                                echo "
                                <tr>
                                    <td>{$value->id}</td>
                                    <td>{$value->product_id}</td>
                                    <td>{$value->qty}</td>
                                    <td>{$value->date}</td>
                                    <td>{$value->transaction_id}</td>
                                    <td>{$value->warehouse_id}</td>
                                    <td>{$value->created_at}</td>
                                    <td>{$value->updated_at}</td>
                                    <td>
                                        <div class='btn-group' role='group'>
                                            <a class='btn btn-sm btn-info text-white' href='$base_url/stocks/edit/{$value->id}'>
                                                <i class='bi bi-pencil-square'></i> Edit
                                            </a>
                                            <a class='btn btn-sm btn-danger' href='$base_url/stocks/delete/{$value->id}'
                                               onclick=\"return confirm('Are you sure you want to delete this stock record?')\">
                                                <i class='bi bi-trash'></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                ";
                            }
                        } else {
                            echo "<tr><td colspan='9' class='text-muted py-4'>No stock records found.</td></tr>";
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
