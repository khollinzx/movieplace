//  Logging Out the User
// and Clearing the JWT Token from LocalStorage
$(document).ready(function () {
    $('#logout').on('click', function () {
        localStorage.clear();
    });
});