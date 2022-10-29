<!DOCTYPE html>
<html>
<head>
<title>Laravel 8 Ajax Form using jQuery Validation</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<style>
.error{
color: #FF0000;
}
</style>
</head>
<body>
<div class="container mt-4">
<div class="card">
<div class="card-header text-center font-weight-bold">
<h2>Ajax Post Form Data</h2>
</div>
<div class="card-body">
<form enctype="multipart/form-data" action="{{route('storedata')}}" name="contactUsForm" id="contactUsForm" method="post">
    @csrf
    <div id="res"></div>
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" id="name" name="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" id="email" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Phone</label>
        <input type="number" id="phone" name="phone" class="form-control">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Description</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Role id</label>
        <input type="number" id="role_id" name="role_id" require class="form-control">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Image</label>
        <input type="file" id="image" name="image" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
</form>
</div>
</div>
</div>
<script>
if ($("#contactUsForm").length > 0) {
    $("#contactUsForm").validate({
    rules: {
        name: {
        required: true,
        maxlength: 50
        },
        email: {
        required: true,
        maxlength: 50,
        email: true,
        },
        description: {
        required: true,
        maxlength: 300
        },
        phone: {
        required: true,
        maxlength: 10
        },
        role_id: {
        required: true,
        },

    },

    submitHandler: function(form) {
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    // $('#submit').html('Please Wait...');
    // $("#submit"). attr("disabled", true);
    $.ajax({
        url: "storedata",
        type: "POST",
        data: $('#contactUsForm').serialize(),
        enctype:'multipart/form-data',
        success: function( response ) {
            if(response.code==400){

                let error='<span class="alert alert-danger">'+response.msg+'</span>';
                $("#res").html(error);
            }
        // $('#submit').html('Submit');
        // $("#submit"). attr("disabled", false);
        alert(response.msg);
        //document.getElementById("contactUsForm").reset();
        }
    });
    }
})
}
</script>
</body>
</html>
