<?php 
// Dates
$daysInTheMonth = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
$firstDayInTheMonth = date("w",mktime(0,0,0,date("m"),1,date("Y")));
?>