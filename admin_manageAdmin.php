<?php
	require('dbConnection.php');
	require('includes/html_form.class.php');
	session_start();
	require('admin_config.php');
	$success = "";
	$errMsg = "";

	if(ISSET($_REQUEST['delete'])) {
		$username = $_REQUEST['username'];
		$query = sprintf("DELETE FROM account WHERE username = '%s'", mysql_real_escape_string($username));
		$result = mysql_query( $query, $link );
        if(!$result) {
            $errMsg = "Sorry an error occur. please contact admin.";
        } else {
        	$success = "Admin : " . $username . " has been deleted.";
        } 
	}

	$query = "SELECT * FROM Account";
	$result = mysql_query($query);

	$html_table = "<table>";
	$html_table .= "<tr><td>Username</td><td>Password</td><td>Edit Password</td><td>Delete</td></tr>";

	while ($row = mysql_fetch_assoc($result)) {
		$html_table .= "<tr>";
		$html_table .= "<td>" . $row["username"] . "</td>";
		$html_table .= "<td>xxx</td>";

		$frm = new HTML_Form();
		$frmStr = $frm->startForm('admin_editAdmin.php?edit=1', 'post') . PHP_EOL .
    	$frm->addInput('hidden', 'username', $row["username"], array('id'=>'username') ) .
    	$frm->startTag('p') . 
	    $frm->addInput('submit', 'submit', 'Update') . 
	    $frm->endTag() . PHP_EOL .
        $frm->endForm();
        $html_table .= "<td>" . $frmStr . "</td>";

		$frmDel = new HTML_Form();
		$frmStr = $frmDel->startForm('?delete=1', 'post') . PHP_EOL .
    	$frmDel->addInput('hidden', 'username', $row["username"], array('id'=>'username') ) .
    	$frmDel->startTag('p') . 
	    $frmDel->addInput('submit', 'submit', 'Delete') . 
	    $frmDel->endTag() . PHP_EOL .
        $frmDel->endForm();
        $html_table .= "<td>" . $frmStr . "</td>";

        $html_table .= "</tr>";
	}
	$html_table .= "</table>";
?>
<?php require('front_half.php'); ?>
<?php echo $success; echo $errMsg; ?>
<h1> Admin Management </h1>
<?php echo $html_table; ?>
<a href="admin_addAdmin.php" style="float:left; display:block; margin: 0px 10px 5px 0px; background:#ccc; text-decoration:none; padding: 10px; width:16%; color:#fff; border-radius:5px;"><b>Add Admin</b></a>
<a href='admin_page.php' style="float:left; display:block; margin: 0px 10px 5px 0px; background:#ccc; text-decoration:none; color:#fff; padding: 10px; width:14%; color:#fff; border-radius:5px;">Back to Admin Page.</a>
<?php require('lower_half.php'); ?>