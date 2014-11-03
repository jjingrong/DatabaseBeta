<?php
	require('dbConnection.php');
	session_start();
	require('admin_config.php');

	$IATACode = $_REQUEST["IATACode"];
	$flightNo =	$_REQUEST["FlightNo"];
	$DepartureTime = $_REQUEST["DepartureTime"];
	$classType = $_REQUEST["classType"];

	$seatbooking_delete = sprintf("DELETE FROM seatsbooking WHERE classType = '%s' AND IATACode = '%s' AND FlightNo = '%s' AND DepartureTime = '%s'", mysql_real_escape_string($classType), mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo), mysql_real_escape_string($DepartureTime));
	$result = mysql_query( $seatbooking_delete, $link );
	if(!$result) {
  		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $seatbooking_delete;
		die($message);
	}

	$seatType_delete = sprintf("DELETE FROM seatstype WHERE classType = '%s' AND IATACode = '%s' AND FlightNo = '%s' AND DepartureTime = '%s'", mysql_real_escape_string($classType), mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo), mysql_real_escape_string($DepartureTime));

	$result = mysql_query($seatType_delete, $link);
	if(!$result) {
  		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $seatType_delete;
		die($message);
	}
	
	echo "The seat type" . $classType . " of the flight No : " . $flightNo . " scheduled on : " .$DepartureTime. " has been deleted.";
?>
<br>
<a href="admin_page.php">Back</a>