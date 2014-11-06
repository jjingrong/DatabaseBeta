<?php
	require('dbConnection.php');
	require('includes/html_form.class.php');
	session_start();
	require('admin_config.php');
	$errMsg = "";
	$success = "";

	if(isset($_REQUEST['delete'])) {
		$ReferenceNo = $_REQUEST["ReferenceNo"];
		$PassportNumber = $_REQUEST["PassportNumber"];
		$query = sprintf("DELETE FROM booking WHERE ReferenceNo = '%s' AND PassportNumber = '%s'", mysql_real_escape_string($ReferenceNo), mysql_real_escape_string($PassportNumber));

		$result = mysql_query($query);
		$success = "<b>The booking with the ReferenceNo : " . $ReferenceNo . " , together with all accompanying passenger has been deleted.</b>";
		$html_table = "";
	} else {
		$passport = htmlspecialchars($_POST['passport']);
		$reference = htmlspecialchars($_POST['reference']);

		$query = "SELECT * FROM booking b INNER JOIN passenger p ON b.PassportNumber = p.PassportNumber WHERE p.PassportNumber='".$passport."' AND b.ReferenceNo ='".$reference."' LIMIT 1;";

		$html_table = "<h3>Flight Details</h3><table border='1' cellspacing='5' cellpadding='8' style='border-collapse:collapse'>"; 
		$html_table .= "<tr><td>Ref No</td><td>Person Booking</td><td>ContactNum</td><td>ContactEmail</td><td>Update Details</td><td>Cancel Booking</td></tr>";
	}
	//echo $query;
	$result = mysql_query($query);

	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		$errMsg = "Something went wrong. Please Contact Admin";
	} else if (!isset($_REQUEST['delete'])) {
		if (mysql_num_rows($result)==0 ) {
			$errMsg = "No results found. Please ensure that you have entered the correct Reference No and Passport Number.";
			$html_table = "";
		} else {
			while ($row = mysql_fetch_assoc($result)) {
				$html_table .= "<tr>";
				$html_table .= "<td>" . $row["ReferenceNo"] . "</td>";
				$html_table .= "<td>" . $row["name"] . "</td>";
				$html_table .= "<td>" . $row["ContactNum"] . "</td>";
				$html_table .= "<td>" . $row["ContactEmail"] . "</td>";

				// create instance of HTML_Form
				$editfrm = new HTML_Form();

				$editFrmStr = $editfrm->startForm('admin_updateBookingDetail.php', 'post') . PHP_EOL .

		    	$editfrm->addInput('hidden', 'ReferenceNo', $row["ReferenceNo"], array('id'=>'ReferenceNo') ) .
		    	$editfrm->addInput('hidden', 'name', $row["name"], array('id'=>'name') ) .
		    	$editfrm->addInput('hidden', 'PassportNumber', $row["PassportNumber"], array('id'=>'PassportNumber') ) .
		    	$editfrm->addInput('hidden', 'ContactNum', $row["ContactNum"], array('id'=>'ContactNum') ) .
		    	$editfrm->addInput('hidden', 'ContactEmail', $row["ContactEmail"], array('id'=>'ContactEmail') ) .

			    $editfrm->startTag('p') . 
			    $editfrm->addInput('submit', 'submit', 'Edit Details') . 
			    $editfrm->endTag() . PHP_EOL .

		        $editfrm->endForm();
		        $html_table .= "<td>" . $editFrmStr . "</td>";

				// create instance of HTML_Form
				$deletefrm = new HTML_Form();

				$delFrmStr = $deletefrm->startForm('?delete=1', 'post') . PHP_EOL .

		    	$deletefrm->addInput('hidden', 'ReferenceNo', $row["ReferenceNo"], array('id'=>'ReferenceNo') ) .
		    	$deletefrm->addInput('hidden', 'PassportNumber', $row["PassportNumber"], array('id'=>'PassportNumber') ) .

			    $deletefrm->startTag('p') . 
			    $deletefrm->addInput('submit', 'submit', 'Delete') . 
			    $deletefrm->endTag() . PHP_EOL .

		        $deletefrm->endForm();
		        $html_table .= "<td>" . $delFrmStr . "</td>";
				$html_table .= "</tr>";
				$html_table .= "</table>";

				$html_table .= "<h3>Passenger Details</h3><table border='1' cellspacing='5' cellpadding='8' style='border-collapse:collapse'>"; 
				$html_table .= "<tr><td>No.</td><td>Name</td><td>PassportNumber</td><td>Date of Birth</td></tr>";
				$html_table .= "<tr>";
				$html_table .= "<td>1</td>";
				$html_table .= "<td>" . $row["name"] . "</td>";
				$html_table .= "<td>" . $row["PassportNumber"] . "</td>";
				$tdate = explode(" ",$row["DOB"]);
				$html_table .= "<td>" . $tdate[0] . "</td>";
				$html_table .= "</tr>";
			}


				

			$query = "SELECT * FROM accompanied_booking a INNER JOIN passenger p ON a.PassportNumber = p.PassportNumber WHERE a.ReferenceNo ='".$reference."';";
			//echo $query;
			$result = mysql_query($query);
			$i = 1;
			while ($row = mysql_fetch_assoc($result)) {
				$html_table .= "<tr>";
				$html_table .= "<td>" . $i . "</td>";
				$html_table .= "<td>" . $row["name"] . "</td>";
				$html_table .= "<td>" . $row["PassportNumber"] . "</td>";
				$tdate = explode(" ",$row["DOB"]);
				$html_table .= "<td>" . $tdate[0] . "</td>";
				$html_table .= "</tr>";
				$i += 1;
			}
			$html_table .= "</table>";
		}

	}
?>
<?php require('front_half.php'); ?>
<h2>Check & Modify Existing Booking</h2>
<?php
	echo $errMsg;
	echo $success;
	echo $html_table;
?>
<br>
<?php require('lower_half.php'); ?>

