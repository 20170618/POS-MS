@extends('masterlayout.salespersonlayout')

@section('location')
    TRANSACTIONS
@endsection


@section('content')

    <div class="container" style="margin-top: 10px">
        <div class="row">
            <div class="col-2">
                <button class="btn btn-yellow" type="button" onclick="document.location='../salesperson/salespersonaddtransactions'">Add Transaction</button>
            </div>
            <!-- <div class="col-6">
                <button class="btn btn-yellow" type="button">View Debts</button>
            </div> -->
            <div class="col">
                <div class="form-group">
            
                    <div class="form-group" style="width: 20rem">
                      <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search"> 
                      </div>
                    </div>
        
                </div>
            </div>
        </div>

        

        <div class="row">

            <div class="container">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Salesperson</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <th scope="row">Jan 1, 2021</th>
                        <td>12:00 AM</td>
                        <td>Salesperson</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#editTransactionModal"><i class="fas fa-pen"></i></button>
                            
                            &nbsp;

                            <button class="btn btn-danger" type="button"><i class="fas fa-times"></i></button>
                            
                        </td>
                    </tr>
                    
                    </tbody>
                </table>
            </div>

        </div>

    </div>

@endsection