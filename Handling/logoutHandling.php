<?php
  session_start();
  unset($_SESSION['loggedUserId']);
  header("Location:../HTML-PHP/homepage.php");
?>
