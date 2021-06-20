<?php include_once '../Logic/EmployeeManager.class.php';?>
<?php
  function LoginHandling($employee_id, $email, $departmentName)
  {
    $error_msg = "Login credentials invalid!";

    $employeeManager = new EmployeeManager();
    $allEmployees = $employeeManager->GetAllEmployees();

    if($employeeManager->GetEmployee($employee_id) != null)
    {
      $currEmp = $employeeManager->GetEmployee($employee_id);

      if( $currEmp->GetDepartment()->GetName() == $departmentName && $currEmp->GetEmail() == $email)
      {
          // Set session for user to save id
          session_start();
          //$_SESSION['loggedUser'] = serialize($currEmp);
          $_SESSION['loggedUserId'] = $currEmp->GetID();
          header("Location: ../HTML-PHP/homepage.php");
      }
      else{
          session_start();
          $_SESSION['error_login'] = $error_msg;
          header("Location: ../HTML-PHP/landing-login.php");
          exit();
      }
    }
    else{
        $dbHelper = new DbHelper();
        $isEmpCredentialsValid = $dbHelper->GetUsersExpiringContract($employee_id, $email, $departmentName);

        if ($isEmpCredentialsValid) {
            session_start();
            $_SESSION['error_login'] = "Your contract is expired so you can't log in into your account! 
            Please contact the Administration department for more info!";
            header("Location: ../HTML-PHP/landing-login.php");
            exit();
        }
        else {
            session_start();
            $_SESSION['error_login'] = $error_msg;
            header("Location: ../HTML-PHP/landing-login.php");
            exit();
        }
    }
  }

  if(isset($_POST['email']) && isset($_POST['employeeId']) && isset($_POST['departmentName']))
  {
      $email = (string) $_POST['email'];
      $employee_id = (int) $_POST['employeeId'];
      $departmentName = (string) $_POST['departmentName'];
      //echo "Email: {$email}; ID: {$employee_id}; DepName: {$departmentName}";
      if($email == '' || $employee_id == '' || $departmentName == '') {
          session_start();
          $_SESSION['error_login'] = "Type in all the boxes to login!";
          header("Location: ../HTML-PHP/landing-login.php");
          exit();
      }
      else {
          LoginHandling($employee_id, $email, $departmentName);
      }

  }
?>
