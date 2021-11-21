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
                            <div class="col-3">
                                <button class="btn btn-yellow" style="width: 10rem" type="button" data-bs-toggle="modal" data-bs-target="#accessLogsModal">Access Logs</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-yellow" type="button" data-bs-toggle="modal" data-bs-target="#pendingModal">Pending</button>
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
                        </div>
        
                        &nbsp;
        
                        <div class="row">
                            <div class="container">
                                <table class="table table-hover">
                                    <thead>
                                    <tr class="table-yellow">
                                        <th scope="col">Name</th>
                                        <th scope="col">Type</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($restricteds as $restricted)  
                                        <tr class="table-light">
                                            <th scope="row">{{$restricted->FirstName}} {{$restricted->LastName}}</th>
                                            <td>{{$restricted->UserType}}</td>

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
@endsection