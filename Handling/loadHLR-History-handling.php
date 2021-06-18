<?php
include_once '../Logic/HLR-Manager.class.php';
if(isset($_GET['nrRequests']) && isset($_GET['employeeId']))
{
    $employeeId = (int) ($_GET['employeeId']);
    $nrRequests = (int) ($_GET['nrRequests']);

    $requests = array();
    $hlrManager = new HlrManager();
    if($nrRequests == 0) {
        $hlrManager->LoadMostRecentRequests($employeeId, $nrRequests);
        $requests = $hlrManager->GetLoadedRequests();
    }
    else{
        $hlrManager->LoadMoreRequests($employeeId, $nrRequests);
        $requests = $hlrManager->GetLoadedRequests();
    }


    if($requests != null) {
        for ($i = 0; $i < count($requests); $i++) {

            $currRequest = $requests[$i];
            echo
                '
            <tr>
                <td>' . $currRequest->GetStartDay()->format('Y-m-d') . '</td>
                <td>' . $currRequest->GetEndDay()->format('Y-m-d') . '</td>
                <td>' . $currRequest->GetRequestDate()->format('Y-m-d') . '</td>
                <td>' . $currRequest->GetStatus() . '</td>
            </tr>
            ';
        }
    }
}
?>