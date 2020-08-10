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
                <form id="AdminloginDetails" enctype="multipart/form-data">
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