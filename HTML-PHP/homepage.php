

  <?php include '../Logic/EmployeeManager.php';?>
  <?php
  session_start();
  if(isset($_SESSION['loggedUser']))
  {

    $currEmp = unserialize($_SESSION['loggedUser']);

  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="../CSS/homepage-style.css">
</head>
<body>
    <?php include 'main.php';?>
    <div class="content">
        <div class="welcome-text">
            <h2>Welcome, <?php echo $currEmp->GetFirstName(); ?></h2>
            <p>Your next shift starts in [days] and [hours]</p>
        </div>
        <div class="btnview">
<!--            <a href="#">View full schedule ></a>-->
            <button>View full schedule ></button>
            <h2>

            </h2>
        </div>
    </div>
</body>
</html>
<?php
  }
  else{
    header("Location: ../HTML-PHP/landing-login.php");
  }
?>
