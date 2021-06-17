<?php

if(isset($_GET['nrRequests']))
{
    $nrRequests = (int) ($_GET['nrRequests']);
    for ($i=$nrRequests;$i<$nrRequests + 5;$i++) {
        //TODO: call db handler to retrive current number of requests
    }

}
?>