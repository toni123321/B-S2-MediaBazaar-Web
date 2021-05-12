<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="../CSS/account-style.css">
</head>


<body>
  <?php
    include '../Models/Employee.php';
    session_start();
    if(isset($_SESSION['loggedUser']))
    {
      $currEmp = unserialize($_SESSION['loggedUser']);
    }
  ?>
  <div class="back-container">
    <div class="top">
      <p>Account settings</p>
      <a href="#"><svg fill="#000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
          <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
          <path d="M0 0h24v24H0z" fill="none" /></svg></a>
    </div>

    <div class="front-container">
      <img src="../Images/avatar.png" alt="avatar" />
      <form class="form-group" action="#" method="post">
        <div class="email">
          <label for="email">Email</label>
          <input type="text" id="email" placeholder="Enter your email" value="<?php echo $currEmp->GetEmail()?>"/>
        </div>

        <div class="phoneNumber">
          <label for="phoneNumber">Phone number</label>
          <input type="text" id="phoneNumber" placeholder="Enter your phone number" value="<?php echo $currEmp->GetPhoneNumber()?>"/>
        </div>

        <div class="street">
          <label for="street">Street</label>
          <input type="text" id="street" placeholder="Enter your street" value="<?php echo $currEmp->GetStreet()?>"/>
        </div>

        <div class="city">
          <label for="city">City</label>
          <input type="city" id="city" placeholder="Enter your city" value="<?php echo $currEmp->GetCity()?>"/>
        </div>

        <div class="country">
          <label for="country">Country</label>
          <input type="country" id="country" placeholder="Enter your country" value="<?php echo $currEmp->GetCountry()?>"/>
        </div>

        <div class="postCode">
          <label for="postCode">Post code</label>
          <input type="text" id="postCode" placeholder="Enter your post code" value="<?php echo $currEmp->GetPostCode()?>"/>
        </div>


        <div class="bsn">
          <label for="bsn">Bsn</label>
          <input type="bsn" id="bsn" placeholder="Enter your Bsn number" value="<?php echo $currEmp->GetBSN()?>"/>
        </div>

        <div class="emConName">
          <label for="emConName">Emergency contact name</label>
          <input type="emConName" id="emConName" placeholder="Enter your emergency contact name" value="<?php echo $currEmp->GetEmConName()?>"/>
        </div>

        <div class="emConRelation">
          <label for="emConRelation">Emergency Contact Relation</label>
          <input type="emConRelation" id="emConRelation" placeholder="Enter your Emergency Contact Relation" value="<?php echo $currEmp->GetEmCOnRelation()?>"/>
        </div>

        <div class="emConEmail">
          <label for="emConEmail">Emergency contact email</label>
          <input type="emConEmail" id="emConEmail" placeholder="Enter your emergency contact email" value="<?php echo $currEmp->GetEmConEmail()?>"/>
        </div>
        <div class="emConPhone">
          <label for="emConPhone">Emergency Contact Phone number</label>
          <input type="emConPhone" id="emConPhone" placeholder="Enter your Emergency Contact phone number" value="<?php echo $currEmp->GetEmConPhone()?>"/>
        </div>
      </form>
    </div>

    <div class="bottom">
      <button class="cancel_button" type="button" name="cancel_button">Cancel</button>
      <button class="save_button" type="button" name="save_button">Save</button>
      <!-- <a href="#">Cancel</a>
      <a href="#">Save</a> -->
    </div>
  </div>
</body>
</html>
