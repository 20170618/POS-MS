function changeDisplayCategory() {
  var cat = document.getElementById("prodCategory").value;
  if(cat == "Consumable" || cat == "Non-Consumable"){
    document.getElementById('PPrice').hidden = false;
    document.getElementById('PStock').hidden = false;
    document.getElementById('POperator').hidden = true;
  }else if(cat == "E-Load Regular"){
    document.getElementById('PPrice').hidden = true;
    document.getElementById('PStock').hidden = true;
    document.getElementById('POperator').hidden = false;
  }else if(cat == "E-Load Promo"){
    document.getElementById('PPrice').hidden = false;
    document.getElementById('PStock').hidden = true;
    document.getElementById('POperator').hidden = false;
  }
}

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
  $('#productName').val("");
  categoryClick = $(this).val();
  var c_id = $(this).val();
  $("#productsTable").html('');
  $('#viewProductModal').modal('show');
  $.ajax({
    type: "GET",
    url: "products/view-products/" + c_id,
    success: function (data) {
      var len = data.products.length;
      console.log(data.category);

      var tableHeader = "<thead style='text-align: center'>\
      <tr class='table-yellow'>\
          <th scope='col'>Name</th>\
          <th scope='col'>Price</th>\
          <th scope='col'>Stock</th>\
          <th scope='col'>Actions</th>\
      </tr>\
      </thead>";

      $("#productsTable").append(tableHeader);

      var tableStart =
      "</thead>\
      <tbody>";
      $("#productsTable").append(tableStart);
      for (var i = 0; i < len; i++) {
        var id = data.products[i].ProductID;
        var productN = data.products[i].ProductName;
        var productP = data.products[i].Price;
        var productS = data.products[i].Stock;
        if (productS <= 5) {
          var tr_str = 
          "<tr style='text-align: center' class='table-yellow'>" +
          "<td align='center'>" + productN + "</td>" +
          "<td align='center'>" + productP + "</td>" +
          "<td align='center'>" + productS + "</td>" +
          "<td><button class='btn btn-info editProduct' value="+ id +" style='margin-right:2%'><i class='fas fa-pen'></i></button>"+
          "<button class='btn btn-danger deleteProduct' value="+ id +"><i class='fas fa-trash'></i></button></td> " +
          "</tr>";

        } else {
          var tr_str = "<tr style='text-align: center'>" +
          "<td align='center'>" + productN + "</td>" +
          "<td align='center'>" + productP + "</td>" +
          "<td align='center'>" + productS + "</td>" +
          "<td><button class='btn btn-info editProduct' value="+ id +" style='margin-right:2%'><i class='fas fa-pen'></i></button>"+
          "<button class='btn btn-danger deleteProduct' value="+ id +"><i class='fas fa-trash'></i></button></td> " +
          "</tr>";

        }
        $("#productsTable").append(tr_str);
      }
      var tableEnd = "</tbody>";
      $("#productsTable").append(tableEnd);


    }
  });
});

$(document).on('click', '.view_product2', function (e) {
  e.preventDefault();
  $('#productName').val("");
  categoryClick = $(this).val();
  console.log(categoryClick);
  var c_id = $(this).val();
  $("#productsTable tbody").html('');
  $('#viewProductModal').modal('show');
  $.ajax({
    type: "GET",
    url: "salesperson/products/view-products/" + c_id,
    success: function (data) {
      var len = data.products.length;

      for (var i = 0; i < len; i++) {
        var id = data.products[i].ProductID;
        var productN = data.products[i].ProductName;
        var productP = data.products[i].Price;
        var productS = data.products[i].Stock;

        var tr_str = "<tr style='text-align: center'>" +
          "<td align='center'>" + productN + "</td>" +
          "<td align='center'>" + productP + "</td>" +
          "<td align='center'>" + productS + "</td>" +
          "</tr>";

        $("#productsTable tbody").append(tr_str);
      }


    }
  });
});

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
        $('#delete_stock').val(response.product.Stock);
        $('#delete_p_id').val(p_id);

        if (response.product.Stock == 0) {
          document.getElementById("delete_product_btn").disabled = false;
        } else {
          document.getElementById("delete_product_btn").disabled = true;
        }
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
        $('#edit_category').val(response.product.Category);
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
    'Category': $('#edit_category').val(),
    'Stock': $('#edit_stock').val(),
  }

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
          $('#updateform_errList').append('<li>' + err_values + '</li>');
        });
      } else {
        $('#updateform_errList').html("");
        $('#editModal').modal('hide');

        Swal.fire(
          'Success!',
          response.message,
          'success'
        ).then(function(){
          
        });
      }
    }
  });
});
