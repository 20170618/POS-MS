<!-- Add Food Modal -->
<div id="addFoodModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header blue-bg yellow">
                <h5 class="modal-title">Add Food <i class="fas fa-utensils"></i></h5>
                <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label>Product Name</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Product Name" name="foodName" id="foodName"> 
                    </div>
                </div>

                <div class="form-group">
                    <label>Product Price</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="0.00" name="foodPrice" id="foodPrice"> 
                    </div>
                </div>

                <div class="form-group" hidden>
                    <label>Product Category</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="food" name="foodCategory" id="foodCategory"> 
                    </div>
                </div>

            </div> 
          
            <div class="modal-footer" style="text-align: right">
                <button class="btn btn-yellow add_food" type="button">Add</button>
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>
<!-- End Add Food Modal -->

<!-- View Food Modal -->
<div id="viewFoodModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header blue-bg yellow">
                <h5 class="modal-title">Food Products</h5>
                <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="container">
                        <table class="table table-hover">
                            <thead style="text-align: center">
                            <tr class="table-yellow">
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                            </tr>
                            </thead>
                            <tbody>
        
                            @foreach ($foodProducts as $foodProduct)
                                <tr style="align-content: center; text-align: center;">
                                    <th scope="row">{{$foodProduct->ProductName}}</th>
                                    <td>&#8369; {{number_format($foodProduct->Price, 2)}}</td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- End View Food Modal -->

<!-- Start Add non-Food Modal -->
<div id="addNonFoodModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header blue-bg yellow">
                <h5 class="modal-title">Add Non-Food <i class="fas fa-air-freshener"></i></h5>
                <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label>Product Name</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Product Name" name="nonFoodName" id="nonFoodName"> 
                    </div>
                </div>

                <div class="form-group">
                    <label>Product Price</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="0.00" name="nonFoodPrice" id="nonFoodPrice"> 
                    </div>
                </div>

                <div class="form-group" hidden>
                    <label>Product Category</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="nonFood" name="nonFoodCategory" id="nonFoodCategory"> 
                    </div>
                </div>

            </div> 
          
            <div class="modal-footer" style="text-align: right">
                <button class="btn btn-yellow add_nonFood" type="button">Add</button>
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>
<!-- End Add non-Food Modal -->

<!-- Start view non-food Modal -->
<div id="viewNonFoodModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header blue-bg yellow">
                <h5 class="modal-title">Non-Food Products</h5>
                <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="container">
                        <table class="table table-hover">
                            <thead style="text-align: center">
                            <tr class="table-yellow">
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                            </tr>
                            </thead>
                            <tbody>
        
                            @foreach ($nonFoodProducts as $nonFoodProduct)
                                <tr style="align-content: center; text-align: center;">
                                    <th scope="row">{{$nonFoodProduct->ProductName}}</th>
                                    <td>&#8369; {{number_format($nonFoodProduct->Price, 2)}}</td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- End view non-food Modal -->

<!-- Start Add E-Load Modal -->
<div id="addELoadModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header blue-bg yellow">
                <h5 class="modal-title">Add E-Load <i class="fas fa-mobile-alt"></i></h5>
                <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label>E-Load Name</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Product Name" name="eLoadName" id="eLoadName"> 
                    </div>
                </div>

                <div class="form-group">
                    <label>E-Load Price</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="0.00" name="eLoadPrice" id="eLoadPrice"> 
                    </div>
                </div>

                <div class="form-group" hidden>
                    <label>Product Category</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="eLoad" name="eLoadCategory" id="eLoadCategory"> 
                    </div>
                </div>

            </div> 
          
            <div class="modal-footer" style="text-align: right">
                <button class="btn btn-yellow add_eLoad" type="button">Add</button>
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>
<!-- End add E-Load Modal -->

<!-- Start view E-Load Modal -->
<div id="viewELoadModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header blue-bg yellow">
                <h5 class="modal-title">E-Load</h5>
                <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="container">
                        <table class="table table-hover">
                            <thead style="text-align: center">
                            <tr class="table-yellow">
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                            </tr>
                            </thead>
                            <tbody>
        
                            @foreach ($eLoads as $eLoad)
                                <tr style="align-content: center; text-align: center;">
                                    <th scope="row">{{$eLoad->ProductName}}</th>
                                    <td>&#8369; {{number_format($eLoad->Price, 2)}}</td>

                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- End view E-Load Modal -->