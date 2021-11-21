<!-- Start Delete -->
<div id="archiveModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header blue-bg yellow">
                <h5 class="modal-title">Archive</h5>
                <button type="button" class="btn-close dirty-white" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="archive_u_id">
                <input type="hidden" id="archive_UserType" value="restricted">
                <p>
                    You're about to archive this user:
                </p>

                <label for="archive_UserName" class="col col-form-label">Username</label>
                <input type="text" name="archive_UserName" id="archive_UserName" value="" disabled>
                <br>
                <label for="archive_FirstName" class="col col-form-label">First Name</label>
                <input type="text" name="archive_FirstName" id="archive_FirstName" value="" disabled>
                <br>
                <label for="archive_LastName" class="col col-form-label">Last Name</label>
                <input type="text" name="archive_LastName" id="archive_LastName" value="" disabled>


            </div> 
          
            <div class="modal-footer" style="text-align: right">
                <button class="btn btn-yellow archive_user_btn" type="button">Archive</button>
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>
<!-- End Delete Modal -->