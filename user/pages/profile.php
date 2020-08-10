<?php $userDetails = json_decode($_SESSION["user_details"]->user_details); ?>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3">
            <h3>User Profile</h3>
            <div class="card mb-3">
                <div class="card-body">
                    <form id="profileDetails">
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $userDetails->full_name; ?>" disabled>

                            <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo $userDetails->date_of_birth; ?>" hidden>
                        </div>
                        <div class="form-group">
                            <label for="phone_no">Mobile No.</label>
                            <input type="text" class="form-control" id="phone_no" name="phone_no" value="<?php echo $userDetails->phone_no ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" disabled><?php echo $userDetails->address ?></textarea>
                        </div>
                    </form>
                    <div class="mt-5 text-center">
                        <button id="update" type="submit" class="btn btn-success">Update Changes</button>
                        <button id="editProfile" class="btn btn-success">Edit Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>services/ajax/UpdateProfile.js"></script>