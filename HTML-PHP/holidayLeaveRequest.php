<?php?>
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
    <script>
        let maxDate = 30;
    $( function() {
        var dateFormat = "mm/dd/yy",
            from = $( "#from" )
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1,
                    minDate: "+1W",
                    showWeek: true,
                    firstDay: 1
                })
                    /*.on( "change", function() {
                        to.datepicker( "option", "minDate", getDate( this ) );
                    }),*/
            to = $( "#to" ).datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                minDate: "+7D",
                showWeek: true,
                firstDay: 1
            })
                /*.on( "change", function() {
                    from.datepicker( "option", "maxDate", getDate( this ) );
                });*/

        /*function getDate( element ) {
            var date;
            try {
                date = $.datepicker.parseDate( dateFormat, element.value );
            } catch( error ) {
                date = null;
            }

            return date;
        }*/
    } );
    </script>
    <?php include 'main.php';?>
    <div class="front-container">
        <img src="../Images/holidayAvatar.png" alt="avatar" />
        <form id="accountForm" class="form-group" action="../Handling/accountHandling.php" method="post">
            <!--<div class="email">
                <label for="">Field</label>
                <input type="text" name="" id="" placeholder=""/>
            </div>-->
            <div class="datePicker">
                <div class="from-wrapper">
                    <label for="from">From:</label>
                    <input type="text" id="from" name="from">
                </div>
                <div class="to-wrapper">
                    <label for="to">to:</label>
                    <input type="text" id="to" name="to">
                </div>
            </div>

            <div class="textarea-wrapper">
                <textarea></textarea>
                <button class="btnHolidayRequest">Submit <i class="fas fa-arrow-right"></i></button>
            </div>

        </form>
    </div>

</body>
</html>
