<?php
	require('dbConnection.php');
    require('includes/html_form.class.php');
	session_start();
	require('admin_config.php');

        if(ISSET($_REQUEST["change"])) {
            $IATACode = $_SESSION["IATACode"];
            $flightNo = $_SESSION["FlightNo"];
            $DepartureTime = $_SESSION["DepartureTime"];
            $ArrivalTime = $_REQUEST["ArrivalTime"];
            $classType = $_SESSION["classType"];
            $source = $_REQUEST["source"];
            $destination = $_REQUEST["destination"];
            
            $seatbooking_update = sprintf("UPDATE flight SET source = '%s', destination = '%s', ArrivalTime = '".$ArrivalTime. "' WHERE IATACode = '%s' AND FlightNo = '%s' AND DepartureTime = '".$DepartureTime."'", mysql_real_escape_string($source), mysql_real_escape_string($destination), mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo));
            echo $seatbooking_update;
            $result = mysql_query($seatbooking_update, $link);
            if(!$result) {
                $message  = 'Invalid query: ' . mysql_error() . "\n";
                $message .= 'Whole query: ' . $seatbooking_update;
                die($message);
            }
            echo "<a href='http://localhost/DatabaseBeta/admin_page.php'>Back</a>";
        } else {
            $_SESSION["IATACode"] = $_REQUEST["IATACode"];
            $_SESSION["FlightNo"] = $_REQUEST["FlightNo"];
            $_SESSION["ArrivalTime"] = $_REQUEST["ArrivalTime"];
            $_SESSION["DepartureTime"] = $_REQUEST["DepartureTime"];
            $_SESSION["source"] = $_REQUEST["source"];
            $_SESSION["destination"] = $_REQUEST["destination"];
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Flight Edit Page</title>
</head>
<body>
<h1> EDIT FORM </h1>
<?php
	// create instance of HTML_Form
	$frm = new HTML_Form();

	// using $frmStr to concatenate long string of form elements
	// startForm arguments: action, method, id, optional attributes added in associative array
	$frmStr = $frm->startForm('?change=1', 'post', 'demoForm', array('class'=>'demoForm', 'onsubmit'=>'return checkBeforeSubmit(this)') ) . PHP_EOL .

	// wrap form elements in paragraphs 
    $frm->startTag('p') . 
    // label and text input with optional attributes
    $frm->addLabelFor('IATACode', 'IATACode : ') .
    // using html5 required attribute
    $frm->addInput('text', 'IATACode', $_SESSION["IATACode"], array('id'=>'IATACode', 'size'=>16, 'disabled'=>true) ) . 
    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
    $frm->endTag() . PHP_EOL .

	// wrap form elements in paragraphs 
    $frm->startTag('p') . 
    // label and text input with optional attributes
    $frm->addLabelFor('Flight No', 'Flight No : ') .
    // using html5 required attribute
    $frm->addInput('text', 'FlightNo', $_SESSION["FlightNo"], array('id'=>'FlightNo', 'size'=>16, 'disabled'=>true) ) . 
    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
    $frm->endTag() . PHP_EOL .

  	// wrap form elements in paragraphs 
    $frm->startTag('p') . 
    // label and text input with optional attributes
    $frm->addLabelFor('DepartureTime', 'Departure Time : ') .
    // using html5 required attribute
    $frm->addInput('Text', 'DepartureTime', $_SESSION["DepartureTime"], array('id'=>'DepartureTime', 'size'=>16, 'disabled'=>true) ) . 
    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
    $frm->endTag() . PHP_EOL .

    // wrap form elements in paragraphs 
    $frm->startTag('p') . 
    // label and text input with optional attributes
    $frm->addLabelFor('Arrival Time', 'Arrival Time : ') .
    // using html5 required attribute
    $frm->addInput('Text', 'ArrivalTime', $_REQUEST["ArrivalTime"], array('id'=>"ArrivalTime", 'size'=>16, 'required'=>true) ) . 
    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
    $frm->endTag() . PHP_EOL .

    // wrap form elements in paragraphs 
    $frm->startTag('p') . 
    // label and text input with optional attributes
    $frm->addLabelFor('Source ', 'Source : ') .
    // using html5 required attribute
    $frm->addInput('Text', 'source', $_REQUEST["source"], array('id'=>"source", 'size'=>16, 'required'=>true) ) . 
    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
    $frm->endTag() . PHP_EOL .

    // wrap form elements in paragraphs 
    $frm->startTag('p') . 
    // label and text input with optional attributes
    $frm->addLabelFor('Source ', 'Source : ') .
    // using html5 required attribute
    $frm->addInput('Text', 'destination', $_REQUEST["destination"], array('id'=>"destination", 'size'=>16, 'required'=>true) ) . 
    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
    $frm->endTag() . PHP_EOL .

    $frm->startTag('p') . 
    $frm->addInput('submit', 'submit', 'Submit') . 
    $frm->endTag() . PHP_EOL .
    
    $frm->endForm();

	// finally, output the long string
	echo $frmStr;
?>
</body>
</html>