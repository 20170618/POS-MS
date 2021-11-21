<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{csrf_token()}}"> {{-- You need this to run CRUD operations --}}

        <title>

        @yield('title',"POS-MS")

        </title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link href="../../css/bootstrap.css" rel="stylesheet">
        
        <script src="https://kit.fontawesome.com/ad9a071612.js" crossorigin="anonymous"></script>    
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        
    </head>

    <body>     
        <div class="container-fluid " style="height: 100vh">
            <div class="row " style="height: 100%">
                
                <div class="row col-6 d-flex align-items-center" >
                    <div class="col-md-12 d-block text-center">

                    <img class="" src="../../images/migui store.png" alt="migui store" style="width: 60%">
                    <br>
                    <h6 class="text-muted">POINT-OF-SALE-SYSTEM</h6>
                
                    </div>                 
                </div> 

                <div class="col-6 d-flex align-items-center" >
                    
                    <div class="card text-white mb-3 blue-bg" style="width: 30rem;">
                        <div class="card-body">
                        <h4 class="card-title yellow"><b>Log in</b></h4>

                        <form>
                            <fieldset>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label mt-4 yellow">Username or Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username or Email">

                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1" class="form-label mt-4 yellow">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                <small class="yellow">Forgot your Password? <a href="" data-bs-toggle="modal" data-bs-target="#Modal1">Recover your account here.</a></small>
                            </div>

                            &nbsp;

                            <div class="row">
                                <div class="col-8">
                                    <small class="yellow">Don't have an account? <a href="register">Sign up here</a></small>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <a href="admin/home">
                                            <button type="button" class="btn btn-warning btn-yellow blue"><b>Log in</b></button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            </fieldset>
                        </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        @extends('recovmodal')

    </body>
</html>