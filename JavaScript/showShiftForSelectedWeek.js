$(document).ready(function(){
    $("#weeks").on('change', function postinput(){
        var selectedWeek = $(this).val();
        xhttp.open("GET", "../Handling/scheduleHandling.php?selectedWeek=" + selectedWeek, true);
        xhttp.send();
    });
});