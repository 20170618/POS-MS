
// Add Food
$(document).on('click', '.add_product', function (e) {
  e.preventDefault();
  var data = {
    'ProductName': $('#prodName').val(),
    'Price': $('#prodPrice').val(),
    'Category': $('#prodCategory').val(),
    'Stock': $('#prodStock').val(),
    'Description': $('#prodDescription').val(),
  }
  console.log(data);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    type: "POST",
    url: "products",
    data: data,
    dataType: "json",
    success: function (response) {

      if (response.status == 400) {
        $('#saveform_errList').html("");
        $('#saveform_errList').addClass('alert alert-danger');
        $.each(response.errors, function (key, err_values) {
          $('#saveform_errList').append('<li>' + err_values + '</li>');
        })
      } else {
        $('#saveform_errList').html("");
        $('#pizza_message').addClass('alert alert-info');
        $('#pizza_message').text(response.message);
        $('#addProductModal').modal('hide');
        $('#addProductModal').find('input').val("");

        Swal.fire(
            'Success!',
            response.message,
            'success'
        ).then(function(){
          window.location = window.location;
        });

      }
    }
  });
});
// End Add Food

// View
$(document).on('click', '.view_product', function (e) {
  e.preventDefault();
  categoryClick = $(this).val();
  console.log(categoryClick);
  var c_id = $(this).val();
  $("#productsTable tbody").html('');
  $('#viewProductModal').modal('show');
  $.ajax({
    type: "GET",
    url: "products/view-products/" + c_id,
    success: function (data) {
      var len = data.products.length;

      for (var i = 0; i < len; i++) {
        var id = data.products[i].ProductID;
        var productN = data.products[i].ProductName;
        var productP = data.products[i].Price;
        var productS = data.products[i].Stock;
        var productD = data.products[i].Description;

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
  });
});

$(document).on('click', '.view_product2', function (e) {
  e.preventDefault();
  categoryClick = $(this).val();
  console.log(categoryClick);
  var c_id = $(this).val();
  $("#productsTable tbody").html('');
  $('#viewProductModal').modal('show');
  $.ajax({
    type: "GET",
    url: "products/view-products/" + c_id,
    success: function (data) {
      var len = data.products.length;

      for (var i = 0; i < len; i++) {
        var id = data.products[i].ProductID;
        var productN = data.products[i].ProductName;
        var productP = data.products[i].Price;
        var productS = data.products[i].Stock;
        var productD = data.products[i].Description;

        var tr_str = "<tr style='text-align: center'>" +
          "<td align='center'>" + productN + "</td>" +
          "<td align='center'>" + productD + "</td>" +
          "<td align='center'>" + productP + "</td>" +
          "<td align='center'>" + productS + "</td>" +
          "</tr>";

        $("#productsTable tbody").append(tr_str);
      }


    }
  });
});

// Add E-Load
$(document).on('click', '.add_eLoad', function (e) {
  e.preventDefault();
  var data = {
    'ProductName': $('#eLoadName').val(),
    'Price': $('#eLoadPrice').val(),
    'Category': $('#eLoadCategory').val(),
  }
  console.log(data);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    type: "POST",
    url: "products",
    data: data,
    dataType: "json",
    success: function (response) {

      if (response.status == 400) {
        $('#saveform_errList').html("");
        $('#saveform_errList').addClass('alert alert-danger');
        $.each(response.errors, function (key, err_values) {
          $('saveform_errList').append('<li>' + err_values + '</li>');
        })
      } else {
        $('#saveform_errList').html("");
        $('#pizza_message').addClass('alert alert-info');
        $('#pizza_message').text(response.message);
        $('#addELoadModal').modal('hide');
        $('#addELoadModal').find('input').val("");
        window.location = window.location;
      }
    }
  });
});
// End Add E-Load

// Delete
$(document).on('click', '.deleteProduct', function (e) {
  e.preventDefault();
  var p_id = $(this).val();
  $('#deleteModal').modal('show');
  $('#viewProductModal').modal('hide');
  $.ajax({
    type: "GET",
    url: "products/delete-product/" + p_id,
    success: function (response) {
      if (response.status == 404) {
        $('#pizza_message').html("");
        $('#pizza_message').addClass('alert alert-danger');
        $('#pizza_message').text(response.message);
      } else {
        $('#delete_productName').val(response.product.ProductName);
        $('#delete_price').val(response.product.Price);
        $('#delete_p_id').val(p_id);
      }
    }
  });
});

$(document).on('click', '.delete_product_btn', function (e) {
  e.preventDefault();
  var p_id = $('#delete_p_id').val();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    type: "DELETE",
    url: "products/delete-product/" + p_id,
    success: function (response) {
      $('#pizza_message').addClass('alert alert-info');
      $('#pizza_message').text(response.message);
      $('#deleteModal').modal('hide');

      Swal.fire(
        'Success!',
        response.message,
        'success'
      ).then(function(){
        window.location = window.location;
      });
    }
  });
});
// End Delete

// Edit
$(document).on('click', '.editProduct', function (e) {
  e.preventDefault();
  var p_id = $(this).val();
  $('#editModal').modal('show');
  $('#viewProductModal').modal('hide');
  $.ajax({
    type: "GET",
    url: "products/edit-product/" + p_id,
    success: function (response) {
      if (response.status == 404) {
        $('#pizza_message').html("");
        $('#pizza_message').addClass('alert alert-danger');
        $('#pizza_message').text(response.message);
      } else {
        $('#edit_productName').val(response.product.ProductName);
        $('#edit_price').val(response.product.Price);
        $('#edit_stock').val(response.product.Stock);
        $('#edit_category').val(response.category.CategoryName);
        $('#edit_desc').val(response.product.Description);
        $('#edit_p_id').val(p_id);
      }
    }
  });
});

// Update
$(document).on('click', '.update_product', function (e) {
  e.preventDefault();
  var p_id = $('#edit_p_id').val();
  var data = {
    'ProductName': $('#edit_productName').val(),
    'Price': $('#edit_price').val(),
    'Stock': $('#edit_stock').val(),
    'Description': $('#edit_desc').val(),
  }
  console.log(p_id);
  console.log(data);

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    type: "PUT",
    url: "products/update-product/" + p_id,
    data: data,
    dataType: "json",
    success: function (response) {
      if (response.status == 400) {
        $('#updateform_errList').html("");
        $('#updateform_errList').addClass('alert alert-danger');
        $.each(response.errors, function (key, err_values) {
          $('updateform_errList').append('<li>' + err_values + '</li>');
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
        ).then(function(){
          window.location = window.location;
        });
      }
    }
  });
});
