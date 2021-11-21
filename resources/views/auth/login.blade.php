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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>     
            @if ($message = Session::get('success'))
                <script>
                    console.log('{{$message}}');
                    Swal.fire(
                        'Success!',
                        '{{$message}}',
                        'success'
                    )
                </script>
            @endif
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

                        @if(Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <strong>Error!</strong> {!! session('error') !!}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="form-label mt-4 yellow">{{ __('E-Mail Address') }}</label>


                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter E-Mail Address">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label mt-4 yellow">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                @if (Route::has('password.request'))
                                <small class="yellow">Forgot your Password?
                                <a href="{{ route('password.request') }}">
                                    {{ __('Recover your account here.') }}
                                </a>
                                </small>
                                @endif  
                                
                            </div>

                            <div class="form-group">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            

                            

                            <div class="form-group" style="align-content: center;text-align: center">
                                <div class="col">
                                    <button type="submit" class="btn btn-warning btn-yellow blue">
                                        {{ __('Log in') }}
                                    </button>
                                </div>

                                <div class="col">
                                    <small class="yellow">Don't have an account? <a href="register">Register here</a></small>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>

    @extends('recovmodal')

    </body>
</html>

