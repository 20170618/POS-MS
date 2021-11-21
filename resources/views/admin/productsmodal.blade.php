<!-- Add Food Modal -->
<div id="addProductModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header blue-bg yellow">
                <h5 class="modal-title"><i class="fas fa-shopping-cart"></i> &nbsp;&nbsp;Add Product</h5>
                <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="saveform_errList"></div>
                <div class="form-group">
                    <label class="form-label mt-4">Product Name</label>

                        <input type="text" class="form-control" placeholder="Product Name" name="prodName" id="prodName"> 
                    <small id="productHelp" class="form-text text-muted">Must contain product unit in name.</small>
                </div>


                <div class="form-group">
                    <label class="form-label mt-4">Product Stock</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="0" name="prodStock" id="prodStock" min="0"> 
                    </div>
                </div>

                <div class="form-group">
                    <label>Product Price</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="0.00" name="prodPrice" id="prodPrice" min="1.00"> 
                    </div>
                </div>

                <div class="form-group">
                    <label>Product Category</label>
                    <div class="input-group mb-3">
                        <select class="form-select" id="prodCategory">
                            @foreach ($categories as $category)
                            <option value="{{$category->CategoryID}}">{{$category->CategoryName}}</option>
                            @endforeach
                            
                          </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Product Description</label>
                    <div class="input-group mb-3">
                        <textarea class="form-control" placeholder="Enter the Product's Description" name="prodDescription" id="prodDescription" rows="3"></textarea> 
                    </div>
                </div>

            </div> 
          
            <div class="modal-footer" style="text-align: right">
                <button class="btn btn-yellow add_product" type="button">Add</button>
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>
<!-- End Add Food Modal -->

<!-- View Food Modal -->
<div id="viewProductModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header blue-bg yellow">
                <h5 class="modal-title" id="modal-title"><i class="fas fa-shopping-cart"></i> &nbsp;&nbsp;Products</h5>
                <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group mb-3" style="width: 20rem">
                    <label for="productName" class="form-label mt-2">Search Product</label>
                    <div class="input-group">
                        <input type="text" class="form-control productName" aria-describedby="categoryHelp"
                            placeholder="Enter product name" name="productName" id="productName">
                    </div>
                </div>

                <div class="row">
                    <div class="container">
                        <table class="table table-hover" id="productsTable">
                            <thead style="text-align: center">
                            <tr class="table-yellow">
                                <th scope="col">Name</th>
                                <th scope="col" style="width: 20rem">Description</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                   

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- End View Food Modal -->

<!-- Start Delete -->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header blue-bg yellow">
                <h5 class="modal-title"><i class="fas fa-shopping-cart"></i> &nbsp;&nbsp;Delete Product</h5>
                <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="saveform_errList"></div>
                <input type="hidden" id="delete_p_id">
                <p>
                    You're about to delete this product:
                </p>

                <label for="delete_productName" class="col-sm-2 col-form-label">Product</label>
                <input type="text" name="delete_productName" id="delete_productName" value="" disabled>
                <br>
                <label for="delete_price" class="col-sm-2 col-form-label">Price</label>
                <input type="number" name="delete_price" id="delete_price" value="" disabled>

            </div> 
          
            <div class="modal-footer" style="text-align: right">
                <button class="btn btn-yellow delete_product_btn" type="button">Delete</button>
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>
<!-- End Delete Modal -->

<!-- Edit Modal -->
<div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header blue-bg yellow">
                <h5 class="modal-title"><i class="fas fa-shopping-cart"></i> &nbsp;&nbsp;Edit Product</h5>
                <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="saveform_errList"></div>
                <p>
                    You're about to edit this product's details:
                </p>

                <input type="hidden" id="edit_p_id">

                <div class="form-group">
                <label>Product Name</label>
         
                <input type="text" class="form-control" placeholder="Enter Product Name" id="edit_productName">
                
                <small id="productHelp" class="form-text text-muted">Must contain product unit in name.</small>
                </div>

                <div class="form-group">
                <label class="form-label mt-4">Product Stock</label>
                <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="Enter Stock" id="edit_stock" min="1">
                </div>
                </div>
        
                <div class="form-group">
                <label>Product Price</label>
                <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="Enter Price" id="edit_price" min="1">
                </div>
                </div>

                <div class="form-group">
                    <label>Product Category</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Enter Product Name" id="edit_category" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label>Product Description</label>
                    <div class="input-group mb-3">
                        <textarea class="form-control" placeholder="Enter the Product's Description" id="edit_desc" rows="3"></textarea> 
                    </div>
                </div>

            </div> 
          
            <div class="modal-footer" style="text-align: right">
                <button class="btn btn-yellow update_product" type="button">Update</button>
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>

  <!-- End Edit Modal -->
