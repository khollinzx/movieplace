<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3">
            <h3>Change Password</h3>
            <div class="card mb-3">
                <br>
                <div class="container">
                    <span id="error"></span>
                </div>
                <div class="card-body">
                    <form id="changePasswordDetails">
                        <div class="form-group">
                            <label for="old_password">Old Password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password">
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                    </form>
                    <div class="mt-5 text-center">
                        <button id="changePassword" type="submit" class="btn btn-success"> Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>services/ajax/ChangePassword.js"></script>