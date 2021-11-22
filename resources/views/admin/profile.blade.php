@extends('masterlayout.adminlayout')

@section('location')
    PROFILE
@endsection


@section('content')

    <div class="container" style="margin-top: 10px; max-width: 50rem;">
        <div class="card border-secondary mb-3">
            <div class="card-body" id="profileCard">
                <div id="message"></div>
                <div class="row">

                    <div class="col-6 blue-bg" style="align-content: center; text-align: center">
                        <div class="row">
                            <i class="fas fa-user-circle fa-7x" style="margin-top: 10%;color: white"></i>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <h4 class="yellow">{{ Auth::user()->FirstName }} {{ Auth::user()->LastName }}</h4>
                        </div>

                    </div>

                    <div class="col-6">
                            <fieldset>
                            <div class="form-group" hidden>
                                <label for="Firstname" class="form-label mt-4">User ID</label>
                                <input type="text" class="form-control" id="UserID" placeholder="First name" disabled="" value="{{ Auth::user()->UserID }}" required>
                            </div>

                            <div class="form-group">
                                <label for="Firstname" class="form-label mt-4">First name</label>
                                <input type="text" class="form-control" id="FirstName" placeholder="First name" disabled="" value="{{ Auth::user()->FirstName }}" required>
                            </div>

                            <div class="form-group">
                                <label for="Lastname" class="form-label mt-4">Last name</label>
                                <input type="text" class="form-control" id="LastName" placeholder="Last name" disabled="" value="{{ Auth::user()->LastName }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label mt-4">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" disabled="" value="{{ Auth::user()->email }}" required>
                            </div>

                            &nbsp;

                            <div class="row" style="align-content: center; text-align: center;" >
                                <div class="form-group">
                                @if (Route::has('password.request'))
                                    <a  href="{{ route('password.request') }}">
                                    <button type="button" id="password" class="btn btn-yellow blue"><b>Change Password</b></button>
                                    </a>
                                 @endif
                                    <button type="button" id="edit" class="btn btn-yellow blue"><b>Edit</b></button>

                                </div>
                                <div class="form-group">
                                    <button type="button" id="save" class="btn btn-yellow blue update_user" hidden><b>Save</b></button>

                                    <button type="button" id="cancel" class="btn btn-yellow blue" hidden><b>Cancel</b></button>
                                </div>
                            </div>

                            </fieldset>

                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="../../js/admin-edit-profile.js"></script>
@endsection
