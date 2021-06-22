<?php
include_once '../DataAccess/DbHelper.php';

session_start();

if(isset($_SESSION['nextShiftId'])){
    $nextShiftId = (int)($_SESSION['nextShiftId']);
    $dbHelper = new DbHelper();

    $dbHelper->CheckInShift($nextShiftId);


    header("Location:../HTML-PHP/schedule.php");
}