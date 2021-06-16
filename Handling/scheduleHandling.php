<?php

include_once '../Logic/EmployeeManager.class.php';
include_once '../DataAccess/DbHelper.php';
include_once '../Logic/ShiftManager.class.php';

if(isset($_SESSION['loggedUserId'])) {
    $employeeManager = new EmployeeManager();
    $loggedUserId = (int)$_SESSION['loggedUserId'];
    $currEmp = $employeeManager->GetEmployee($loggedUserId);

    $selectedWeekNum = (int)$_GET['selectedWeek'];



    $dateNowString = date("Y-m-d");
    $dateNow = strtotime($dateNowString);
    $shiftWeek = idate('W', $dateNow);

    if ($selectedWeekNum == null || $selectedWeekNum < 1 || $selectedWeekNum > 53) {

        $selectedWeekNum = $shiftWeek;

    }

    $shiftManager = new ShiftManager();
    $currEmpShifts = $shiftManager->GetAllShiftsEmp($loggedUserId);

    $shiftsForWeek = [];


    foreach ($currEmpShifts as $shift) {
        $shiftDate = $shift->GetDate();
        $shiftDateSTR = $shiftDate->format('Y-m-d');
        $shiftTimeStamp = strtotime($shiftDateSTR);
        $checkedShiftWeek = idate('W', $shiftTimeStamp);

        if ($checkedShiftWeek == $selectedWeekNum) {

            array_push($shiftsForWeek, $shift);
        }
    }

    $weekDays = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

    $monShift = null;
    $tueShift = null;
    $wedShift = null;
    $thuShift = null;
    $friShift = null;
    $satShift = null;
    $sunShift = null;

    $monShift2 = null;
    $tueShift2 = null;
    $wedShift2 = null;
    $thuShift2 = null;
    $friShift2 = null;
    $satShift2 = null;
    $sunShift2 = null;

    if (count($shiftsForWeek) > 0) {

        foreach ($shiftsForWeek as $shift) {
            if ($shift->GetDate()->format('w') == 1 && $monShift == null) {
                $monShift = $shift;
            }

             if($shift->GetDate()->format('w') == 2 && $tueShift == null){
                 $tueShift = $shift;
             }
             else if($shift->GetDate()->format('w') == 2 && $tueShift != null){
                 $tueShift2 = $shift;
             }

             if($shift->GetDate()->format('w') == 3 && $wedShift == null){
                 $wedShift = $shift;
             }
             else if($shift->GetDate()->format('w') == 3 && $wedShift != null){
                 $wedShift2 = $shift;
             }

             if($shift->GetDate()->format('w') == 4 && $thuShift == null){
                 $thuShift = $shift;
             }
             else if($shift->GetDate()->format('w') == 4 && $thuShift != null){
                 $thuShift2 = $shift;
             }

             if($shift->GetDate()->format('w') == 5 && $friShift == null){
                 $friShift = $shift;
             }
             else if($shift->GetDate()->format('w') == 5 && $friShift != null){
                 $friShift2 = $shift;
             }

             if($shift->GetDate()->format('w') == 6 && $satShift == null){
                 $satShift = $shift;
             }
             else if($shift->GetDate()->format('w') == 6 && $satShift != null){
                 $satShift2 = $shift;
             }

             if($shift->GetDate()->format('w') == 0 && $sunShift == null){
                 $sunShift = $shift;
             }
             else if($shift->GetDate()->format('w') == 0 && $sunShift != null){
                 $sunShift2 = $shift;
             }
        }

        function AddWeekDayTile($shift1, $shift2, $wd){
            $dateNowString = date("Y-m-d");

            echo '<div class="weekDayTile">';
            if ($shift1 == null) {
                echo '<div class="dayOffAttended">Day off</div>';
            } else if ($shift1->GetDate()->format('Y-m-d')> $dateNowString) {
                echo '<div class="upcoming">Upcoming shift</div>';
            } else if ($shift1->GetHasAttended() == true)     {
                echo '<div class="hasAttended">Attended</div>';
            } else if ($shift1->GetHasAttended() == false) {
                echo '<div class="hasNotAttended">Absent</div>';
            }
            if($shift1 == null){
                echo '<div class="weekday">'. $wd .'</div>';
            }
            else{
                echo '<div class="weekday">'. $shift1->GetDate()->format('l') .'</div>';
            }
            echo '<hr class="hr">';
            if ($shift1 == null) {
                echo '<div>No shift(s)</div>';
            } else if ($shift2 == null) {
                echo '<div class="date">' . $shift1->GetDate()->format('j M Y') . '</div>';
                if ($shift1->GetType() == "Morning") {
                    echo '<div class="time">08:00-12:00</div>';
                } else if ($shift1->GetType() == "Afternoon") {
                    echo '<div class="time">12:00-16:00</div>';
                } else if ($shift1->GetType() == "Evening") {
                    echo '<div class="time">16:00-20:00</div>';
                };
            } else {
                echo '<div class="date">' . $shift1->GetDate()->format('j M Y') . '</div>';
                if ($shift1->GetType() == "Morning") {
                    echo '<div class="time">08:00-12:00</div>';
                } else if ($shift1->GetType() == "Afternoon") {
                    echo '<div class="time">12:00-16:00</div>';
                } else if ($shift1->GetType() == "Evening") {
                    echo '<div class="time">16:00-20:00</div>';
                }
                echo '<hr class="hr-2ndShift">';
                echo '<div class="date">' . $shift2->GetDate()->format('j M Y') . '</div>';
                if ($shift2->GetType() == "Morning") {
                    echo '<div class="time">08:00-12:00</div>';
                } else if ($shift2->GetType() == "Noon") {
                    echo '<div class="time">12:00-16:00</div>';
                } else if ($shift2->GetType() == "Evening") {
                    echo '<div class="time">16:00-20:00</div>';
                }
            }
            echo '</div>';
        }

        AddWeekDayTile($monShift, $monShift2, "Monday");
        AddWeekDayTile($tueShift, $tueShift2, "Tuesday");
        AddWeekDayTile($wedShift, $wedShift2, "Wednesday");
        AddWeekDayTile($thuShift, $thuShift2, "Thursday");
        AddWeekDayTile($friShift, $friShift2, "Friday");
        AddWeekDayTile($satShift, $satShift2, "Saturday");
        AddWeekDayTile($sunShift, $sunShift2, "Sunday");

        /*echo '<div class="weekDayTile">';
        if ($monShift == null) {
            echo '<div class="dayOffAttended">Day off</div>';
        } else if ($monShift->GetDate()->format('Y-m-d')> $dateNowString) {
            echo '<div class="upcoming">Upcoming shift</div>';
        } else if ($monShift->GetHasAttended() == true)     {
            echo '<div class="hasAttended">Attended</div>';
        } else if ($monShift->GetHasAttended() == false) {
            echo '<div class="hasNotAttended">Absent</div>';
        }
        echo '<div class="weekday">'. $monShift->GetDate()->format('D') .'</div>';
        echo '<hr class="hr">';
        if ($monShift == null) {
            echo '<div>No shift(s)</div>';
        } else if ($monShift2 == null) {
            echo '<div class="date">' . $monShift->GetDate()->format('j M Y') . '</div>';
            if ($monShift->GetType() == "Morning") {
                echo '<div class="time">08:00-12:00</div>';
            } else if ($monShift->GetType() == "Afternoon") {
                echo '<div class="time">12:00-16:00</div>';
            } else if ($monShift->GetType() == "Evening") {
                echo '<div class="time">16:00-20:00</div>';
            };
        } else {
            echo '<div class="date">' . $monShift->GetDate()->format('j M Y') . '</div>';
            if ($monShift->GetType() == "Morning") {
                echo '<div class="time">08:00-12:00</div>';
            } else if ($monShift->GetType() == "Afternoon") {
                echo '<div class="time">12:00-16:00</div>';
            } else if ($monShift->GetType() == "Evening") {
                echo '<div class="time">16:00-20:00</div>';
            }
            echo '<hr class="hr-2ndShift">';
            echo '<div class="date">' . $monShift2->GetDate()->format('j M Y') . '</div>';
            if ($monShift2->GetType() == "Morning") {
                echo '<div class="time">08:00-12:00</div>';
            } else if ($monShift2->GetType() == "Noon") {
                echo '<div class="time">12:00-16:00</div>';
            } else if ($monShift2->GetType() == "Evening") {
                echo '<div class="time">16:00-20:00</div>';
            }
        }
        echo '</div>';*/



    }
}