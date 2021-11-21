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
            <div class="row" style="height: 100%">

            <div class="row col-6 d-flex align-items-center" >
                    <div class="col-md-12 d-block text-center">

                    
                    <img class="" src="../../images/migui store.png" alt="migui store" style="width: 60%">
                    <br>
                    <h6 class="text-muted">POINT-OF-SALE-SYSTEM</h6>
                    
                
                    </div>
                </div>
                
                <div class="col-6 d-flex align-items-center " >
                    
                    <div class="card text-white  blue-bg " style="width: 30rem">
                        <div class="card-body">
                        <h4 class="card-title yellow">Register</h4>

                        @if(Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <strong>Error!</strong> {!! session('error') !!}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <fieldset>

                                <div class="row yellow">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="firstname" class="form-label mt-4">{{ __('First Name') }}</label>
    
    
                                            <input id="firstname" type="text" class="form-control @error('name') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="name" autofocus placeholder="">
    
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="col">
                                        <div class="form-group">
                                        <label for="lastname" class="form-label mt-4">{{ __('Last Name') }}</label>
    
    
                                            <input id="lastname" type="text" class="form-control @error('name') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="name" autofocus placeholder="">
    
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row yellow">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="contactNo" class="form-label mt-4">{{ __('Contact No.') }}</label>
    
    
                                            <input id="contactNo" type="text" class="form-control @error('contactNo') is-invalid @enderror" name="contactNo" value="{{ old('contactNo') }}" required autocomplete="contactNo" autofocus placeholder="09XXXXXXXXX" maxlength="11">
    
                                            @error('contactNo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="col">
                                        <div class="form-group">
                                        <label for="emContactNo" class="form-label mt-4">{{ __('Emergency Contact No.') }}</label>
    
    
                                            <input id="emContactNo" type="text" class="form-control @error('emContactNo') is-invalid @enderror" name="emContactNo" value="{{ old('emContactNo') }}" required autocomplete="emContactNo" autofocus placeholder="09XXXXXXXXX" maxlength="11">
    
                                            @error('emContactNo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
    
    
                                <div class="form-group yellow">
                                    <label for="email" class="form-label mt-4">{{ __('E-Mail Address') }}</label>
    
                                        <div class="col">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="ex: email@domain.com">
    
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                </div>
    
                                <div class="form-group yellow">
                                    <label for="password" class="form-label mt-4">{{ __('Password') }}</label>
    
                                        <div class="col">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="******">
                                            <small id="password" class="form-text" style="color:lime;text-weight:bold"><i>Minimum of 6 characters, must contain at least one lowercase, an uppercase and a special character or a number.</i></small>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                </div>
    
                                <div class="form-group yellow">
                                    <label for="password-confirm" class="form-label mt-4">{{ __('Confirm Password') }}</label>
    
                                        <div class="col">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="******">
                                        </div>
                                </div>

                            &nbsp;

                            <div class="row" style="align-content: center; text-align: center;" >
                                <div class="form-group">
                                    <div class="col">
                                        <button type="submit" class="btn btn-warning btn-yellow blue">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>

                                    <small class="yellow">Already have an account? <a href="login">Log in here</a></small>       
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
