<?php include_once '../Logic/ShiftManager.class.php'; ?>

<?php
session_start();
if(isset($_SESSION['loggedUserId']))
{
    date_default_timezone_set('Europe/Amsterdam');

    $loggedUserId = (int) $_SESSION['loggedUserId'];
    $shiftManager = new ShiftManager();

    $shifts = $shiftManager->GetAllShiftsEmp($loggedUserId); //gets all shift for the logged in employee

    $dateNowString = date("Y-m-d");
    $dateNow = new DateTime($dateNowString);

    $nextShift = null;

    foreach ($shifts as $shift)
    {
        if($nextShift == null && $dateNow <= $shift->GetDate())
        {
            $nextShift = $shift;
        }
        else if($nextShift != null && date_diff($dateNow,$shift->GetDate())->format("%a") < date_diff($dateNow,$nextShift->GetDate())->format("%a") && $dateNow <= $shift->GetDate())
        {
            $nextShift = $shift;
        }
    }

    if($nextShift != null){

        $shiftDate = $nextShift->GetDate();


      if($nextShift->GetType() == "Morning")
        {
            $shiftDate->setTime(8, 00);
        }
        else if($nextShift->GetType() == "Afternoon")
        {
            $shiftDate->setTime(12, 30);
        }
        else if($nextShift->GetType() == "Evening")
        {
            $shiftDate->setTime(17, 00);
        }

        $_SESSION['nextShiftTime'] = serialize($shiftDate);
        $_SESSION['nextShiftId'] = $nextShift->GetId();
    }
    else{
        unset($_SESSION['nextShiftTime']);
    }

}

?>