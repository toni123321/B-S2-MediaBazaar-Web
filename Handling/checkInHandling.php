<?php
include_once '../DataAccess/DbHelper.php';

session_start();

if(issetSE($_SESSION['nextShiftId'])){
    $nextShiftId = (int)($_SESSION['nextShiftId']);
    $dbHelper = new DbHelper();

    $dbHelper->CheckInShift($nextShiftId);

    unset($_SESSION['nextShiftId']);

    header("../Handling/scheduleHandling.php");
}