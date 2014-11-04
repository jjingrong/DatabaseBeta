<?php
	require('dbConnection.php');
    require('includes/html_form.class.php');
	session_start();
	require('admin_config.php');

    if(ISSET($_REQUEST["delete"])) {
        $IATACode = $_REQUEST["IATACode"];
        $flightNo = $_REQUEST["FlightNo"];
        $DepartureTime = $_REQUEST["DepartureTime"];

        $query_delete_booking = sprintf("DELETE FROM seatsbooking WHERE IATACode = '%s' AND FlightNo = '%s' AND DepartureTime = '%s'", mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo), mysql_real_escape_string($DepartureTime));
        $result = mysql_query( $query_delete_booking, $link );
        if(!$result) {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query_delete_booking;
            die($message);
        }
        $query_delete_seatType = sprintf("DELETE FROM seatstype WHERE IATACode = '%s' AND FlightNo = '%s' AND DepartureTime = '%s'", mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo), mysql_real_escape_string($DepartureTime));
        $result = mysql_query($query_delete_seatType, $link );
        if(!$result) {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query_delete_seatType;
            die($message);
        }
        
        $query_delete_flight = sprintf("DELETE FROM flight WHERE IATACode = '%s' AND FlightNo = '%s' AND DepartureTime = '%s'", mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo), mysql_real_escape_string($DepartureTime));
        $result = mysql_query($query_delete_flight, $link );
        if(!$result) {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query_delete_flight;
            die($message);
        }


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
                                <h1> Flight has been removed from scheduled </h1>
                                <?php echo "The flight No : <b>" . $flightNo . "</b> scheduled on : <b>" .$DepartureTime. "</b> has been deleted."; ?>
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

