<?php

/*
 * @author Emmanuel John
 * 
 * @return json The schedule for the week or the day if a day param is passed
 * 
 */
require_once("../domain/model.php");

$day = $_GET["day"];

if ( !is_numeric($day) || $day < 0 || 6 < $day ) {
	header("HTTP/1.1 400 Bad Request");
	exit("Day of week is empty or invalid.");
}

$schedule = get_schedule($day);

header("Content-Type: application/json");
echo json_encode($schedule);
?>
