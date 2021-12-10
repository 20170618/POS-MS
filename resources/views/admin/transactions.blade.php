@extends('masterlayout.adminlayout')

@section('alert')
    @if($message = Session::get('deleteTransaction'))
        <?php
            echo"<script>
            Swal.fire(
                'Deleted.',
                'The sales record has been deleted.',
                'danger'
            )   </script> ";
        ?>
    @endif
@endsection

@section('location')
    TRANSACTIONS
@endsection

@section('content')

    <div class="container" style="margin-top: 10px">
        <div class="row">
            <div class="col-8">
                <button class="btn btn-yellow" type="button" onclick="document.location='{{ route('admin.addtransaction') }}'">Add Transaction</button>
            </div>
            <div class="col">
                <div class="form-group">

                    <div class="form-group" style="width: 20rem;">
                      <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" id="search" class="form-control" placeholder="Search">
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="container">
                <table class="table table-hover">
                    <thead>
                    <tr style="text-align: center;">
                        <th scope ="col">Sales ID</th>
                        <th scope ="col">Mode of Payment</th>
                        <th scope="col">Date & Time</th>
                        <th scope="col">Person In Charge</th>
                        <th scope="col">Sales Total</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>

                    <tbody id="transactionsBody">
                    {{-- @foreach ($sales as $sale)
                        <tr style="align-content: center; text-align: center;">
                            <th scope="row">{{$sale->SalesID}}</th>
                            <td>{{$sale->ModeOfPayment}}</td>
                            <td>{{$sale->created_at}}</td>
                            <td>{{$sale->FirstName}} {{$sale->LastName}}</td>
                            <td>
                                <button class="btn btn-primary transaction_detail_show" value="{{$sale->SalesID}}"><i class="fas fa-eye"></i></button>
                                <a class="btn btn-primary" href="{{route('admin.editTransaction', $sale->SalesID)}}"><i class="fas fa-pen"></i></a>
                                <button class="btn btn-secondary delete_transaction" value="{{$sale->SalesID}}" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fas fa-archive"></i></button>
                            </td>
                        </tr>
                    @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Start View Sales Details Modal -->
<div id="transactionDetailModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header blue-bg yellow">
                    <h5 class="modal-title" id="modalTitle"><i class='fas fa-list-ul'></i> &nbsp;&nbsp;Sales Details</h5>
                    <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="scrollable">

                        <table class="table table-light">
                            <thead class="thead-light">
                                <tr>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="productsTable">
                                
                            </tbody>
                        </table>

                    </div>

                    <style type="text/css">
                        .scrollable{
                            height: 15rem;
                            overflow:hidden;
                            overflow-y: scroll;
                        }
                    </style>

                    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example"
                        tabindex="0">
                    </div>

                </div>

                <div class="modal-footer" style="text-align: right">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Back</button>
                </div>

            </div>
        </div>
    </div>
<!-- End View Sales Details Modal -->

<!-- Start Delete -->
    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header blue-bg yellow">
                    <h5 class="modal-title">Archive</h5>
                    <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_tran_id">
                    <p>
                        You're about to archive this transaction:
                    </p>

                    <label for="delete_transactID" class="col-sm-3 col-form-label">Sale ID</label>
                        <input type="text" name="delete_transactID" id="delete_transactID" value="" disabled>
                        <br>
                        <label for="delete_incharge" class="col-sm-3 col-form-label">Salesperson:</label>
                        <input type="text" name="delete_incharge" id="delete_incharge" value="" disabled>

                </div>

                <div class="modal-footer" style="text-align: right">
                    <button class="btn btn-yellow delete_transaction_btn" type="button">Confirm</button>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>
<!-- End Delete Modal -->

    <script>
        $(document).ready(function(){
            fetch_data();

            $(document).on('click', '.transactionDetails', function (e) {
            e.preventDefault();
            var t_id = $(this).val();
            $('#transactionDetailModal').modal('show');
            $("#productsTable").html('');
            $("#modalTitle").html('');

                $.ajax({
                    type: "GET",
                    url: "transactionDetails/" + t_id,
                    success: function (data) {
                        $("#modalTitle").append("<i class='fas fa-list-ul'></i> &nbsp;&nbsp;Sales Details: "+t_id+"");
                        var len = data.details.length;

                        for (var i = 0; i < len; i++) {
                            var id = data.details[i].ProductID;
                            var productN = data.details[i].ProductName;
                            var productP = data.details[i].Quantity;
                            var productS = data.details[i].Quantity * data.details[i].Price;

                        
                            var tr_str = "<tr style='text-align: center'>" +
                            "<td align='center'>" + productN + "</td>" +
                            "<td align='center'>" + productP + "</td>" +
                            "<td align='center'>&#8369;" + productS.toFixed(2) + "</td>" +
                            "</tr>";
                            $("#productsTable").append(tr_str);
                            }
                        

                        
                        
                    
                    var tableEnd = "</tbody>";
                    $("#productsTable").append(tableEnd);
                    }
                });
            });


            //fetch all records
            function fetch_data(query=''){
                $.ajax({
                    url:"{{ route('admin.transactionsSearch')}}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data){
                        $('#transactionsBody').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }
                });
            }

            $(document).on('keyup','#search',function(){
                var query = $(this).val();
                fetch_data(query);
                });
            });


        $(document).on("click", ".delete_transaction", function (e) {
            e.preventDefault();
            var id = $(this).val();
            $("#deleteModal").modal("show");

            $.ajax({
                type: "GET",
                url: "deleteTransaction/"+id,
                success: function (response) {
                if(response.status == 404) {
                    $('#pizza_message').html("");
                    $('#pizza_message').addClass('alert alert-danger');
                    $('#pizza_message').text(response.message);
                }else {
                    console.log(response);
                    $('#delete_transactID').val(response.sales[0].SalesID);
                    $('#delete_incharge').val(""+response.sales[0].FirstName+" "+response.sales[0].LastName+"");
                    $('#delete_tran_id').val(response.sales[0].SalesID);
                }
                }
            });
        });


        //ARCHIVE OR DELETE
        $(document).on('click','.delete_transaction_btn', function (e) {
            e.preventDefault();
            var t_id = $('#delete_tran_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "destroyTransaction/"+t_id,
                success: function (response) {
                //$('#pizza_message').addClass('alert alert-info');
                //$('#pizza_message').text(response.message);
                $('#deleteModal').modal('hide');
                //window.location = window.location;

                Swal.fire(
                    "Deleted",
                "The sales record has been deleted.",
                    "info"
                ).then(() =>{
                    location.reload();
                });
                }
            });
        });
        // End Delete


    </script>


@endsection
