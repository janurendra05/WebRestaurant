$(document).ready(function () {
    // AOS.init();

    if ($('#signUp').length) {
        $('#signUp').on('click', function () {
            $('#container').addClass('right-panel-active');
        });

        $('#signIn').click(function () {
            $('#container').removeClass('right-panel-active');
        });
    }
});