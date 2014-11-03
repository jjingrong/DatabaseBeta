<?php
	require('includes/html_form.class.php');
	require('dbConnection.php');
	session_start();

	$err_msg = "";
	if(ISSET($_REQUEST['login'])) {
		if(ISSET($_REQUEST['password']) && ISSET($_REQUEST['username'])) {
			$count = 0;
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];


			$query = sprintf("SELECT * FROM cs2102.account WHERE username='%s' AND password='%s'", mysql_real_escape_string($username), mysql_real_escape_string($password));
			$db = mysql_select_db("cs2102", $link );
			$result = mysql_query($query);
			

			if (!$result) {
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $query;
			    die($message);
			}

			while ($row = mysql_fetch_assoc($result)) {
			    $count++;
			}

			if($count != 0) {
				$_SESSION["admin"] = $username;
				$err_msg = "login success";
				header('Location: http://localhost/DatabaseBeta/admin_page.php/');
			} else {
				$err_msg = "login fail";
			}

			//mysql_free_result($result);
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Login</title>
</head>
<body>
<?php
	// create instance of HTML_Form
	$frm = new HTML_Form();

	// using $frmStr to concatenate long string of form elements
	// startForm arguments: action, method, id, optional attributes added in associative array
	$frmStr = $frm->startForm('?login=1', 'post', 'demoForm', array('class'=>'demoForm', 'onsubmit'=>'return checkBeforeSubmit(this)') ) . PHP_EOL .

  	// wrap form elements in paragraphs 
    $frm->startTag('p') . 
    // label and text input with optional attributes
    $frm->addLabelFor('Username', 'Username : ') .
    // using html5 required attribute
    $frm->addInput('text', 'username', '', array('id'=>'username', 'size'=>16, 'required'=>true) ) . 
    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
    $frm->endTag() . PHP_EOL .

 	// wrap form elements in paragraphs 
    $frm->startTag('p') . 
    // label and text input with optional attributes
    $frm->addLabelFor('password', 'Password : ') .
    // using html5 required attribute
    $frm->addInput('password', 'password', '', array('id'=>'password', 'size'=>16, 'required'=>true) ) . 
    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
    $frm->endTag() . PHP_EOL .

    $frm->startTag('p') . 
    $frm->addInput('submit', 'submit', 'Submit') . 
    $frm->endTag() . PHP_EOL .
    
    $frm->endForm();

	// finally, output the long string
	echo $frmStr;
	echo $err_msg;
?>
</body>
</html>

