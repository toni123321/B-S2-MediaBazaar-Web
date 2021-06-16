var selection = false;
var selectedWeek;

$("#weeks").on('change', function (){
    var xhttp = new XMLHttpRequest();
    selectedWeek = $(this).val();
    selection = true;
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var input = this.responseText;
            $('.flex-container').html(input);
        }
    };
    xhttp.open("GET", "../Handling/scheduleHandling.php?selectedWeek=" + selectedWeek + "&selection=" + selection, true);
    xhttp.send();
});

$("body").ready(function (){
    var xhttp = new XMLHttpRequest();
    selectedWeek = $(this).val();
    selection = true;

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var input = this.responseText;
            $('.flex-container').html(input);
        }
    };
    xhttp.open("GET", "../Handling/scheduleHandling.php?selectedWeek=" + selectedWeek + "&selection=" + selection, true);
    xhttp.send();
});

$("body").ready(function (){
    var xhttp = new XMLHttpRequest();
    var selectedWeek = $(this).val();
    selection = true;

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var input = this.responseText;
            document.getElementById("weeks").selectedIndex = input - 1;

        }
    };
    xhttp.open("GET", "../Handling/setCurrentWeekScheduleSelector.php", true);
    xhttp.send();
});

/*
$("body").ready(function (){
    $.ajax({
        url:'../Handling/scheduleHandling.php',
        data: selectedWeek, selection,
        type:'GET',
        dataType: 'html',
        success:function(){

            var input = this.responseText;
            $('.flex-container').html(input);

            document.getElementById("weeks").selectedIndex = selectedWeek;

        }})
});
*/
