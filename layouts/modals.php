<!-- Modal to Add New Genre -->
<div class="modal" id="addGenre" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Genre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="genreDetails">
                    <div class="container">
                        <span id="error"></span>
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <input type="text" class="form-control" name="genre" id="genre">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="saveGenre" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal to Add New Movie to the Database -->
<div class="modal" id="addProduct" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Movie Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addProductDetails" enctype="multipart/form-data">
                    <div class="container">
                        <span id="error2"></span>
                    </div>
                    <div class="form-group">
                        <label for="productTitle">Movie Title</label>
                        <input type="text" class="form-control" name="productTitle" id="productTitle">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price">
                    </div>
                    <div class="form-group">
                        <label for="description">Movie Description</label>
                        <textarea type="text" class="form-control" name="description" id="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="genre_type">Genre Type</label>
                        <select type="text" class="form-control" id="genre_type" name="genre_type">
                            <option value="">Select Genre</option>
                            <?php foreach ($genres as $genre) { ?>
                                <option value="<?php echo $genre["id"] ?>"><?php echo $genre["genre_name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="photo">Upload Image</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="saveProduct" class="btn btn-primary">Save Product</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal to Preview the particular movie property on the table -->
<div class="modal" id="view_movie" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Movie Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="AdminloginDetails" enctype="multipart/form-data">
                    <div class="container">
                        <span id="error2"></span>
                    </div>
                    <div class="form-group">
                        <label for="photo">Movie Photo</label>
                        <div id="view_photo"></div>
                    </div>
                    <div class="form-group">
                        <label for="productTitle">Movie Title</label>
                        <h4 id="view_productTitle"></h4>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <h4 id="view_price"></h4>
                    </div>
                    <div class="form-group">
                        <label for="description">Movie Description</label>
                        <p id="view_description"></p>
                    </div>
                    <div class="form-group">
                        <label for="genre_type">Genre Type</label>
                        <h4 id="view_genre_type"></h4>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal to Edit/Update a particular movie property on the table -->
<div class="modal" id="edit_movie" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit/Update Movie Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="" enctype="multipart/form-data">
                    <div class="container">
                        <span id="error3"></span>
                    </div>
                    <div class="form-group">
                        <label for="productTitle">Movie Title</label>
                        <input type="text" class="form-control" name="edit_movie_id" id="edit_movie_id" hidden>
                        <input type="text" class="form-control" name="edit_name" id="edit_name">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="edit_price" name="edit_price">
                    </div>
                    <div class="form-group">
                        <label for="description">Movie Description</label>
                        <textarea type="text" class="form-control" name="edit_movie_description" id="edit_movie_description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="genre_type">Genre Type</label>
                        <select type="text" class="form-control" id="edit_genre_type" name="edit_genre_type">
                            <option value="">Select Genre</option>
                            <?php foreach ($genres as $genre) { ?>
                                <option value="<?php echo $genre["id"] ?>"><?php echo $genre["genre_name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="photo">Upload Image</label>
                        <input type="file" class="form-control" id="edit_photo" name="edit_photo">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="updateProduct" class="btn btn-primary">Update Product</button>
            </div>
        </div>
    </div>
</div>