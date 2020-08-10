<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?php echo BASE_URL ?>#"><?php echo SITE_NAME ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php if (isset($_SESSION["admin_details"]) && $_SESSION["admin_details"] != null) { ?>
            <ul class="navbar-nav mr-auto ">
                <li class="nav-item <?php if($pageLink == "dashboard"){ echo "btn btn-outline-dark btn-sm"; } ?>"><a class="nav-link" href="<?php echo BASE_URL ?>admin/portal/?pg=dashboard"> Dashboard </a> </li>
                <li class="nav-item <?php if($pageLink == "report"){ echo "btn btn-outline-dark btn-sm"; } ?>"><a class="nav-link" href="<?php echo BASE_URL ?>admin/portal/?pg=report"> Report </a> </li>
            </ul>
        <?php } ?>
        <ul class="navbar-nav mr-auto ">
        </ul>
        <div class="form-inline my-2 my-lg-0">
            <?php if (isset($_SESSION["user_details"]) && $_SESSION["user_details"] != null) {
                $userDetails = json_decode($_SESSION["user_details"]->user_details)   ?>
                <ul class="navbar-nav mr-5">
                    <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL ?>user/?pg=cart"><i class="fa fa-shopping-cart"></i> <span id="shopping_cart"></span> </a> </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>
                            <?php echo $_SESSION["user_details"]->email; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo BASE_URL ?>user/?pg=purchased-items">Purchase</a>
                            <a class="dropdown-item" href="<?php echo BASE_URL ?>user/?pg=profile">Profile</a>
                            <a class="dropdown-item" href="<?php echo BASE_URL ?>user/?pg=change-password">Change Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="logout" href="<?php echo BASE_URL ?>logout/">Logout</a>
                        </div>
                    </li>
                </ul>
            <?php } else if (isset($_SESSION["admin_details"]) && $_SESSION["admin_details"] != null) { ?>
                <ul class="navbar-nav mr-5">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>
                            <?php echo $_SESSION["admin_details"]->email; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo BASE_URL ?>user/?pg=add-genre"> Add Genre</a>
                            <a class="dropdown-item" href="<?php echo BASE_URL ?>user/?pg=add-movie"> Add Movie</a>
                            <a class="dropdown-item" href="<?php echo BASE_URL ?>user/?pg=view-customers"> View Customers</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="logout" href="<?php echo BASE_URL ?>logout/">Logout</a>
                        </div>
                    </li>
                </ul>
            <?php } else { ?>
                <a href="<?php echo BASE_URL; ?>login/" class="btn btn-success mx-2 my-sm-0">Login</a>
                <a href="<?php echo BASE_URL; ?>signup/" class="btn btn-outline-success my-2 my-sm-0">Sign Up</a>
            <?php } ?>
        </div>
    </div>
</nav>

<script src="<?php echo BASE_URL; ?>services/ajax/Logout.js"></script>

<div class="album py-5 ">