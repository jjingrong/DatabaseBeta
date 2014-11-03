<?php
	require('dbConnection.php');
	session_start();
	require('admin_config.php');
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
	$frmStr = $frm->startForm('?edit=1', 'post', 'demoForm', array('class'=>'demoForm', 'onsubmit'=>'return checkBeforeSubmit(this)') ) . PHP_EOL .

	// wrap form elements in paragraphs 
    $frm->startTag('p') . 
    // label and text input with optional attributes
    $frm->addLabelFor('IATACode', 'IATACode : ') .
    // using html5 required attribute
    $frm->addInput('text', 'IATACode', $_REQUEST["IATACode"], array('id'=>'IATACode', 'size'=>16, 'disabled'=>true) ) . 
    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
    $frm->endTag() . PHP_EOL .

	// wrap form elements in paragraphs 
    $frm->startTag('p') . 
    // label and text input with optional attributes
    $frm->addLabelFor('Flight No', 'Flight No : ') .
    // using html5 required attribute
    $frm->addInput('text', 'FlightNo', $_REQUEST["FlightNo"], array('id'=>'FlightNo', 'size'=>16, 'disabled'=>true) ) . 
    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
    $frm->endTag() . PHP_EOL .

  	// wrap form elements in paragraphs 
    $frm->startTag('p') . 
    // label and text input with optional attributes
    $frm->addLabelFor('DepartureTime', 'Departure Time : ') .
    // using html5 required attribute
    $frm->addInput('Text', 'Departure Time', $_REQUEST["DepartureTime"], array('id'=>'DepartureTime', 'size'=>16, 'disabled'=>true) ) . 
    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
    $frm->endTag() . PHP_EOL .

    // wrap form elements in paragraphs 
    $frm->startTag('p') . 
    // label and text input with optional attributes
    $frm->addLabelFor('Flight No', 'Flight No : ') .
    // using html5 required attribute
    $frm->addInput('Text', 'Arrival Time', $_REQUEST["ArrivalTime"], array('id'=>"ArrivalTime", 'size'=>16, 'disabled'=>true) ) . 
    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
    $frm->endTag() . PHP_EOL .

    // wrap form elements in paragraphs 
    $frm->startTag('p') . 
    // label and text input with optional attributes
    $frm->addLabelFor('Class Type', 'Class Type : ') .
    // using html5 required attribute
    $frm->addInput('Text', 'Arrival Time', $_REQUEST["classType"], array('id'=>"ArrivalTime", 'size'=>16, 'disabled'=>true) ) . 
    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
    $frm->endTag() . PHP_EOL .

    // wrap form elements in paragraphs 
    $frm->startTag('p') . 
    // label and text input with optional attributes
    $frm->addLabelFor('Price', 'Price : ') .
    // using html5 required attribute
    $frm->addInput('Text', 'Arrival Time', $_REQUEST["price"], array('id'=>"price", 'size'=>16, 'required'=>true) ) . 
    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
    $frm->endTag() . PHP_EOL .

    // wrap form elements in paragraphs 
    $frm->startTag('p') . 
    // label and text input with optional attributes
    $frm->addLabelFor('Seat Count', 'Seat Count : ') .
    // using html5 required attribute
    $frm->addInput('Text', 'Seat Count', $_REQUEST["seatCount"], array('id'=>"SeatCount", 'size'=>16, 'required'=>true) ) . 
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