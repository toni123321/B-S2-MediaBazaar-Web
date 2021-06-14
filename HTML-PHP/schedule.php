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
        <title>Home page</title>
        <link rel="stylesheet" href="../CSS/homepage-style.css">
        <link rel="stylesheet" href="../CSS/schedule.css">

        <script src="../Libraries/jquery-3.6.0.min.js"></script>
    </head>
    <body>
    <?php include 'main.php';?>
    <div class="weekSelector">
        <a href="#" class="pointer arrow down"><i class="fas fa-arrow-left"></i></a>
        <select name="weeks" id="weeks">
            <?php include '../Handling/addWeeks.php';?>
        </select>
        <a href="#" class="pointer arrow up"><i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="flex-container">
        <div class="weekDayTile">
            <div class="hasAttended">Attended</div>
            <div class="weekday">Monday</div>
            <hr class="hr">
            <div class="date">23 June 2021</div>
            <div class="time">08:00-12:30</div>
            <hr class="hr-2ndShift">
            <div class="date">23 June 2021</div>
            <div class="time">12:30-17:00</div>
        </div>
        <div class="weekDayTile">
            <div class="hasAttended">Attended</div>
            <div class="weekday">Tuesday</div>
            <hr class="hr">
            <div class="date">23 June 2021</div>
            <div class="time">08:00-12:30</div>
        </div>
        <div class="weekDayTile">
            <div class="dayOffAttended">Day off</div>
            <div class="weekday">Wednesday</div>
            <hr class="hr">
            <div>No shift(s)</div>
        </div>
        <div class="weekDayTile">
            <div class="hasAttended">Attended</div>
            <div class="weekday">Thursday</div>
            <hr class="hr">
            <div class="date">23 June 2021</div>
            <div class="time">08:00-12:30</div>
        </div>
        <div class="weekDayTile">
            <div class="upcoming">Upcoming shift</div>
            <div class="weekday">Friday</div>
            <hr class="hr">
            <div class="date">23 June 2021</div>
            <div class="time">08:00-12:30</div>
            <hr class="hr-2ndShift">
            <div class="date">23 June 2021</div>
            <div class="time">12:30-17:00</div>
        </div>
        <div class="weekDayTile">
            <div class="upcoming">Upcoming shift</div>
            <div class="weekday">Saturday</div>
            <hr class="hr">
            <div class="date">23 June 2021</div>
            <div class="time">08:00-12:30</div>
        </div>
        <div class="weekDayTile">
            <div class="upcoming">Upcoming shift</div>
            <div class="weekday">Sunday</div>
            <hr class="hr">
            <div class="date">23 June 2021</div>
            <div class="time">08:00-12:30</div>
            <hr class="hr-2ndShift">
            <div class="date">23 June 2021</div>
            <div class="time">12:30-17:00</div>
        </div>
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
