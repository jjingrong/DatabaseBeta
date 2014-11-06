<?php
		require('dbConnection.php');
		require('includes/html_form.class.php');
		session_start();
		require('admin_config.php');
		$success = "";
		$errMsg = "";

		if(ISSET($_REQUEST['update'])) {
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];
			$checkExist = sprintf("SELECT username FROM account WHERE username = '%s'", mysql_real_escape_string($username));
			$result = mysql_query($checkExist);

			if(!$result) {
			 	$message  = 'Invalid query: ' . mysql_error() . "\n";
			 	$message .= 'Whole query: ' . $query;
			 	echo $message;
             	$errMsg = "Edit Fails Please contact the adminstrator.";
        	} else {
	        	$count = 0;
	        	while ($row = mysql_fetch_assoc($result)) {
	        		$count++;
	        	}

	        	if($count != 0) {
	        		$errMsg = "Username already exist";
	        	} else {
	        		$insertAdmin = sprintf("INSERT INTO account VALUES ('%s', '%s')", mysql_real_escape_string($username),  mysql_real_escape_string($password));
	        		$result = mysql_query($insertAdmin);
					
					if(!$result) {
					 	$message  = 'Invalid query: ' . mysql_error() . "\n";
					 	$message .= 'Whole query: ' . $insertAdmin;
					 	echo $message;
		             	$errMsg = "Edit Fails Please contact the adminstrator.";
		        	}

	        		$success = "The new admin has been added. <a href='admin_manageAdmin.php'>Back</a>";
	        	}
        	}
		}

		$frm = new HTML_Form();
		$frmStr = $frm->startForm('?update=1', 'post') . PHP_EOL .
        
        // wrap form elements in paragraphs 
        $frm->startTag('p') . 
        // label and text input with optional attributes
        $frm->addLabelFor('UserName', 'Username : ') .
        // using html5 required attribute
        $frm->addInput('Text', 'username', '', array('id'=>"username", 'size'=>16, 'required'=>true) ) . 
        // endTag remembers startTag (but you can pass tag if nesting or for clarity)
        $frm->endTag() . PHP_EOL .

        $frm->startTag('p') . 
        // label and text input with optional attributes
        $frm->addLabelFor('Password', 'Password : ') .
        // using html5 required attribute
        $frm->addInput('password', 'password', '', array('id'=>"password", 'size'=>16, 'required'=>true) ) . 
        // endTag remembers startTag (but you can pass tag if nesting or for clarity)
        $frm->endTag() . PHP_EOL .
    	
    	$frm->startTag('p') . 
	    $frm->addInput('submit', 'submit', 'Update') . 
	    $frm->endTag() . PHP_EOL .
        $frm->endForm();
?>

<?php require('front_half.php'); ?>
<h1>Create a new Admin </h1>
<?php 
	echo $success;
	echo $errMsg;
	echo $frmStr;
?>
<a href='admin_page.php' style="float:left; display:block; margin: 0px 10px 5px 0px; background:#ccc; text-decoration:none; color:#fff; padding: 10px; width:14%; color:#fff; border-radius:5px;">Back to Admin Page.</a>
<?php require('lower_half.php'); ?>


