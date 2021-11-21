@extends('masterlayout.adminlayout')

@section('location')
    CATEGORY
@endsection

@section('content')

    <div class="container mb-4" style>
        <button class="add_category btn btn-yellow" style="margin-left: 10em" type="button" data-bs-toggle="modal"
            data-bs-target="#addCategoryModal">Add Category</button>

    </div>
    <div class="d-flex justify-content-center">

        <div class=" card border-secondary mb-3" style="width:80%">
            <h3 class="card-header">Categories</h3>
            <div class="card-body">
                <table class="table table-light" id='categoryTable'>
                    <thead class="thead-light">
                        <tr>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->CategoryName }}</td>
                                <td>{{ $category->Description }}</td>
                                <td><button class='btn btn-info editCategory' value="{{ $category->CategoryID }}"
                                        style='margin-right:2%' data-bs-target="#editCategoryModal"
                                        data-bs-toggle="modal"><i class='fas fa-pen'></i></button>
                                    <button class='btn btn-danger deleteCategory' value="{{ $category->CategoryID }}"
                                        data-bs-target="#deleteCategoryModal" data-bs-toggle="modal"><i
                                            class='fas fa-trash'></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>

    </div>

    <!-- Add Category Modal -->
    <div id="addCategoryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header blue-bg yellow">
                    <h5 class="modal-title"><i class="fas fa-th-list"></i> &nbsp;&nbsp;Add Category</h5>
                    <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="storeform_errList"></div>

                    <div class="form-group mb-3">
                        <label for="categoryname" class="form-label mt-2">Category Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control categoryname" aria-describedby="categoryHelp"
                                placeholder="Enter category name" name="categoryname" id="categoryname">
                        </div>
                        <small id="categoryHelp" class="form-text text-muted">Must be at least 5 characters and does not
                            contain symbols and numbers.</small>

                        <div id="resultsDiv" class="mt-2">
                        </div>
                    </div>

                    <div class="form-group" id="categorydescriptiondiv" hidden>
                        <label for="catDescription" class="form-label">Category Description</label>
                        <div class="input-group mb-3">
                            <textarea class="catDescription form-control" placeholder="Enter the Product's Description"
                                name="catDescription" id="catDescription" rows="3"></textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer" style="text-align: right">
                    <button class="btn btn-yellow store_category" type="button" id="add_category" disabled>Add</button>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div id="editCategoryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header blue-bg yellow">
                    <h5 class="modal-title"><i class="fas fa-th-list"></i> &nbsp;&nbsp;Edit Category</h5>
                    <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="updateform_errList"></div>
                    <input class="form-control editCategoryID" type="number" name="editCategoryID" id="editCategoryID"
                        hidden>
                    <div class="form-group mb-3">
                        <label for="editCategoryName" class="form-label mt-2">Category Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control editCategoryName" aria-describedby="categoryHelp"
                                placeholder="Enter category name" name="editCategoryName" id="editCategoryName" value="">
                        </div>
                        <small id="categoryHelp" class="form-text text-muted">Must be at least 5 characters and does not
                            contain symbols and numbers.</small>
                        <div id="resultsDiv" class="mt-2">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="editCatDescription" class="form-label">Category Description</label>
                        <div class="input-group mb-3">
                            <textarea class="editCatDescription form-control" placeholder="Enter the Product's Description"
                                name="editCatDescription" id="editCatDescription" rows="3" value=""></textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer" style="text-align: right">
                    <button class="btn btn-yellow update_category" type="button" id="update_category">Update</button>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Delete Category Modal -->
    <div id="deleteCategoryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header blue-bg yellow">
                    <h5 class="modal-title"><i class="fas fa-th-list"></i> &nbsp;&nbsp;Delete Category</h5>
                    <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">

                    <input class="form-control deleteCategoryID" type="number" name="deleteCategoryID" id="deleteCategoryID"
                        hidden>
                    <div class="form-group mb-3">
                        <label for="deleteCategoryName" class="form-label mt-2">Category Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control deleteCategoryName" aria-describedby="categoryHelp"
                                placeholder="Enter category name" name="deleteCategoryName" id="deleteCategoryName"
                                disabled>
                        </div>
                    </div>


                    <label for="deleteCatDescription" class="form-label">Category Description</label>
                    <div class="input-group mb-3">
                        <textarea class="deleteCatDescription form-control" placeholder="Enter the Product's Description"
                            name="deleteCatDescription" id="deleteCatDescription" rows="3" disabled></textarea>
                    </div>


                </div>

                <div class="modal-footer" style="text-align: right">
                    <button class="btn btn-yellow delete_category" type="button" id="delete_category">Delete</button>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>



@endsection

