<?php

session_start();
include '../Logic/EmployeeManager.php';
if(isset($_SESSION['loggedUser']))
{
  $email = $_POST['email'];
  $street = $_POST['street'];
  $phoneNumber = $_POST['phoneNumber'];
  $country = $_POST['country'];
  $city = $_POST['city'];
  $bsn = $_POST['bsn'];
  $emConName = $_POST['emConName'];
  $emConRelation = $_POST['emConRelation'];
  $emConEmail = $_POST['emConEmail'];
  $emConPhoneNum = $_POST['emConPhoneNum'];
  $postCode = $_POST['postCode'];

  //echo $email;

  $currEmp = unserialize($_SESSION['loggedUser']);
  $newEmp = new Employee($currEmp->GetID(), $currEmp->GetFirstName(), $currEmp->GetLastName(), $currEmp->GetDateOfBirth(), $currEmp->GetGender(), $email, $phoneNumber, $street, $city, $country, $postCode, $bsn, $emConName, $emConRelation, $emConEmail, $emConPhoneNum, $currEmp->GetEmploymentType(), $currEmp->GetHourlyWages(), $currEmp->GetDepartment(), $currEmp->GetRemainingHolidayDays());
  $employee_manager = new EmployeeManager();
  $employee_manager->UpdateEmployee($newEmp);

  $_SESSION['loggedUser'] = serialize($employee_manager->GetEmployee($newEmp->GetID()));
  //$test = unserialize($_SESSION['loggedUser']);
  //echo $test->GetEmConName();
  header("Location: ../HTML-PHP/homepage.php");
}

?>
