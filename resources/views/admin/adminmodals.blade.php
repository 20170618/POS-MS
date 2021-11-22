<!-- Access Logs Modal -->
<div id="accessLogsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header blue-bg yellow">
                <h5 class="modal-title">Access Logs</h5>
                <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-yellow" data-bs-dismiss="modal">Records</button>

                <div class="row">
                    <div class="container" style="margin-top: 10px">
                        <table class="table table-hover">
                            <thead>
                            <tr class="table-yellow">
                                <th scope="col">Name</th>
                                <th scope="col">Position</th>
                                <th scope="col">Time in</th>
                                <th scope="col">Time out</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr class="table-light">
                                <th scope="row">Dela Cruz, Juan</th>
                                <td>Salesperson</td>
                                <td>6:00pm</td>
                                <td>12:00am</td>
                                <td>01/01/2021</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Access Logs Modal -->

<!-- Edit Transaction Modal -->
<div id="editTransactionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content blue-bg yellow">
            <div class="modal-header">
                <h5 class="modal-title">January 1, 2021 &nbsp; 12:00AM</h5>
                <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="yellow">Transaction ID:</h6>
                        <hr>

                        <div class="row">
                            <div class="container">

                            <table class="table table-hover">
                                <thead>
                                <tr class="table yellow">
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr class="table yellow">
                                    <th scope="row"></th>
                                    <td></td>
                                </tr>

                                </tbody>
                            </table>

                            <hr>

                            <div class="row">
                                <div class="col">
                                    <h6>Total</h6>
                                    <br>
                                    <p>Cash</p>
                                    <p>Change</p>
                                </div>
                                <div class="col">
                                    <p>₱0.00</p>
                                    <p>₱0.00</p>
                                    <p>₱0.00</p>
                                </div>
                            </div>

                            </div>
                        </div>
            </div>
            <div class="modal-footer" style="text-align: right">
                <button class="btn btn-yellow" type="button">Edit</button>
            </div>

        </div>
    </div>
</div>
<!-- End Edit Transaction Modal -->



<!-- Start Pending Modal -->
<div id="pendingModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header blue-bg yellow">
                <h5 class="modal-title">Pending Accounts</h5>
                <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="container" style="margin-top: 10px">
                        <table class="table table-hover">
                            <thead>
                            <tr class="table-yellow">
                                <th scope="col">Name</th>
                                <th scope="col">Position</th>
                                <th scope="col">Actions</th>


                            </tr>
                            </thead>
                            <tbody>

                            <tr class="table-light">
                                <th scope="row">Dela Cruz, Juan</th>
                                <td>Salesperson</td>
                                <td>
                                    <button class="btn btn-primary" type="button"><i class="fas fa-check"></i></button>

                                    &nbsp;

                                    <button class="btn btn-danger" type="button"><i class="fas fa-times"></i></button>

                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Pending Modal -->

