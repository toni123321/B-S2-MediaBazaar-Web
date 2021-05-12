<?php

session_start();
if(isset($_SESSION['loggedUser']))
{
  $currEmp = unserialize($_SESSION['loggedUser']);

  

}

?>
