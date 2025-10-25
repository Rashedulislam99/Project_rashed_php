<?php
// Debug (optional):
// print_r($suppliers);
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Update Supplier</h4>
                </div>
                <div class="card-body">
                    <form action="<?= $base_url ?>/suppliers/update" method="POST">
                        <!-- Hidden ID Field -->
                        <input type="hidden" name="id" value="<?= htmlspecialchars($suppliers->id) ?>">

                        <!-- Supplier Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Supplier Name</label>
                            <input value="<?= htmlspecialchars($suppliers->name) ?>" 
                                   type="text" name="name" class="form-control" id="name" 
                                   placeholder="Enter supplier name" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input value="<?= htmlspecialchars($suppliers->email) ?>" 
                                   type="email" name="email" class="form-control" id="email" 
                                   placeholder="Enter email address">
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input value="<?= htmlspecialchars($suppliers->phone) ?>" 
                                   type="text" name="phone" class="form-control" id="phone" 
                                   placeholder="Enter phone number">
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" class="form-control" id="address" rows="3" 
                                      placeholder="Enter supplier address"><?= htmlspecialchars($suppliers->address) ?></textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" name="update" value="update" class="btn btn-success">
                                <i class="bi bi-check-circle me-1"></i> Update
                            </button>
                            <a href="<?= $base_url ?>/suppliers" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle me-1"></i> Back to List
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
