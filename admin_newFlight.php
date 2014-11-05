<?php
	require('dbConnection.php');
    require('includes/html_form.class.php');
	session_start();
	require('admin_config.php');
    $success = "";

	if(ISSET($_REQUEST["add"])) {
		$IATACode = $_REQUEST["IATACode"];
		$flightNo =	$_REQUEST["FlightNo"];
		$DepartureTime = $_REQUEST["DepartureTime"];
		$ArrivalTime = $_REQUEST["ArrivalTime"];
		$source = $_REQUEST["source"];
		$destination = $_REQUEST["destination"];
		$ecPrice = $_REQUEST["ecPrice"];
		$ecSeatCount = $_REQUEST["ecSeatCount"];
		$bzPrice = $_REQUEST["bzPrice"];
		$bzSeatCount = $_REQUEST["bzSeatCount"];

		$insertQuery = sprintf("INSERT INTO flight VALUES ('%s','%s','%s','%s','%s','%s')", mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo), mysql_real_escape_string($DepartureTime), mysql_real_escape_string($ArrivalTime), mysql_real_escape_string($source), mysql_real_escape_string($destination));
		$result = mysql_query($insertQuery);
		
		if(!$result) {
  			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $insertQuery;
			die($message);
		}

		$insertSeatTypeEC = sprintf("INSERT INTO seatstype VALUES ('Economy','%s','%s','%s','%s','%s')", mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo), mysql_real_escape_string($ecPrice),mysql_real_escape_string($DepartureTime),  mysql_real_escape_string($ecSeatCount));
		
		$result = mysql_query($insertSeatTypeEC);
		if(!$result) {
  			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $insertSeatTypeEC;
			die($message);
		}

		$insertSeatTypeBz =sprintf("INSERT INTO seatstype VALUES ('Business','%s','%s','%s','%s','%s')", mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo), mysql_real_escape_string($bzPrice),mysql_real_escape_string($DepartureTime),  mysql_real_escape_string($bzSeatCount));;
		
		$result = mysql_query($insertSeatTypeBz);
		if(!$result) {
  			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $insertSeatTypeBz;
			die($message);
		}
		$success = "The Flight No : " . $flightNo . " has been added to the list";
		$success .= "<a href='http://localhost/DatabaseBeta/admin_page.php'>View Here</a>";
	}

	$IATAquery = "SELECT IATACode FROM airline";
	$result = mysql_query( $IATAquery, $link );
	$months = array();

	if(!$result) {
  		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $IATAquery;
		die($message);
	}
	while ($row = mysql_fetch_assoc($result)) {
		array_push($months, $row["IATACode"]);
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
                                <h1> ADD NEW FLIGHT </h1>
                                <?php
                                    if(strlen($success) == 0) {
                                    // create instance of HTML_Form
                                    $frm = new HTML_Form();

                                    // using $frmStr to concatenate long string of form elements
                                    // startForm arguments: action, method, id, optional attributes added in associative array
                                    $frmStr = $frm->startForm('?add=1', 'post', 'demoForm') . PHP_EOL .

                                    $frm->endTag() . PHP_EOL .
                                    $frm->startTag('p') . 
                                    $frm->addLabelFor('IATA Code', 'IATA Code : ') .
                                    $frm->addSelectListArrays('IATACode', $months, $months) .
                                    $frm->endTag() . PHP_EOL .
                                    $frm->startTag('p') . 

                                    // wrap form elements in paragraphs 
                                    $frm->startTag('p') . 
                                    // label and text input with optional attributes
                                    $frm->addLabelFor('Flight No', 'Flight No : ') .
                                    // using html5 required attribute
                                    $frm->addInput('text', 'FlightNo', '', array('id'=>'FlightNo', 'size'=>16, 'required'=>true) ) . 
                                    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
                                    $frm->endTag() . PHP_EOL .

                                    // wrap form elements in paragraphs 
                                    $frm->startTag('p') . 
                                    // label and text input with optional attributes
                                    $frm->addLabelFor('DepartureTime', 'Departure Time : ') .
                                    // using html5 required attribute
                                    $frm->addInput('Text', 'DepartureTime', '2014-11-09 00:00:00', array('id'=>'DepartureTime', 'size'=>16, 'required'=>true) ) . 
                                    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
                                    $frm->endTag() . PHP_EOL .

                                    // wrap form elements in paragraphs 
                                    $frm->startTag('p') . 
                                    // label and text input with optional attributes
                                    $frm->addLabelFor('Arrival Time', 'Arrival Time : ') .
                                    // using html5 required attribute
                                    $frm->addInput('Text', 'ArrivalTime', '2014-11-09 00:00:00', array('id'=>"ArrivalTime", 'size'=>16, 'required'=>true) ) . 
                                    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
                                    $frm->endTag() . PHP_EOL .

                                    // wrap form elements in paragraphs 
                                    $frm->startTag('p') . 
                                    // label and text input with optional attributes
                                    $frm->addLabelFor('Source ', 'Source : ') .
                                    // using html5 required attribute
                                    $frm->addInput('Text', 'source', '', array('id'=>"source", 'size'=>16, 'required'=>true) ) . 
                                    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
                                    $frm->endTag() . PHP_EOL .

                                    // wrap form elements in paragraphs 
                                    $frm->startTag('p') . 
                                    // label and text input with optional attributes
                                    $frm->addLabelFor('Destination ', 'Destination : ') .
                                    // using html5 required attribute
                                    $frm->addInput('Text', 'destination', '', array('id'=>"destination", 'size'=>16, 'required'=>true) ) . 
                                    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
                                    $frm->endTag() . PHP_EOL .

                                    // wrap form elements in paragraphs 
                                    $frm->startTag('p') . 
                                    // label and text input with optional attributes
                                    $frm->addLabelFor('Economic class ', 'Economic Class price : ') .
                                    // using html5 required attribute
                                    $frm->addInput('Text', 'ecPrice', '', array('id'=>"ecPrice", 'size'=>16, 'required'=>true) ) . 
                                    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
                                    $frm->endTag() . PHP_EOL .

                                        // wrap form elements in paragraphs 
                                    $frm->startTag('p') . 
                                    // label and text input with optional attributes
                                    $frm->addLabelFor('Economic class ', 'Economic Class seatCount : ') .
                                    // using html5 required attribute
                                    $frm->addInput('Text', 'ecSeatCount', '0', array('id'=>"ecSeatCount", 'size'=>16, 'required'=>true) ) . 
                                    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
                                    $frm->endTag() . PHP_EOL .

                                   // wrap form elements in paragraphs 
                                    $frm->startTag('p') . 
                                    // label and text input with optional attributes
                                    $frm->addLabelFor('Business class ', 'Business Class price : ') .
                                    // using html5 required attribute
                                    $frm->addInput('Text', 'bzPrice', '', array('id'=>"bzPrice", 'size'=>16, 'required'=>true) ) . 
                                    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
                                    $frm->endTag() . PHP_EOL .

                                        // wrap form elements in paragraphs 
                                    $frm->startTag('p') . 
                                    // label and text input with optional attributes
                                    $frm->addLabelFor('Business class ', 'Business Class seatCount : ') .
                                    // using html5 required attribute
                                    $frm->addInput('Text', 'bzSeatCount', '0', array('id'=>"bzSeatCount", 'size'=>16, 'required'=>true) ) . 
                                    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
                                    $frm->endTag() . PHP_EOL .

                                    $frm->startTag('p') . 
                                    $frm->addInput('submit', 'submit', 'Submit') . 
                                    $frm->endTag() . PHP_EOL .
                                    
                                    $frm->endForm();

                                    // finally, output the long string
                                    echo $frmStr;
                                    }
                                    echo $success;
                                ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?php include_once 'footer.php' ?>  

    </body>
    </html>
