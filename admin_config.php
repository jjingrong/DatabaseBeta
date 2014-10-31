<?php 
	if(ISSET($_SESSION["admin"])) {
		$welcome_msg = "Welcome , " . $_SESSION["admin"];
	} else {
		header('Location: http://localhost/2102/admin_login.php/');
	}
?>