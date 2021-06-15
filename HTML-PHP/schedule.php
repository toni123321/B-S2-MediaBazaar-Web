<?php
include_once '../Handling/timeUntilNextShift.php';
include_once '../Logic/EmployeeManager.class.php';
?>
<?php
if(isset($_SESSION['loggedUserId']))
{
    $employeeManager = new EmployeeManager();
    $loggedUserId = (int) $_SESSION['loggedUserId'];
    $currEmp = $employeeManager->GetEmployee($loggedUserId);
    ?>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Schedule</title>
        <link rel="stylesheet" href="../CSS/homepage-style.css">
        <link rel="stylesheet" href="../CSS/schedule.css">
        <script src="../Libraries/jquery-3.6.0.min.js"></script>
    </head>
    <body>
    <?php include 'main.php';?>
    <div class="weekSelector">
        <a class="pointer arrow down"><i class="fas fa-arrow-left"></i></a>

        <select name="weeks" id="weeks">
            <?php include '../Handling/addWeeks.php';?>
        </select>
        <a class="pointer arrow up"><i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="flex-container">
        <?php include '../Handling/scheduleHandling.php';?>
    </div>
    <script src="../JavaScript/showShiftForSelectedWeek.js"></script>
    <script src="../JavaScript/weekUpDownSelector.js"></script>
    </body>
    </html>
    <?php
}
else{
    header("Location: ../HTML-PHP/landing-login.php");
}
?>
