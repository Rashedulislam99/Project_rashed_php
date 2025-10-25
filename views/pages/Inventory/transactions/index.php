

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">transactions List</h3>

        <!-- Search Form -->
        <form class="d-flex" method="post" action="<?= $base_url ?>/transactions/index">
            <input type="text" name="search" class="form-control me-2" placeholder="Find transactions...">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Add transactions Button -->
        <a href="<?= $base_url ?>/transactions/create" class="btn btn-success" type="button" id="showAddFormBtn">
            + Add transactions
        </a>
    </div>

    <!-- Add transactions Form (Hidden by default) -->
    <div id="addtransactionsForm" class="card mb-4" style="display:none;">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span>Add New transactions</span>
            <button type="button" class="btn-close btn-close-white" id="closeAddFormBtn"></button>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= $base_url ?>/transactions/store">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter transactions name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="factor" class="form-label">Factor</label>
                        <input type="text" name="factor" id="factor" class="form-control" placeholder="Enter factor value">
                    </div>
                    <div class="col-md-6">
                        <label for="warehouse_id" class="form-label">Warehouse ID</label>
                        <input type="number" name="warehouse_id" id="warehouse_id" class="form-control" placeholder="Enter warehouse ID">
                    </div>
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success">Save transactions</button>
                </div>
            </form>
        </div>
    </div>

    <!-- transactions Table -->
    <table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Factor</th>
                <th>Warehouse ID</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
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
                        <td class='btn-group'>
                            <a class='btn btn-sm btn-info' href='$base_url/transactions/edit/{$value->id}'>Edit</a>
                            <a class='btn btn-sm btn-danger' href='$base_url/transactions/delete/{$value->id}' 
                               onclick=\"return confirm('Are you sure you want to delete this transactions?')\">Delete</a>
                        </td>
                    </tr>
                    ";
                }
            } else {
                echo "<tr><td colspan='7' class='text-muted'>No transactions found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Show/Hide Form Script -->
<script>
const showBtn = document.getElementById('showAddFormBtn');
const closeBtn = document.getElementById('closeAddFormBtn');
const formDiv = document.getElementById('addtransactionsForm');

showBtn.addEventListener('click', () => {
    formDiv.style.display = 'block';
    showBtn.style.display = 'none';
});

closeBtn.addEventListener('click', () => {
    formDiv.style.display = 'none';
    showBtn.style.display = 'inline-block';
});
</script>
