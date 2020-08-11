<?php
$genres = select_all("genre_table");
?>
<div class="container">
    <h3>Movies Table</h3>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="py-4">
                        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#addGenre">Add Genre</button>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addProduct">Add Movie</button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Movie Photo</th>
                                <th>Movie Title</th>
                                <th>Price</th>
                                <th>Genre</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="movie_list">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h4>List of Genre </h4>
                    <ul class="list-group" id="genre_list">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

include(ROOT_PATH . 'layouts/modals.php');

?>
<script src="<?php echo BASE_URL; ?>services/ajax/AddProducts.js"></script>