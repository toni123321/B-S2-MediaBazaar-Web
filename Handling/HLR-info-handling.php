<?php
session_start();
include_once '../Logic/EmployeeManager.class.php';
if(isset($_SESSION['loggedUserId']))
{
    $loggedEmpId = (int)$_SESSION['loggedUserId'];
    $dbHelper = new DbHelper();

    $usedHolidayDays = $dbHelper->GetUsedHolidayDays($loggedEmpId);
    $remainingHolidayDays = $dbHelper->GetReaminingHolidayDays($loggedEmpId);
    $totalHolidayDays = $usedHolidayDays + $remainingHolidayDays;

    echo $usedHolidayDays;
    echo $remainingHolidayDays;
    echo $totalHolidayDays;

}