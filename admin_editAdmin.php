<?php 
	require('dbConnection.php');
	require('includes/html_form.class.php');
	session_start();
	require('admin_config.php');

	$errMsg = "";
	$success = "";
	
	if(ISSET($_REQUEST['update'])) {
		$username = $_SESSION['edit_username'];
		$password = $_REQUEST['password'];

		$query = sprintf("UPDATE account SET password = '%s' WHERE username = '%s'", mysql_real_escape_string($password), mysql_real_escape_string($username));
		$result = mysql_query($query);

		if(!$result) {
			 $message  = 'Invalid query: ' . mysql_error() . "\n";
			 $message .= 'Whole query: ' . $query;
			 echo $message;
             $errMsg = "Edit Fails Please contact the adminstrator.";
        }
        $success = "The updated has been successful. Please click on the link to view the changes made <a href='admin_manageAdmin.php'>Back</a>";

	}

	if(ISSET($_REQUEST['edit']) && ISSET($_REQUEST['username'])) {
		$username = $_REQUEST['username'];
		$_SESSION['edit_username'] = $username;

		$frm = new HTML_Form();
		$frmStr = $frm->startForm('?update=1', 'post') . PHP_EOL .
        
        // wrap form elements in paragraphs 
        $frm->startTag('p') . 
        // label and text input with optional attributes
        $frm->addLabelFor('UserName', 'Username : ') .
        // using html5 required attribute
        $frm->addInput('Text', 'usernameField', $_REQUEST["username"], array('id'=>"usernameField", 'size'=>16, 'disabled'=>true) ) . 
        // endTag remembers startTag (but you can pass tag if nesting or for clarity)
        $frm->endTag() . PHP_EOL .

        $frm->startTag('p') . 
        // label and text input with optional attributes
        $frm->addLabelFor('New Password', 'New Password : ') .
        // using html5 required attribute
        $frm->addInput('Text', 'password', '', array('id'=>"password", 'size'=>16, 'required'=>true) ) . 
        // endTag remembers startTag (but you can pass tag if nesting or for clarity)
        $frm->endTag() . PHP_EOL .
    	
    	$frm->startTag('p') . 
	    $frm->addInput('submit', 'submit', 'Update') . 
	    $frm->endTag() . PHP_EOL .
        $frm->endForm();
	}
?>
<?php require('front_half.php'); ?>
<?php 
	echo $errMsg;

	if(strlen($success) == 0)
		echo $frmStr;
	else 
		echo $success;
?>
<a href='admin_page.php' style="float:left; display:block; margin: 0px 10px 5px 0px; background:#ccc; text-decoration:none; color:#fff; padding: 10px; width:14%; color:#fff; border-radius:5px;">Back to Admin Page.</a>
<?php require('lower_half.php'); ?>