
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
