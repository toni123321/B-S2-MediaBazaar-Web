<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="../CSS/main.css">
    <title>Main</title>
</head>
<body>
    <div class="header">
        <div class="grid-items" id="logo"></div>

        <div class="navbar grid-items">
            <div class="progress_bar_container">
                <div class="progress_bar"></div>
            </div>
            <a href="../HTML-PHP/homepage.php"><i class="fa fa-fw fa-home"></i></a>
            <a href="#"><i class="fa fa-calendar"></i></a>
            <a href="../HTML-PHP/accountPage.php"><i class="fa fa-fw fa-user account"></i></a>

            <?php
              // if (isset($_SESSION['loggedUser'])) {
              //     echo '<a href=""><i class="fas fa-sign-out-alt"></i></a>';
              // }
              echo '<a href="../Handling/logoutHandling.php"><i class="fas fa-sign-out-alt"></i></a>';

            ?>
        </div>
    </div>

</body>
</html>
