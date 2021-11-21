var edit = document.getElementById('edit');
edit.addEventListener('click', function(){
    document.getElementById('FirstName').disabled = false;
    document.getElementById('LastName').disabled = false;


    document.getElementById('save').hidden = false;
    document.getElementById('cancel').hidden = false;

    document.getElementById('edit').hidden = true;
});

var save = document.getElementById('save');
save.addEventListener('click', function(e){
    document.getElementById('FirstName').disabled = true;
    document.getElementById('LastName').disabled = true;

    document.getElementById('save').hidden = true;
    document.getElementById('cancel').hidden = true;

    document.getElementById('edit').hidden = false;

    e.preventDefault();
    var u_id = $('#UserID').val();
    var data = {
      'FirstName' : $('#FirstName').val(),
      'LastName' : $('#LastName').val(),
    }
    console.log(u_id);
    console.log(data);

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: "PUT",
      url: "profile/update-user/"+u_id,
      data: data,
      dataType: "json",
      success: function (response) {
        if(response.status == 400){
          console.log(u_id);
        }else if(response.status == 404){
          console.log(u_id);

        }else{            
            window.location = window.location;
            
        }
      }
    });
});

var cancel = document.getElementById('cancel');
cancel.addEventListener('click', function(){
    document.getElementById('FirstName').disabled = true;
    document.getElementById('LastName').disabled = true;

    document.getElementById('save').hidden = true;
    document.getElementById('cancel').hidden = true;

    document.getElementById('edit').hidden = false;
    window.location = window.location;
});

