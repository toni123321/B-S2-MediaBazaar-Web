
<?php
include_once '../Logic/EmployeeManager.class.php';
session_start();
if(isset($_SESSION['loggedUserId']))
{
    $loggedEmpId = (int)$_SESSION['loggedUserId'];
    // get $curr user from db
    $employeeManager = new EmployeeManager();
    $currEmp = $employeeManager->GetEmployee($loggedEmpId);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account page</title>
    <link rel="stylesheet" href="../CSS/account-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="../Libraries/jquery-3.6.0.min.js"></script>
</head>


<body>
  <div class="back-container">
    <div class="top">
      <p>Account settings</p>
      <a href="../HTML-PHP/homepage.php" class="closeBtn">
          <i class="fas fa-times"></i>
      </a>
    </div>

    <div class="front-container">
      <img src="../Images/avatar.png" alt="avatar" />
      <form id="accountForm" class="form-group" action="../Handling/accountHandling.php" method="post">
        <div class="email">
          <label for="email">Email</label>
          <input type="text" name="email" id="email" placeholder="Enter your email" value="<?php echo $currEmp->GetEmail()?>"/>
        </div>

        <div class="phoneNumber">
          <label for="phoneNumber">Phone number</label>
          <input type="text" name = "phoneNumber" id="phoneNumber" placeholder="Enter your phone number" value="<?php echo $currEmp->GetPhoneNumber()?>"/>
        </div>

        <div class="street">
          <label for="street">Street</label>
          <input type="text" name="street" id="street" placeholder="Enter your street" value="<?php echo $currEmp->GetStreet()?>"/>
        </div>

        <div class="city">
          <label for="city">City</label>
          <input type="city" name="city" id="city" placeholder="Enter your city" value="<?php echo $currEmp->GetCity()?>"/>
        </div>

        <div class="country">
          <label for="country">Country</label>
          <input type="country" name="country" id="country" placeholder="Enter your country" value="<?php echo $currEmp->GetCountry()?>"/>
        </div>

        <div class="postCode">
          <label for="postCode">Post code</label>
          <input type="text" name = "postCode" id="postCode" placeholder="Enter your post code" value="<?php echo $currEmp->GetPostCode()?>"/>
        </div>

<!---->
<!--        <div class="bsn">-->
<!--          <label for="bsn">Bsn</label>-->
<!--          <input type="bsn" name="bsn" id="bsn" placeholder="Enter your Bsn number" value="--><?php //echo $currEmp->GetBSN()?><!--"/>-->
<!--        </div>-->

        <div class="emConName">
          <label for="emConName">Emergency contact name</label>
          <input type="emConName" name = "emConName" id="emConName" placeholder="Enter your emergency contact name" value="<?php echo $currEmp->GetEmConName()?>"/>
        </div>

        <div class="emConRelation">
          <label for="emConRelation">Emergency Contact Relation</label>
          <input type="emConRelation" name="emConRelation" id="emConRelation" placeholder="Enter your Emergency Contact Relation" value="<?php echo $currEmp->GetEmCOnRelation()?>"/>
        </div>

        <div class="emConEmail">
          <label for="emConEmail">Emergency contact email</label>
          <input type="emConEmail" name = "emConEmail" id="emConEmail" placeholder="Enter your emergency contact email" value="<?php echo $currEmp->GetEmConEmail()?>"/>
        </div>
        <div class="emConPhone">
          <label for="emConPhone">Emergency Contact Phone number</label>
          <input type="emConPhone" name="emConPhoneNum" id="emConPhone" placeholder="Enter your Emergency Contact phone number" value="<?php echo $currEmp->GetEmConPhone()?>"/>
        </div>
      </form>
    </div>

    <div class="bottom">
      <button class="reset_button" type="button" name="reset_button">Reset</button>
      <button class="save_button" type="submit" name="save_button" form="accountForm">Save</button>
    </div>
  </div>
  <script src="../JavaScript/reloadAccountPageHandling.js"></script>

  <?php
    if(isset($_SESSION['edit-account-details-msg']))
    {
        $msg = (string) $_SESSION['edit-account-details-msg'];
        //echo "<h2 class='msg'>{$msg}</h2>";
    ?>

        <script type="text/javascript">
            let msg = <?php echo json_encode($msg); ?>;
            alert(msg);
        </script>

        <?php
        unset($_SESSION['edit-account-details-msg']);
    }
    ?>
</body>
</html>

<?php
}
else{
    header("Location: ../HTML-PHP/landing-login.php");
}
?>