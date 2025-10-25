<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Stocks List</h3>

        <!-- Search Form -->
        <form class="d-flex" method="post" action="<?= $base_url ?>/stocks/index">
            <input type="text" name="search" class="form-control me-2" placeholder="Find stock...">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Add Stock Button -->
        <a href="<?= $base_url ?>/stocks/create" class="btn btn-success" type="button" id="showAddFormBtn">
            + Add Stock
        </a>
    </div>

    <!-- Add Stock Form (Hidden by default) -->
    <div id="addstocksForm" class="card mb-4" style="display:none;">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span>Add New Stock</span>
            <button type="button" class="btn-close btn-close-white" id="closeAddFormBtn"></button>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= $base_url ?>/stocks/store">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="product_id" class="form-label">Product ID</label>
                        <input type="number" name="product_id" id="product_id" class="form-control" placeholder="Enter product ID" required>
                    </div>

                    <div class="col-md-6">
                        <label for="qty" class="form-label">Quantity</label>
                        <input type="number" name="qty" id="qty" class="form-control" placeholder="Enter quantity" required>
                    </div>

                    <div class="col-md-6">
                        <label for="date" class="form-label">Date</label>
                        <input type="datetime-local" name="date" id="date" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="transaction_id" class="form-label">Transaction ID</label>
                        <input type="number" name="transaction_id" id="transaction_id" class="form-control" placeholder="Enter transaction ID">
                    </div>

                    <div class="col-md-6">
                        <label for="warehouse_id" class="form-label">Warehouse ID</label>
                        <input type="number" name="warehouse_id" id="warehouse_id" class="form-control" placeholder="Enter warehouse ID" required>
                    </div>
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success">Save Stock</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Stocks Table -->
    <table class="table table-bordered table-striped text-center align-middle">
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
                        <td class='btn-group'>
                            <a class='btn btn-sm btn-info' href='$base_url/stocks/edit/{$value->id}'>Edit</a>
                            <a class='btn btn-sm btn-danger' href='$base_url/stocks/delete/{$value->id}' 
                               onclick=\"return confirm('Are you sure you want to delete this stock?')\">Delete</a>
                        </td>
                    </tr>
                    ";
                }
            } else {
                echo "<tr><td colspan='9' class='text-muted'>No stocks found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Show/Hide Form Script -->
<script>
const showBtn = document.getElementById('showAddFormBtn');
const closeBtn = document.getElementById('closeAddFormBtn');
const formDiv = document.getElementById('addstocksForm');

showBtn.addEventListener('click', () => {
    formDiv.style.display = 'block';
    showBtn.style.display = 'none';
});

closeBtn.addEventListener('click', () => {
    formDiv.style.display = 'none';
    showBtn.style.display = 'inline-block';
});
</script>
