<?php
// fetching all the customers in the users table
$all_users = select_all("users_table");

// Fetching all the movies that ends with the Character "S"
$character_with_S  = select_all_with_specify_character("movies_table", "movie_title");

// Fetching all the customers that are above 50
$customer_above_50 = select_users_above_50("users_table", "*", "age", ">=", 50);

?>
<div class="container">
    <h3>Report</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h3>List of All Customers With the Total Items Purchase</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Customer mobile No.</th>
                                <th>Total Items Purchased.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // List all the customers fetched from the database
                            $i = 1;
                            foreach ($all_users as $user) {
                                $user_details = json_decode($user["user_details"]); ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $user_details->full_name; ?></td>
                                    <td><?php echo $user["email"]; ?></td>
                                    <td><?php echo $user_details->phone_no; ?></td>
                                    <td><?php echo selectValueCount("items_table", "user_id", $user["id"]); ?></td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h4>List of User Above Age 50 </h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Customer Age.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // List all the customers fetched from the database that are above 50
                            $sn = 1;
                            foreach ($customer_above_50 as $cus_age) {
                                $user_details = json_decode($cus_age["user_details"]); ?>
                                <tr>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo $user_details->full_name; ?></td>
                                    <td><?php echo $cus_age["email"]; ?></td>
                                    <td><?php echo $cus_age["age"]; ?></td>
                                </tr>
                            <?php $sn++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h4>List of Movies That End with Character "S" </h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Movie Title</th>
                                <th>Genre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // List all the Movies fetched from the database that ends with the character "S"
                             $no = 1;
                            foreach ($character_with_S as $movie_s) { ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $movie_s["movie_title"]; ?></td>
                                    <td><?php echo selectField2("genre_table", "genre_name", "id", $movie_s["genre_id"]); ?></td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>