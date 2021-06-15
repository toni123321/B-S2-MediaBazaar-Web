<?php
session_start();

include_once '../Logic/EmployeeManager.class.php';
include_once '../DataAccess/DbHelper.php';
include_once '../Logic/ShiftManager.class.php';

if(isset($_SESSION['loggedUserId']))
{
    $employeeManager = new EmployeeManager();
    $loggedUserId = (int) $_SESSION['loggedUserId'];
    $currEmp = $employeeManager->GetEmployee($loggedUserId);
    $selectedWeekNumSTR=(string)$_POST['weekNum'];
    $selectedWeekNum=(int)$selectedWeekNumSTR;


        
    $dateNowString = date("Y-m-d");
    $dateNow = strtotime($dateNowString);
    $shiftWeek=idate('W', $dateNow); 

    if($selectedWeekNum==null || $selectedWeekNum<1 || $selectedWeekNum>53){

     $selectedWeekNum=$shiftWeek;

    }

    $shiftManager = new ShiftManager();
    $currEmpShifts=$shiftManager->GetAllShiftsEmp($loggedUserId);
    
    $shiftsForWeek=[];

    
    foreach ($currEmpShifts as $shift)
    {
        $shiftDate=$shift->GetDate();
        $shiftDateSTR=$shiftDate->format('Y-m-d');
        $shiftTimeStamp=strtotime($shiftDateSTR);
        $checkedShiftWeek=idate('W', $shiftTimeStamp);

       if($checkedShiftWeek==$selectedWeekNum){

        array_push($shiftsForWeek, $shift);
       }
    }

    header("Location: ../HTML-PHP/schedule.php");


}
?>