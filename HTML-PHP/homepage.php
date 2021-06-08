
<?php

include_once '../Logic/EmployeeManager.class.php';
include_once '../Handling/timeUntilNextShift.php';
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
    <script src="../Libraries/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php include 'main.php';?>
    <div class="content">
        <div class="welcome-text">
            <h2>Welcome, <?php echo $currEmp->GetFirstName(); ?></h2>
            <?php
                if(isset($_SESSION['nextShiftTime'])) {
                    $nextShift = unserialize($_SESSION['nextShiftTime']);
                    echo "<p>Your next shift starts at {$nextShift->format('g:i')} on {$nextShift->format('j M, Y')} ({$nextShift->format('l')})</p>";
                }
                else{
                    echo '<p>There are no upcoming shifts. Have fun!</p>';
                }
            ?>

        </div>
        <div class="btnview">
<!--            <a href="#">View full schedule ></a>-->
            <button>View full schedule ></button>
            <h2>

            </h2>
        </div>
    </div>
    <script src="../JavaScript/autoRefreshHomepage.js"></script>
    <script src="../JavaScript/processProgressBar.js"></script>
</body>
</html>
<?php
}
else{
    header("Location: ../HTML-PHP/landing-login.php");
}
?>
