<?php
// Debug (optional):
// print_r($transactions);
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Update Transaction</h4>
                </div>
                <div class="card-body">
                    <form action="<?= $base_url ?>/transactions/update" method="POST">
                        <!-- Hidden ID Field -->
                        <input type="hidden" name="id" value="<?= htmlspecialchars($transactions->id) ?>">

                        <!-- Transaction Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Transaction Name</label>
                            <input value="<?= htmlspecialchars($transactions->name) ?>" 
                                   type="text" name="name" class="form-control" id="name" 
                                   placeholder="Enter transaction name" required>
                        </div>

                        <!-- Factor -->
                        <div class="mb-3">
                            <label for="factor" class="form-label">Factor</label>
                            <input value="<?= htmlspecialchars($transactions->factor) ?>" 
                                   type="text" name="factor" class="form-control" id="factor" 
                                   placeholder="Enter factor value">
                        </div>

                        <!-- Warehouse ID -->
                        <div class="mb-3">
                            <label for="warehouse_id" class="form-label">Warehouse ID</label>
                            <input value="<?= htmlspecialchars($transactions->warehouse_id) ?>" 
                                   type="number" name="warehouse_id" class="form-control" id="warehouse_id" 
                                   placeholder="Enter warehouse ID" required>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" name="update" value="update" class="btn btn-success">
                                <i class="bi bi-check-circle me-1"></i> Update
                            </button>
                            <a href="<?= $base_url ?>/transactions" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle me-1"></i> Back to List
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
