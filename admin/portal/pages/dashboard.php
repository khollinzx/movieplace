<?php
$genres = select_all("genre_table");
?>
<div class="container">
    <h3>Cart</h3>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="py-3">
                        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#addGenre">Add Genre</button>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addProduct">Add Product</button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Movie Title</td>
                                <td>Price</td>
                                <td>Genre</td>
                                <td>Action</td>
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