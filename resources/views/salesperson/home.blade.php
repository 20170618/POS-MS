@extends('masterlayout.salespersonlayout')

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
                    <a class="btn btn-yellow" href="../salespersonproducts"><b>View Products</b></a>
                </div>
                
            </div>
        </div>

        <div class="col">
            <div class="card text-white mb-3 blue-bg" style="max-width: 20rem;">
                
                <div class="card-body" style="text-align: center">
                    <i class="far fa-credit-card fa-5x"></i>
                </div>

                <div class="card-footer" style="text-align: center">
                    <a class="btn btn-yellow" href="{{ route('salesperson.salespersonaddtransaction') }}"><b>Add Transaction</b></a>
                </div>
                
            </div>
        </div>

        </div>
    </div>

   

@endsection