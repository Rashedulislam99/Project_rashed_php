<?php
// Get low stock products
$stocks = Stock::getLowStockProducts(10);
?>
<div class="container my-5">
    <div class="card shadow-sm border-0">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="mb-0 d-flex align-items-center text-danger">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        Low Stock Products
    </h3>
</div>


        <!-- Table -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <!-- Table Header -->
                    <thead class="bg-primary text-white text-uppercase">
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Product Name</th>
                            <th class="text-center">Quantity</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        <?php if (!empty($stocks)) : ?>
                            <?php foreach ($stocks as $value) : ?>
                                <tr>
                                    <td class="text-center"><?= $value->product_id ?></td>
                                    <td><?= htmlspecialchars($value->product) ?></td>
                                    <td class="text-center">
                                        <?php 
                                        $qty = $value->quantity;
                                        if ($qty <= 5) {
                                            echo "<span class='badge bg-danger'>$qty</span>";
                                        } elseif ($qty <= 10) {
                                            echo "<span class='badge bg-warning text-dark'>$qty</span>";
                                        } else {
                                            echo "<span class='badge bg-success'>$qty</span>";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="text-center py-3 text-muted">
                                    All products are sufficiently stocked.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
