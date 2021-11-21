    <!-- Recovery Modal 1 -->
    <div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content blue-bg">
            <div class="modal-header yellow">
            <h5 class="modal-title" id="exampleModalLabel">Account Recovery</i></h5>
            <button type="button" class="btn dirty-white" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>

            <div class="modal-body yellow">
                <p>Forgot your password? We got you.</p>

                <p>Please enter your mobile phone number and we'll send a verification code for password reset.</p>
                
            <div id="saveform_errList"></div>

                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label mt-4">Contact No.</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Contact No.">
                </div>

                &nbsp;
                <div class="form-group" style="text-align: center">
                    <button type="button" class="btn btn-warning btn-yellow" data-bs-toggle="modal" data-bs-target="#Modal2"><b>Submit</b></button>
                </div>
                &nbsp;

            </div>
                
            </div>
        </div>
        </div>
    </div>
    </div>

    <!-- Recovery Modal 2 -->
    <div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content blue-bg">
            <div class="modal-header yellow">
            <h5 class="modal-title" id="exampleModalLabel">Account Recovery</i></h5>
            <button type="button" class="btn dirty-white" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>

            <div class="modal-body yellow">
                <p>Please wait a few minutes for the OTP Code to arrive then enter the code below.</p>
                
            <div id="saveform_errList"></div>

                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label mt-4">OTP Code</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="OTP Code">
                </div>

                &nbsp;
                <div class="row">
                    <div class="col-9">
                        <small>Didn't receive a code? <a href="">Click here to get a new one.</a></small>
                    </div>

                    <div class="col-2">
                        <div class="form-group">
                            <button type="button" class="btn btn-warning btn-yellow blue" data-bs-toggle="modal" data-bs-target="#Modal3"><b>Submit</b></button>
                        </div>
                    </div>
                </div>

                &nbsp;

            </div>
                
            </div>
        </div>
        </div>
    </div>
    </div>

    <!-- Recovery Modal 3 -->
    <div class="modal fade" id="Modal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content blue-bg">
            <div class="modal-header yellow">
            <h5 class="modal-title" id="exampleModalLabel">Account Recovery</i></h5>
            <button type="button" class="btn dirty-white" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>

            <div class="modal-body yellow">
                
            <div id="saveform_errList"></div>

                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label mt-4">New Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="New Password">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label mt-4">Confirm New Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm New Password">
                </div>
                
                &nbsp;
                <div class="form-group" style="text-align: center">
                    <button type="button" class="btn btn-warning btn-yellow blue"><b>Submit</b></button>
                </div>
                &nbsp;

            </div>
                
            </div>
        </div>
        </div>
    </div>
    </div>