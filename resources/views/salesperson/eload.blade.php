@extends('masterlayout.salespersonlayout')

@section('location')
    E-LOAD
@endsection

@section('content')
    <div id="sales_message"></div>

    <br>

    <div class="container" style="margin-top: 10px">
        <div class="row">
            <div class="col-3">
                <button class="btn btn-yellow" type="button" data-bs-toggle="modal" data-bs-target="#addRegularModal">E-Load Regular Order</button>
            </div>
            <div class="col-3">
                <button class="btn btn-yellow" type="button" data-bs-toggle="modal" data-bs-target="#addPromoModal">E-Load Promo Order</button>
            </div>
        </div>

    </div>

    <!-- Add Regular Modal -->
    <div id="addRegularModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header blue-bg yellow">
                    <h5 class="modal-title">Add Regular Load Order</h5>
                    <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="saveform_errList"></div>
                    <div class="form-group">
                        <label for="exampleSelect2" class="form-label mt-4">Operator</label>
                        <select multiple="" class="form-select" id="exampleSelect2">
                          <option>SMART</option>
                          <option>GLOBE</option>
                          <option>SUN</option>
                          <option>TNT</option>
                          <option>TM</option>
                        </select>
                      </div>

                      <div class="row">
                          <div class="col">
                            <div class="form-group">
                                <label class="form-label mt-4">Price</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" placeholder="0.00" name="regularPrice" id="regularPrice" min="1.00">
                                </div>
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                                <label class="form-label mt-4">Markup</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" placeholder="0.00" name="markUp" id="markUp" min="1.00" readonly>
                                </div>
                            </div>
                          </div>

                      </div>



                </div>

                <div class="modal-footer" style="text-align: right">
                    <button class="btn btn-yellow add_regular" type="button">Add</button>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>
    <!-- End Add Regular Modal -->

    <!-- Add Promo Modal-->
    <div id="addPromoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header blue-bg yellow">
                    <h5 class="modal-title">Add Promo Load Order</h5>
                    <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="saveform_errList"></div>
                    <div class="form-group">
                        <label class="form-label mt-4">Promo Name</label>

                            <input type="text" class="form-control" placeholder="Product Name" name="prodName" id="prodName">
                    </div>


                    <div class="row">
                        <div class="col">
                          <div class="form-group">
                              <label class="form-label mt-4">Price</label>
                              <div class="input-group mb-3">
                                  <input type="number" class="form-control" placeholder="0.00" name="regularPrice" id="regularPrice" min="1.00" readonly>
                              </div>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                              <label class="form-label mt-4">Markup</label>
                              <div class="input-group mb-3">
                                  <input type="number" class="form-control" placeholder="0.00" name="markUp" id="markUp" min="1.00" readonly>
                              </div>
                          </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer" style="text-align: right">
                    <button class="btn btn-yellow add_product" type="button">Add</button>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>

    <!--End of Promo Modal-->

    <script>
        //format should be year/month/date
        var dt = new Date().toLocaleString();
        $(document).ready(function(){

            fetch_data();
            //fetch all records
            function fetch_data(query=''){
                $.ajax({
                    url:"{{ route('admin.search')}}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data){
                        $('#productBody').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }
                });
            }

            $(document).on('keyup','#search',function(){
                var query = $(this).val();
                fetch_data(query);
                console.log(query);
            });
        });


            var subTotals = [];
            var products = [];
            var xy = 0;

        function addToInvoice(ProdName, Price, ProdId){
            var tab = document.getElementById("invoiceTable");
            var rowLength = tab.rows.length;

            quantity = document.getElementById("quantity").value;
            var quantInt = parseInt(quantity);

            var status = true;

            //If object is empty,
            if(products.length == 0){
                products.push({id: ProdId, quantity: quantInt});
                console.log(products);

                var table = document.getElementById("invoiceTable"),
                newRow = table.insertRow(table.length),
                nameCell = newRow.insertCell(0),
                priceCell = newRow.insertCell(1),
                quantityCell = newRow.insertCell(2),
                subTotalCell = newRow.insertCell(3),
                //console.log(ProdId);
                subTotal = Price * quantity;
                subTotals.push(subTotal);



                ftotal = subTotals.reduce(function(a,b){
                    return a + b;
                }, 0);

                document.getElementById("total").value = ftotal.toFixed(2);


                //console.log(products);

                nameCell.innerHTML = ProdName;
                priceCell.innerHTML = Price;
                quantityCell.innerHTML = quantity;
                subTotalCell.innerHTML = subTotal;
            }else{

                for (let i = 0; i < products.length; i++) {
                    if (products[i].id == ProdId) {
                        console.log("Product already there with the ID:"+products[i].id +"Therefore, we just add the quantity.");
                        status = true;
                        products[i].quantity+=quantInt;
                        //console.log(products);

                        var table = document.getElementById("invoiceTable");
                        var totalRows = table.rows.length;
                        console.log("rows:"+ totalRows);
                        for (let index = 1; index < totalRows; index++) {
                            console.log(table.rows[index].cells[2].innerHTML);

                            if(table.rows[index].cells[0].innerHTML == ProdName){

                                console.log("found it!");
                                table.rows[index].cells[2].innerHTML = products[i].quantity;
                                Price = table.rows[index].cells[1].innerHTML;
                                subTotal = Price * products[i].quantity;
                                table.rows[index].cells[3].innerHTML = subTotal;

                                //subTotal = Price * quantity
                                // var subt;
                                // for (let ind = 1; ind < totalRows; ind++) {
                                //     subt += table.rows[index].cells[3].innerHTML;
                                // }
                                // console.log("subt:"+subt);
                                subTotals.splice(index-1, 1, subTotal);
                                // second arg defines how many to delete, so 1 only
                                //subTotals.push(subTotal);

                                console.log(products);
                                console.log(subTotals);

                                ftotal = subTotals.reduce(function(a,b){
                                    return a + b;
                                }, 0);

                                document.getElementById("total").value = ftotal.toFixed(2);
                                break;
                            }else{
                                console.log("nothing there to look for");
                                console.log(table.rows[index].cells[0]);
                            }
                        }

                        break;
                    }else{
                        console.log("Product is unique therefore we add");
                        status = false;
                    }
                }

                if (!status) {
                    products.push({id: ProdId, quantity: quantInt});
                    console.log(products);

                var table = document.getElementById("invoiceTable"),
                newRow = table.insertRow(table.length),
                nameCell = newRow.insertCell(0),
                priceCell = newRow.insertCell(1),
                quantityCell = newRow.insertCell(2),
                subTotalCell = newRow.insertCell(3),
                //console.log(ProdId);
                subTotal = Price * quantity;
                // push SubTotal to arra
                subTotals.push(subTotal);



                ftotal = subTotals.reduce(function(a,b){
                    return a + b;
                }, 0);

                document.getElementById("total").value = ftotal.toFixed(2);


                //console.log(products);

                nameCell.innerHTML = ProdName;
                priceCell.innerHTML = Price;
                quantityCell.innerHTML = quantity;
                subTotalCell.innerHTML = subTotal;
                }

            }
        }

        function reloadInvoice(){
                var table = document.getElementById("invoiceTable");
                var rowCount = table.rows.length;

                for (var x=rowCount-1; x>0; x--) {
                    table.deleteRow(x);
                }
                document.getElementById("total").value = 0.00;
                document.getElementById("cash").value = 0.00;
                document.getElementById("change").value = 0.00;
                document.getElementById("addtransact").reset();

                products = [];
                subTotals = [];
            }

        function calculateChange(){
            cash = document.getElementById("cash").value;
            subTotal = document.getElementById("total").value;

                finalTotal = cash - subTotal;
                document.getElementById("change").value = finalTotal.toFixed(2);
        }

        function storeTransaction(){
            var data = {
            products,
            'PersonInCharge': $('#personInCharge').val(),
            'ModeOfPayment': 'Cash',
            'AmountDue': $('#total').val(),
            'AmountPaid': $('#cash').val()
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "store",
                data: data,
                dataType: "json",
                success: function(response){

                    if(response.status == 400){
                    $('#transactionMessage').html("");
                    $('#transactionMessage').addClass('alert alert-danger');
                    $.each(response.errors, function(key, err_values){
                        $('#transactionMessage').append('<li>'+err_values+'</li>');
                    })
                    }else{
                    $('#saveform_errList').html("");
                    //$('#sales_message').addClass('alert alert-info');
                    //$('#sales_message').text(response.message);


                    Swal.fire(
                        "Success!",
                    ""+response.message+"",
                        "success"
                    ).then(() =>{
                        location.reload();
                    });
                    //console.log(response.log);
                    }
                }
            });
        }

        function storeDebt(){
            var data = {
            products,
            'PersonInCharge': $('#personInCharge').val(),
            'ModeOfPayment': 'Cash',
            'AmountDue': $('#total').val(),
            'AmountPaid': $('#cash').val(),
            'DebtorName': $('#debtName').val(),
            'ContactNumber': $('#debtNum').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "store-debt",
                data: data,
                dataType: "json",
                success: function(response){

                    if(response.status == 400){
                    $('#debt_errList').html("");
                    $('#debt_errList').addClass('alert alert-danger');
                    $.each(response.errors, function(key, err_values){
                        $('#debt_errList').append('<li>'+err_values+'</li>');
                    })
                    }else{
                    $('#debt_errList').html("");
                    //$('#sales_message').addClass('alert alert-info');
                    //$('#sales_message').text(response.message);
                    $('#addDebtorModal').modal('hide');

                    Swal.fire(
                        "Success!",
                        ""+response.message+"",
                        "success"
                    ).then(() =>{
                        location.reload();
                    });
                    //console.log(response.log);
                    }
                }
            });
        }

        $(document).on('click', '.storeTransaction', function(e){
            e.preventDefault();
            var cash = parseInt($('#cash').val());
            var total = parseInt($('#total').val());

            if (cash == 0 || cash == null || cash < total) {
                $('#addDebtorModal').modal('show');
            } else {
                storeTransaction();
            }
        });

        $(document).on('click', '.add_debt', function(e){
            e.preventDefault();
            storeDebt();

        });

    </script>
@endsection
