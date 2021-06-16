<?php
session_start();
include_once '../Logic/EmployeeManager.class.php';

if(isset($_SESSION['loggedUserId'])) {

    $dateNowString = date("Y-m-d H:i:s");

    $loggedEmpId = (int)$_SESSION['loggedUserId'];
    $dbHelper = new DbHelper();



    $startDateString = strtotime((string)$_POST['startDate']);
    //$startDate = getDate($startDateString);


    $startDate = date('Y-m-d', $startDateString);



    $endDateString = strtotime((string)$_POST['endDate']);
    $endDate = date('Y-m-d', $endDateString);


    $earlier = new DateTime($endDate);
    $later = new DateTime($startDate);


    $comment = (string)$_POST['comment'];
    $totalDays = $later->diff($earlier)->format("%a");



    echo "End date: {$endDate} <br> Start date: {$startDate} <br>" . date("Y-m-d") . '<br>';


    if($startDate < date("Y-m-d")) {
        echo "Smaller start date";
    }

    if($endDate >= $startDate && $startDate > date("Y-m-d")) {
        $dbHelper->InsertHLR($loggedEmpId, $startDate, $endDate, $totalDays, $comment, $dateNowString);

        session_start();
        $_SESSION['holidayRequestSent-msg'] = "You have successfully sent a holiday leave request!";
        header("Location: ../HTML-PHP/holidayLeaveRequest.php");
        exit();
    }
    else{
        echo 'Error :/';
    }


}
