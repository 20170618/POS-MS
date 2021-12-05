
<!DOCTYPE html>
<html lang="en"></html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{csrf_token()}}"> {{-- You need this to run CRUD operations --}}

        <title>Point of Sale Migui's Store</title>
     
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link href="../../../css/bootstrap.css" rel="stylesheet">
        <link href="../../../css/sidebar.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

        <script src="https://kit.fontawesome.com/ad9a071612.js" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
        </script>

        <script src="../../../js/sidebar.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>

    <body>
        <div class="container-fluid">
            <div class="container-fluid">
                
            
                <div class="row">
        
                    <h2 style="margin-top: 5px">
                        REPORT PREVIEW
                        <button class="btn btn-yellow" id="GenerateButton" type="submit" style="float: right">Export To PDF</button>
                    </h2>

                    <hr>

                    <div class="row">
                        <h4 style="text-align: center">Migui's Store Report</h4>
                        <h5 style="text-align: center">Date Created: {{$now}}</h5>
                        <h5 style="text-align: center">Start Date: {{$startDate}} End Date: {{$endDate}}</h3>
                    </div>
                        <div class="row">
                            <div class="col">
                                <h5>Number of Sales: {{$sales}}</h5>
                            </div>
                            <div class="col">
                                <h5>Number of Debts: {{$debts}}</h5>
                            </div>
                        </div>
                        
                        
                            
                            <h5 style="text-align: center">Sales Breakdown</h5>

                            @if (in_array('Consumable', $categories) || in_array('allCheck', $categories))
                                <div>
                            @else
                                <div hidden>
                            @endif
                            
                                <h5>Consumable</h5>
                                <table class="table table-light">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Product Name</th>
                                            <th># Sold</th>
                                            <th>Sale Per Product</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        @if ($consumableSales == '[]')
                                            <tr>
                                                <td colspan="3" style="text-align: center">No Products</td>
                                            </tr> 
                                        @else
                                            @php
                                            $totalCon = 0    
                                            @endphp
                                            @foreach ($consumableSales as $consumableSale)
                                            <tr>
                                                <td>{{$consumableSale->ProductName}}</td>
                                                <td>{{$consumableSale->sold}}</td>
                                                <td>{{$consumableSale->cost}}</td>
                                            </tr>
                                            @php
                                            $totalCon += $consumableSale->cost    
                                            @endphp
                                            @endforeach
                                            <tr>
                                                <td colspan="2" style="text-align: right">Total:</td>
                                                <td><b>{{$totalCon}}</b></td>
                                            </tr>

                                                

                                        @endif                                  
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                            @if (in_array('Non-Consumable', $categories) || in_array('allCheck', $categories))
                                <div>
                            @else
                                <div hidden>
                            @endif
                            
                                <h5>Non-Consumable</h5>
                                <table class="table table-light">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Product Name</th>
                                            <th># Sold</th>
                                            <th>Sale Per Product</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        @if ($nonConsumableSales == '[]')
                                            <tr>
                                                <td colspan="3" style="text-align: center">No Products</td>
                                            </tr> 
                                        @else
                                            @php
                                            $totalNCon = 0    
                                            @endphp
                                            @foreach ($nonConsumableSales as $nonConsumableSale)
                                            <tr>
                                                <td>{{$nonConsumableSale->ProductName}}</td>
                                                <td>{{$nonConsumableSale->sold}}</td>
                                                <td>{{$nonConsumableSale->cost}}</td>
                                            </tr>
                                            @php
                                            $totalNCon += $nonConsumableSale->cost
                                            @endphp
                                            
                                            @endforeach
                                            <tr>
                                                <td colspan="2" style="text-align: right">Total:</td>
                                                <td><b>{{$totalNCon}}</b></td>
                                            </tr>
                                        @endif                                  
                                        
                                    </tbody>
                                </table>
                            </div>

                            @if (in_array('E-Load', $categories) || in_array('allCheck', $categories))
                                <div>
                            @else
                                <div hidden>
                            @endif
                            
                                <h5>E-Load</h5>
                                <table class="table table-light">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Sale Per Product</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        @if ($eLoadSales == '[]')
                                            <tr>
                                                <td colspan="3" style="text-align: center">No Products</td>
                                            </tr> 
                                        @else
                                            @php
                                            $totalELoad = 0    
                                            @endphp
                                            @foreach ($eLoadSales as $eLoadSale)
                                            <tr>
                                                <td>{{$eLoadSale->ProductName}}</td>
                                                <td>{{$eLoadSale->sold}}</td>
                                            </tr>
                                            @php
                                            $totalELoad += $eLoadSale->sold
                                            @endphp
                                            
                                            @endforeach
                                            <tr>
                                                <td colspan="1" style="text-align: right">Total:</td>
                                                <td><b>{{$totalELoad}}</b></td>
                                            </tr>
                                        @endif                                  
                                        
                                    </tbody>
                                </table>
                            </div>

                            <h5 style="text-align: center">Products Out of Stock</h5>
                            <table class="table table-light">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Stock</th>
                                    </tr>
                                     
                                </thead>
                                <tbody>
                                    @if ($outOfStocks == '[]')
                                        <tr>
                                            <td colspan="3" style="text-align: center">No Products</td>
                                        </tr> 
                                    @else
                                        @foreach ($outOfStocks as $outOfStock)
                                        <tr>
                                            <td>{{$outOfStock->ProductName}}</td>
                                            <td>{{$outOfStock->Category}}</td>
                                            <td>{{$outOfStock->Stock}}</td>
                                        </tr> 
                                        @endforeach
                                    @endif                                  
                                     
                                </tbody>
                            </table>
    
    
                </div>
            </div>
        </div>
    </body>
</html>
