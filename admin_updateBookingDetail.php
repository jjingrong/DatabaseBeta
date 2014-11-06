<?php
	require('dbConnection.php');
	require('includes/html_form.class.php');
	session_start();
	require('admin_config.php');
	$errMsg = "";
	$success = "";

	if(isset($_REQUEST['change'])) {
		$ReferenceNo = $_SESSION['ReferenceNo'];
		$PassportNumber = $_SESSION['PassportNumber'];
		$name = $_REQUEST['name'];
		$ContactNum = $_REQUEST['ContactNum'];
		$ContactEmail = $_REQUEST['ContactEmail'];

		$bookingDetail_update = sprintf("UPDATE Booking SET ContactEmail = '%s', ContactNum = '%s' WHERE ReferenceNo = '%s' AND PassportNumber = '%s'", mysql_real_escape_string($ContactEmail), mysql_real_escape_string($ContactNum), mysql_real_escape_string($ReferenceNo), mysql_real_escape_string($PassportNumber));


        $result = mysql_query($bookingDetail_update, $link);
        if(!$result) {
            $errMsg = "Edit Fails Please contact the adminstrator.";
        } else {
			$bookingDetail_update = sprintf("UPDATE Passenger SET name = '%s' WHERE PassportNumber = '%s'", mysql_real_escape_string($name), mysql_real_escape_string($PassportNumber));

			$result = mysql_query($bookingDetail_update, $link);
			if(!$result) {
            	$errMsg = "Edit Fails Please contact the adminstrator.";
        	} else {
        		$success = "The updated has been successful. Please click on the link to view the changes made <a href='admin_bookingManagement.php'>Back</a>";
        	}
        } 
	} else {
		$_SESSION['ReferenceNo'] = $_REQUEST['ReferenceNo'];
		$_SESSION['PassportNumber'] = $_REQUEST['PassportNumber'];
	}

	$name = $_REQUEST['name'];
	$ContactNum = $_REQUEST['ContactNum'];
	$ContactEmail = $_REQUEST['ContactEmail'];
	
	// create instance of HTML_Form
	$frm = new HTML_Form();

	// using $frmStr to concatenate long string of form elements
	// startForm arguments: action, method, id, optional attributes added in associative array
	$frmStr = $frm->startForm('?change=1', 'post', 'demoForm') . PHP_EOL .

	$frm->startTag('p') . 
	$frm->addLabelFor('Reference No', 'Reference No : ') .                            
	$frm->addInput('text', 'ReferenceNo', $_SESSION['ReferenceNo'], array('id'=>'ReferenceNo', 'size'=>16, 'disabled'=>true) ) . 

	$frm->startTag('p') . 
	$frm->addLabelFor('Passport No', 'Passport No : ') .                            
	$frm->addInput('text', 'PassportNumber', $_SESSION['PassportNumber'], array('id'=>'PassportNumber', 'size'=>16, 'disabled'=>true) ) . 

	$frm->startTag('p') . 
	$frm->addLabelFor('Name', 'Name : ') .                            
	$frm->addInput('text', 'name', $name, array('id'=>'name', 'size'=>16, 'required'=>true) ) .

	$frm->startTag('p') . 
	$frm->addLabelFor('ContactNum', 'Contact Num: ') .                            
	$frm->addInput('text', 'ContactNum', $ContactNum, array('ContactNum', 'size'=>16, 'required'=>true) ) .

	$frm->startTag('p') . 
	$frm->addLabelFor('ContactEmail', 'Contact Email: ') .                            
	$frm->addInput('text', 'ContactEmail', $ContactEmail, array('ContactEmail', 'size'=>16, 'required'=>true) ) .
	
	// endTag remembers startTag (but you can pass tag if nesting or for clarity)
	$frm->endTag() . PHP_EOL .
	$frm->startTag('p') . 
	$frm->addInput('submit', 'submit', 'Submit') . 
	$frm->endTag() . PHP_EOL .
	                                        
	$frm->endForm();
?>


<?php require('front_half.php'); ?>
<h1>Update Booking Contact Person Details</h1>
	<?php 
		echo $errMsg;
		echo $success;
		echo $frmStr; 
	?>
	<a href='admin_page.php' style="float:left; display:block; margin: 0px 10px 5px 0px; background:#ccc; text-decoration:none; color:#fff; padding: 10px; width:14%; color:#fff; border-radius:5px;">Back to Admin Page.</a>
<?php require('lower_half.php'); ?>

