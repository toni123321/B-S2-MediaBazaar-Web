<?php
$dateNowString = date("Y-m-d");
$dateNow = strtotime($dateNowString);
$shiftWeek = idate('W', $dateNow);

echo $shiftWeek;