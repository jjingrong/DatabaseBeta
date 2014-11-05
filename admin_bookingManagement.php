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
	}

	$query = "SELECT * FROM booking b INNER JOIN passenger p ON b.PassportNumber = p.PassportNumber";

	$html_table = "<table border='1' cellspacing='5' cellpadding='8' style='border-collapse:collapse'>"; 
	$html_table .= "<tr><td>Ref No</td><td>Name</td><td>ContactNum</td><td>ContactEmail</td><td>PassportNumber</td><td>Update Details</td><td>Cancel Booking</td></tr>";


	$result = mysql_query($query);

	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		$errMsg = "Something went wrong. Please Contact Admin";
	} else {
		while ($row = mysql_fetch_assoc($result)) {
			$html_table .= "<tr>";
			$html_table .= "<td>" . $row["ReferenceNo"] . "</td>";
			$html_table .= "<td>" . $row["name"] . "</td>";
			$html_table .= "<td>" . $row["ContactNum"] . "</td>";
			$html_table .= "<td>" . $row["ContactEmail"] . "</td>";
			$html_table .= "<td>" . $row["PassportNumber"] . "</td>";

			// create instance of HTML_Form
			$editfrm = new HTML_Form();

			$editFrmStr = $editfrm->startForm('?delete=1', 'post') . PHP_EOL .

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
		}
		$html_table .= "</table>";
	}
?>
<?php require('front_half.php'); ?>
<h1> Booking Management </h1>
<?php
	echo $errMsg . "<br>";
	echo $success . "<br>";
	echo $html_table;
?>
<br>
<a href='admin_page.php' style="float:left; display:block; margin: 0px 10px 5px 0px; background:#ccc; text-decoration:none; color:#fff; padding: 10px; width:14%; color:#fff; border-radius:5px;">Back to Admin Page.</a>
<?php require('lower_half.php'); ?>

