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
	$seatCount = "0";

	//CHECKS FOR EMPTY SEAT COUNT
	$query 	= "CALL cs2102.GetEmptySeats('".$IATACode."','".$FlightNo."','".$DepartureTime."','".$class."',@seatCount);";
	include_once 'dbConnection.php';
	//$queryResult = mysql_query("CALL cs2102.SearchFlights('Singapore','Hong Kong','2014-11-09','Economy');");
	$queryResult = mysql_query($query);

	$query = "SELECT @seatCount as seatCount;";
	$queryResult = mysql_query($query);
	while($row = mysql_fetch_assoc($queryResult)){
		$seatCount = $row["seatCount"];
	}
	//echo $seatCount;

	$passData = '\'<input type="hidden" name="source" value="'.$source.'">';
	$passData .= '<input type="hidden" name="destination" value="'.$dest.'">';
	$passData .= '<input type="hidden" name="IATACode" value="'.$IATACode.'">';
	$passData .= '<input type="hidden" name="FlightNo" value="'.$FlightNo.'">';
	$passData .= '<input type="hidden" name="price" value="'.$price.'">';
	$passData .= '<input type="hidden" name="name" value="'.$name.'">';
	$passData .= '<input type="hidden" name="ArrivalTime" value="'.$ArrivalTime.'">';
	$passData .= '<input type="hidden" name="DepartureTime" value="'.$DepartureTime.'">';
	$passData .= '<input type="hidden" name="date" value="'.$date.'">';
	$passData .= '<input type="hidden" name="class" value="'.$class.'">\'';
   
	
   //echo $source;
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
									<form action="search_results.php" method="post">
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

										
									</form>
								</section>
								
							</div>
						</div>
						<div class="9u skel-cell-important">
							<div id="content">

								<!-- Content -->

								<article>
									<h2><?php echo $source?> to <?php echo $dest?> on <?php echo $date?></h2>
									<!-- Table function -->
									<h4 id="noSeats" style="display:none">There are not enough seats! Remaining Seats: <?php echo $seatCount ?></h4>
									<form id= "bookform" action="book_result.php" method="post">
									<h3>Passenger Details </h3><br>Number of Passengers:<br>
									<select id="numpax" name="numpax" onchange="numPax()" form="bookform">
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
														</select>

									
											<h4>Passenger 1:</h4>
											<table id="dataTable" border="5" width="100%" cellspacing="0" cellpadding="5">
												<tr>
													<td>
														<input type="text" name="name1" id="name1" placeholder="Full Name"/><br>
													</td>
													<td>
														<input type="text" name="passport1" id="passport1" placeholder="Passport Number"  /><br>
													</td>
													<td>
														<input type="date" name="dob1" id="dob1" placeholder="Date of Birth"/><br>
													</td>
												</tr>
												<tr>
													<td>
														<input type="text" name="phone" id="phone" placeholder="Mobile Phone"/><br>
													</td>
													<td>
														<input type="text" name="email" id="email" placeholder="Email Address"/><br>
													</td>
												</tr>
											</table>
											<div id = "pax2" style="display:none">
												<h4>Passenger 2:</h4>
												<table id="dataTable" border="5" width="100%" cellspacing="0" cellpadding="5">
													<tr>
														<td>
															<input type="text" name="name2" id="name2" placeholder="Full Name"/><br>
														</td>
														<td>
															<input type="text" name="passport2" id="passport2" placeholder="Passport Number"  /><br>
														</td>
														<td>
															<input type="date" name="dob2" id="dob2" placeholder="Date of Birth"/><br>
														</td>
													</tr>
												</table>
											</div>
											<div id = "pax3" style="display:none">
												<h4>Passenger 3:</h4>
												<table id="dataTable" border="5" width="100%" cellspacing="0" cellpadding="5">
													<tr>
														<td>
															<input type="text" name="name3" id="name3" placeholder="Full Name"/><br>
														</td>
														<td>
															<input type="text" name="passport3" id="passport3" placeholder="Passport Number"  /><br>
														</td>
														<td>
															<input type="date" name="dob3" id="dob3" placeholder="Date of Birth"/><br>
														</td>
													</tr>
												</table>
											</div>
											<div id = "pax4" style="display:none">
												<h4>Passenger 4:</h4>
												<table id="dataTable" border="5" width="100%" cellspacing="0" cellpadding="5">
													<tr>
														<td>
															<input type="text" name="name4" id="name4" placeholder="Full Name"/><br>
														</td>
														<td>
															<input type="text" name="passport4" id="passport4" placeholder="Passport Number"  /><br>
														</td>
														<td>
															<input type="date" name="dob4" id="dob4" placeholder="Date of Birth"/><br>
														</td>
													</tr>
												</table>
											</div>
											<input type="submit" class="btn go small icon fa-circle-o-right" text="Search!"/>
											
										</form>
									</article>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<script type="text/javascript">
		document.getElementById('bookform').innerHTML += <?php echo $passData?>;
		if(<?php echo $seatCount ?> <= 0)
		{
			document.getElementById('bookform').style.display="none";
			document.getElementById('noSeats').style.display="block";
		}
		function numPax()
		{
			var nPax = document.getElementById('numpax').value;
			switch(nPax){
			case "4":
				if(<?php echo $seatCount ?> < 4)
				{
					document.getElementById('noSeats').style.display="block";
					break;
				}
				document.getElementById('pax2').style.display="block";
				document.getElementById('pax3').style.display="block";
				document.getElementById('pax4').style.display="block";
				break;
			case "3":
				if(<?php echo $seatCount ?> < 3)
				{
					document.getElementById('noSeats').style.display="block";
					break;
				}
				document.getElementById('noSeats').style.display="none";
				document.getElementById('pax2').style.display="block";
				document.getElementById('pax3').style.display="block";
				document.getElementById('pax4').style.display="none";
				break;
			case "2":
				if(<?php echo $seatCount ?> < 2)
				{
					document.getElementById('noSeats').style.display="block";
					break;
				}
				document.getElementById('noSeats').style.display="none";
				document.getElementById('pax2').style.display="block";
				document.getElementById('pax3').style.display="none";
				document.getElementById('pax4').style.display="none";
				break;
			case "1":
				document.getElementById('noSeats').style.display="none";
				document.getElementById('pax2').style.display="none";
				document.getElementById('pax3').style.display="none";
				document.getElementById('pax4').style.display="none";
				//document.getElementById('pax1').style.display="block";
				break;
			}
				return;
		}
		</script>
		<?php include_once 'footer.php' ?>	

	</body>
	</html>