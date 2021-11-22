@extends('masterlayout.adminlayout')

@section('location')
    TRANSACTIONS :
    @foreach ($sales as $sale)
        {{$sale->SalesID}}
    @endforeach
@endsection


@section('content')
    <div id="sales_message"></div>

    <br>

    <div class="container" style="margin-top: 10px">
        <div class="row">
            <div class="col-2">
                <button class="btn btn-yellow" type="button" onclick="document.location='{{ route('admin.transactions') }}'">Transactions</button>
            </div>
        </div>     

    </div>

    
    <div class="container" style="margin-top: 10px; width: 50%;">
        <div class="row">
            <div class="card text-white mb-3 blue-bg">
                <div class="card-body yellow">
                    <div class="row">
                        <div class="col-4">
                            <h3 class="yellow">Replace/Exchange Form</h3>
                        </div>
                        <br>
                    </div>
                    <div class="row">
                        <div class = "col-md-2">
                            <label for="SaleId" class="col col-form-label">Sales ID</label>
                            
                        </div>
                        <div class="col-md-5">
                            @foreach ($sales as $sale)
                            <input id = "SaleId" class="form-control" readonly value="{{ $sale->SalesID }}">
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class = "col-md-2">
                            <label for="productToReplace" class="col col-form-label">Product To Replace</label>
                        </div>
                        <div class="col-md-5">
                            <select onchange="newProduct(this)" width="100%;">
                                @foreach ($details as $detail)
                                    <option id = "product{{$detail->ProductName}}" value="{{$detail->ProductPrice}}">{{$detail->ProductName}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class = "col-md-2">
                            <label for="newProduct" class="col col-form-label">New Product</label>
                        </div>
                        <div class="col-md-5">
                            @foreach ($sales as $sale)
                            <input id = "SaleId" class="form-control" readonly value="{{ $sale->SalesID }}">
                            @endforeach
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="container" style="margin-top: 10px">
        <div class="row">

            <div class="col">
                <div class="card text-white mb-3 blue-bg">
                    <form method="POST" action="{{route('admin.storeTransaction')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body yellow">
                        <div class="row">
                            <div class="col-4">
                                <h3 class="yellow">Invoice</h3>
                            </div>
                            <div class="col" hidden>
                                <div class="form-group row">
                                    <label for="personInCharge" class="col col-form-label">Person In Charge</label>
                                    <div class="col">
                                        @foreach ($sales as $sale)
                                        <input id = "personInCharge" class="form-control" readonly value="{{ $sale->PersonInCharge }}">
                                        <input id = "salesID" class="form-control" readonly value="{{ $sale->SalesID }}"> 
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>

                        <div class="row">
                            <div class="container">
                                <table id = "invoiceTable" class="table table-hover table-light">
                                    <thead>
                                    <tr class="table yellow" style="text-align: center">
                                        <th scope = "col">Product</th>
                                        <th scope = "col">Price</th>
                                        <th scope = "col">Quantity</th>
                                        <th scope = "col">Sub Total</th>
                                        <th scope = "col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id = "tableBody">
                                        @foreach ($details as $detail)
                                            <tr style="align-content: center; text-align: center;" id="{{$detail->ProductName}}">
                                                <th scope="row" hidden>{{$detail->SalesID}}</th>
                                                <td>{{$detail->ProductName}}</td>
                                                <td id="{{$detail->ProductName}}Price">{{$detail->ProductPrice}}</td>
                                                <td id="{{$detail->ProductName}}Quantity">{{$detail->Quantity}}</td>
                                                <td id="{{$detail->ProductName}}SubTotal">{{($detail->ProductPrice)*($detail->Quantity)}}</td>
                                                
                                                <td>
                                                    <button class="btn btn-primary addQuant" value="{{$detail->ProductName}}" type="button"><i class="fas fa-plus"></i></button>
                                                    <button class="btn btn-primary subQuant" value="{{$detail->ProductName}}" type="button"><i class="fas fa-minus"></i></button>

                                                    &nbsp;

                                                    <button class="btn btn-danger removeItem" value="{{$detail->ProductName}}" type="button"><i class="fas fa-trash-alt"></i></button>
                                                </td>
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
                                                <input id = "total" class="form-control" placeholder="0.00" readonly value="{{number_format($detail->AmountDue, 2)}}"> 
                                                @endforeach
                                            </div>
                                        </div>

                                        
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="card-footer" style="text-align: right">
                        <button type="button" class="btn btn-yellow updateTransaction">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        function newProduct(selectedOpt){
            var price = selectedOpt.value;
            console.log(a);

            $.ajax({
                type: "GET",
                header: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: "samePricedProducts/" + price,
                dataType: "json",
                success: function (response) {
                    if(response.status == 400){
                        console.log("works")
                        //console.log(response.products);
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
    }

    </script>
@endsection