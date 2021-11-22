<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{csrf_token()}}"> {{-- You need this to run CRUD operations --}}


        <title>

        @yield('title',"Point of Sale Migui's Store")

        </title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link href="../../css/bootstrap.css" rel="stylesheet">
        <link href="../../css/sidebar.css" rel="stylesheet">

        <script src="https://kit.fontawesome.com/ad9a071612.js" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

        <script src="../../js/sidebar.js"></script>
    </head>

    <body>
        <!-- The sidebar -->
        <div class="sidebar" style="background-color: white">

            <ul class="nav nav-pills flex-column mb-auto">

                <div style="text-align: center; margin-top: 10px;">
                  <div class="container-fluid d-flex align-items-center">
                    <div class="row " style="height: 100%">

                        <div class="row d-flex align-items-center" >
                            <div class="col d-block text-center">

                            <img class="" src="../../images/migui store.png" alt="migui store" style="width: 70%">
                            <br>
                            <br>

                            </div>
                        </div>
                    </div>
                  </div>
                </div>

                <li class="nav-item" style="text-align: center">

                    <i class="fas fa-calendar-alt fa-lg gray" style="margin-right: 10px"></i>
                    <span id="demo"></span>
                </li>
            </ul>

            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item" >
                  <a href="/home">
                    <i class="fas fa-home fa-2x gray" style="margin-right: 2rem"></i>
                    Home
                  </a>
                </li>
                <li>
                    <a href="profile">
                      <i class="fas fa-user fa-2x gray" style="margin-right: 2rem"></i>
                      Profile
                    </a>
                  </li>
                <li>
                  <a href="salespersonproducts">
                    <i class="fas fa-shopping-cart fa-2x gray" style="margin-right: 2rem"></i>
                    Products
                  </a>
                </li>
                <li>
                  <a href="{{ route('salesperson.salespersonaddtransaction') }}">
                    <i class="far fa-credit-card fa-2x gray" style="margin-right: 2rem"></i>
                    Transactions
                  </a>
                </li>

                <li>
                    <a href="{{ route('salesperson.eload') }}">
                      <i class="fas fa-mobile-alt fa-2x gray" style="margin-right: 2rem"></i>
                      E-Load
                    </a>
                  </li>

                </ul>
              <hr style="margin-top: 5rem">
              <div>
                <ul class="nav nav-pills flex-column">
                    <li>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                          <i class="fas fa-sign-out-alt fa-2x gray" style="margin-right: 2rem"></i>
                          {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
              </div>
        </div>

        <!-- Page content -->
        <div class="content">
            <div class="row" >

              <h2 style="margin-top: 5px">
                @yield('location')
              </h2>
              <hr>

                @yield('content')

            </div>
        </div>
    </body>
</html>
