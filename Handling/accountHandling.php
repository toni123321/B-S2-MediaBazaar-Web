<?php

session_start();
include_once '../Logic/EmployeeManager.class.php';
if(isset($_SESSION['loggedUser']))
{
  $email = $_POST['email'];
  $street = $_POST['street'];
  $phoneNumber = $_POST['phoneNumber'];
  $country = $_POST['country'];
  $city = $_POST['city'];
  $emConName = $_POST['emConName'];
  $emConRelation = $_POST['emConRelation'];
  $emConEmail = $_POST['emConEmail'];
  $emConPhoneNum = $_POST['emConPhoneNum'];
  $postCode = $_POST['postCode'];

  //echo $email;

  $loggedEmpId = (int)$_SESSION['loggedUserId'];

  $employeeManager = new EmployeeManager();
  $currEmp = $employeeManager->GetEmployee($loggedEmpId);

  $editedEmp = new Employee($currEmp->GetID(), $currEmp->GetFirstName(), $currEmp->GetLastName(), $currEmp->GetDateOfBirth(), $currEmp->GetGender(), $email, $phoneNumber, $street, $city, $country, $postCode, $emConName, $emConRelation, $emConEmail, $emConPhoneNum, $currEmp->GetEmploymentType(), $currEmp->GetHourlyWages(), $currEmp->GetDepartment(), $currEmp->GetRemainingHolidayDays());


  $dbHelper = new DbHelper();
  $isRequestAlreadySent = $dbHelper->IsAccountEditRequestSent($editedEmp->GetID());
  echo $isRequestAlreadySent;
  //echo $dbHelper->IsAccountEditRequestSent($editedEmp->GetID());
  if($isRequestAlreadySent == true)
  {
    $dateNowString = date("Y-m-d H:i:s");
    $newRequestDate = new DateTime($dateNowString);
    $dbHelper->UpdateAccountEditRequest($editedEmp, $newRequestDate);
  }
  else {
    $dateNowString = date("Y-m-d H:i:s");
    $requestDate = new DateTime($dateNowString);
    $dbHelper->SendAccountEditRequest($editedEmp, $requestDate);
  }

  //$employee_manager = new EmployeeManager();
  //$employee_manager->UpdateEmployee($newEmp);

  //$_SESSION['loggedUser'] = serialize($employee_manager->GetEmployee($newEmp->GetID()));
  //$test = unserialize($_SESSION['loggedUser']);
  //echo $test->GetEmConName();
  $_SESSION['edit-account-details-msg'] = "Your request has been sent to HR team!";
  header("Location: ../HTML-PHP/accountPage.php");
  exit();
}

?>
