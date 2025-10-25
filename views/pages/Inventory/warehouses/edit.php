<?php
// Debug (optional):
 print_r($warehouses);
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Update Warehouse</h4>
                </div>
                <div class="card-body">
                    <form action="<?= $base_url ?>/warehouses/update" method="POST">
                 
                        <!-- Hidden ID Field -->
<input type="hidden" name="id" value="<?= isset($warehouses) ? htmlspecialchars($warehouses->id) : '' ?>">


                                            <!-- Warehouse Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Warehouse Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="<?= isset($warehouses) ? htmlspecialchars($warehouses->name) : '' ?>"
                                placeholder="Enter warehouse name" required>
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control" rows="3"
                                    placeholder="Enter warehouse address"><?= isset($warehouses) ? htmlspecialchars($warehouses->address) : '' ?></textarea>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                value="<?= isset($warehouses) ? htmlspecialchars($warehouses->phone) : '' ?>"
                                placeholder="Enter phone number">
                        </div>


                        <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" 
                        value="<?= isset($warehouses) ? htmlspecialchars($warehouses->email) : '' ?>" 
                        placeholder="Enter email address">
                </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" name="update" value="update" class="btn btn-success">
                                <i class="bi bi-check-circle me-1"></i> Update
                            </button>
                            <a href="<?= $base_url ?>/warehouses" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle me-1"></i> Back to List
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
