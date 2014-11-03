<?php
	require('dbConnection.php');
    require('includes/html_form.class.php');
	session_start();
	require('admin_config.php');

    if(ISSET($_REQUEST["delete"])) {
        $IATACode = $_REQUEST["IATACode"];
        $flightNo = $_REQUEST["FlightNo"];
        $DepartureTime = $_REQUEST["DepartureTime"];

        $query_delete_booking = sprintf("DELETE FROM seatsbooking WHERE IATACode = '%s' AND FlightNo = '%s' AND DepartureTime = '%s'", mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo), mysql_real_escape_string($DepartureTime));
        $result = mysql_query( $query_delete_booking, $link );
        if(!$result) {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query_delete_booking;
            die($message);
        }
        $query_delete_seatType = sprintf("DELETE FROM seatstype WHERE IATACode = '%s' AND FlightNo = '%s' AND DepartureTime = '%s'", mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo), mysql_real_escape_string($DepartureTime));
        $result = mysql_query($query_delete_seatType, $link );
        if(!$result) {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query_delete_seatType;
            die($message);
        }
        
        $query_delete_flight = sprintf("DELETE FROM flight WHERE IATACode = '%s' AND FlightNo = '%s' AND DepartureTime = '%s'", mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo), mysql_real_escape_string($DepartureTime));
        $result = mysql_query($query_delete_flight, $link );
        if(!$result) {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query_delete_flight;
            die($message);
        }


    }

    echo "The flight No : " . $flightNo . " scheduled on : " .$DepartureTime. " has been deleted.";

?>
<br>
<a href="admin_page.php">Back</a>
