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
            $ArrivalTime = $_REQUEST["ArrivalTime"];
            $source = $_REQUEST["source"];
            $destination = $_REQUEST["destination"];
            
            $date = strtotime($ArrivalTime);
            $date2 = strtotime($DepartureTime);

            if(!($date === false) && $date > $date2) {
                $seatbooking_update = sprintf("UPDATE flight SET DepartureTime = '". $DepartureTime . "', source = '%s', destination = '%s', ArrivalTime = '".$ArrivalTime. "' WHERE IATACode = '%s' AND FlightNo = '%s' AND DepartureTime = '".$DepartureTime."'", mysql_real_escape_string($source), mysql_real_escape_string($destination), mysql_real_escape_string($IATACode), mysql_real_escape_string($flightNo));
                $result = mysql_query($seatbooking_update, $link);
                if(!$result) {
                    $errMsg = "Edit Fails Please contact the adminstrator.";
                } else 
                    $success = "The updated has been successful. Please click on the link to view the changes made <a href='admin_page.php'>Back</a>";
            }else {
                $errMsg = "Edit Fails Please contact the adminstrator.";
            }

        } else {
            $_SESSION["IATACode"] = $_REQUEST["IATACode"];
            $_SESSION["FlightNo"] = $_REQUEST["FlightNo"];
            $_SESSION["ArrivalTime"] = $_REQUEST["ArrivalTime"];
            $_SESSION["DepartureTime"] = $_REQUEST["DepartureTime"];
            $_SESSION["source"] = $_REQUEST["source"];
            $_SESSION["destination"] = $_REQUEST["destination"];
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
                                    <h1> EDIT FLIGHT FORM </h1>
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
                                        echo $errMsg;
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

