@extends('masterlayout.adminlayout')

@section('location')
    PRODUCTS
@endsection


@section('content')

    <div class="container" style="margin-top: 10px">
        <button class="btn btn-yellow" type="button" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>

        <div class="row" style="margin-top: 10px">
            @foreach ($categories as $category)
                
            
            <div class="col-4">
                
                <div class="card mb-3" style="max-width: 20rem;background-color: transparent">
                    <button class="btn btn-blue view_product" style="align-items: center" value="{{$category->CategoryID}}" id="view_product">
                    <div class="card-body" style="text-align: center">
                        <h6 style="text-align: center"><b>{{$category->CategoryName}}</b></h6>
                    </div>
                </button>
                </div>
                
            </div>
            @endforeach
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
                    <th scope="col" style="width: 20rem;">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Category</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody id="searchBody">

                </tbody>
            </table>
        </div>

        </div>

    </div>
@extends('admin.productsmodal')
    <script src="../../js/products.js"></script>
    <script>
        $(document).ready(function(){
        
        //fetch_customer_data();
        
         function fetch_customer_data(query = '')
         {
          $.ajax({
           url:"{{ route('products_search.action') }}",
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

        var categoryClick = 0;


        // SEACRCH UNDER PRODUCT CATEGORY
        $(document).on('keyup','#productName', function () {
            var query = $(this).val();

            var data = {
                'cID': parseInt(categoryClick),
                'query': query
            };

            console.log(data);

            $.ajax({
                type: "GET",
                url: "searchProductUnderCat",
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
                            var productD = response.products[i].Description;

                            var tr_str = "<tr style='text-align: center'>" +
                            "<td align='center'>" + productN + "</td>" +
                            "<td align='center'>" + productD + "</td>" +
                            "<td align='center'>" + productP + "</td>" +
                            "<td align='center'>" + productS + "</td>" +
                            "<td><button class='btn btn-info editProduct' value="+ id +" style='margin-right:2%'><i class='fas fa-pen'></i></button>"+
                            "<button class='btn btn-danger deleteProduct' value="+ id +"><i class='fas fa-trash'></i></button></td> " +
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