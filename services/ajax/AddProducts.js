$(document).ready(function () {
    getGenre();
    getMovies();

    $(document).on('keyup', function () {
        $('#error').html('');
        $('#error2').html('');
    });


    function error_alert(value, type) {
        $('#error').html(
            `<div class="alert alert-${type}" role="alert"><strong><i class="fas fa-warning"></i></strong>&ensp;${value}</div>`
        );
    }

    function error_alert2(value, type) {
        $('#error2').html(
            `<div class="alert alert-${type}" role="alert"><strong><i class="fas fa-warning"></i></strong>&ensp;${value}</div>`
        );
    }



    $('#saveGenre').click(function (e) {
        if ($('#genre').val() == '') {
            if ($('#genre').val() == '') {
                error_alert('Enter Genre Name', 'warning');
            }
        } else {
            saveGenre();
        }

        function saveGenre() {
            var accessToken = localStorage.getItem("token");
            var genreDetails = $('#genreDetails').serialize();
            $.ajax({
                type: 'POST',
                url: '../../services/controllers/AddGenreController.php',
                data: genreDetails,
                headers: {
                    Authorization: accessToken
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#saveGenre').html('Saving Changes...');
                    $('#saveGenre').attr('disabled', true);
                },
                success: function (response) {
                    saveGenreProcess(response.value);
                },
            }); // ends create ajax
        }

        function saveGenreProcess(data) {
            var codeNo = '';
            var msgs = '';
            $.each(data, function (key, item) {
                codeNo = item.code;
                msgs = item.msgs;
            });
            if (codeNo == "200") {
                $('#saveGenre').html('Saving Change...');
                $('#saveGenre').attr('disabled', false);
                $(".modal").modal('hide');
                getGenre();
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Save Succesfully',
                    showConfirmButton: false,
                    timer: 2500,
                });

            } else if (codeNo == "400") {
                $('#saveGenre').html('Save Changes');
                $('#saveGenre').attr('disabled', false);
                error_alert(msgs, "warning");
            } else if (codeNo == "404") {
                $('#saveGenre').html('Save Changes');
                $('#saveGenre').attr('disabled', false);
                error_alert(msgs, "warning");
            }
        }
    });

    function getGenre() {
        $.ajax({
            url: '../../services/Controllers/GetGenreController.php',
            type: 'GET',
            data: 'getGenres',
            dataType: 'json',
            beforeSend: function () {

            }
        }).done(function (data) {
            if (data.data != 'zero') {

                if (data.count != 0) {
                    //call manage data function
                    getGenreList(data.data);
                } else {
                    $("#genre_list").html('No List Found');
                }

            } else {
                $("#genre_list").html('No List Found');
            }

        });
    }

    function getGenreList(data) {
        var row = '';
        $.each(data, function (key, value) {
            row += `<li class="list-group-item d-flex justify-content-between align-items-center">${value.name} <span class="badge badge-primary badge-pill">${value.count}</span></li>`;
        });

        $("#genre_list").html(row);
    }


    $('#saveProduct').on("click", function () {
        if (
            $('#productTitle').val() == '' || $('#price').val() == '' || $('#description').val() == '' || $('#genre_type').val() == '' || $('#photo').val() == ''
        ) {
            if ($('#productTitle').val() == '') {
                error_alert2('Movie Title is Required', 'warning');
            } else if ($('#price').val() == '') {
                error_alert2('Price is Required', 'warning');
            } else if ($('#description').val() == '') {
                error_alert2('Description is Required', 'warning');
            } else if ($('#genre_type').val() == '') {
                error_alert2('Select a Genre', 'warning');
            } else if ($('#photo').val() == '') {
                error_alert2('Photo is Required', 'warning');
            }
        } else {
            createFile();
        }

        function createFile() {
            var productTitle = $("#productTitle").val();
            var price = $("#price").val();
            var description = $("#description").val();
            var genre_type = $("#genre_type").val();
            var photo = $("#photo").prop("files")[0];
            var form_data = new FormData();
            form_data.append("productTitle", productTitle);
            form_data.append("price", price);
            form_data.append("description", description);
            form_data.append("genre_type", genre_type);
            form_data.append("photo", photo);
            var accessToken = localStorage.getItem('token');
            $.ajax({
                type: 'POST',
                url: '../../services/controllers/AddMovieProductController.php',
                data: form_data,
                dataType: 'json',
                headers: {
                    Authorization: accessToken,
                    Content_type: "Application/json"
                },
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('#saveProduct').html('Saving Product....');
                    $('#saveProduct').attr('disabled', true);
                },
                success: function (response) {
                    SaveMovieProduct(response.value);
                },
            }); // createFolder Ajax Ends
        } // ends createFolder function

        function SaveMovieProduct(data) {
            var codeNo = '';
            var msgs = '';
            $.each(data, function (key, item) {
                codeNo = item.code;
                msgs = item.msgs;
            });
            if (codeNo == "200") {
                $('#saveProduct').html('Save Product');
                $('#saveProduct').attr('disabled', false);
                $(".modal").modal('hide');
                getMovies();
                getGenre();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Movie Product Saved',
                    showConfirmButton: false,
                    timer: 1500
                });

            } else if (codeNo == "400") {
                $('#saveProduct').html('Save Product');
                $('#saveProduct').attr('disabled', false);
                error_alert2(msgs, "danger");
            } else if (codeNo == "404") {
                $('#saveProduct').html('Save Product');
                $('#saveProduct').attr('disabled', false);
                error_alert2(msgs, "danger");
            }
        }
    });


    function getMovies() {
        $.ajax({
            url: '../../services/Controllers/GetMovieController.php',
            type: 'GET',
            data: 'getMovies',
            dataType: 'json'
        }).done(function (data) {
            if (data.data != 'zero') {
                if (data.count != 0) {
                    //call manage data function
                    getMovieList(data.data);
                } else {
                    $("#movie_list").html('No List Found');
                }

            } else {
                $("#movie_list").html('No List Found');
            }

        });
    }

    function getMovieList(data) {
        var row = '';
        $.each(data, function (key, value) {
            row += `<tr>`;
            row += `<td>${value.index}</td>`;
            row += `<td>${value.name}</td>`;
            row += `<td><span>&#8358;</span>${value.price}</span></td>`;
            row += `<td><span class="badge badge-success"> ${value.genre}</span></td>`;
            row += `<td data-id=${value.id}>
                        <button class="btn btn-primary view"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-warning edit"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger delete"><i class="fas fa-trash"></i></button>
                    </td>`;
            row += `</tr>`;
        });


        $("#movie_list").html(row);
    }


});