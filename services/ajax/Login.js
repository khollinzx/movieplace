$(document).ready(function () {

    function error_alert(value, type) {
        $('#error').html(
            `<div class="alert alert-${type}" role="alert"><strong><i class="fas fa-warning"></i></strong>&ensp;${value}</div>`
        );
    }


    $('#login').click(function (e) {
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
            var loginData = $('#loginDetails').serialize();
            $.ajax({
                type: 'POST',
                url: '../services/controllers/LoginController.php',
                data: loginData,
                dataType: 'json',
                beforeSend: function () {
                    $('#login').html('Validating...');
                    $('#login').attr('disabled', true);
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
                $('#login').html('Connecting...');
                $('#login').attr('disabled', false);
                localStorage.setItem('token', accessToken);
                // window.location.href = "../";
                window.history.back();

            } else if (codeNo == "400") {
                $('#login').html('Login');
                $('#login').attr('disabled', false);
                error_alert(msgs, "warning");
            } else if (codeNo == "404") {
                $('#login').html('Login');
                $('#login').attr('disabled', false);
                error_alert(msgs, "warning");
            }
        }
    });



});