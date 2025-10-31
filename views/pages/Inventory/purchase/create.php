


<style>
  body {
    background: linear-gradient(135deg, #f9f9ff, #e9f3ff);
    font-family: "Poppins", sans-serif;
    color: #222;
    padding: 2rem;
  }

  .invoice {
    background: #ffffff;
    border-radius: 1rem;
    padding: 2rem;
    border: 2px solid #edf1f7;
  }

  h3 {
    font-weight: 600;
    color: #0077b6;
    border-bottom: 3px solid #00b4d8;
    display: inline-block;
    padding-bottom: 4px;
  }

  .form-control,
  .form-select {
    border: 1px solid #cbd5e1;
    border-radius: 0.6rem;
    background: #f8fafc;
    transition: 0.2s;
  }

  .form-control:focus,
  .form-select:focus {
    border-color: #00b4d8;
    background: #ffffff;
  }

  .table {
    border-radius: 0.5rem;
    overflow: hidden;
  }

  .table thead {
    background: linear-gradient(90deg, #00b4d8, #48cae4);
    color: white;
  }

  .table thead th {
    border: none;
    font-weight: 500;
  }

  .table tbody tr:nth-child(odd) {
    background: #f1f9ff;
  }

  .table tbody tr:nth-child(even) {
    background: #ffffff;
  }

  .table tbody tr:hover {
    background: #caf0f8;
  }

  .btn {
    border: none;
    border-radius: 0.6rem;
    font-weight: 500;
    padding: 0.5rem 1rem;
    transition: 0.3s;
  }

  .btn-success {
    background: linear-gradient(90deg, #38b000, #70e000);
    color: white;
  }

  .btn-success:hover {
    background: linear-gradient(90deg, #2d9f00, #57d100);
  }

  .btn-outline-success {
    border: 2px solid #38b000;
    color: #38b000;
    background: transparent;
  }

  .btn-outline-success:hover {
    background: #38b000;
    color: white;
  }

  .btn-outline-danger {
    border: 2px solid #e63946;
    color: #e63946;
    background: transparent;
  }

  .btn-outline-danger:hover {
    background: #e63946;
    color: white;
  }

  #grandTotal {
    font-size: 1.6rem;
    font-weight: 700;
    color: #007f5f;
  }

  textarea {
    border-radius: 0.6rem;
    border: 1px solid #cbd5e1;
    background: #f8fafc;
  }

  textarea:focus {
    border-color: #00b4d8;
    background: #ffffff;
  }

  /* Print style */
  @media print {
    .no-print {
      display: none !important;
    }
    body {
      background: #fff;
      padding: 0;
    }
    .invoice {
      border: none;
      border-radius: 0;
    }
  }
</style>





</head>

<body>
  <div class="container">
    <div class="invoice mx-auto" style="max-width: 900px;">
      <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
          <h3 class="mb-0">Add purchases</h3>
        </div>
        
      </div>

      <div class="row mb-4">
        <div class="col-sm-4">
          <h6 class="mb-1">Suppliers</h6>
           <!-- <input id="billTo" class="form-control form-control-sm" value="Customer Name">  -->
          <?php
          echo Supplier::html_select("supplier");
          ?>
          <input id="Address" class="form-control form-control-sm mt-2 billAddress" rows="2"></input>
        </div>


		<div class="col-sm-4">
          <h6 class="mb-1">warehouse</h6>
           <!-- <input id="billTo" class="form-control form-control-sm" value="Customer Name">  -->
          <?php
          echo Warehouse::html_select("warehouse");
          ?>
          
        </div>



        <div class="col-sm-4">
          <h6 class="mb-1">Order Date</h6>
           
      
      <input type="date" id="purchase_date" name="purchase_date" class="form-control" value="<?= date('Y-m-d') ?>">
    </div>
         
        
    

      <div class="table-responsive mb-3 no-break">
        <table class="table align-middle">
          <thead class="table-light">
            <tr>
              <th style="width: 5%;">#</th>
              <th style="width: 45%;">Product List</th>
              <th style="width: 10%;">Qty</th>
              <th style="width: 15%;">Unit Price</th>
              <th style="width: 15%;">Tax</th>
              <th style="width: 15%;">Line Total</th>
              <th style="width: 15%;">Action</th>
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
      $("#supplier").on("change", function() {
		
        let supplier_id = $(this).val();
        $.ajax({
          url: "<?= $base_url ?>/api/supplier/find",
          type: "GET",
          data: {
            id: supplier_id
          },
          success: function(res) {
			// console.log("aaaaa",res);
            let data = JSON.parse(res);
            $("#Address").val(data.supplier.address);
          },
          error: function(err) {
            console.log(err);
          }
        });
      });

      //  Product change event
      $("#product").on("change", function() {
        let product_id = $(this).val();
        let product_name = $(this).find("option:selected").data("name");

        $.ajax({
          url: "<?= $base_url ?>/api/product/find",
          type: "GET",
          data: {
            id: product_id
          },
          success: function(res) {
			//  console.log("aaaaa",res);
            let data = JSON.parse(res);
            $(".unit_price").val(data.purchase_price);
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
      $(document).on("change", ".qty, .Unit_price, #vat, .discount", function() {
       let qty = parseFloat($(".qty").val());
      let price = parseFloat($(".unit_price").val());
      let vat = parseFloat($(".vat").val());
      
      let subtotal = price * qty ;
      let vatAmount = subtotal * (vat / 100);
      

      $(".line-total").text(Math.round(subtotal + vatAmount));
      });

     


      $(document).on("click", ".qty, .Unit_price, .vat, .discount", function() {
       let qty = parseFloat($(".qty").val());
      let price = parseFloat($(".unit_price").val());
      let vat = parseFloat($(".vat").val());
      
      let subtotal = price * qty;
      let vatAmount = subtotal * (vat / 100);
      

      $(".line-total").text(Math.round(subtotal + vatAmount));
      });

      //  Add Row
      $(".add-row").on("click", function() {
        let product_id = parseFloat($("#product").val());
        let product_name = $("#product").find("option:selected").text();
        let qty = Number($(".qty").val());
        let price = parseFloat($(".unit_price").val());
        let vat = parseFloat($(".vat").val());

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

      $("#confirmOrder").on("click", function() {
        let warehouse = parseFloat($("#warehouse").val());
        let supplier_id = parseFloat($("#supplier").val());
        let discount = parseFloat($("#discount").val());
        let net_total = parseFloat($("#grandTotal").text());
        let remark = $("#notes").val()
        let products = cart.getData();


        let data = {
          supplier_id,
          discount,
          net_total,
          products,
          remark,
          warehouse
         
        }
        console.log(data);

        $.ajax({
          url: "<?= $base_url ?>/api/purchase/purchase_save",
          type: "GET",
          data: {
            data: data
          },
          success: function(res) {
            let data= JSON.parse(res)
            console.log(res);
             if(data.success){
               cart.clearItem();
               printCart();
               location.reload();
             }
        
           // location.reload()
          },
          error: function(err) {
            console.log(err);
          }
        })




      })





    });
  </script>