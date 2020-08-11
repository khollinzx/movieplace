<?php
$purchased_item = select_all_value("items_table", "*", "user_id", $_SESSION["user_details"]->id);
$i = 1;
?>
<div class="container">
    <h3>Purchased Items</h3>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Movie Title</th>
                                <th>Price</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($purchased_item as $item) { ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo selectField2("movies_table", "movie_title", "id", $item["movie_id"]); ?></td>
                                    <td><?php echo selectField2("movies_table", "price", "id", $item["movie_id"]); ?></td>
                                    <td><?php echo $item["trans_date"]; ?></td>
                                </tr>

                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>services/ajax/Cart.js"></script>