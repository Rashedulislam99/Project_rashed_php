<?php
// Debug (optional):
// print_r($stocks);
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Update Stock</h4>
                </div>
                <div class="card-body">
                    <form action="<?= $base_url ?>/stocks/update" method="POST">
                        <!-- Hidden ID Field -->
                        <input type="hidden" name="id" value="<?= htmlspecialchars($stocks->id) ?>">

                        <!-- Product ID -->
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Product ID</label>
                            <input value="<?= htmlspecialchars($stocks->product_id) ?>" 
                                   type="number" name="product_id" class="form-control" id="product_id" 
                                   placeholder="Enter product ID" required>
                        </div>

                        <!-- Quantity -->
                        <div class="mb-3">
                            <label for="qty" class="form-label">Quantity</label>
                            <input value="<?= htmlspecialchars($stocks->qty) ?>" 
                                   type="number" name="qty" class="form-control" id="qty" 
                                   placeholder="Enter quantity" required>
                        </div>

                        <!-- Date -->
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input value="<?= htmlspecialchars($stocks->date) ?>" 
                                   type="datetime-local" name="date" class="form-control" id="date" 
                                   required>
                        </div>

                        <!-- Transaction ID -->
                        <div class="mb-3">
                            <label for="transaction_id" class="form-label">Transaction ID</label>
                            <input value="<?= htmlspecialchars($stocks->transaction_id) ?>" 
                                   type="number" name="transaction_id" class="form-control" id="transaction_id" 
                                   placeholder="Enter transaction ID">
                        </div>

                        <!-- Warehouse ID -->
                        <div class="mb-3">
                            <label for="warehouse_id" class="form-label">Warehouse ID</label>
                            <input value="<?= htmlspecialchars($stocks->warehouse_id) ?>" 
                                   type="number" name="warehouse_id" class="form-control" id="warehouse_id" 
                                   placeholder="Enter warehouse ID" required>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" name="update" value="update" class="btn btn-success">
                                <i class="bi bi-check-circle me-1"></i> Update
                            </button>
                            <a href="<?= $base_url ?>/stocks" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle me-1"></i> Back to List
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
