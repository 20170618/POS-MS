@extends('masterlayout.adminlayout')

@section('location')
    TRANSACTIONS : 
    @foreach ($sales as $sale)
        {{$sale->SalesID}}
    @endforeach
@endsection

@section('content')

    <div class="container" style="margin-top: 10px">
        <div class="row">
            <div class="col-6">
                <a href="{{ route('admin.transactions')}}" class="btn btn-yellow ">Back</a>
                <!-- <button class="btn btn-yellow" type="button">Back</button> -->
            </div>
        </div>

        <div class="row">
            <div class="container">
                <table class="table table-hover">
                    <thead>
                    <tr style="text-align: center">
                        <th scope="col">SalesID</th>
                        <th scope="col">ProductID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <!-- <th scope="col">Load Amount</th> -->
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($details as $detail)
                        <tr style="align-content: center; text-align: center;">
                            <th scope="row">{{$detail->SalesID}}</th>
                            <td>{{$detail->ProductID}}</td>
                            <td>{{$detail->ProductName}}</td>
                            <td>{{$detail->Quantity}}</td>
                            <!-- <td>{{$detail->LoadAmount}}</td> -->
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>
            </div>

        </div>

    </div>

@endsection

