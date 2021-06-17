$('.loadNewDataOnClick').click(function (){
    var xhttp = new XMLHttpRequest();
    let currentNrOfRequests = $('.requests-table tr').length;

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let moreRequests = this.responseText;
            $('.requests-table').append("<tr>\n" +
                "            <td>20-02-2020</td>\n" +
                "            <td>25-02-2020</td>\n" +
                "            <td>12-01-2020</td>\n" +
                "            <td>Accepted</td>\n" +
                "        </tr>");
        }
    };
    xhttp.open("GET", "../Handling/loadHLR-History-handling.php?nrRequests=" + currentNrOfRequests, true);
    xhttp.send();


});