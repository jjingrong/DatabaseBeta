<?php
		require('dbConnection.php');
		require('includes/html_form.class.php');
		session_start();
		require('admin_config.php');
		$success = "";
		$errMsg = "";
		$count = 0;

		$IATACode = $_REQUEST["IATACode"];
		$flightNo = $_REQUEST["FlightNo"];
		$DepartureTime = $_REQUEST["DepartureTime"];

		$query = sprintf("SELECT DISTINCT ab.PassportNumber AS 'AccompaniedPN', p.name, sb.ReferenceNo, b.ContactNum, b.ContactEmail  FROM seatsbooking sb INNER JOIN accompanied_booking ab ON sb.ReferenceNo = ab.ReferenceNo INNER JOIN passenger p ON p.PassportNumber = ab.PassportNumber INNER JOIN booking b ON sb.ReferenceNo = b.ReferenceNo WHERE IATACode = '%s' AND FlightNo = '%s' AND DepartureTime = '%s'", mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo), mysql_real_escape_string($DepartureTime));


		$result = mysql_query($query);

		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		} else {

			$html_table = "<table border='1' cellspacing='5' cellpadding='8' style='border-collapse:collapse'>"; 
			$html_table .= "<tr><td>Booking Ref No.</td><td>Passport Number</td><td>Name</td><td>Contact No</td><td>Contact Email</td></tr>";

			while ($row = mysql_fetch_assoc($result)) {
				$count ++;
				$html_table .= "<tr>";
				$html_table .= "<td>" . $row["ReferenceNo"] . "</td>"; 
				$html_table .= "<td>" . $row["AccompaniedPN"] . "</td>";
				$html_table .= "<td>" . $row["name"] . "</td>";
        		$html_table .= "<td>" . $row["ContactNum"] ."</td>";
        		$html_table .= "<td>" . $row["ContactEmail"] ."</td>";
				$html_table .= "</tr>";
			}

			$query = sprintf("SELECT DISTINCT b.PassportNumber AS 'MainPN', p.name, sb.ReferenceNo, b.ContactNum, b.ContactEmail FROM seatsbooking sb INNER JOIN booking b ON sb.ReferenceNo = b.ReferenceNo INNER JOIN passenger p ON p.PassportNumber = b.PassportNumber WHERE IATACode = '%s' AND FlightNo = '%s' AND DepartureTime = '%s'", mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo), mysql_real_escape_string($DepartureTime));

			$result = mysql_query($query);

			if (!$result) {
				$message  = 'Invalid query: ' . mysql_error() . "\n";
				$message .= 'Whole query: ' . $query;
				die($message);
			} else {
				while ($row = mysql_fetch_assoc($result)) {
					$count ++;
					$html_table .= "<tr>";
					$html_table .= "<td>" . $row["ReferenceNo"] . "</td>"; 
					$html_table .= "<td>" . $row["MainPN"] . "</td>";
					$html_table .= "<td>" . $row["name"] . "</td>";
	        		$html_table .= "<td>" . $row["ContactNum"] ."</td>";
        			$html_table .= "<td>" . $row["ContactEmail"] ."</td>";
					$html_table .= "</tr>";
				}
			}
			$html_table .= "</table>";
		}
?>


<?php require('front_half.php'); ?>
<h1>Flight Details</h1>
<?php 
	echo $success;
	echo $errMsg;
	if($count == 0) {
		echo "No booking has been made for this flight";
	} else {
		echo $html_table;
	}
?>
<br>
<a href='admin_page.php' style="float:left; display:block; margin: 0px 10px 5px 0px; background:#ccc; text-decoration:none; color:#fff; padding: 10px; width:14%; color:#fff; border-radius:5px;">Back to Admin Page.</a>
<?php require('lower_half.php'); ?>