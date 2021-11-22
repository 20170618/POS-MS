@extends('masterlayout.salespersonlayout')

@section('location')
    PRODUCTS
@endsection


@section('content')

    

<div class="col-6">
    
                <div class="card mb-3" style="max-width: 20rem;background-color: transparent" >
                    <button class="btn btn-blue view_product2" style="align-items: center" value="Consumable" id="view_product2">
                    <div class="card-body" style="text-align: center">
                        <h6 style="text-align: center"><b>Consumable</b></h6>
                    </div>
                </button>
                </div>

            </div>

            <div class="col-6">

                <div class="card mb-3" style="max-width: 20rem;background-color: transparent">
                    <button class="btn btn-blue view_product2" style="align-items: center" value="Non-Consumable" id="view_product2">
                    <div class="card-body" style="text-align: center">
                        <h6 style="text-align: center"><b>Non-Consumable</b></h6>
                    </div>
                </button>
                </div>

            </div>

            <div class="col-6">

                <div class="card mb-3" style="max-width: 20rem;background-color: transparent">
                    <button class="btn btn-blue view_product2" style="align-items: center" value="E-Load Regular" id="view_product2">
                    <div class="card-body" style="text-align: center">
                        <h6 style="text-align: center"><b>E-Load Regular</b></h6>
                    </div>
                </button>
                </div>

            </div>

            <div class="col-6">

                <div class="card mb-3" style="max-width: 20rem;background-color: transparent">
                    <button class="btn btn-blue view_product2" style="align-items: center" value="E-Load Promo" id="view_product2">
                    <div class="card-body" style="text-align: center">
                        <h6 style="text-align: center"><b>E-Load Promo</b></h6>
                    </div>
                </button>
                </div>

            </div>
        </div>

        <hr>

        

        <a><h5>Search Product</h5></a>
        <div class="form-group">
            <div class="form-group" style="width: 20rem;">
                <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                  <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                </div>
            </div>

        <div class="container">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
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

        //fetch_customer_data();

         function fetch_customer_data(query = '')
         {
          $.ajax({
           url:"{{ route('salespersonproduct_search.action') }}",
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

        var categoryClick = '';


        // SEACRCH UNDER PRODUCT CATEGORY
        $(document).on('keyup','#productName', function () {
            var query = $(this).val();

            var data = {
                'cID': categoryClick,
                'query': query
            };

            console.log(data);

            $.ajax({
                type: "GET",
                url: "salespersonsearchProductUnderCat",
                data: data,
                dataType: "json",
                success: function (response) {

                    //success
                    if(response.status=200){
                        var len = response.products.length;
                        console.log(response.products);
                        $("#productsTable tbody").empty();
                        for (var i = 0; i < len; i++) {
                            var id = response.products[i].ProductID;
                            var productN = response.products[i].ProductName;
                            var productP = response.products[i].Price;
                            var productS = response.products[i].Stock;
                         

                            var tr_str = "<tr style='text-align: center'>" +
                            "<td align='center'>" + productN + "</td>" +
                            "<td align='center'>" + productP + "</td>" +
                            "<td align='center'>" + productS + "</td>" +
                            "</tr>";

                            $("#productsTable tbody").append(tr_str);
                        }
                    }
                }
            });

        });

    </script>

    @if ($message = Session::get('success'))
        <script>
            console.log('{{$message}}');
            Swal.fire(
                'Success!',
                '{{$message}}',
                'success'
            )
        </script>
    @endif
@endsection
