<?php
  session_start();
  unset($_SESSION['loggedUser']);
  header("Location:../HTML-PHP/homepage.php");
?>
