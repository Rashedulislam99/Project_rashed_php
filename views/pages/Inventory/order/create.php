<style>
  /* Small visual tweaks */
  body {
    background: #f6f8fb;
    color: #212529;
    padding: 2rem;
  }

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
</head>

<body>
  <div class="container">
    <div class="invoice mx-auto" style="max-width: 900px;">
      <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
          <h3 class="mb-0">Store management system</h3>
          <small class="text-muted">Street address · City · Country</small><br>
          <small class="text-muted">Phone: +88 0123 456 789 · Email: hello@example.com</small>
        </div>
        <div class="text-end">
          <h4 class="mb-0">INVOICE</h4>
          <small class="text-muted">#000<?php
                                        echo Order::get_last_id() + 1;
                                        ?></small><br>
          <small class="text-muted">Issue date: <?= date("d-m-Y") ?> </small>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-sm-6">
          <h6 class="mb-1">Bill To</h6>
          <!-- <input id="billTo" class="form-control form-control-sm" value="Customer Name"> -->
          <?php
          echo Customer::html_select("customer");
          ?>
          <textarea id="Address" class="form-control form-control-sm mt-2 billAddress" rows="2">Customer address line 1
            City, Country</textarea>
        </div>
        <div class="col-sm-6 text-sm-end">
          <h6 class="mb-1">Ship To</h6>
          <input id="shipTo" class="form-control form-control-sm" value="Customer Receiver (optional)">
          <textarea id="shipAddress" class="form-control form-control-sm mt-2 billAddress" rows="2">Shipping address</textarea>
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
              <th style="width: 15%;">Vat</th>
              <th style="width: 15%;">Line Total</th>
              <th style="width: 10%;" class="no-print"> </th>
            </tr>

            <tr class="item-row">
              <td class="align-middle">1</td>
              <td>
                <?php
                echo Product::html_select("product");
                ?>
              </td>
              <td><input id="qty" type="number" min="0" step="1" class="form-control form-control-sm qty" value="1"></td>
              <td><input type="number" min="0" step="0.01" class="form-control form-control-sm unit_price" value="00"></td>
              <td><input id="vat" type="number" min="0" class="form-control form-control-sm vat" value="00"></td>
              <td id="line_total" class="line-total align-middle">00</td>
              <td class="no-print text-end"><button class="btn btn-sm btn-outline-success add-row">Add</button></td>
            </tr>

          </thead>
          <tbody id="items">

          </tbody>
        </table>
      </div>

      <div class="d-flex justify-content-between align-items-center mb-3 no-print">


        <div class="text-end" style="min-width: 300px;">
          <div class="row g-2">
            <div class="col-6 text-muted">Subtotal</div>
            <div class="col-6 text-end fw-semibold" id="subtotal"><?php $subtotal ?></div>

            <!-- <div class="col-6 text-muted">Tax (%)</div>
            <div class="col-6 text-end">
              <input id="taxPercent" type="number" min="0" step="0.01" class="form-control form-control-sm" value="0">
            </div> -->

            <div class="col-6 text-muted">Discount</div>
            <div class="col-6 text-end">
              <input id="discount" type="number" min="0" step="0.01" class="form-control form-control-sm" value="0">
            </div>

            <div class="col-6 text-muted">Shipping</div>
            <div class="col-6 text-end">
              <input id="shipping" type="number" min="0" step="0.01" class="form-control form-control-sm" value="0.00">
            </div>

            <div class="col-6 text-muted">Total</div>
            <div class="col-6 text-end fs-5 fw-bold" id="grandTotal">100.00</div>
          </div>
        </div>
      </div>



      <div class="mb-4">
        <label class="form-label">Notes</label>
        <textarea id="notes" class="form-control" rows="3">Payment due within 7 days.</textarea>
      </div>

      <div class="d-flex justify-content-between align-items-center no-print">
        <div>
          <small class="text-muted">Bank: Your Bank · A/C: 000-000-000 · SWIFT: ABCDXX</small>
        </div>
        <div>
          <button id="confirmOrder" class="btn btn-success">Confirm Order</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS bundle -->




  <script>
    $(function() {

      const cart = new Cart("order");

      //  Customer change event
      $("#customer").on("change", function() {
        let customer_id = $(this).val();
        $.ajax({
          url: "<?= $base_url ?>/api/customer/find",
          type: "GET",
          data: {
            id: customer_id
          },
          success: function(res) {
            let data = JSON.parse(res);
            $(".billAddress").val(data.address);
          },
          error: function(err) {
            console.log(err);
          }
        });
      });

      //  Product change event
      $("#product").on("change", function() {
        let product_id = $(this).val();
        let product_vat = $(this).find("option:selected").data("vat");

        $.ajax({
          url: "<?= $base_url ?>/api/product/find",
          type: "GET",
          data: {
            id: product_id
          },
          success: function(res) {
            let data = JSON.parse(res);
            $(".unit_price").val(data.price);
            $(".vat").val(data.price * (product_vat / 100));
            $(".line-total").text(data.price);
            $(".qty").val(1);
          },
          error: function(err) {
            console.log(err);
          }
        });
      });

      // Quantity change
      $(".qty").on("change", function() {
        let val = $(this).val();
        let price = $(".unit_price").val();
        $(".line-total").text((price * val).toFixed(2));
      });

      //  Add Row
      $(".add-row").on("click", function() {
        let product_id = parseFloat($("#product").val());
        let product_name = $("#product").find("option:selected").text();
        let qty = Number($(".qty").val());
        let price = parseFloat($(".unit_price").val());
        let vat = parseFloat($(".vat").val());
       // let lineTotal = parseFloat($(".line_total").val());
      //  let lineTotal = (price * qty) + totalVat;
        let data = {
          id: product_id,
          qty,
          product_name,
          price,
          vat
        };

        cart.AddItem(data);
        printCart();
      });

      //  Initial print
      printCart();

      //  Print Cart Function
      function printCart() {
        let data = cart.getData();
        console.log(data);

        let html = "";
        let subtotal = 0;

        data.forEach((element, i) => {
          let qty = parseFloat(element.qty);
          let price = parseFloat(element.price);
          let vat = parseFloat(element.vat);
          let totalVat = (vat * qty);
          let lineTotal = (price * qty) + totalVat;

          subtotal += lineTotal;



          html += `
          <tr class="item-row">
            <td class="align-middle">${i + 1}</td>
            <td><input type="text" class="form-control form-control-sm desc" value="${element.product_name}"></td>
            <td><input type="number" min="0" step="1" class="form-control form-control-sm " value="${qty}"></td>
            <td><input type="number" min="0" step="0.01" class="form-control form-control-sm " value="${price}"></td>
            <td><input type="number" min="0" step="0.01" class="form-control form-control-sm " value="${vat}"></td>
            <td class="align-middle">${lineTotal.toFixed(2)}</td>
            <td class="no-print text-end"><button class="btn btn-sm btn-outline-danger remove-row" data-id="${element.id}">Remove</button></td>
          </tr>
        `;
        });

        $("#items").html(html);
        $("#subtotal").text(subtotal.toFixed(2));

        updateGrandTotal();
      }

      //  Remove Row
      $(document).on("click", ".remove-row", function() {
        let id = $(this).data("id");
        cart.delItem(id);
        printCart();
      });

      //  Discount & Shipping input change
      $(document).on("input", "#discount, #shipping", function() {
        updateGrandTotal();
      });

      //  Update Grand Total Function
      function updateGrandTotal() {
        let subtotal = parseFloat($("#subtotal").text()) || 0;
        let discount = parseFloat($("#discount").val()) || 0;
        let shipping = parseFloat($("#shipping").val()) || 0;

        let grandTotal = (subtotal + shipping) - discount;
        $("#grandTotal").text(grandTotal.toFixed(2));
      }

      $("#confirmOrder").on("click", function(e) {
        e.preventDefault();

        let customer_id = parseFloat($("#customer").val());
        let shipping_address = $("#shipAddress").val()
        let order_total = parseFloat($("#grandTotal").text());
        let discount = parseFloat($("#discount").val());
        let vat = parseFloat($("#vat").val());
        // let unit_price =parseFloat($(".unit_price").val()); 
        let qty = parseFloat($("#qty").val());
        let remark = $("#notes").val()
        let products = cart.getData();


        let data = {
          customer_id,
          shipping_address,
          order_total,
          discount,
          vat,
          // unit_price,
          qty,
          remark,
          products
        }
        console.log(data);

        $.ajax({
          url: "<?= $base_url ?>/api/order/order_save",
          type: "GET",
          data: {
            data: data
          },
          success: function(res) {

            console.log(res);

            cart.clearItem();
            printCart();
            location.reload()
          },
          error: function(err) {
            console.log(err);
          }
        })




      })





    });
  </script>