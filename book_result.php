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

<script>
    
	function numPax(nPax)
	{
		switch(nPax){
		case 4:
			document.getElementById('pax2').style.display="block";
			document.getElementById('pax3').style.display="block";
			document.getElementById('pax4').style.display="block";
			break;
		case 3:
			document.getElementById('pax2').style.display="block";
			document.getElementById('pax3').style.display="block";
			document.getElementById('pax4').style.display="none";
			break;
		case 2:
			document.getElementById('pax2').style.display="block";
			document.getElementById('pax3').style.display="none";
			document.getElementById('pax4').style.display="none";
			break;
		case 1:
			document.getElementById('pax2').style.display="none";
			document.getElementById('pax3').style.display="none";
			document.getElementById('pax4').style.display="none";
			//document.getElementById('pax1').style.display="block";
			break;
		}
			return;
	}
</script>

<body class="left-sidebar">
	<!-- Header Wrapper -->
	<?php include_once 'top.php' ?>
	<?php 
	//todo: check if valid data
	$IATACode 	= htmlspecialchars($_POST['IATACode']);
	$FlightNo 	= htmlspecialchars($_POST['FlightNo']);
	$price 	= htmlspecialchars($_POST['price']);
	$name 	= htmlspecialchars($_POST['name']);
	$ArrivalTime 	= htmlspecialchars($_POST['ArrivalTime']);
	$DepartureTime 	= htmlspecialchars($_POST['DepartureTime']);
	$source = htmlspecialchars($_POST['source']);
	$dest 	= htmlspecialchars($_POST['destination']);
	$date 	= htmlspecialchars($_POST['date']);
	$class 	= htmlspecialchars($_POST['class']);

	$numpax = htmlspecialchars($_POST['numpax']);
	$name1 = htmlspecialchars($_POST['name1']);
	$passport1 = htmlspecialchars($_POST['passport1']);
	$dob1 = htmlspecialchars($_POST['dob1']);
	$phone = htmlspecialchars($_POST['phone']);
	$email = htmlspecialchars($_POST['email']);

	if($numpax > 1)
	{
		$name2 = htmlspecialchars($_POST['name2']);
		$passport2 = htmlspecialchars($_POST['passport2']);
		$dob2 = htmlspecialchars($_POST['dob2']);
		$query 	= "CALL cs2102.MakeBookingForTwo('".$IATACode."','".$FlightNo."','".$DepartureTime."','".$class."','".$phone."','".$email."','".$passport1."','".$name1."','".$dob1."','".$passport2."','".$name2."','".$dob2."');";
	}
	if($numpax > 2)
	{
		$name3 = htmlspecialchars($_POST['name3']);
		$passport3 = htmlspecialchars($_POST['passport3']);
		$dob3 = htmlspecialchars($_POST['dob3']);
		$query 	= "CALL cs2102.MakeBookingForThree('".$IATACode."','".$FlightNo."','".$DepartureTime."','".$class."','".$phone."','".$email."','".$passport1."','".$name1."','".$dob1."','".$passport2."','".$name2."','".$dob2."','".$passport3."','".$name3."','".$dob3."');";

	}
	if($numpax > 3)
	{
		$name4 = htmlspecialchars($_POST['name4']);
		$passport4 = htmlspecialchars($_POST['passport4']);
		$dob4 = htmlspecialchars($_POST['dob4']);
		$query 	= "CALL cs2102.MakeBookingForFour('".$IATACode."','".$FlightNo."','".$DepartureTime."','".$class."','".$phone."','".$email."','".$passport1."','".$name1."','".$dob1."','".$passport2."','".$name2."','".$dob2."','".$passport3."','".$name3."','".$dob3."','".$passport4."','".$name4."','".$dob4."');";
	}
	if($numpax == 1)
	{
		$query 	= "CALL cs2102.MakeBooking('".$IATACode."','".$FlightNo."','".$DepartureTime."','".$class."','".$phone."','".$email."','".$passport1."','".$name1."','".$dob1."');";
	}
	//echo $query;
	include_once 'dbConnection.php';
	//$queryResult = mysql_query("CALL cs2102.SearchFlights('Singapore','Hong Kong','2014-11-09','Economy');");
	$queryResult = mysql_query($query);
	if(!$queryResult)
	{
		//echo $queryResult;
		$isError = true;
	}
	else
	{
		$isError = false;
		while ($row = mysql_fetch_assoc($queryResult)) {
			$referenceNum = $row['ReferenceNo'];
		}
	}
	?>
	<!-- Main Wrapper -->
	<div id="main-wrapper">
		<div class="wrapper style2">
			<div class="inner">
				<div class="container">
					<div class="row">
						<div class="3u">
							<div id="sidebar">

								<!-- Sidebar -->

								<section>
									<h2>Flight Details</h2>
										<?php
										echo "<div class='flightbkg'>";
										echo	"<div class='row quarter'>";
										echo"<div class='12u'><div class='flighthead'><h4>".$IATACode." ".$FlightNo."</h4></div></div>";
										echo	"</div>";
										echo"<div class='row quarter'>";
										echo  "<div class='12u'><div class='flightbody'>".$name."<br>Departing : ".$DepartureTime."<br>Arrving: ".$ArrivalTime."<br>Class : ".$class."</div></div>";
										echo"</div>";
										echo"<div class='row quarter'>";
										echo  "<div class='12u'><div class='flightfooter'>Price: SGD".$price."</div></div>";
										echo"</div></div><br>";
										 
										 ?> 
								</section>
								
							</div>
						</div>
						<div class="9u skel-cell-important">
							<div id="content">

								<!-- Content -->

								<article>
									<div id='noerror' <?php if($isError){echo 'style="display:none"';} ?>>
										<h2>Booking Confirmed! Reference Number: <?php echo $referenceNum ?></h2>
										<!-- Table function -->
										<h3> <?php echo $source?> to <?php echo $dest?> on <?php echo $date?></h3>
										<div id='pax1'>
										<div class='flightbkg'>
											<h4>Passenger 1:</h4>
											<div class='row quarter'>
												<div class='4u'><div class='flightbody'> Name: <?php echo $name1 ?></div></div>
												<div class='4u'><div class='flightbody'> Passport Number: <?php echo $passport1 ?></div></div>
												<div class='4u'><div class='flightbody'> Date of Birth: <?php echo $dob1 ?></div></div>
											</div>
											<div class='row quarter'>
												<div class='4u'><div class='flightbody'> Mobile: <?php echo $phone ?></div></div>
												<div class='4u'><div class='flightbody'> Email: <?php echo $email ?></div></div>
											</div>
										</div>
										</div><br>
										<div id='pax2'>
										<div class='flightbkg'>
											<h4>Passenger 2:</h4>
											<div class='row quarter'>
												<div class='4u'><div class='flightbody'> Name: <?php echo $name2 ?></div></div>
												<div class='4u'><div class='flightbody'> Passport Number: <?php echo $passport2 ?></div></div>
												<div class='4u'><div class='flightbody'> Date of Birth: <?php echo $dob2 ?></div></div>
											</div>
										</div>
										</div><br>
										<div id='pax3'>
										<div class='flightbkg'>
											<h4>Passenger 2:</h4>
											<div class='row quarter'>
												<div class='4u'><div class='flightbody'> Name: <?php echo $name3 ?></div></div>
												<div class='4u'><div class='flightbody'> Passport Number: <?php echo $passport3 ?></div></div>
												<div class='4u'><div class='flightbody'> Date of Birth: <?php echo $dob3 ?></div></div>
											</div>
										</div>
										</div><br>
										<div id='pax4'>
										<div class='flightbkg'>
											<h4>Passenger 2:</h4>
											<div class='row quarter'>
												<div class='4u'><div class='flightbody'> Name: <?php echo $name4?></div></div>
												<div class='4u'><div class='flightbody'> Passport Number: <?php echo $passport4 ?></div></div>
												<div class='4u'><div class='flightbody'> Date of Birth: <?php echo $dob4 ?></div></div>
											</div>
										</div>
										</div>
									</div>

									<div id='goterror' <?php if(!$isError){echo 'style="display:none"';} ?>>
										<h2>There was a problem with your booking. Please ensure that passenger details have been correctly entered.</h2>
									</div>


									</article>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<?php echo "<script>numPax(".$numpax.");</script>"; ?>

		<?php include_once 'footer.php' ?>	

	</body>
	</html>