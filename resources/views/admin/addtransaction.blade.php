@extends('masterlayout.adminlayout')

@section('location')
    TRANSACTIONS
@endsection


@section('content')
    <div id="sales_message"></div>
    <!-- Add Debtor Modal -->
    <div id="addDebtorModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header blue-bg yellow">
                    <h5 class="modal-title"><i class="fas fa-money-check-alt"></i> &nbsp;&nbsp;Add Debt Record</h5>
                    <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="debt_errList"></div>
                    <p>This transaction has been identified as a debt record.</p>
                    <div class="form-group">
                        <label class="form-label mt-4">Debtor Name</label>

                        <input type="text" class="form-control" placeholder="Enter Debtor Name" name="debtName"
                            id="debtName" required>
                    </div>

                    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example"
                        tabindex="0">
                        <p>New debtor must not have any running debts.</p>
                        <table class="table table-hover mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">Debtors</th>
                                    <th scope="col">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($debtors as $debtor)


                                    <tr>
                                        <th scope="row">{{ $debtor->Debtor }}</th>
                                        <td>{{ $debtor->Balance }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="modal-footer" style="text-align: right">
                    <button class="btn btn-yellow add_debt" type="button">Submit</button>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>
    <!-- End Add Debtor Modal -->

    <br>

    <div class="container" style="margin-top: 10px">
        <div class="row">
            <div class="col-2">
                <button class="btn btn-yellow" type="button"
                    onclick="document.location='{{ route('admin.transactions') }}'">View Transactions</button>
            </div>
        </div>

    </div>

    <div class="container" style="margin-top: 10px">
        <div class="row">
            <div class="col-6">
                <div class="card text-white mb-3 blue-bg">

                    <div class="card-body yellow">
                        <h3>Product</h3>
                        <hr>

                        <div class="row">
                            <div class="col-6 ">
                                <!-- <form action="{{ route('admin.search') }}" type = "get"> -->
                                <div class="form-group">
                                    <label for="">Search</label>
                                    <div class="input-group mb-3">
                                        <button id="btnSearch" class="input-group-text" type="submit"><i
                                                class="fas fa-search"></i></button>

                                        <input type="text" id="search" name="search" class="form-control"
                                            placeholder="Search">
                                    </div>
                                </div>

                                <!-- </form> -->
                            </div>
                            <div class="col-6">
                                <!-- <form action="{{ route('admin.search') }}" type = "get"> -->
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <div class="input-group mb-3">
                                        <input type="number" id="quantity" name="quantity" class="form-control" min="1"
                                            value="1">
                                    </div>
                                </div>

                                <!-- </form> -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="container">
                                <table class="table table-hover" id="productTable">
                                    <thead>
                                        <tr class="table-yellow" style="text-align: center">
                                            <th scope="col">Name</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productBody">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <!-- <div class="card-footer" style="text-align: right">
                            <button class="btn btn-primary" type="button">Cancel</button>
                            <button  class="btn btn-yellow" type="button" >Add</button>
                        </div> -->

                </div>
            </div>

            <div class="col-6">
                <div class="card text-white mb-3 blue-bg">
                    <form method="POST" action="{{ route('admin.storeTransaction') }}" id="addtransact"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body yellow">
                            <div class="row">
                                <div class="col-4">
                                    <h3 class="yellow">Invoice</h3>
                                </div>
                                <div id="transactionMessage"></div>
                                <div class="col" hidden>
                                    <div class="form-group row">
                                        <label for="personInCharge" class="col col-form-label">Person In Charge</label>
                                        <div class="col">
                                            <input id="personInCharge" class="form-control" readonly
                                                value="{{ Auth::user()->UserID }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="container">
                                    <table id="invoiceTable" class="table table-hover table-light">

                                    <div class="d-flex" id="cash_error"  style="width:100%"></div>

                                        <thead>
                                            <tr class="table yellow">
                                                <th scope="col">Product</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody style="display:block;max-height:500px;overflow-y:auto;">

                                        </tbody>
                                    </table>

                                    <hr>

                                    <div class="row">
                                        
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="total" class="col-sm-7 col-form-label">Total</label>
                                                <div class="col-sm-5">
                                                    <input id="total" class="form-control" placeholder="0.00" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="cash" class="col-sm-7 col-form-label">Cash</label>
                                                <div class="col-sm-5">
                                                    <input name="cash" id="cash" oninput="calculateChange()" type="number"
                                                        min="0" class="form-control" placeholder="0.00" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="change" class="col-sm-7 col-form-label">Change</label>
                                                <div class="col-sm-5">
                                                    <input id="change" class="form-control" placeholder="0.00" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="card-footer" style="text-align: right">
                            <a href="{{ route('admin.addtransaction') }}" class="btn btn-primary">Clear</a>
                            <button type="button" class="btn btn-yellow storeTransaction">Submit</button>
                            &nbsp;
                    </form>
                    <!-- <button onclick="reloadInvoice()" class = "btn btn-primary">Clear</button> -->
                </div>


            </div>
        </div>
    </div>
    </div>

    <script>
        //format should be year/month/date
        var dt = new Date().toLocaleString();
        $(document).ready(function() {

            fetch_data();
            //fetch all records
            function fetch_data(query = '') {
                $.ajax({
                    url: "{{ route('admin.search') }}",
                    method: 'GET',
                    data: {
                        query: query
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#productBody').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }
                });
            }

            $(document).on('keyup', '#search', function() {
                var query = $(this).val();
                fetch_data(query);
                console.log(query);
            });
        });


        var subTotals = [];
        var products = [];
        var xy = 0;

        function addToInvoice(ProdName, Price, ProdId, Stock) {
            var tab = document.getElementById("invoiceTable");
            var rowLength = tab.rows.length;

            
            quantity = document.getElementById("quantity").value;
            var quantInt = parseInt(quantity);
            var intStock = parseInt(Stock);

            var status = true;

            if(Stock < quantInt){
                Swal.fire(
                    'Error!',
                    'Insufficient stock!',
                    'error'
                )
            }else{
                //If object is empty,
                if (products.length == 0) {
                    products.push({
                        id: ProdId,
                        quantity: quantInt
                    });
                    console.log(products);

                    var table = document.getElementById("invoiceTable"),
                        newRow = table.insertRow(table.length),
                        nameCell = newRow.insertCell(0),
                        priceCell = newRow.insertCell(1),
                        quantityCell = newRow.insertCell(2),
                        subTotalCell = newRow.insertCell(3),
                        subTotal = Price * quantity;
                    subTotals.push(subTotal);


                    ftotal = subTotals.reduce(function(a, b) {
                        return a + b;
                    }, 0);

                    document.getElementById("total").value = ftotal.toFixed(2);

                    nameCell.innerHTML = ProdName;
                    priceCell.innerHTML = Price;
                    quantityCell.innerHTML = quantity;
                    subTotalCell.innerHTML = subTotal;
                } else {
                    for (let i = 0; i < products.length; i++) {
                        if (products[i].id == ProdId) {
                            var a = products[i].quantity + quantInt;
                            var qty = products[i].quantity;

                            if(a <= Stock){
                                console.log("Product already there with the ID:" + products[i].id +
                                "Therefore, we just check the quantity if it's possible to add.");
                                
                                status = true;
                                products[i].quantity += quantInt;

                                var table = document.getElementById("invoiceTable");
                                var totalRows = table.rows.length;
                                console.log("rows:" + totalRows);
                                for (let index = 1; index < totalRows; index++) {
                                    console.log(table.rows[index].cells[2].innerHTML);

                                    if (table.rows[index].cells[0].innerHTML == ProdName) {

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
                                        subTotals.splice(index - 1, 1, subTotal);
                                        // second arg defines how many to delete, so 1 only
                                        //subTotals.push(subTotal);

                                        console.log(products);
                                        console.log(subTotals);

                                        ftotal = subTotals.reduce(function(a, b) {
                                            return a + b;
                                        }, 0);

                                        document.getElementById("total").value = ftotal.toFixed(2);
                                        break;
                                    } else {
                                        console.log("nothing there to look for");
                                        console.log(table.rows[index].cells[0]);
                                    }
                                }

                                break;
                            }else{
                                var x = intStock - qty;

                                if(x == 0){
                                    Swal.fire(
                                    'Error!',
                                    "Maximum reached! You can't add more!",
                                    'error'
                                    )
                                }else{
                                    Swal.fire(
                                    'Error!',
                                    'Insufficient stock! At most, you can only add '+x+'!',
                                    'error'
                                    )
                                }
                                
                                status = true;
                                break;
                            }
                                break;
                        } else {
                            console.log("Product is unique therefore we add");
                            status = false;
                        }
                    }

                    if (!status) {
                        products.push({
                            id: ProdId,
                            quantity: quantInt
                        });
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



                        ftotal = subTotals.reduce(function(a, b) {
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


        }

        function reloadInvoice() {
            var table = document.getElementById("invoiceTable");
            var rowCount = table.rows.length;

            for (var x = rowCount - 1; x > 0; x--) {
                table.deleteRow(x);
            }
            document.getElementById("total").value = 0.00;
            document.getElementById("cash").value = 0.00;
            document.getElementById("change").value = 0.00;
            document.getElementById("addtransact").reset();

            products = [];
            subTotals = [];
        }

        function calculateChange() {
            $('#cash_error').removeClass('alert alert-danger');
            $('#cash_error').val("");

            cash = document.getElementById("cash").value;
            subTotal = document.getElementById("total").value;

            finalTotal = cash - subTotal;
            document.getElementById("change").value = finalTotal.toFixed(2);
        }

        function storeTransaction() {
            var data = {
                products,
                'PersonInCharge': $('#personInCharge').val(),
                'ModeOfPayment': 'Cash',
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
                success: function(response) {
                    if (response.status == 400) {
                        $('#transactionMessage').html("");
                        $('#transactionMessage').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values) {
                            $('#transactionMessage').append('<li>' + err_values + '</li>');
                        })
                    } else {
                        $('#saveform_errList').html("");
                        //$('#sales_message').addClass('alert alert-info');
                        //$('#sales_message').text(response.message);
                        Swal.fire(
                            "Success!",
                            "" + response.message + "",
                            "success"
                        ).then(() => {
                            location.reload();
                        });
                        //console.log(response.log);
                    }
                }
            });
        }

        $('#addDebtorModal').on('hidden.bs.modal', function () {
            $('#debt_errList').removeClass('alert alert-danger');
            $('#debtName').val("");
        });

        function storeDebt() {
            var balance = $('#total').val() - $('#cash').val();
            var data = {

                products,
                'PersonInCharge': $('#personInCharge').val(),
                'ModeOfPayment': 'Cash',
                'Balance': balance,
                'AmountPaid': $('#cash').val(),
                'DebtorName': $('#debtName').val(),
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
                success: function(response) {
                    if (response.status == 400) {
                        $('#debt_errList').html("");
                        $('#debt_errList').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values) {
                            $('#debt_errList').append('<li>' + err_values + '</li>');
                        })
                    }else if (response.status == 20012){
                        $('#debt_errList').html("");
                        $('#debt_errList').addClass('alert alert-danger');
                        $('#debt_errList').html(response.message);
                    } else {
                        $('#debt_errList').html("");
                        //$('#sales_message').addClass('alert alert-info');
                        //$('#sales_message').text(response.message);
                        $('#addDebtorModal').modal('hide');

                        Swal.fire(
                            "Success!",
                            "" + response.message + "",
                            "success"
                        ).then(() => {
                            location.reload();
                        });
                        //console.log(response.log);
                    }
                }
            });
        }

        $(document).on('click', '.storeTransaction', function(e) {
            e.preventDefault();
            var cash = parseFloat($('#cash').val());
            var total = parseFloat($('#total').val());
            var checkEmpty = $('#cash').val();
            var percentage1 = total/2;
            if (cash < percentage1) {
                    console.log('half: '+percentage1);
                    console.log('total: '+total);
                    $('#cash_error').html("");
                    $('#cash_error').addClass('alert alert-danger');
                    $('#cash_error').text("Downpayment for debt should at least be Php "+percentage1.toFixed(2)+", or <b>50% of the Total!");  
            }else if(cash >= percentage1){
                $('#addDebtorModal').modal('show');
            } else if(checkEmpty == ""){
                $('#cash_error').html("");
                $('#cash_error').addClass('alert alert-danger');
                $('#cash_error').text("Please fill in all fields!");
            }else{
                storeTransaction();
            }
        });

        $(document).on('click', '.add_debt', function(e) {
            var total = $('#total').val();
            var cash = $('#cash').val();
                storeDebt();
        });
    </script>
@endsection
