@extends('masterlayout.adminlayout')

@section('location')
    TRANSACTIONS :
    @foreach ($sales as $sale)
        {{ $sale->SalesID }}
    @endforeach
@endsection


@section('content')

    <br>

    <div class="container" style="margin-top: 10px">
        <div class="d-flex">
            <div class="d-inline">
                <button class="btn btn-yellow" type="button"
                    onclick="document.location='{{ route('admin.transactions') }}'">Transactions</button>
                <button class="btn btn-outline-danger return" type="button">Return / Exchange</button>
            </div>
        </div>

    </div>

    <div class="container" style="margin-top: 10px">
        <div class="row">

            <div class="col">
                <div class="card text-white mb-3 blue-bg">
                    @csrf
                    <div class="card-body yellow">
                        <div class="row">
                            <div class="col-4">
                                <h3 class="yellow">Details</h3>
                            </div>
                            <div class="col" hidden>
                                <div class="form-group row">
                                    <label for="personInCharge" class="col col-form-label">Person In Charge</label>
                                    <div class="col">
                                        @foreach ($sales as $sale)
                                            <input id="personInCharge" class="form-control" readonly
                                                value="{{ $sale->PersonInCharge }}">
                                            <input id="salesID" class="form-control" readonly
                                                value="{{ $sale->SalesID }}">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="container">
                                <table id="invoiceTable" class="table table-hover table-light">
                                    <thead>
                                        <tr class="table yellow" style="text-align: center">
                                            <th scope="col">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                        @foreach ($details as $detail)
                                            <tr style="align-content: center; text-align: center;"
                                                id="{{ $detail->ProductName }}">
                                                <th scope="row" hidden>{{ $detail->SalesID }}</th>
                                                <td>{{ $detail->ProductName }}</td>
                                                <td id="{{ $detail->ProductName }}Price">{{ $detail->ProductPrice }}
                                                </td>
                                                <td id="{{ $detail->ProductName }}Quantity">{{ $detail->Quantity }}
                                                </td>
                                                <td id="{{ $detail->ProductName }}SubTotal">
                                                    {{ $detail->ProductPrice * $detail->Quantity }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <hr>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label for="total" class="col-sm-7 col-form-label">Total</label>
                                            <div class="col-sm-5">
                                                @foreach ($details as $detail)
                                                    <input id="total" class="form-control" placeholder="0.00" readonly
                                                        value="{{ number_format($detail->AmountDue, 2) }}">
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="returnProductModal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="returnProductModal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header blue-bg yellow">
                    <h5 class="modal-title" id="returnProduct">Replace / Exchange Product</h5>
                    <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">

                    <div id="err_load_refill"></div>

                    <input type="hidden" id="operatorLoadRefill">
                    <div class="form-group">
                        <label for="productToReplace" class="form-label">Select product to replace / exchange:</label>
                        <select class="form-select" id="productToReplace">
                            <option>Product 1</option>
                            <option>Product 2</option>
                            <option>Product 3</option>
                        </select>
                    </div>
                    <div class="form-group mt-4">
                        <label for="productToReplace" class="form-label ">Select replacement:</label>
                        <select class="form-select" id="productReplacement">
                            <option>Product 1</option>
                            <option>Product 2</option>
                            <option>Product 3</option>
                        </select>
                        <small class="text-muted"><em>The product replacement diplayed are those products that have the same price with the product that will be replaced.</em></small>
                    </div>

                    <div class="form-group">
                        <label for="Reason">Reason for replace / exchange:</label>
                        <input id="Reason" class="form-control" type="text" name="">
                    </div>


                </div>


                <div class="modal-footer" style="text-align: right">
                    <button class="btn btn-yellow refill_load" type="button">Confirm</button>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div> 

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $(document).on('click', '.return', function() {

                $('#returnProductModal').modal('show');

            });

        });
    </script>

    <!-- function newProduct(selectedOpt){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var id = selectedOpt.value;
                    var SaleId = $('#SaleId').val();
                    //console.log(price);

                    $.ajax({
                        type: "GET",
                        url: SaleId+"/editProduct/"+id,
                        success: function (response) {
                            if(response.status == 200){
                                console.log("works")
                                //console.log(response.products);
                            }else{
                                console.log('error');
                            }
                        }
                    });
                }
                //format should be year/month/date
                var dt = new Date().toLocaleString();
                var initialPrice=[];
                var toBeUpdated = [];
                $(document).ready(function(){
                    var table = document.getElementById("tableBody");
                    var a;
                    for (let i in table.rows) {
                        let row = table.rows[i]
                        for (let j in row.cells) {
                            let col = row.cells[2]
                            let quant = row.cells[3]
                            if(row.cells[3]){
                                toBeUpdated.push({name: row.cells[1].innerHTML, quantity: row.cells[3].innerHTML});
                                console.log(col.innerHTML*quant.innerHTML);
                                a = col.innerHTML*quant.innerHTML;
                                initialPrice.push(a);
                                break;
                            }
                        }
                    }
                    console.log(toBeUpdated);
                    console.log(initialPrice);
                });

                function calculateChange(){
                    productName = document.getElementById('btn').value;
                    console.log(productName);

                    /*cash = document.getElementById("cash").value;
                    subTotal = document.getElementById("total").value;

                        finalTotal = cash - subTotal;
                        document.getElementById("change").value = finalTotal.toFixed(2);
                        */
                }

                $(document).on('click', '.storeTransaction', function(e){
                e.preventDefault();
                var data = {
                    products,
                    'PersonInCharge': $('#personInCharge').val(),
                    'ModeOfPayment': 'Cash',
                    'AmountToPay': $('#total').val(),
                    'AmountTendered': $('#cash').val(),
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
                        $('#saveform_errList').html("");
                        $('#saveform_errList').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values){
                            $('saveform_errList').append('<li>'+err_values+'</li>');
                        })
                        }else{
                        $('#saveform_errList').html("");
                        $('#sales_message').addClass('alert alert-info');
                        $('#sales_message').text(response.message);
                        console.log(response.log);
                        }
                    }
                });
                console.log(data);


            });
                var toBeRemoved = []
            $(document).on('click', '.removeItem', function(e){
                var ProductName = $(this).val();
                var SubTotal = document.getElementById(''+ProductName+'SubTotal').innerHTML;
                var Total = document.getElementById('total').value;
                var Cash = document.getElementById('cash').value;
                var Change = document.getElementById('change').value;
                document.getElementById('total').value = (Total-SubTotal).toFixed(2);

                document.getElementById('change').value = (Cash - document.getElementById('total').value).toFixed(2);
                toBeRemoved.push(ProductName);

                console.log(toBeRemoved);
                document.getElementById(ProductName).remove();
            });

            $(document).on('click', '.addQuant', function(e){
                var ProductName = $(this).val(); // this is to get ProductName
                var total = document.getElementById('total').value;
                var cash = document.getElementById('cash').value;

                    var Price1 = document.getElementById(''+ProductName+'Price').innerHTML; //  needs to get ProductName muna
                    var Quantity1 = document.getElementById(''+ProductName+'Quantity').innerHTML;
                    var newQuant1 = parseInt(Quantity1) + 1;
                    //var total1= Price1 * newQuant1;
                    var total1;
                    total1 = parseInt(total) + parseInt(Price1);
                    console.log('total: '+total1);

                if(total1 > cash){
                    Swal.fire(
                            "Hold It!",
                        "Cash insufficient!",
                            "info"
                        )
                }else{
                    var ProductName = $(this).val();
                    var SubTotal = document.getElementById(''+ProductName+'SubTotal').innerHTML;
                    var Total = document.getElementById('total').value;
                    var Cash = document.getElementById('cash').value;
                    var Change = document.getElementById('change').value;
                    var Price = document.getElementById(''+ProductName+'Price').innerHTML;
                    var Quantity = document.getElementById(''+ProductName+'Quantity').innerHTML;
                    var newQuant = parseInt(Quantity) + 1;
                    document.getElementById(''+ProductName+'Quantity').innerHTML = newQuant;

                    document.getElementById(''+ProductName+'SubTotal').innerHTML = newQuant * Price;

                    toBeUpdated.forEach(element => {
                        if (element.name == ProductName) {
                            element.quantity = newQuant;
                            console.log(toBeUpdated);
                        }
                    });

                    totalPrice();
                    calculateChange();
                }

            });

            $(document).on('click', '.subQuant', function(e){
                var ProductName = $(this).val();
                var SubTotal = document.getElementById(''+ProductName+'SubTotal').innerHTML;
                var Total = document.getElementById('total').value;
                var Cash = document.getElementById('cash').value;
                var Change = document.getElementById('change').value;
                var Price = document.getElementById(''+ProductName+'Price').innerHTML;
                var Quantity = document.getElementById(''+ProductName+'Quantity').innerHTML;
                var newQuant = parseInt(Quantity) - 1;
                if (document.getElementById(''+ProductName+'Quantity').innerHTML == '1') {

                    //HERE BOI
                    Swal.fire(
                            "Warning",
                        "Item quantity cannot be less than 0. If you want to remove the product click delete.",
                            "info"
                        ).then(() =>{
                            location.reload();
                        });
                    console.log('cannot be less than 1');
                }else{
                    toBeUpdated.forEach(element => {
                        if (element.name == ProductName) {
                            element.quantity = newQuant;
                            console.log(toBeUpdated);
                        }
                    });

                    document.getElementById(''+ProductName+'Quantity').innerHTML = newQuant;
                    document.getElementById(''+ProductName+'SubTotal').innerHTML = newQuant * Price
                }

                totalPrice();
                calculateChange();
            });

            function calculateChange(){
                    cash = document.getElementById("cash").value;
                    subTotal = document.getElementById("total").value;

                        finalTotal = cash - subTotal;
                        document.getElementById("change").value = finalTotal.toFixed(2);
                }

            $(document).on('click', '.updateTransaction', function(e){
                e.preventDefault();
                var s_id = $('#salesID').val();
                data = {
                    toBeUpdated,
                    toBeRemoved,
                    'AmountToPay' : $('#total').val(),
                }
                console.log(data);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "/admin/transactions/update/"+s_id,
                    data: data,
                    dataType: "json",
                    success: function (response) {
                    console.log(response.message);
                    if(response.status == 400){
                        $('#updateform_errList').html("");
                        $('#updateform_errList').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values){
                        $('updateform_errList').append('<li>'+err_values+'</li>');
                        });

                    }else if(response.status == 404){
                        $('#updateform_errList').html("");
                        $('#pizza_message').addClass('alert alert-info');
                        $('#pizza_message').text(response.message);

                    }else{
                        $('#updateform_errList').html("");
                        $('#sales_message').html("");
                        $('#sales_message').addClass('alert alert-info');
                        $('#sales_message').text(response.message);

                    }
                    }
                });
            });

            function totalPrice(){

                    var table = document.getElementById("tableBody");
                    for (let i in table.rows) {
                        let row = table.rows[i]
                        for (let j in row.cells) {
                            let col = row.cells[2]
                            let quant = row.cells[3]
                            if(row.cells[3]){
                                console.log(col.innerHTML*quant.innerHTML);
                                var a = col.innerHTML*quant.innerHTML;
                                initialPrice.push(a);
                                initialPrice.splice(i, 3, a);
                                break;
                            }
                        }
                    }

                    //Reduce and then update
                    ftotal = initialPrice.reduce(function(a,b){
                            return a + b;
                        }, 0);

                    document.getElementById("total").value = ftotal.toFixed(2);

                    console.log(initialPrice);
            } -->
@endsection
