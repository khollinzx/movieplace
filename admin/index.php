<?php
//get the configuration for the local server
require_once("../starter/header.php");

include(ROOT_PATH . 'layouts/header.php');

?>
<div class="album py-5 ">
    <div class="container">
        <div class="col-md-6 offset-md-3">
            <form id="AdminloginDetails">
                <h3>Admin Log In</h3>
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
            <button id="Adminlogin" type="submit" class="btn btn-primary">Login</button>
        </div>
    </div>
    <script src="<?php echo BASE_URL; ?>services/ajax/AdminLogin.js"></script>
    <?php

    include(ROOT_PATH . 'layouts/footer.php');

    ?>