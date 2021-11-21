@extends('masterlayout.adminlayout')

@section('alert')
    @if ($message = Session::get('deleteTransaction'))
        <?php
        echo "<script>
                                                                    Swal.fire(
                                                                        'Deleted.',
                                                                        'The sales record has been deleted.',
                                                                        'danger'
                                                                    )   </script> ";
        ?>
    @endif
@endsection

@section('location')
    DEBTORS
@endsection

@section('content')

    <div class="container" style="margin-top: 10px">
        <div class="row">

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
                            <th scope="col">Debtor ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody id="transactionsBody">
                        @foreach ($debtors as $debtor)
                            <tr style="align-content: center; text-align: center;">

                                <th scope="row">{{ $debtor->DebtorID }}</th>
                                <td>{{ $debtor->DebtorName }}</td>
                                <td>{{ $debtor->ContactNumber }}</td>
                                <td>
                                    <button class="btn btn-primary debt_record" value="{{ $debtor->DebtorID }}"><i
                                            class="fas fa-eye"></i></button>
                                    <a class="btn btn-primary" href=""><i class="fas fa-pen"></i></a>
                                    <button class="btn btn-secondary delete_transaction" value="" type="button"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                            class="fas fa-archive"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Start View Products of Debt Record -->
    <div id="DebtRecordModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header blue-bg yellow">
                    <h5 class="modal-title" id="DebtRecordModalHeader"></h5>
                    <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="DebtorsDebt">
                        <input type="hidden" id="delete_tran_id">
                        <div class="form-group">
                            <label for="Amount Due" class="form-label mt-2">Last Amount Paid:</label>
                            <div class="input-group">
                                <input type="number" class="form-control LastAmountPaid" id="LastAmountPaid" readonly>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="Amount Due" class="form-label mt-2">Amount Due:</label>
                            <div class="input-group">
                                <input type="number" class="form-control deleteCategoryName" id="AmountDue" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="text-align: right">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Okay</button>
                </div>

            </div>
        </div>
    </div>
    <!-- End View Debt Record Modal -->

    <script>
        $(document).ready(function() {

            $(document).on('click', '.debt_record', function() {

                $('#DebtRecordModal').modal('show');

                var debtorID = $(this).val();
                console.log(debtorID);


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "GET",
                    url: "debtors-record/" + debtorID,
                    success: function(response) {
                        if (response.status == 200) {

                            $.each(response.debtor, function(key, dRecord) {
                                // key would be the numerical index; value is the key:value pair of the array index's element.
                                console.log(dRecord
                                .AmountPaid); // should print the firstname of the first element.

                                $('#LastAmountPaid').val(dRecord.AmountPaid);
                                $('#AmountDue').val(dRecord.AmountDue - dRecord
                                    .AmountPaid);
                            });
                        } else {
                            $('#DebtorsDebt').hide();
                        }
                    }
                });

            });

        });
        // End Delete
    </script>


@endsection
