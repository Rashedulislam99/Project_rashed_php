<style>
    /* Small visual tweaks */
    /* body {
        background: #f6f8fb;
        color: #212529;
        padding: 2rem;
    } */

    .invoice {
        background: #fff;
        padding: 2rem;
        border-radius: .5rem;
        box-shadow: 0 6px 18px rgba(0, 0, 0, .06);
    }

    .table thead th {
        border-bottom: 2px solid #e9ecef;
    }

    .no-break {
        page-break-inside: avoid;
    }

    /* Print styles: hide controls that are not part of invoice */
    @media print {
        body {
            background: #fff;
            padding: 0;
        }

        .no-print {
            display: none !important;
        }

        .invoice {
            box-shadow: none;
            border: none;
            margin: 0;
            border-radius: 0;
        }
    }

    /* Make small inputs look nicer in table */
    .table input[type="number"],
    .table input[type="text"] {
        width: 100%;
        min-width: 0;
        box-shadow: none;
        border: none;
        background: transparent;
        padding: 0.25rem 0;
    }

    .table input:focus {
        outline: none;
    }
</style>

<div class="row">

    <div class="invoice mx-auto " style="max-width: 900px;">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h3 class="mb-0">My SMS</h3>
                <small class="text-muted">25/10, Munshibari Road, Zigatola, Dhaka</small><br>
                <small class="text-muted">Phone: +88 01922 745 118 · Email: mnnadeembd@gmail.com</small>
            </div>
            <div class="text-end">
                <h4 class="mb-0">INVOICE</h4>
                <small class="text-muted"> #000<?php echo $order->id; ?> </small><br>
                <small class="text-muted">Issue: <?php echo date("d-m-Y"); ?></small>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-6">
                <h6 class="mb-1">Bill To</h6>
                <?php
                $customer =  Customer::find($order->customer_id);

                ?>
                <input id="billTo" class="form-control form-control-sm" value="<?php echo $customer->name ?>">
                <textarea id="billAddress" class="form-control form-control-sm mt-2" rows="2"><?php echo $customer->address ?></textarea>
            </div>
            <div class="col-sm-6 text-sm-end">
                <h6 class="mb-1">Ship To</h6>
                <input id="shipTo" class="form-control form-control-sm" value="Customer Receiver (optional)">
                <textarea id="shipAddress" class="form-control form-control-sm mt-2" rows="2"><?php echo Customer::find($order->customer_id)->address ?></textarea>
            </div>
        </div>

        <div class="table-responsive mb-3 no-break">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 45%;">Description</th>
                        <th style="width: 10%;">Qty</th>
                        <th style="width: 15%;">Unit Price</th>
                        <th style="width: 15%;">Line Total</th>
                    </tr>
                </thead>
                <tbody id="items">

 <?php
$order_detials = OrderDetail::find_all_by_order_id($order->id);
$count = 1;
$total = 0;
$nettotal = 0;
$shippingCharge = 100;

foreach ($order_detials as $value) {
    $product_id = is_array($value) ? $value['product_id'] : $value->product_id;
    $product = Product::find($product_id);

    $product_name = $product ? $product->name : 'Unknown Product';
    $qty = is_array($value) ? $value['qty'] : $value->qty;
    $price = is_array($value) ? $value['unit_price'] : $value->price;
    $total_price = $price * $qty;

    echo "
    <tr class=\"item-row\">
        <td class=\"align-middle\">{$count}</td>
        <td><input type=\"text\" class=\"form-control form-control-sm desc\" value=\"{$product_name}\"></td>
        <td><input type=\"number\" min=\"0\" step=\"1\" class=\"form-control form-control-sm qty\" value=\"{$qty}\"></td>
        <td><input type=\"number\" min=\"0\" step=\"0.01\" class=\"form-control form-control-sm price\" value=\"{$price}\"></td>
        <td class=\"line-total align-middle\">{$total_price}</td>
    </tr>";

    $count++;
    $total += $total_price;
    $discount = $total * 0.05;
    $payableAmount = $total - $discount;
    $vat = $payableAmount * 0.05;
    $grand_total = $payableAmount + $vat + $shippingCharge;
}
?>




                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3 no-print">
            <!-- <div>
        <button id="addRow" class="btn btn-sm btn-outline-primary">+ Add item</button>
        <button id="resetRows" class="btn btn-sm btn-outline-secondary">Reset</button>
      </div> -->
            <div class="text-end" style="min-width: 300px;">
                <div class="row g-2">
                    <div class="col-6 text-muted">Subtotal</div>
                    <div class="col-6 text-end fw-semibold" id="subtotal"><?= $total ?></div>


                    <div class="col-6 text-muted">Discount</div>
                    <div class="col-6 text-end">
                        <input id="discount" type="number" min="0" step="0.01" class="form-control form-control-sm" value="<?= $discount ?>">
                    </div>
                    <div class="col-6 text-muted">Payble Amount</div>
                    <div class="col-6 text-end">
                        <input id="discount" type="number" min="0" step="0.01" class="form-control form-control-sm" value="<?= $payableAmount ?>">
                    </div>

                    <div class="col-6 text-muted">Vat (%)</div>
                    <div class="col-6 text-end">
                        <input id="taxPercent" type="number" min="0" step="0.01" class="form-control form-control-sm" value="<?= $vat ?>">
                    </div>


                    <div class="col-6 text-muted">Shipping</div>
                    <div class="col-6 text-end">
                        <input id="shipping" type="number" min="0" step="0.01" class="form-control form-control-sm" value="<?php echo $shippingCharge ?>">
                    </div>

                    <div class="col-6 text-muted">Total</div>
                    <div class="col-6 text-end fs-5 fw-bold" id="grandTotal"><?= $grand_total ?></div>
                </div>
            </div>
        </div>






        <div class="mb-4">
            <label class="form-label">Notes</label>
            <textarea id="notes" class="form-control" rows="3">Payment due within 14 days.</textarea>
        </div>

        <div class="d-flex justify-content-between align-items-center no-print">
            <div>
                <small class="text-muted">Bank: Your Bank · A/C: 000-000-000 · SWIFT: ABCDXX</small>
            </div>
            <div>
                <button onclick="window.print()" class="btn btn-success me-2" id="printBtn">Print / Save PDF</button>
                <button class="btn btn-primary" id="downloadBtn">Download HTML</button>
            </div>
        </div>
    </div>
    
</div>

<!-- Bootstrap JS bundle -->


<script>

</script>