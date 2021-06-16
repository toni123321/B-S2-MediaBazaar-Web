/*
$(document).ready(function(){
    $("#weeks").on('change', function postinput(){
        var selectedWeek = $(this).val();
        xhttp.open("GET", "../Handling/scheduleHandling.php?selectedWeek=" + selectedWeek, true);
        xhttp.send();
    });
});*/
/*
$('.test').click(function (){
    var xhttp = new XMLHttpRequest();
    let testVariable = 5
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };
    xhttp.open("GET", "../Handling/scheduleHandling.php?test=" + testVariable,true);
    xhttp.send();
});*/

$("#weeks").on('change', function (){
    var xhttp = new XMLHttpRequest();
    var selectedWeek = $(this).val();
    console.log(selectedWeek);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);

        }
    };
    xhttp.open("GET", "../Handling/scheduleHandling.php?selectedWeek=" + selectedWeek, true);
    xhttp.send();
});
