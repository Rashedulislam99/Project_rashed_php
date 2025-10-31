<?php
// Get over stock products
$stocks = Stock::getOverStockProducts(20); // Threshold পরিবর্তন করতে পারো
?>
<div class="container my-5">
    <div class="card shadow-sm border-0">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0 d-flex align-items-center text-success">
                <i class="bi bi-box-seam-fill me-2"></i>
                Over Stock Products
            </h3>
            <!-- ✅ Print Button -->
            <button id="printOverStock" class="btn btn-outline-success">
                <i class="bi bi-printer-fill me-1"></i> Print
            </button>
        </div>

        <!-- Table -->
        <div class="card-body p-0" id="printAreaOver">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <!-- Table Header -->
                    <thead class="bg-success text-white text-uppercase">
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Product Name</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Last Updated</th>
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
                                        if ($qty > 300) {
                                            echo "<span class='badge bg-danger'>$qty</span>";
                                        } elseif ($qty > 200) {
                                            echo "<span class='badge bg-warning text-dark'>$qty</span>";
                                        } else {
                                            echo "<span class='badge bg-success'>$qty</span>";
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center text-muted">
                                        <?= date("d M Y", strtotime($value->last_updated)) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">
                                    No overstock products found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ✅ jQuery & Print Function -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $("#printOverStock").click(function(){
        var printContent = $("#printAreaOver").html();
        var today = new Date().toLocaleDateString();

        var newWindow = window.open('', '', 'width=900,height=700');
        newWindow.document.write('<html><head><title>Over Stock Products</title>');
        newWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">');
        newWindow.document.write('<style>');
        newWindow.document.write(`
            body { padding: 30px; font-family: Arial, sans-serif; }
            .header { text-align: center; margin-bottom: 20px; }
            .header img { height: 60px; margin-bottom: 10px; }
            .footer { text-align: center; font-size: 12px; margin-top: 30px; color: gray; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #dee2e6 !important; padding: 8px; }
            th { background: #198754; color: white; text-transform: uppercase; }
            h4 { margin-bottom: 0; }
        `);
        newWindow.document.write('</style>');
        newWindow.document.write('</head><body>');

        // ✅ Header with Logo + Title + Date
        newWindow.document.write(`
            <div class="header">
                <img src="https://i.ibb.co/N6GmLKh/company-logo.png" alt="Company Logo">
                <h4 class="text-success mb-1">Store Management System</h4>
                <p class="text-muted">Over Stock Report - Date: ${today}</p>
                <hr>
            </div>
        `);

        newWindow.document.write(printContent);

        // ✅ Footer
        newWindow.document.write(`
            <div class="footer">
                <hr>
                <p>Generated by Store Management System | &copy; ${new Date().getFullYear()}</p>
            </div>
        `);

        newWindow.document.write('</body></html>');
        newWindow.document.close();
        newWindow.print();
    });
});
</script>
