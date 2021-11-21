@extends('masterlayout.salespersonlayout')

@section('location')
    PRODUCTS
@endsection


@section('content')

<div class="container" style="margin-top: 10px">
        

    <div class="row">
        <div class="col">
            <div class="card text-white mb-3 blue-bg" style="max-width: 20rem;">
            
                <div class="card-body" style="text-align: center">
                    <i class="fas fa-utensils fa-5x"></i>
                    
                </div>
                    &nbsp;

                    <h4 style="text-align: center"><b>FOOD</b></h4>

                    &nbsp;

                <div class="card-footer" style="text-align: center">
                    <button class="btn btn-yellow" type="button" data-bs-toggle="modal" data-bs-target="#viewFoodModal">View</button>
                </div>
                
            </div>
        </div>

        <div class="col">
            <div class="card text-white mb-3 blue-bg" style="max-width: 20rem;">
            
                <div class="card-body" style="text-align: center">
                    <i class="fas fa-air-freshener fa-5x"></i>
                    
                </div>
                    &nbsp;

                    <h4 style="text-align: center"><b>NON-FOOD</b></h4>

                    &nbsp;

                <div class="card-footer" style="text-align: center">
                <button class="btn btn-yellow" type="button" data-bs-toggle="modal" data-bs-target="#viewnonFoodModal">View</button>
                </div>
                
            </div>
        </div>

        <div class="col">
            <div class="card text-white mb-3 blue-bg" style="max-width: 20rem;">
            
                <div class="card-body" style="text-align: center">
                    <i class="fas fa-mobile-alt fa-5x"></i>
                    
                </div>
                    &nbsp;

                    <h4 style="text-align: center"><b>E-LOAD</b></h4>

                    &nbsp;

                <div class="card-footer" style="text-align: center">
                <button class="btn btn-yellow" type="button" data-bs-toggle="modal" data-bs-target="#viewELoadModal">View</button>
                </div>
                
            </div>
        </div>

    </div>

    <hr>

    <a><h5>Search Product</h5></a>
    <div class="form-group">

    <div class="input-group mb-3" style="width: 20rem">
        <input type="text" name="search" id="search" class="form-control" placeholder="Search" />
    </div>

    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
            </tr>
            </thead>
            <tbody id="searchBody">

            </tbody>
        </table>
    </div>

    </div>

</div>

@extends('salesperson.productsmodal')
    <script src="../../js/products.js"></script>
    <script>
        $(document).ready(function(){
        
        // fetch_customer_data();
        
         function fetch_customer_data(query = '')
         {
          $.ajax({
           url:"{{ route('product_search.action') }}",
           method:'GET',
           data:{query:query},
           dataType:'json',
           success:function(data)
           {
            $('#searchBody').html(data.table_data);
            $('#total_records').text(data.total_data);
           }
          })
         }
        
         $(document).on('keyup', '#search', function(){
          var query = $(this).val();
          fetch_customer_data(query);
         });
        });
    </script>
@endsection