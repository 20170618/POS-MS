@extends('masterlayout.salespersonlayout')

@section('location')
    E-LOAD
@endsection

@section('content')

    <br>

    <div class="container" style="margin-top: 10px">
        <button class="btn btn-yellow btn-lg d-inline-block addRegular" type="button" data-bs-toggle="modal"
            data-bs-target="#addRegularModal">Load Regular</button>
        <button class="btn btn-yellow btn-lg d-inline-block addPromo" type="button" data-bs-toggle="modal"
            data-bs-target="#addPromoModal">Load Promo</button>

        <div class="card text-white mt-3 blue-bg">
            <div class="card-header">
                <h3 class="yellow">Wallet Balance: </h3>
            </div>
            <div class="d-flex justify-content-center card-body blue flex-wrap">

                <div class="flex-fill card" style="margin:2%">
                    <div class="card-body">
                        <h4 class="card-header">SMART/TNT</h4>
                        <h1 class="mt-4 card-text text-center" id="smartTntLoadWallet">----</h1>
                        <div class="d-grid gap-2 col-6 mx-auto">
                        </div>
                    </div>
                </div>
                <div class="flex-fill card" style="margin:2%">
                    <div class="card-body">
                        <h4 class="card-header">GLOBE/TM</h4>
                        <h1 class="mt-4 card-text text-center" id="globeTMLoadWallet">----</h1>
                        <div class="d-grid gap-2 col-6 mx-auto">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <table class="table table-light" id="EloadTable">
            <thead class="thead-light">
                <tr>
                    <th>Eload ID</th>
                    <th>Product Name</th>
                    <th>Load Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eloads as $eload)
                <tr>
                    <td>{{$eload->id}}</td>
                    <td>{{$eload->ProductName}}</td>
                    <td>{{$eload->LoadAmount}}</td>
                    <td>{{$eload->created_at}}</td>
                </tr>
                @endforeach
                
            </tbody>
        </table>

    </div>

    <!-- Add Regular Modal -->
    <div id="addRegularModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header blue-bg yellow">
                    <h5 class="modal-title">Add Regular Load Order</h5>
                    <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="load_errList"></div>
                    <div class="form-group">
                        <label for="searched" class="form-label mt-4">Load Regular</label>
                        <select class="form-select" id="selectedOperator">
                            @foreach ($regular as $load)
                                <option value="{{ $load->ProductID }}" id="{{$load->ProductID}}">{{ $load->ProductName }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label mt-4">Load Amount</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" placeholder="0.00" name="regularPrice"
                                        id="regularPrice" min="1.00" required>
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
                    <button class="btn btn-yellow add_regular" type="submit">Add</button>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>
    <!-- End Add Regular Modal -->

    <!-- Add Promo Modal-->
    <div id="addPromoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
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
                    {{-- <div class="form-group">
                        <label class="form-label mt-4">Promo Name</label>
                            <input type="text" class="form-control" placeholder="Product Name" name="prodName" id="prodName">
                    </div> --}}

                    <div class="form-group">
                        <label for="searched" class="form-label mt-4">Promos</label>
                        <select class="form-select" id="selectedPromo">
                            @foreach ($promos as $promo)
                                <option value="{{ $promo->ProductID }}">{{ $promo->ProductName }} </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label mt-4">Price</label>
                                <div class="input-group mb-3">
                                    <div style="display: none">
                                    </div>
                                        <input type="number" value="" class="form-control"
                                            placeholder="0.00" name="promoPrice" id="promoPrice" min="1.00" readonly>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer" style="text-align: right">
                    <button class="btn btn-yellow add_promo" type="button">Add</button>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>

    <!--End of Promo Modal-->
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {

                $('#EloadTable').DataTable({
                    "order": [[ 3, "desc" ]]
                });

            fetchLoadWallet();

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content"),
                },
            });

            function fetchLoadWallet() {
                $.ajax({
                    type: "GET",
                    url: "fetch-loadwallet",
                    success: function(response) {

                        document.getElementById("smartTntLoadWallet").innerHTML = "&#8369; " + response
                            .smart.Stock.toFixed(2) + "";
                        document.getElementById("globeTMLoadWallet").innerHTML = "&#8369; " + response
                            .globe.Stock.toFixed(2) + "";
                    }
                });
            }

            $('.smartRefill').click(function(e) {
                e.preventDefault();

                $('#refillLoadModal').modal('show');
                document.getElementById("refillLoadTitle").innerHTML = "Refill Load for SMART/TNT";
                document.getElementById("LoadWalletHelp").innerHTML =
                    "The minimum restock is 6000 for SMART/TNT.";
                $('#inputLoadWallet').val(0);
                $('#operatorLoadRefill').val('SMART');
                $('#err_load_refill').html("");
                $('#err_load_refill').removeClass('alert alert-danger');
            });

            $('.refill_load').click(function(e) {
                e.preventDefault();

                var operator = $('#operatorLoadRefill').val();
                var loadRefill = $('#inputLoadWallet').val();

                if (operator == "SMART") {

                    if (loadRefill < 6000) {
                        $('#err_load_refill').html("");
                        $('#err_load_refill').addClass('alert alert-danger');
                        $('#err_load_refill').text("Insufficient refill amount!");
                    } else {
                        $('#err_load_refill').html("");
                        $('#err_load_refill').removeClass('alert alert-danger');

                        var data = {
                            'loadval': loadRefill,
                        }

                        $.ajax({
                            type: "PUT",
                            url: "refill/" + operator,
                            data: data,
                            success: function(response) {
                                if (response.status == 'Success') {
                                    $('#refillLoadModal').modal('hide');
                                    $('#inputLoadWallet').val(0);
                                    fetchLoadWallet();

                                    Swal.fire('Success',
                                        response.message,
                                        'success');
                                }
                            }
                        });
                    }

                } else if (operator == "GLOBE") {
                    if (loadRefill < 3000) {
                        $('#err_load_refill').html("");
                        $('#err_load_refill').addClass('alert alert-danger');
                        $('#err_load_refill').text("Insufficient refill amount!");
                    } else {
                        $('#err_load_refill').html("");
                        $('#err_load_refill').removeClass('alert alert-danger');

                        var data = {
                            'loadval': loadRefill,
                        }

                        $.ajax({
                            type: "PUT",
                            url: "refill/" + operator,
                            data: data,
                            success: function(response) {
                                if (response.status == 'Success') {
                                    $('#refillLoadModal').modal('hide');
                                    $('#inputLoadWallet').val(0);
                                    fetchLoadWallet();

                                    Swal.fire('Success',
                                        response.message,
                                        'success');
                                }
                            }
                        });
                    }
                }

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content"),
                    },
                });
            });

            $('.globeRefill').click(function(e) {
                e.preventDefault();

                $('#refillLoadModal').modal('show');
                document.getElementById("refillLoadTitle").innerHTML = "Refill Load for GLOBE/TM";
                document.getElementById("LoadWalletHelp").innerHTML =
                    "The minimum restock is 3000 for GLOBE/TM.";
                $('#inputLoadWallet').val(0);
                $('#operatorLoadRefill').val('GLOBE');
                $('#err_load_refill').html("");
                $('#err_load_refill').removeClass('alert alert-danger');
            });

            $('#selectedPromo').on('change', function(e) {
                var price = $('#promoPrice').val();
                var prodId = $('#selectedPromo').val();

                $.ajax({
                    type: "GET",
                    url: "eload/getPromoPrice/" + prodId,
                    dataType: "json",
                    success: function(response) {
                        $('#promoPrice').val(response.product.Price);
                    }
                });
            });

            $(document).on('keyup', '#regularPrice', function() {
                var amount = $('#regularPrice').val();
                var prodId = $('#selectedOperator').val();
                console.log(prodId);
                if (amount < 500) {
                    $('#markUp').val(5);
                } else {
                    $('#markUp').val(10);
                }
            });

            $(document).on('keyup', '#prodName', function() {
                var name = $('#prodName').val();
                console.log(name);
                $.ajax({
                    type: "PUT",
                    url: "filter",
                    data: {
                        'productName': name,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 200) {
                            console.log(response.message);
                        } else {
                            console.log('error!');
                        }

                    }
                });
            });

            $('#addRegularModal').on('hidden.bs.modal', function() {
                $('#load_errList').removeClass('alert alert-danger');
                $('#exampleSelect2').val("");
                $('#regularPrice').val(0.00);

                $('#load_errList').text("");
            })


            $(document).on('click', '.add_regular', function(e) {
                e.preventDefault();
                var amount = $('#regularPrice').val();
                var prodId = $('#selectedOperator').val();
                var mark = $('#markUp').val()
                var operator;
                console.log(amount);
                console.log(prodId);
                if (amount == "" || prodId == "") {
                    $('#load_errList').html("");
                    $('#load_errList').addClass('alert alert-danger');
                    $('#load_errList').text("Please fill in all fields!");
                } else if(amount < 5){
                    $('#load_errList').html("");
                    $('#load_errList').addClass('alert alert-danger');
                    $('#load_errList').text("Minimum amount for load is 5!");
                }    else {
                    
                    if(prodId==1){
                        operator = "SMART";
                    }else if(prodId==2){
                        operator = "GLOBE";
                    }

                    var loadamount = parseInt(amount) + parseInt(mark)

                    var data = {
                        'ProductID': prodId,
                        'LoadAmount': loadamount,
                        'Operator': operator,
                    };
                    console.log(data);


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "PUT",
                        url: "eload/storeEload",
                        data: data,
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire(
                                    "Success!",
                                    "" + response.message + "",
                                    "success"
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                $('#load_errList').html("");
                                $('#load_errList').addClass('alert alert-danger');
                                $('#load_errList').text("Error! Something went wrong!");
                            }
                        }
                    });
                }
            });

            $('.addPromo').click(function (e) { 
                e.preventDefault();
                
                var prodId = $('#selectedPromo').val();

                $.ajax({
                    type: "GET",
                    url: "eload/getPromoPrice/" + prodId,
                    dataType: "json",
                    success: function(response) {
                        $('#promoPrice').val(response.product.Price);
                    }
                });

            });

            $(document).on('click', '.add_promo', function(e) {
                e.preventDefault();
                var amount = $('#promoPrice').val();
                var prodId = $('#selectedPromo').val();
                var isPromo = 1;
                console.log(amount);
                console.log(prodId);
                if (amount == "" || prodId == "") {
                    $('#load_errList').html("");
                    $('#load_errList').addClass('alert alert-danger');
                    $('#load_errList').text("Please fill in all fields!");
                } else {

                    var data = {
                        'ProductID': prodId,
                        'LoadAmount': amount,
                        'isPromo': isPromo,
                    };

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "PUT",
                        url: "eload/storeEload",
                        data: data,
                        success: function(response) {
                            console.log(response.status);
                            if (response.status == 200) {
                                Swal.fire(
                                    "Success!",
                                    "" + response.message + "",
                                    "success"
                                ).then(() => {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });

        });
    </script>
@endsection
