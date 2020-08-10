<?php

//get the configuration for the local server
require_once("starter/header.php");

if (isset($_SESSION["user_details"]) || isset($_SESSION["admin_details"])) {
    Redirect::to("../");
}
include(ROOT_PATH . 'layouts/header.php');

include(ROOT_PATH . 'layouts/navbar.php');

?>

<div class="container">
    <div class="col-md-6 offset-md-3">
        <form id="loginDetails">
            <h3>Log In</h3>
            <br>
            <div class="container">
                <span id="error"></span>
            </div>
            <div class="form-group">
                <label for="email_address">Email address</label>
                <input type="email" class="form-control" name="email_address" id="email_address">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
        </form>
        <button id="login" type="submit" class="btn btn-primary">Login</button>
        <br>
        <div class="mt-4">
            <a href="<?php echo BASE_URL; ?>signup/"> Don't have an account</a>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>services/ajax/Login.js"></script>
<?php

include(ROOT_PATH . 'layouts/footer.php');

?>