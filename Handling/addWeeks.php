<?php
$year = date("Y");
$weeks=date("W",strtotime('28th December '. $year));

for ($i = 1; $i <= $weeks; $i++) {
    echo '<option value="'.$i.'">'.$i.'</option>';
}

?>