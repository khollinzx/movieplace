$(document).ready(function () {

    function error_alert(value, type) {
        $('#error').html(
            `<div class="alert alert-${type}" role="alert"><strong><i class="fas fa-warning"></i></strong>&ensp;${value}</div>`
        );
    }

    $('#signup').click(function (e) {
        if (
            $('#full_name').val() == '' || $('#email_address').val() == '' || $('#date_of_birth').val() == '' || $('#password').val() == ''
        ) {
            if ($('#full_name').val() == '') {
                error_alert('Full Name is Required', 'warning');
            } else if ($('#email_address').val() == '') {
                error_alert('Email is Required', 'warning');
            } else if ($('#date_of_birth').val() == '') {
                error_alert('Date of Birth is Required', 'warning');
            } else if ($('#password').val() == '') {
                error_alert('Password is Required', 'warning');
            }
        } else {
            signupUser();
        }

        function signupUser() {
            var signupData = $('#signupdetails').serialize();
            $.ajax({
                type: 'POST',
                url: '../services/controllers/SignupController.php',
                data: signupData,
                dataType: 'json',
                beforeSend: function () {
                    $('#signup').html('Validating...');
                    $('#signup').attr('disabled', true);
                },
                success: function (response) {
                    signupUserProcess(response.value);
                },
            }); // ends create ajax
        }

        function signupUserProcess(data) {
            var codeNo, msgs, accessToken = '';
            $.each(data, function (key, item) {
                codeNo = item.code;
                msgs = item.msgs;
                accessToken = item.token;
            });
            if (codeNo == "200") {
                $('#signup').html('Connecting...');
                $('#signup').attr('disabled', false);
                window.location.href = "../";
                localStorage.setItem("token", accessToken);

            } else if (codeNo == "400") {
                $('#signup').html('Submit');
                $('#signup').attr('disabled', false);
                error_alert(msgs, "warning");
            } else if (codeNo == "404") {
                $('#signup').html('Submit');
                $('#signup').attr('disabled', false);
                error_alert(msgs, "warning");
            }
        }
    });


});