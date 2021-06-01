setInterval(function () {
    $.get('../HTML-PHP/homepage.php', function(result) {
        $('body').html(result);
    });
}, 5000);
