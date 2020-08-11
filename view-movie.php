<?php
//get the configuration for the local server
require_once("starter/header.php");

include(ROOT_PATH . 'layouts/header.php');

include(ROOT_PATH . 'layouts/navbar.php');

if (isset($_GET["movie"])) {
    $movie_code = $_GET["movie"];
}

$single_movie = select_all_value("movies_table", "*", "token_id", $movie_code);

foreach ($single_movie as $value) {
    $movie_id = $value["id"];
    $movie_title = $value["movie_title"];
    $movie_photo = $value["photo"];
    $movie_price = $value["price"];
    $movie_description = $value["description"];
}

?>

<div class="container">
    <h3>Movie List</h3>
    <div class="py-2">
        <a href="<?php echo BASE_URL; ?>" class="btn btn-outline-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="<?php echo BASE_URL . 'uploads/photos/' . $movie_photo; ?>" class="card-img-top" alt="<?php echo $movie_photo; ?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $movie_title; ?></h5>
                        <p class="card-text"><?php echo $movie_description; ?></p>
                        <h4 class="card-text"><small class="text-muted"><span>&#8358;</span> <?php echo $movie_price; ?></small></h4>

                        <div class=" text-right mr-auto" data-id="<?php echo $movie_id ?>">
                            <?php if (isset($_SESSION["user_details"]) && $_SESSION["user_details"] != null) { ?>
                                <button id="move_to_cart" class="btn btn-primary clearfix"><i class="fa fa-money"></i> Purchase Movie</button>
                            <?php } else if (!isset($_SESSION["user_details"]) && $_SESSION["user_details"] == null) { ?>
                                <a href="<?php echo BASE_URL ?>login/" class="btn btn-outline-primary clearfix"><i class="fa fa-money"></i> Login to Purchase Movie</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>services/ajax/ViewMovie.js"></script>
<?php

include(ROOT_PATH . 'layouts/footer.php');

?>