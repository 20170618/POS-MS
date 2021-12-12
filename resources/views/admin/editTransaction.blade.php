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
                    <h3 class="card-header yellow mx-2">Details: </h3>
                    <div class="card-body yellow">

                        <div class="row">

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
                                            <input id="total" class="form-control" placeholder="0.00" readonly
                                                value="{{ number_format($totalVal, 2) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>



                        <!-- -->


                    </div>

                </div>
                <div class="card text-white mt-4 blue-bg">
                    <h3 class="card-header yellow mx-2">Replace / Exchange History: </h3>
                    <div class="d-flex justify-content-center card-body blue flex-wrap">

                        <div class="card-body">
                            <div class="container mt-3">
                                <table id="replaceExchange" class="table table-hover table-light">
                                    <thead>
                                        <tr class="table yellow" style="text-align: center">
                                            <th scope="col">Old Item</th>
                                            <th scope="col">New Item</th>
                                            <th scope="col">No. Items</th>
                                            <th scope="col">Reason</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody" style="text-align: center">
                                        @if ($REHistory == '[]')
                                            <tr>
                                                <td colspan="6">No records so far.</td>
                                            </tr>
                                        @else
                                            @foreach ($REHistory as $record)
                                                <tr>
                                                    <td>{{ $record->OldProduct }}</td>
                                                    <td>{{ $record->NewProduct }}</td>
                                                    <td>{{ $record->Quantity }}</td>
                                                    <td>{{ $record->Reason }}</td>
                                                    <td>{{ $record->Status }}</td>
                                                    <td>{{ $record->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
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

                    <div id="replaceAlert"></div>

                    <div class="form-group">
                        <label for="productToReplace" class="form-label">Select product to replace / exchange:</label>
                        <select class="form-select" id="productToReplace" required>
                            <option selected="true" disabled="disabled">Select product...</option>
                            @foreach ($details as $detail)
                                <option value="{{ $detail->ProductID }}">{{ $detail->ProductName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @foreach ($sales as $sale)
                        <input type="number" value="{{ $sale->SalesID }}" hidden id="saleID">
                    @endforeach

                    <div id="NewProductSelect">
                        <div class="form-group mt-4">
                            <label for="productReplacement" class="form-label ">Select replacement:</label>
                            <select class="form-select" id="productReplacement">

                            </select>
                            <small class="text-muted"><em>The product replacement diplayed are those products that have
                                    the
                                    same price with the product that will be replaced. You can only exchange one item at a
                                    time.</em></small>
                        </div>

                        <div class="form-group mt-4">
                            <label for="selectQuantity" class="form-label mt-4">Number of items to replace:</label>
                            <select class="form-select" id="selectQuantity">
                            </select>
                        </div>

                        <div class="form-group mt-4">
                            <label for="inputReason">Reason for replace / exchange:</label>
                            <input id="inputReason" class="form-control" type="text" name="">
                        </div>
                    </div>


                </div>


                <div class="modal-footer" style="text-align: right">
                    <button class="btn btn-yellow proceedReplace" type="button">Confirm</button>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            var saleID = $('#saleID').val();

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content"),
                },
            });

            $('#NewProductSelect').hide();

            $(document).on('click', '.return', function() {

                $('#returnProductModal').modal('show');

            });


            //  function changeProd() {
            //      var x = document.getElementById("productToReplace").value;
            //      alert(x);
            //  }

            var selectNewProduct = document.getElementById('productReplacement');
            var selectQuantity = document.getElementById('selectQuantity');

            $('#productToReplace').change(function(e) {
                e.preventDefault();

                var x = this.value;
                var data = {
                    'saleID': saleID
                };
                $('#productReplacement').find('option').remove();
                $('#selectQuantity').find('option').remove();

                $.ajax({
                    type: "GET",
                    url: "selectOldProduct/" + x,
                    data: data,
                    success: function(response) {

                        if (response.Quantity == null) {
                            Swal.fire('Product out of Stock!',
                                'The selected product currently has no available products to be replaced or exchanged with.',
                                'error');
                            $('#NewProductSelect').fadeOut();
                            $('.proceedReplace').fadeOut();
                        } else {
                            var maxVal = response.Quantity.Quantity;
                            $.each(response.NewProducts, function(key, product) {
                                var opt = document.createElement('option');
                                opt.value = product.ProductID;
                                opt.innerHTML = product.ProductName;
                                selectNewProduct.appendChild(opt);
                            });
                            $('#NewProductSelect').fadeIn();
                            $('.proceedReplace').show();

                            for (var i = 1; i <= maxVal; i++) {
                                if (i == 1) {
                                    var opt = document.createElement('option');
                                    opt.value = i;
                                    opt.selected = "true";
                                    opt.innerHTML = i;
                                    selectQuantity.appendChild(opt);
                                } else {
                                    var opt = document.createElement('option');
                                    opt.value = i;
                                    opt.innerHTML = i;
                                    selectQuantity.appendChild(opt);
                                }
                            }
                        }


                    }
                });
            });

            $('.proceedReplace').click(function(e) {
                e.preventDefault();

                //Testing if quantity is selected.
                var inputReason = $('#inputReason').val();
                if (inputReason == "") {

                    $('#replaceAlert').html("");
                    $('#replaceAlert').addClass('alert alert-danger');
                    $('#replaceAlert').text("Please input reason!");

                } else {
                    $('#replaceAlert').removeClass('alert alert-danger');
                    $('#replaceAlert').html("");


                    var data = {
                        'SaleID': saleID,
                        'OldProdID': $('#productToReplace').val(),
                        'NewProdID': $('#productReplacement').val(),
                        'Quantity': $('#selectQuantity').val(),
                        'Reason': $('#inputReason').val()
                    }

                    $.ajax({
                        type: "PUT",
                        url: "proceedReplace",
                        data: data,
                        success: function(response) {
                            if (response.status == 100) {
                                Swal.fire('Success!', 'Product has been replaced.', 'success')
                                    .then(() => {
                                        location.reload();
                                    });
                            } else if (response.status == 200) {
                                Swal.fire('Success!', 'Product has been exchanged.', 'success')
                                    .then(() => {
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
