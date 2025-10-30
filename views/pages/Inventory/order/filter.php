<div class="container my-4">
  <div class="card shadow p-4">
    <h3 class="mb-3 text-center text-primary">Order Filter (Daily / Monthly / Custom)</h3>

    <form action="<?= $base_url ?>/order/filter" method="post" class="mb-4">
      <div class="row g-3">
        <div class="col-md-3">
          <select name="filter_type" class="form-select" id="filter_type" onchange="toggleDateInputs()">
            <option value="daily">Daily</option>
            <option value="monthly">Monthly</option>
            <option value="custom">Custom Range</option>
          </select>
        </div>
        <div class="col-md-3 custom-date" style="display:none;">
          <input type="date" name="from_date" class="form-control" placeholder="From Date">
        </div>
        <div class="col-md-3 custom-date" style="display:none;">
          <input type="date" name="to_date" class="form-control" placeholder="To Date">
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
      </div>
    </form>

    <?php 
      $orders = isset($orders) ? $orders : (isset($data["orders"]) ? $data["orders"] : []);
      if(count($orders) > 0): 
    ?>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Customer</th>
          <th>Order Date</th>
          <th>Delivery Date</th>
          <th>Order Total</th>
          <th>Paid</th>
          <th>Remark</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($orders as $order): ?>
        <tr>
          <td><?= $order->id ?></td>
          <td><?= $order->customer_name ?></td>
          <td><?= $order->order_date ?></td>
          <td><?= $order->delivery_date ?></td>
          <td><?= $order->order_total ?></td>
          <td><?= $order->paid_amount ?></td>
          <td><?= $order->remark ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php else: ?>
      <p class="text-center text-muted">No orders found for this period.</p>
    <?php endif; ?>
    
  </div>
</div>

<script>
function toggleDateInputs() {
  let type = document.getElementById("filter_type").value;
  let customInputs = document.querySelectorAll(".custom-date");
  customInputs.forEach(el => {
    el.style.display = (type === "custom") ? "block" : "none";
  });
}
</script>
