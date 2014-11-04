<?php
	require('dbConnection.php');
	session_start();
	require('admin_config.php');

	$IATACode = $_REQUEST["IATACode"];
	$flightNo =	$_REQUEST["FlightNo"];
	$DepartureTime = $_REQUEST["DepartureTime"];
	$classType = $_REQUEST["classType"];

	$seatbooking_delete = sprintf("DELETE FROM seatsbooking WHERE classType = '%s' AND IATACode = '%s' AND FlightNo = '%s' AND DepartureTime = '%s'", mysql_real_escape_string($classType), mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo), mysql_real_escape_string($DepartureTime));
	$result = mysql_query( $seatbooking_delete, $link );
	if(!$result) {
  		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $seatbooking_delete;
		die($message);
	}

	$seatType_delete = sprintf("DELETE FROM seatstype WHERE classType = '%s' AND IATACode = '%s' AND FlightNo = '%s' AND DepartureTime = '%s'", mysql_real_escape_string($classType), mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo), mysql_real_escape_string($DepartureTime));

	$result = mysql_query($seatType_delete, $link);
	if(!$result) {
  		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $seatType_delete;
		die($message);
	}
	
	
?>


<!DOCTYPE HTML>
<!--
    ZeroFour by HTML5 UP
    html5up.net | @n33co
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<?php include_once 'header.php' ?>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-typeahead.js"></script>


<body class="left-sidebar">
    <!-- Header Wrapper -->
    <?php include_once 'top.php' ?>
    
    <!-- Main Wrapper -->
    <div id="main-wrapper">
        <div class="wrapper style2">
            <div class="inner">
                <div class="container">
                    <div class="row">
                        <div class="3u">
                            <div id="sidebar">

                                <!-- Sidebar -->
                                
                            </div>
                        </div>
                        <div class="12u skel-cell-important">
                            <div id="content">
                                <h1> Flight's Seat Typed has been removed from scheduled.</h1>
                                <?php echo "The seat type <b>" . $classType . "</b> of the flight No : <b>" . $flightNo . "</b> scheduled on : <b>" .$DepartureTime. "</b> has been deleted."; ?>
                                <a href="admin_page.php">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?php include_once 'footer.php' ?>  

    </body>
    </html>
