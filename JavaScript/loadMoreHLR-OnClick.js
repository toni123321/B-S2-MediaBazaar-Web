$('.loadNewDataOnClick').click(function (){
    var xhttp = new XMLHttpRequest();
    let employeeId= empId;
    let currentNrOfRequests = $('.requests-table tr').length - 1;

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if($.trim(this.responseText)) {
                let moreRequests = this.responseText;
                $('.requests-table').append(moreRequests);
            }
            else{
                alert("There are no more holiday leave requests in the history");
            }
        }
    };
    xhttp.open("GET", "../Handling/loadHLR-History-handling.php?employeeId=" + employeeId + "&nrRequests=" + currentNrOfRequests, true);
    xhttp.send();


});