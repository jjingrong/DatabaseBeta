<?php 
	if(ISSET($_SESSION["admin"])) {
		$welcome_msg = "Welcome , " . $_SESSION["admin"];
	} else {
		header('Location: http://localhost/DatabaseBeta/admin_login.php');
	}
?>