<?php


//get the configuration for the local server
require_once("starter/header.php");

include(ROOT_PATH . 'layouts/header.php');

include(ROOT_PATH . 'layouts/navbar.php');

$movies = select_all("movies_table");

?>
<div class="container">
    <h3>Movie List</h3>
    <div class="row">
        <?php foreach ($movies as $movie) { ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <a href="<?php echo BASE_URL . 'view-movie/?movie=' . $movie["token_id"]; ?>">
                        <img src="<?php echo BASE_URL . 'uploads/photos/' . $movie["photo"]; ?>" class="card-img-top" alt="<?php echo $movie["photo"]; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $movie["movie_title"]; ?></h5>
                            <div class="text-right clearfix">
                                <h4 class="card-text text-left"><small class="text-muted"><span>&#8358;</span> <?php echo $movie["price"]; ?></small></h4>
                                <p class="card-text text-left"><small><?php echo $movie["created_at"]; ?></small></p>
                            </div>
                        </div>
                    </a>
                    <?php if (isset($_SESSION["user_details"]) && $_SESSION["user_details"] != null) { ?>
                        <div data-id="<?php echo $movie["id"]; ?>">
                            <button id="move_to_cart" class="btn btn-lg btn-outline-primary btn-block"> Purchase Movie</button>
                        </div>
                    <?php }  ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>services/ajax/Index.js"></script>
<?php

include(ROOT_PATH . 'layouts/footer.php');

?>