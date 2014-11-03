<?php
	require('dbConnection.php');
	require('includes/html_form.class.php');
	session_start();
	require('admin_config.php');
	echo $welcome_msg . "</br>";
	$html_table = "<table border='1' cellspacing='5' cellpadding='8' style='border-collapse:collapse'>"; 

	$query = "SELECT * FROM fullflightdetails";

	$result = mysql_query($query);

	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}

	$html_table .= "<tr><td>IATACode</td><td>Flight No.</td><td>Departure Time</td><td>Arrival Time</td><td> Source </td><td> Destination </td><td>Class Type</td><td>Price</td><td>Capacity</td><td>Update</td><td>Delete</td></tr>";

	while ($row = mysql_fetch_assoc($result)) {
		$html_table .= "<tr>";
		$html_table .= "<td>" . $row["IATACode"] . "</td>";
		$html_table .= "<td>" . $row["FlightNo"] . "</td>";
		$html_table .= "<td>" . $row["DepartureTime"] . "</td>";
		$html_table .= "<td>" . $row["ArrivalTime"] . "</td>";
		$html_table .= "<td>" . $row["source"] . "</td>";
		$html_table .= "<td>" . $row["destination"] . "</td>";
		$html_table .= "<td>" . $row["classType"] . "</td>";
		$html_table .= "<td>" . $row["price"] . "</td>";
		$html_table .= "<td>" . $row["seatCount"] . "</td>";
		
		// create instance of HTML_Form
		$frm = new HTML_Form();

		// using $frmStr to concatenate long string of form elements
		// startForm arguments: action, method, id, optional attributes added in associative array
		$frmStr = $frm->startForm('admin_edit.php?edit=1', 'post') . PHP_EOL .

    	$frm->addInput('hidden', 'IATACode', $row["IATACode"], array('id'=>'IATACode') ) .
    	$frm->addInput('hidden', 'FlightNo', $row["FlightNo"], array('id'=>'FlightNo') ) .
    	$frm->addInput('hidden', 'DepartureTime', $row["DepartureTime"], array('id'=>'DepartureTime') ) .
    	$frm->addInput('hidden', 'ArrivalTime', $row["ArrivalTime"], array('id'=>'ArrivalTime') ) .
    	$frm->addInput('hidden', 'source', $row["source"], array('id'=>'source') ) .
    	$frm->addInput('hidden', 'destination', $row["destination"], array('id'=>'destination') ) .
    	$frm->addInput('hidden', 'classType', $row["classType"], array('id'=>'classType') ) .
    	$frm->addInput('hidden', 'price', $row["price"], array('id'=>'price') ) .
    	$frm->addInput('hidden', 'seatCount', $row["seatCount"], array('id'=>'seatCount') ) .

	    $frm->startTag('p') . 
	    $frm->addInput('submit', 'submit', 'Update') . 
	    $frm->endTag() . PHP_EOL .

        $frm->endForm();

        $html_table .= "<td>" . $frmStr . "</td>";

        // create instance of HTML_Form
		$deletefrm = new HTML_Form();

		// using $frmStr to concatenate long string of form elements
		// startForm arguments: action, method, id, optional attributes added in associative array
		$delFrmStr = $deletefrm->startForm('admin_delete.php?delete=1', 'post') . PHP_EOL .

    	$deletefrm->addInput('hidden', 'IATACode', $row["IATACode"], array('id'=>'IATACode') ) .
    	$deletefrm->addInput('hidden', 'FlightNo', $row["FlightNo"], array('id'=>'FlightNo') ) .
    	$deletefrm->addInput('hidden', 'DepartureTime', $row["DepartureTime"], array('id'=>'DepartureTime') ) .
    	$deletefrm->addInput('hidden', 'ArrivalTime', $row["ArrivalTime"], array('id'=>'ArrivalTime') ) .
    	$deletefrm->addInput('hidden', 'source', $row["source"], array('id'=>'source') ) .
    	$deletefrm->addInput('hidden', 'destination', $row["destination"], array('id'=>'destination') ) .
    	$deletefrm->addInput('hidden', 'classType', $row["classType"], array('id'=>'classType') ) .
    	$deletefrm->addInput('hidden', 'price', $row["price"], array('id'=>'price') ) .
    	$deletefrm->addInput('hidden', 'seatCount', $row["seatCount"], array('id'=>'seatCount') ) .

	    $deletefrm->startTag('p') . 
	    $deletefrm->addInput('submit', 'submit', 'Delete') . 
	    $deletefrm->endTag() . PHP_EOL .

        $deletefrm->endForm();
        $html_table .= "<td>" . $delFrmStr . "</td>";
		$html_table .= "</tr>";
	}
	$html_table .= "</table>";
	echo "<h1>Flight Seats Details</h1>";
	echo $html_table;

		$flights_query = "SELECT * FROM flight";

	$result = mysql_query($flights_query);

	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}

	$html_table = "<table border='1' cellspacing='5' cellpadding='8' style='border-collapse:collapse'>"; 

	$html_table .= "<tr><td>IATACode</td><td>Flight No.</td><td>Departure Time</td><td>Arrival Time</td><td> Source </td><td> Destination </td><td>Update</td><td>Delete</td></tr>";

	while ($row = mysql_fetch_assoc($result)) {
		$html_table .= "<tr>";
		$html_table .= "<td>" . $row["IATACode"] . "</td>";
		$html_table .= "<td>" . $row["FlightNo"] . "</td>";
		$html_table .= "<td>" . $row["DepartureTime"] . "</td>";
		$html_table .= "<td>" . $row["ArrivalTime"] . "</td>";
		$html_table .= "<td>" . $row["source"] . "</td>";
		$html_table .= "<td>" . $row["destination"] . "</td>";
		
		// create instance of HTML_Form
		$flightFrm = new HTML_Form();

		// using $frmStr to concatenate long string of form elements
		// startForm arguments: action, method, id, optional attributes added in associative array
		$frmStr = $flightFrm->startForm('admin_flightEdit.php?edit=1', 'post', 'editForm', array('class'=>'editForm')) . PHP_EOL .

    	$flightFrm->addInput('hidden', 'IATACode', $row["IATACode"], array('id'=>'IATACode') ) .
    	$flightFrm->addInput('hidden', 'FlightNo', $row["FlightNo"], array('id'=>'FlightNo') ) .
    	$flightFrm->addInput('hidden', 'DepartureTime', $row["DepartureTime"], array('id'=>'DepartureTime') ) .
    	$flightFrm->addInput('hidden', 'ArrivalTime', $row["ArrivalTime"], array('id'=>'ArrivalTime') ) .
    	$flightFrm->addInput('hidden', 'source', $row["source"], array('id'=>'source') ) .
    	$flightFrm->addInput('hidden', 'destination', $row["destination"], array('id'=>'destination') ) .

	    $flightFrm->startTag('p') . 
	    $flightFrm->addInput('submit', 'submit', 'Update') . 
	    $flightFrm->endTag() . PHP_EOL .

        $flightFrm->endForm();

        $html_table .= "<td>" . $frmStr . "</td>";

        // create instance of HTML_Form
		$deleteFlightfrm = new HTML_Form();

		// using $frmStr to concatenate long string of form elements
		// startForm arguments: action, method, id, optional attributes added in associative array
		$delFrmStr = $deleteFlightfrm->startForm('admin_flightDelete.php?delete=1', 'post', 'deleteForm', array('class'=>'deleteForm') ) . PHP_EOL .

    	$deleteFlightfrm->addInput('hidden', 'IATACode', $row["IATACode"], array('id'=>'IATACode') ) .
    	$deleteFlightfrm->addInput('hidden', 'FlightNo', $row["FlightNo"], array('id'=>'FlightNo') ) .
    	$deleteFlightfrm->addInput('hidden', 'DepartureTime', $row["DepartureTime"], array('id'=>'DepartureTime') ) .
    	$deleteFlightfrm->addInput('hidden', 'ArrivalTime', $row["ArrivalTime"], array('id'=>'ArrivalTime') ) .
    	$deleteFlightfrm->addInput('hidden', 'source', $row["source"], array('id'=>'source') ) .
    	$deleteFlightfrm->addInput('hidden', 'destination', $row["destination"], array('id'=>'destination') ) .

	    $deleteFlightfrm->startTag('p') . 
	    $deleteFlightfrm->addInput('submit', 'submit', 'Delete') . 
	    $deleteFlightfrm->endTag() . PHP_EOL .

        $deleteFlightfrm->endForm();
        $html_table .= "<td>" . $delFrmStr . "</td>";
		$html_table .= "</tr>";
	}
	$html_table .= "</table>";
	echo "<h1>Flights Available</h1>";
	echo $html_table;
?>

<a href="admin_newFlight.php">New Flight</a>