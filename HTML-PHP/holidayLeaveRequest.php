<?php

include_once '../Logic/EmployeeManager.class.php';
include_once '../Handling/timeUntilNextShift.php';
?>
<?php

if(isset($_SESSION['loggedUserId']))
{
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HolidayLeaveRequests</title>

    <link rel="stylesheet" href="../CSS/holidayLeaveRequest.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
<script src="../JavaScript/dateTimePicker.js"></script>
<?php include 'main.php';?>
<?php include_once '../DataAccess/DbHelper.php'; ?>

<?php

if(isset($_SESSION['holidayRequestSent-msg'])) {
    $msg = (string)$_SESSION['holidayRequestSent-msg'];
    echo "<h3 class='msg'>{$msg}</h3>";
    unset($_SESSION['holidayRequestSent-msg']);
}
?>

<div class="hlr-send-request">
    <img src="../Images/holidayAvatar.png" alt="avatar" />
    <form  class="form-hlr-send-request" action="../Handling/HLR-form-handling.php" method="post">
        <?php
        $loggedEmpId = (int)$_SESSION['loggedUserId'];
        $dbHelper = new DbHelper();
        $HLR_requests = $dbHelper->GetNumberHLRsPerEmp($loggedEmpId);
        if($HLR_requests >= 3){
           echo '<div class="datePicker">
            <div class="from-wrapper">
                <label for="from">From:</label>
                <input type="text" id="from" name="startDate" disabled>
            </div>
            <div class="to-wrapper">
                <label for="to">to:</label>
                <input type="text" id="to" name="endDate" disabled>
            </div>
        </div>
        <div class="textarea-wrapper">
            <label for="reasonHLR">Reason:</label>
            <textarea name="comment" disabled></textarea>
            <button class="btnHolidayRequest disabledHLRbtn" disabled>Submit <i class="fas fa-arrow-right"></i></button>
        </div>';
        }
        else{
            echo '<div class="datePicker">
            <div class="from-wrapper">
                <label for="from">From:</label>
                <input type="text" id="from" name="startDate" required>
            </div>
            <div class="to-wrapper">
                <label for="to">to:</label>
                <input type="text" id="to" name="endDate" required>
            </div>
        </div>
        <div class="textarea-wrapper">
            <label for="reasonHLR">Reason:</label>
            <textarea name="comment" required></textarea>
            <button class="btnHolidayRequest enabledHLRbtn">Submit <i class="fas fa-arrow-right"></i></button>
        </div>';
        }
        ?>
    </form>
</div>
<?php

include_once '../Logic/EmployeeManager.class.php';

if (isset($_SESSION['loggedUserId'])) {
    $loggedEmpId = (int)$_SESSION['loggedUserId'];
    $dbHelper = new DbHelper();

    $usedHolidayDays = $dbHelper->GetUsedHolidayDays($loggedEmpId);

    $remainingHolidayDays = $dbHelper->GetRemainingHolidayDays($loggedEmpId);

    $pendingHolidayDays = $dbHelper->GetPendingHolidayDays($loggedEmpId);
    $totalHolidayDays = $usedHolidayDays + $remainingHolidayDays;
}

echo '
<div class="hlr-statistics">
    <h3>Holiday days</h3>
    <ul class="hlr-statistics-list">
        <li>TOTAL: ' . $totalHolidayDays . '</li>
        <li>REMAINING: '. $remainingHolidayDays .'</li>
        <li>USED: '. $usedHolidayDays .'</li>
        <li>PENDING: '. $pendingHolidayDays .'</li>
    </ul>
</div>
';
?>
<div class="hlr-request-history">
    <h3>Recent holiday requests</h3>
    <table class="requests-table">
        <tr>
            <th>StartDay</th>
            <th>EndDay</th>
            <th>SubmittedOn</th>
            <th>Status</th>
        </tr>
    </table>
    <button class="loadNewDataOnClick">Load more</button>

</div>
<script>
    var empId = <?php echo json_encode($loggedEmpId); ?>;
</script>
<script src="../JavaScript/loadMostRecentHLR.js"></script>
<script src="../JavaScript/loadMoreHLR-OnClick.js"></script>
</body>
</html>
<?php
}
else{
    header("Location: ../HTML-PHP/landing-login.php");
}
?>