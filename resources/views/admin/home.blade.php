@extends('masterlayout.adminlayout')

@section('location')
    HOME
@endsection


@section('content')

    <div class="container" style="margin-top: 10px; max-width: 50rem;">
        <div class="row row-cols-2">

        <div class="col">
            <div class="card text-white mb-3 blue-bg" style="max-width: 20rem;">
                
                <div class="card-body" style="text-align: center">
                    <i class="fas fa-shopping-cart fa-5x"></i>
                </div>

                <div class="card-footer" style="text-align: center">
                    <a class="btn btn-yellow" href="../admin/products"><b>View Products</b></a>
                </div>
                
            </div>
        </div>

        <div class="col">
            <div class="card text-white mb-3 blue-bg" style="max-width: 20rem;">
                
                <div class="card-body" style="text-align: center">
                    <i class="far fa-credit-card fa-5x"></i>
                </div>

                <div class="card-footer" style="text-align: center">
                    <a class="btn btn-yellow" href="../admin/transactions"><b>Add Transaction</b></a>
                </div>
                
            </div>
        </div>

        <div class="col">
            <div class="card text-white mb-3 blue-bg" style="max-width: 20rem;">
                
                <div class="card-body" style="text-align: center">
                    <i class="fas fa-users fa-5x"></i>
                </div>

                <div class="card-footer" style="text-align: center">
                    <a class="btn btn-yellow" href="../admin/userManagement"><b>User Management</b></a>
                </div>
                
            </div>
        </div>

        <div class="col">
            <div class="card text-white mb-3 blue-bg" style="max-width: 20rem;">
                
                <div class="card-body" style="text-align: center">
                    <i class="fas fa-file-alt fa-5x"></i>
                </div>

                <div class="card-footer" style="text-align: center">
                    <a class="btn btn-yellow" href="../admin/reports"><b>Reports</b></a>
                </div>
                
            </div>
        </div>

        </div>
    </div>

@endsection