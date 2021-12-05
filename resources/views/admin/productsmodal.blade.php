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
                    <small id="productHelp" class="form-text text-muted">Product unit in name is recommended.</small>
                </div>

                <div class="form-group">
                    <label for="prodCategory" class="form-label mt-3">Product Category</label>
                    <select class="form-select" id="prodCategory" name="prodCategory" onchange="changeDisplayCategory()">
                        <option value="Consumable" id="C">Consumable</option>
                        <option value="Non-Consumable" id="NC">Non-Consumable</option>
                        <option value="E-Load Promo" id="EP">E-Load Promo</option>
                    </select>
                </div>

                <div class="form-group" id="PPrice">
                    <label class="form-label mt-4">Product Price</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="0.00" name="prodPrice" id="prodPrice" min="1.00"> 
                    </div>
                </div>

                <div class="form-group" id="PStock">
                    <label>Product Stock</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="0" name="prodStock" id="prodStock" min="0"> 
                    </div>
                </div>

                <div class="form-group" id="POperator" hidden>
                    <label for="prodOperator" class="form-label mt-3">E-Load Operator</label>
                    <select class="form-select" id="prodOperator" name="prodOperator">
                        <option value="SMART/TNT" id="1">SMART/TNT</option>
                        <option value="GLOBE/TM" id="2">GLOBE/TM</option>
                    </select>
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
                            {{-- <thead style="text-align: center">
                            <tr class="table-yellow">
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                   

                            </tbody> --}}
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
                
                <input type="hidden" id="delete_p_id">
                <p>
                    You're about to delete this product:
                </p>
                <div class="form-group">
                    <label for="delete_productName" class="col-sm-2 col-form-label">Product</label>
                    <input type="text" name="delete_productName" id="delete_productName" value="" disabled>
                </div>
                <br>
                <div class="form-group">
                    <label for="delete_price" class="col-sm-2 col-form-label">Price</label>
                    <input type="number" name="delete_price" id="delete_price" value="" disabled>
                </div>
                
                
                <small id="deleteSmall">Stock must be 0 for product to be deleted.</small>
                
                <br>

                <div class="form-group">
                    <label for="delete_price" class="col-sm-2 col-form-label" id="deleteLabel">Stock</label>
                    <input type="number" name="delete_stock" id="delete_stock" value="" disabled>
                 </div>
                
                
            </div> 
            
          
            <div class="modal-footer" style="text-align: right">
                <button class="btn btn-yellow delete_product_btn" type="button" id="delete_product_btn">Delete</button>
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
                <div id="updateform_errList"></div>
                <p>
                    You're about to edit this product's details:
                </p>

                <input type="hidden" id="edit_p_id">

                <div class="form-group">
                <label>Product Name</label>
         
                <input type="text" class="form-control" placeholder="Enter Product Name" id="edit_productName">
                
                <small id="productHelp" class="form-text text-muted">Product unit in name is recommended.</small>
                </div>

                <div class="form-group">
                    <label class="form-label mt-4">Product Category</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Enter Product Name" id="edit_category" readonly>
                    </div>
                </div>

                <div class="form-group">
                <label class="form-label mt-4">Product Price</label>
                <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="0.00" id="edit_price" min="1">
                </div>

                <div class="form-group" id="stockDiv">
                <label class="form-label" id="stockLabel">Product Stock</label>
                <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="0" id="edit_stock" min="1">
                </div>
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
