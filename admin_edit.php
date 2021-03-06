<?php
	require('dbConnection.php');
	require('includes/html_form.class.php');
	session_start();
	require('admin_config.php');
    $success = "";
    $errMsg = "";
	if(ISSET($_REQUEST["change"])) {
		$IATACode = $_SESSION["IATACode"];
		$flightNo = $_SESSION["FlightNo"];
		$DepartureTime = $_SESSION["DepartureTime"];
		$classType = $_SESSION["classType"];
		$seatCount = $_REQUEST["seatCount"];
		$price = $_REQUEST["price"];
        
        $seatbooking_update = sprintf("UPDATE seatsType SET price = %s, seatCount = %s WHERE classType = '%s' AND IATACode = '%s' AND FlightNo = '%s' AND DepartureTime = '".$DepartureTime."'", mysql_real_escape_string($price), mysql_real_escape_string($seatCount), mysql_real_escape_string($classType), mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo));
		$result = mysql_query($seatbooking_update, $link);
		if(!$result) {
            $errMsg = "Data invalid. Error in update. Please contact Adminstrator.";
		} else {
            $success = "The updated has been successful. Please click on the link to view the changes made <a href='http://localhost/DatabaseBeta/admin_page.php'>Back</a>";
        }
	} else {
		$_SESSION["IATACode"] = $_REQUEST["IATACode"];
		$_SESSION["FlightNo"] = $_REQUEST["FlightNo"];
		$_SESSION["ArrivalTime"] = $_REQUEST["ArrivalTime"];
		$_SESSION["DepartureTime"] = $_REQUEST["DepartureTime"];
		$_SESSION["classType"] = $_REQUEST["classType"];
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
                                <h1> EDIT SEAT TYPE FORM </h1>
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
                                    $frm->addInput('text', 'IATACode1', $_SESSION["IATACode"], array('id'=>'IATACode1', 'size'=>16, 'disabled'=>true) ) . 
                                    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
                                    $frm->endTag() . PHP_EOL .

                                    // wrap form elements in paragraphs 
                                    $frm->startTag('p') . 
                                    // label and text input with optional attributes
                                    $frm->addLabelFor('Flight No', 'Flight No : ') .
                                    // using html5 required attribute
                                    $frm->addInput('text', 'FlightNo1', $_SESSION["FlightNo"], array('id'=>'FlightNo1', 'size'=>16, 'disabled'=>true) ) . 
                                    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
                                    $frm->endTag() . PHP_EOL .

                                    // wrap form elements in paragraphs 
                                    $frm->startTag('p') . 
                                    // label and text input with optional attributes
                                    $frm->addLabelFor('DepartureTime', 'Departure Time : ') .
                                    // using html5 required attribute
                                    $frm->addInput('Text', 'DepartureTime', $_SESSION["DepartureTime"], array('id'=>'DepartureTime1', 'size'=>16, 'disabled'=>true) ) . 
                                    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
                                    $frm->endTag() . PHP_EOL .

                                    // wrap form elements in paragraphs 
                                    $frm->startTag('p') . 
                                    // label and text input with optional attributes
                                    $frm->addLabelFor('Arrival Time', 'Arrival Time : ') .
                                    // using html5 required attribute
                                    $frm->addInput('Text', 'ArrivalTime', $_SESSION["ArrivalTime"], array('id'=>"ArrivalTime1", 'size'=>16, 'disabled'=>true) ) . 
                                    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
                                    $frm->endTag() . PHP_EOL .

                                    // wrap form elements in paragraphs 
                                    $frm->startTag('p') . 
                                    // label and text input with optional attributes
                                    $frm->addLabelFor('Class Type', 'Class Type : ') .
                                    // using html5 required attribute
                                    $frm->addInput('Text', 'ClassType', $_SESSION["classType"], array('id'=>"classType1", 'size'=>16, 'disabled'=>true) ) . 
                                    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
                                    $frm->endTag() . PHP_EOL .


                                    // wrap form elements in paragraphs 
                                    $frm->startTag('p') . 
                                    // label and text input with optional attributes
                                    $frm->addLabelFor('Price', 'Price : ') .
                                    // using html5 required attribute
                                    $frm->addInput('Text', 'price', $_REQUEST["price"], array('id'=>"price", 'size'=>16, 'required'=>true) ) . 
                                    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
                                    $frm->endTag() . PHP_EOL .

                                    // wrap form elements in paragraphs 
                                    $frm->startTag('p') . 
                                    // label and text input with optional attributes
                                    $frm->addLabelFor('Seat Count', 'Seat Count : ') .
                                    // using html5 required attribute
                                    $frm->addInput('Text', 'seatCount', $_REQUEST["seatCount"], array('id'=>"seatCount", 'size'=>16, 'required'=>true) ) . 
                                    // endTag remembers startTag (but you can pass tag if nesting or for clarity)
                                    $frm->endTag() . PHP_EOL .

                                    $frm->startTag('p') . 
                                    $frm->addInput('submit', 'submit', 'Submit') . 
                                    $frm->endTag() . PHP_EOL .
                                    
                                    $frm->endForm();

                                    // finally, output the long string
                                    echo $errMsg;
                                    echo $frmStr;
                                    echo $success;
                                ?>
                                <a href='admin_page.php' style="float:left; display:block; margin: 0px 10px 5px 0px; background:#ccc; text-decoration:none; color:#fff; padding: 10px; width:14%; color:#fff; border-radius:5px;">Back to Admin Page.</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?php include_once 'footer.php' ?>  

    </body>
    </html>