$(document).ready(function () {
    getProductFromCart();

    function getProductFromCart() {
        var accessToken = localStorage.getItem("token");
        $.ajax({
            url: 'services/controllers/GetProductFromCart.php',
            data: "getShoppingCart",
            headers: {
                Authorization: accessToken
            },
            success: function (html) {
                $("#shopping_cart").html(html);
            }
        });
    }


    $("body").on("click", "#move_to_cart", function () {
        var movie_id = $(this).parent("div").data('id');
        moveToCart(movie_id)

        function moveToCart(movie_id) {
            var accessToken = localStorage.getItem("token");
            var movie_id = movie_id;
            $.ajax({
                type: 'POST',
                url: 'services/controllers/MoveToCartController.php',
                data: {
                    movie_id: movie_id
                },
                headers: {
                    Authorization: accessToken
                },
                dataType: 'json',
                success: function (response) {
                    moveToCartProcess(response.value);
                },
            });
        }

        function moveToCartProcess(data) {
            var codeNo = '';
            var msgs = '';
            $.each(data, function (key, item) {
                codeNo = item.code;
                msgs = item.msgs;
            });
            if (codeNo == "200") {
                getProductFromCart();
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: msgs,
                    showConfirmButton: false,
                    timer: 2500,
                });

            } else if (codeNo == "400") {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: msgs,
                    showConfirmButton: false,
                    timer: 2500,
                });
            } else if (codeNo == "404") {
                alert(msgs);
            }
        }
    });



});