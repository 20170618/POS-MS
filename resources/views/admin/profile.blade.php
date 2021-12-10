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
                            <h4 class="yellow">{{ Auth::user()->FirstName }} {{ Auth::user()->LastName }}</h4><br>
                            <h6 class="text-white">{{ Auth::user()->email }}</h6>
                        </div>

                    </div>

                    <div class="col-6">
                            <fieldset>
                            <div id="message"></div>
                            <div class="form-group" hidden>
                                <label for="Firstname" class="form-label mt-4">User ID</label>
                                <input type="text" class="form-control" id="UserID" placeholder="First name" disabled="" value="{{ Auth::user()->UserID }}" required>
                            </div>
                            <div class="form-group" hidden>
                                <label for="password" class="form-label mt-4">Password</label>
                                <input type="text" class="form-control" id="userPassword" placeholder="First name" disabled="" value="{{ Auth::user()->password }}" required>
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
                                <label for="ContactNo" class="form-label mt-4">Contact No.</label>
                                <input type="text" class="form-control" id="ContactNo" placeholder="09XXXXXXXXX" disabled="" value="{{ Auth::user()->ContactNo }}" required maxlength="11">
                            </div>

                            <div class="form-group">
                                <label for="EmContactNo" class="form-label mt-4">Emergency Contact No.</label>
                                <input type="text" class="form-control" id="EmContactNo" placeholder="09XXXXXXXXX" disabled="" value="{{ Auth::user()->EmContactNo }}" required maxlength="11">
                            </div>

                            &nbsp;

                            <div class="row" style="align-content: center; text-align: center;" >
                                <div class="form-group">
                                @if (Route::has('password.request'))
                                    <button type="button" id="changepasswordbutton" class="btn btn-yellow blue changepassmodal"><b>Change Password</b></button>
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

    <div id="changePassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header blue-bg yellow">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                
            <div id="oldPasswordDiv">
                <form id ="confirmOldPassword" class="form-horizontal">
                    <div id = "errorNotif"></div>
                    <div class= "form-group">
                        <label class="form-label mt-4">Old Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="oldPassword"
                                id="oldPassword" required>
                        </div>
                    </div>
                    <div class= "form-group">
                        <label class="form-label mt-4">New Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="newPassword"
                                id="newPassword" required>
                        </div>
                    </div>
                    <div class= "form-group">
                        <label class="form-label mt-4">Confirm Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="confirmPassword"
                                id="confirmPassword" required>
                        </div>
                    </div>
                </form>
            </div>
            </div> 
            <div class="modal-footer" style="text-align: right">
                <button class="btn btn-yellow confirmOldPasswordBtn" type="submit" id="confirmOldPasswordBtn">Next</button>
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>

    <script src="../../js/admin-edit-profile.js"></script>
@endsection