@push('category')
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#categoryTable').DataTable([]);

            //Category Name
            $(document).on('keyup', '#categoryname', function() {
                var query = $(this).val();
                var description = document.getElementById("categorydescriptiondiv");

                if (query.length < 5) {

                    document.getElementById("categoryHelp").innerHTML =
                        "Must be at least 5 characters and does not contain symbols and numbers.";
                    $(description).fadeOut();
                    document.getElementById("add_category").disabled = true;
                    $("#resultsDiv").empty();

                } else if (query != "") {
                    $.ajax({
                        type: "GET",
                        url: "categoryinput/" + query,
                        success: function(response) {

                            //Category is not unique
                            if (response.status == 123) {
                                document.getElementById("categoryHelp").innerHTML = response
                                    .message;
                                description.hidden = true;
                                document.getElementById("add_category").disabled = true;
                                $(description).fadeOut();

                                console.log(response.category);
                                var len = response.category.length;
                                $("#resultsDiv").empty();

                                for (var i = 0; i < len; i++) {
                                    var id = response.category[i].CategoryID;
                                    var categoryN = response.category[i].CategoryName;

                                    var tr_str =
                                        "<small class='form-text text-danger'><strong>Existing categories with like keywords:</strong></small><br>" +
                                        "<tr style='text-align: center'>" +
                                        "<td align='center'> <small class='form-text text-danger'>" +
                                        categoryN + "</small></td>" +
                                        "</tr>";

                                    $("#resultsDiv").append(tr_str);


                                }
                            }
                            //Category is unique
                            else if (response.status == 101) {
                                document.getElementById("categoryHelp").innerHTML = response
                                    .message;

                                $(description).fadeIn();
                                description.removeAttribute("hidden");
                                document.getElementById("add_category").disabled = false;
                            }
                            // Category is less than 5
                            else if (response.status == 404) {
                                document.getElementById("categoryHelp").innerHTML = response
                                    .message;
                                document.getElementById("add_category").disabled = true;
                                $(description).fadeOut();
                                $("#resultsDiv").empty();
                            }
                        }
                    });

                } else {
                    document.getElementById("categoryHelp").innerHTML =
                        "Must be at least 5 characters and does not contain symbols and numbers.";
                    $(description).fadeOut();
                    document.getElementById("add_category").disabled = true;
                    $("#resultsDiv").empty();
                }

            });



            //Add Category
            $(document).on('click', '.store_category', function(e) {
                e.preventDefault();

                var data = {
                    'categoryName': $('.categoryname').val(),
                    'catDescription': $('.catDescription').val()
                }

                console.log(data);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "store-category",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 400){
                            $('#storeform_errList').html("");
                            $('#storeform_errList').addClass('alert alert-danger');
                            $.each(response.errors, function (key, err_values) {
                            $('#storeform_errList').append('<li>' + err_values + '</li>');
                            })
                        }else
                        //success
                        if (response.status == 202) {
                            Swal.fire(
                                'Success!',
                                'The category has been successfully added.',
                                'success'
                            );
                            $('#addCategoryModal').modal('hide');
                            location.reload();
                        }

                    }
                });
            });

            // Edit
            $(document).on('click', '.editCategory', function(e) {
                e.preventDefault();
                var c_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "categories/edit-category/" + c_id,
                    success: function(response) {
                        if (response.status == 404) {
                            $('#pizza_message').html("");
                            $('#pizza_message').addClass('alert alert-danger');
                            $('#pizza_message').text(response.message);
                        } else {
                            $('#editCatDescription').val(response.category.Description);
                            $('#editCategoryName').val(response.category.CategoryName);
                            $('#editCategoryID').val(c_id);
                        }
                    }
                });
            });

            //Update changes from Edit modal
            $(document).on('click', '.update_category', function() {
                var category_id = $('.editCategoryID').val();

                var data = {
                    'CategoryName': $('.editCategoryName').val(),
                    'Description': $('.editCatDescription').val()
                }

                console.log(data);
                console.log(category_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "categories/update-category/" + category_id,
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 400) {
                            $('#updateform_errList').html("");
                            $('#updateform_errList').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values) {
                                $('#updateform_errList').append('<li>' + err_values +
                                    '</li>');
                            });

                        } else if (response.status == 404) {
                            $('#updateform_errList').html("");
                            $('#pizza_message').addClass('alert alert-info');
                            $('#pizza_message').text(response.message);

                        } else {
                            $('#updateform_errList').html("");
                            $('#pizza_message').html("");
                            $('#pizza_message').addClass('alert alert-info');
                            $('#pizza_message').text(response.message);

                            $('#editModal').modal('hide');

                            Swal.fire(
                                'Success!',
                                response.message,
                                'success'
                            ).then(function() {
                                window.location = window.location;
                            });
                        }
                    }
                });
                // $.ajax({
                //     type: "PUT",
                //     url: "update-category/"+category_id,
                //     data: "data",
                //     dataType: "dataType",
                //     success: function (response) {

                //     }
                // });

            });

            // Delete
            $(document).on('click', '.deleteCategory', function(e) {
                e.preventDefault();
                var c_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "categories/delete-category/" + c_id,
                    success: function(response) {
                        if (response.status == 404) {
                            $('#pizza_message').html("");
                            $('#pizza_message').addClass('alert alert-danger');
                            $('#pizza_message').text(response.message);
                        } else {
                            $('#deleteCatDescription').val(response.category.Description);
                            $('#deleteCategoryName').val(response.category.CategoryName);
                            $('#deleteCategoryID').val(c_id);
                        }
                    }
                });
            });

            $(document).on('click', '.delete_category', function(e) {
                    e.preventDefault();
                    var c_id = $('#deleteCategoryID').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                            type: "DELETE",
                            url: "categories/delete-product/" + c_id,
                            success: function(response) {
                                if (response.status == 404) {
                                    Swal.fire(
                                        'Error!',
                                        response.message,
                                        'error'
                                    ).then(function() {
                                        $('#deleteCategoryModal').modal('hide');;
                                    });

                                } else {

                                    $('#pizza_message').addClass('alert alert-info');
                                    $('#pizza_message').text(response.message);
                                    $('#deleteModal').modal('hide');

                                    Swal.fire(
                                        'Success!',
                                        response.message,
                                        'success'
                                    ).then(function() {
                                        window.location = window.location;
                                    });
                                }
                            }
                    });
                //End Delete


            });
        });
    </script>
@endpush
