var current_title = $(document).attr('title');
if (current_title == "Home") {
    $('nav a').removeClass('active');
    $('#home').addClass('active');
}
else if(current_title == "Schedule") {
    $('nav a').removeClass('active');
    $('#schedule').addClass('active');
}