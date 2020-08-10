$(document).ready(function () {
    getProductFromCart();
    getUserMovieList();
    GetTotalAmountOfItems();

    function getProductFromCart() {
        var accessToken = localStorage.getItem("token");
        $.ajax({
            url: '../services/controllers/GetProductFromCart.php',
            data: "getShoppingCart",
            headers: {
                Authorization: accessToken
            },
            success: function (html) {
                $("#shopping_cart").html(html);
            }
        });
    }

    function GetTotalAmountOfItems() {
        var accessToken = localStorage.getItem("token");
        $.ajax({
            url: '../services/controllers/GetTotalAmountOfItems.php',
            data: "getAmountOfItems",
            headers: {
                Authorization: accessToken
            },
            success: function (html) {
                $("#display_amount").html(html);
                $("#amount_holder").val(html);
            }
        });
    }


    $("body").on("click", ".remove_id", function () {
        var cart_id = $(this).parent("td").data('id');
        removeMovieFromCart(cart_id);
    });

    function removeMovieFromCart(cart_id) {
        var accessToken = localStorage.getItem("token");
        var cart_id = cart_id;
        $.ajax({
            type: 'POST',
            url: '../services/controllers/RemoveItemFromCartController.php',
            data: {
                cart_id: cart_id
            },
            headers: {
                Authorization: accessToken
            },
            dataType: 'json',
            success: function (response) {
                removeFronCartProcess(response.value);
            },
        });
    }

    function removeFronCartProcess(data) {
        var codeNo = '';
        var msgs = '';
        $.each(data, function (key, item) {
            codeNo = item.code;
            msgs = item.msgs;
        });
        if (codeNo == "200") {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: msgs,
                showConfirmButton: false,
                timer: 2500,
            });
            window.location.href = "?pg=cart"

        } else if (codeNo == "404") {
            alert(msgs);
        }
    }

    function getUserMovieList() {
        $.ajax({
            url: '../services/Controllers/ListProductFromCart.php',
            type: 'GET',
            data: 'getUserMovieList',
            dataType: 'json'
        }).done(function (data) {
            if (data.data != 'zero') {
                if (data.count != 0) {
                    //call manage data function
                    getItemList(data.data);
                } else {
                    $("#user_item").html('No List Found');
                }

            } else {
                $("#user_item").html('No List Found');
            }

        });
    }

    function getItemList(data) {
        var row = '';
        $.each(data, function (key, value) {
            row += `<tr>`;
            row += `<td><img src="../uploads/photos/${value.photo}" alt="${value.photo}" style="max-width: 50px;"></td>`;
            row += `<td>${value.name}</td>`;
            row += `<td><span>&#8358;</span>${value.price}</span></td>`;
            row += `<td data-id=${value.id}>
                        <button class="btn btn-outline-danger remove_id"><i class="fas fa-trash"></i> Remove</button>
                    </td>`;
            row += `</tr>`;
        });


        $("#user_item").html(row);
    }

    $('#proceed_to_payment').on('click', function () {
        payWithPaystack();

        function payWithPaystack() {
            var emailAddress = $('#email').val();
            var amount = $("#amount_holder").val();
            var publicKey = 'pk_test_b9ec763282d9ae4ec903e15dd98c3b19db68fbc3';
            var handler = PaystackPop.setup({
                key: publicKey,
                email: emailAddress,
                amount: amount + '00',
                currency: 'NGN',
                metadata: {
                    custom_fields: [{
                        display_name: emailAddress,
                        variable_name: emailAddress,
                    }, ],
                },
                callback: function (response) {
                    var accessToken = localStorage.getItem("token");
                    var reference = response.reference;
                    $.ajax({
                        type: 'POST',
                        url: '../services/controllers/PaymentVerificationController.php',
                        data: {
                            reference: reference,
                        },
                        headers: {
                            x_auth_token: accessToken
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.success == 'true') {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Thanks For Patronizing Us',
                                    showConfirmButton: false,
                                    timer: 2500,
                                });
                                setInterval(window.location.href = '?pg=cart', 3000);
                            } else if (response.error == 'false') {
                                Swal.fire({
                                    position: 'center',
                                    type: 'error',
                                    title: 'Payment Failed',
                                    showConfirmButton: false,
                                    timer: 2500,
                                });
                            }
                        },
                    });
                },
                onClose: function () {
                    alert('window closed');
                },
            });
            if (handler == undefined) {
                alert('network error');
            }
            handler.openIframe();
        }
    });




});