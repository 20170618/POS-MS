@extends('masterlayout.adminlayout')

@section('location')
    USER MANAGEMENT
@endsection


@section('content')

    <div class="container" style="margin-top: 10px;width: 90rem">
        <div class="row">

            <div class="col-7">
                <div class="card text-white mb-3 blue-bg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <h4 class="yellow">Active Users</h4>
                            </div>

                        </div>

                        &nbsp;

                        <div class="row">
                            <div class="container">
                                <table class="table table-hover">
                                    <thead>
                                    <tr class="table-yellow">
                                        <th scope="col">Name</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($actives as $active)
                                        <tr class="table-light">
                                            <th scope="row">{{$active->FirstName}} {{$active->LastName}}</th>
                                            <td>{{$active->UserType}}</td>
                                            <td>

                                                @if (Auth::user()->UserID != $active->UserID)
                                                <button class="btn btn-danger archive_user" value={{$active->UserID}} type="button"><i class="fas fa-archive"></i></button>
                                                <button type="button"
                                                        class="btn btn-primary" 
                                                        role="button" 
                                                        data-html="true" 
                                                        data-toggle="popover" 
                                                        data-trigger="focus" 
                                                        title="{{$active->FirstName}} {{$active->LastName}}" 
                                                        data-bs-content=
                                                        "<div><b>Contact #:</b><br>{{$active->ContactNo}}</div><br>
                                                        <div><b>Emergency Contact #:</b><br>{{$active->EmContactNo}}</div><br>
                                                        <div><b>E-Mail Address:</b><br>{{$active->email}}</div>">
                                                        <i class="fas fa-eye"></i>
                                                </button>
                                                @endif
                                               
                                            </td>

                                        </tr>
                                    @endforeach

                                    <tr class="pageRow">
                                        <td colspan="6">
                                           <div class="d-flex justify-content-center pt-4"> {{ $actives->links() }} </div>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card text-white mb-3 gray-bg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <h4 class="yellow">Archived Users</h4>
                            </div>
                            <small>These users will be deleted from the system one year after their account creation.</small>
                        </div>

                        &nbsp;

                        <div class="row">
                            <div class="container">
                                <table class="table table-hover">
                                    <thead>
                                    <tr class="table-yellow">
                                        <th scope="col">Name</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($restricteds as $restricted)
                                        <tr class="table-light">
                                            <th scope="row">{{$restricted->FirstName}} {{$restricted->LastName}}</th>
                                            <td>{{$restricted->UserType}}</td>
                                            <td><button type="button"
                                                class="btn btn-primary" 
                                                role="button" 
                                                data-html="true" 
                                                data-toggle="popover" 
                                                data-trigger="focus" 
                                                title="{{$restricted->FirstName}} {{$restricted->LastName}}" 
                                                data-bs-content=
                                                "<div><b>Contact #:</b><br>{{$restricted->ContactNo}}</div><br>
                                                <div><b>Emergency Contact #:</b><br>{{$restricted->EmContactNo}}</div><br>
                                                <div><b>E-Mail Address:</b><br>{{$restricted->email}}</div>">
                                                <i class="fas fa-eye"></i>
                                                </button>
                                            </td>

                                        </tr>
                                    @endforeach

                                    <tr class="pageRow">
                                        <td colspan="6">
                                           <div class="d-flex justify-content-center pt-4"> {{ $restricteds->links() }} </div>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>




    </div>
@extends('admin.usersmodals')
    <script src="../../js/users.js"></script>
    <script>
        $(document).ready(function(){
         $('[data-toggle="popover"]').popover({html: true});   
        });
    </script>
@endsection
