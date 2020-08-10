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

    $("#update").hide();


    $('#editProfile').on('click', function () {
        $('#update').show();
        $('#full_name').attr('disabled', false);
        $('#phone_no').attr('disabled', false);
        $('#address').attr('disabled', false);
        $(this).hide();
        // $('#table1').show();
        // $('#show_table1').hide();
        // $('#show_table2').show();
    });


    function error_alert(value, type) {
        $('#error').html(
            `<div class="alert alert-${type}" role="alert"><strong><i class="fas fa-warning"></i></strong>&ensp;${value}</div>`
        );
    }


    $('#update').click(function (e) {
        if (
            $('#full_name').val() == '' || $('#phone_no').val() == '' || $('#address').val() == ''
        ) {
            if ($('#full_name').val() == '') {
                error_alert('Name is Required', 'warning');
            } else if ($('#phone_no').val() == '') {
                error_alert('Mobile No. is Required', 'warning');
            } else if ($('#address').val() == '') {
                error_alert('Address is Required', 'warning');
            }
        } else {
            updateProfile();
        }

        function updateProfile() {
            var accessToken = localStorage.getItem("token");
            var updatProfileDetails = $('#profileDetails').serialize();
            $.ajax({
                type: 'POST',
                url: '../services/controllers/UpdateProfileController.php',
                data: updatProfileDetails,
                headers: {
                    Authorization: accessToken
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#update').html('Saving Changes...');
                    $('#update').attr('disabled', true);
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
                $('#update').html('Saving Changes...');
                $('#update').attr('disabled', false);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Profile Updated',
                    showConfirmButton: false,
                    timer: 2500,
                })
                window.location.href = "?pg=profile";

            } else if (codeNo == "400") {
                $('#update').html('Update Changes');
                $('#update').attr('disabled', false);
                error_alert(msgs, "warning");
            } else if (codeNo == "404") {
                $('#update').html('Update Changes');
                $('#update').attr('disabled', false);
                error_alert(msgs, "warning");
            }
        }
    });



});