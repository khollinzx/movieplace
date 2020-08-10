<div class="container">
    <h3>Cart</h3>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Movie Image</td>
                                <td>Movie Title</td>
                                <td>Price</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody id="user_item">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="mt-5">
                        <h3>Total Price: &#8358; <span id="display_amount"></span>
                        </h3>
                    </div>
                    <div class="mt-5 text-center">
                        <input type="text" id="email" value="<?php echo $_SESSION["user_details"]->email ?>" hidden>
                        <input type="text" id="amount_holder" hidden>
                        <button class="btn btn-lg btn-primary" id="proceed_to_payment">Process To Payment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>services/ajax/Cart.js"></script>