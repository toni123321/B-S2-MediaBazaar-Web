<?php
session_start();
include_once '../Logic/EmployeeManager.class.php';

if(isset($_SESSION['loggedUserId'])) {
    $loggedEmpId = (int)$_SESSION['loggedUserId'];
    $dbHelper = new DbHelper();

    $startDateString = strtotime((string)$_GET['startDate']);
    $startDate = getDate($startDateString);

    $endDateString = strtotime((string)$_GET['endDate']);
    $endDate = getDate($endDateString);

    $earlier = new DateTime("2010-07-06");
    $later = new DateTime("2010-07-09");

    $comment = (string)$_GET['comment'];
    $totalDays = $later->diff($earlier)->format("%a");

    if(strtotime($endDate) > strtotime($startDate) && strtotime($startDate) > strtotime('now')) {
        $dbHelper->InsertHLR($loggedEmpId, $startDate, $endDate, $totalDays, $comment);
    }
    else{
        echo 'Error :/';
    }


}
