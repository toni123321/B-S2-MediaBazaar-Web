<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login page</title>
    <link rel="stylesheet" href="../CSS/landing-login-styles.css">
    <script src="../Libraries/jquery-3.6.0.min.js"></script>

</head>
<body>
    <div class="main-parent">
        <div class="main">
            <p class="login-title" >Log in</p>

            <form class="loginForm" action="../Handling/loginHandling.php" method="post">
                <input class="email" name="email" type="text" align="center" placeholder="Email...">
                <input class="employeeId" name="employeeId" type="text" align="center" placeholder="Employee id...">
                <input class="department" list="department" name="departmentName" type="text" align="center" placeholder="Department...">
                <datalist id="department">
                    <?php include '../Logic/DepartmentManager.php';?>
                    <?php
                    $departmentManager = new DepartmentManager();
                    $allDepartments = $departmentManager->GetAllDepartments();
                    foreach ($allDepartments as $department) {

                    ?>
                      <option value="<?php echo $department->GetName(); ?>">
                    <?php
                    }
                    ?>
                </datalist>
                <button class="submit" type="submit">Sign in</button>
<!--                <p class="forgot"><a href="#">Forgot Password?</p>-->
            </form>
        </div>
    </div>
    <script src="../JavaScript/loginHandling.js">

    </script>

</body>
</html>
