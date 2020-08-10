$(document).ready(function () {
    getProductFromCart();

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

    function error_alert(value, type) {
        $('#error').html(
            `<div class="alert alert-${type}" role="alert"><strong><i class="fas fa-warning"></i></strong>&ensp;${value}</div>`
        );
    }


    $('#changePassword').click(function (e) {
        if (
            $('#old_password').val() == '' || $('#new_password').val() == ''
        ) {
            if ($('#old_password').val() == '') {
                error_alert('Enter Previous Password', 'warning');
            } else if ($('#new_password').val() == '') {
                error_alert('Enter a New Password', 'warning');
            }
        } else {
            changePassword();
        }

        function changePassword() {
            var accessToken = localStorage.getItem("token");
            var changePasswordDetails = $('#changePasswordDetails').serialize();
            $.ajax({
                type: 'POST',
                url: '../services/controllers/ChangePasswordController.php',
                data: changePasswordDetails,
                headers: {
                    Authorization: accessToken
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#changePassword').html('Saving Changes...');
                    $('#changePassword').attr('disabled', true);
                },
                success: function (response) {
                    updateProfileProcess(response.value);
                },
            }); // ends create ajax
        }

        function updateProfileProcess(data) {
            var codeNo = '';
            var msgs = '';
            $.each(data, function (key, item) {
                codeNo = item.code;
                msgs = item.msgs;
            });
            if (codeNo == "200") {
                $('#changePassword').html('Saving Change...');
                $('#changePassword').attr('disabled', false);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Password Changed Succesfully',
                    showConfirmButton: false,
                    timer: 2500,
                });
                window.location.href = "?pg=profile";

            } else if (codeNo == "400") {
                $('#changePassword').html('Save Changes');
                $('#changePassword').attr('disabled', false);
                error_alert(msgs, "warning");
            } else if (codeNo == "404") {
                $('#changePassword').html('Save Changes');
                $('#changePassword').attr('disabled', false);
                error_alert(msgs, "warning");
            }
        }
    });



});