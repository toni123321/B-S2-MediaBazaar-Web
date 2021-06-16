<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
session_start();
if(isset($_SESSION['holidayRequestSent-msg'])) {
    $msg = (string)$_SESSION['holidayRequestSent-msg'];
    echo "<h3 class='msg'>{$msg}</h3>";
    unset($_SESSION['holidayRequestSent-msg']);
}
?>

<div class="front-container">
    <img src="../Images/holidayAvatar.png" alt="avatar" />
    <form id="accountForm" class="form-group" action="../Handling/HLR-form-handling.php" method="post">
        <!--<div class="email">
            <label for="">Field</label>
            <input type="text" name="" id="" placeholder=""/>
        </div>-->


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

</body>
</html>
