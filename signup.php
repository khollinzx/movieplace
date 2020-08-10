<?php
//get the configuration for the local server
require_once("starter/header.php");

include(ROOT_PATH . 'layouts/header.php');

include(ROOT_PATH . 'layouts/navbar.php');

?>

<div class="container m-auto">
    <div class="col-md-6 offset-md-3">
        <form id="signupdetails">
            <h3>Sign Up</h3>
            <br>
            <div class="container">
                <span id="error"></span>
            </div>
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name">
            </div>
            <div class="form-group">
                <label for="email_address">Email address</label>
                <input type="email" class="form-control" id="email_address" name="email_address">
            </div>
            <div class="form-group">
                <label for="date_of_birth">Date 0f Birth</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

        </form>
        <button type="submit" id="signup" class="btn btn-primary">Submit</button>
        <br>

        <div class="mt-4">
            <a href="<?php echo BASE_URL; ?>login/" class="mt-4"> Already have an account</a>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>services/ajax/SignUp.js"></script>
<?php

include(ROOT_PATH . 'layouts/footer.php');

?>