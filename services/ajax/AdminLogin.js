$(document).ready(function () {

    function error_alert(value, type) {
        $('#error').html(
            `<div class="alert alert-${type}" role="alert"><strong><i class="fas fa-warning"></i></strong>&ensp;${value}</div>`
        );
    }


    $('#Adminlogin').click(function (e) {
        if (
            $('#email_address').val() == '' || $('#password').val() == ''
        ) {
            if ($('#email_address').val() == '') {
                error_alert('Email is Required', 'warning');
            } else if ($('#password').val() == '') {
                error_alert('Password is Required', 'warning');
            }
        } else {
            loginUser();
        }

        function loginUser() {
            var loginData = $('#AdminloginDetails').serialize();
            $.ajax({
                type: 'POST',
                url: '../services/controllers/AdminLoginController.php',
                data: loginData,
                dataType: 'json',
                beforeSend: function () {
                    $('#Adminlogin').html('Validating...');
                    $('#Adminlogin').attr('disabled', true);
                },
                success: function (response) {
                    signInProcess(response.value);
                },
            }); // ends create ajax
        }

        function signInProcess(data) {
            var codeNo = '';
            var msgs = '';
            var accessToken = '';
            $.each(data, function (key, item) {
                codeNo = item.code;
                msgs = item.msgs;
                accessToken = item.token;
            });
            if (codeNo == "200") {
                $('#Adminlogin').html('Connecting...');
                $('#Adminlogin').attr('disabled', false);
                localStorage.setItem('token', accessToken);
                window.location.href = "portal/?pg=dashboard";

            } else if (codeNo == "400") {
                $('#Adminlogin').html('Login');
                $('#Adminlogin').attr('disabled', false);
                error_alert(msgs, "warning");
            } else if (codeNo == "404") {
                $('#Adminlogin').html('Login');
                $('#Adminlogin').attr('disabled', false);
                error_alert(msgs, "warning");
            }
        }
    });



});