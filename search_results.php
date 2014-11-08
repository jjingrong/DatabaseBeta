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
	$(document).ready(function($) {
        // Workaround for bug in mouse item selection
        $.fn.typeahead.Constructor.prototype.blur = function() {
        	var that = this;
        	setTimeout(function () { that.hide() }, 250);
        };

        $('#source').typeahead({
        	source: function(query, process) {
        		return ["Singapore","Ho Chi Minh City", "Hong Kong"];
        	}
        });

        $('#destination').typeahead({
        	source: function(query, process) {
        		return ["Singapore","Ho Chi Minh City", "Hong Kong"];
        	}
        });
    })
</script>

<body class="left-sidebar">
	<!-- Header Wrapper -->
	<?php include_once 'top.php' ?>
	<?php 
	//todo: check if valid data
	$source = htmlspecialchars($_POST['source']);
	$dest 	= htmlspecialchars($_POST['destination']);
	$date 	= htmlspecialchars($_POST['date']);
	$class 	= htmlspecialchars($_POST['class']);
	$query 	= "CALL cs2102.SearchFlights('".$source."','".$dest."','".$date."','".$class."');";
	$curSort = 'none';
	if(isset($_POST['SortBy']) && $_POST['SortBy']!='none') {
		if($_POST['SortBy'] == 'price') {
			$query = "CALL cs2102.SearchFlightsSorted('".$source."','".$dest."','".$date."','".$class."','price', 'A');";
		} else if($_POST['SortBy'] == 'name') {
			$query = "CALL cs2102.SearchFlightsSorted('".$source."','".$dest."','".$date."','".$class."','name', 'D');";
		} else if($_POST['SortBy'] == 'early') {
			$query = "CALL cs2102.SearchFlightsSorted('".$source."','".$dest."','".$date."','".$class."','DepartureTime', 'A');";
			echo $query;
		} else if($_POST['SortBy'] == 'late') {
			$query = "CALL cs2102.SearchFlightsSorted('".$source."','".$dest."','".$date."','".$class."','DepartureTime', 'D');";
		}
		$curSort=$_POST['SortBy'];
	} 
	include_once 'dbConnection.php';
	//$queryResult = mysql_query("CALL SearchFlights(".$source.",".$dest.",".$date.",".$class.")");
	//$queryResult = mysql_query("CALL cs2102.SearchFlights('Singapore','Hong Kong','2014-11-09','Economy');");
	$queryResult = mysql_query($query);
	
	$passData = '\'<input type="hidden" name="source" value="'.$source.'">';
	$passData .= '<input type="hidden" name="destination" value="'.$dest.'">';
	$passData .= '<input type="hidden" name="date" value="'.$date.'">';
	$passData .= '<input type="hidden" name="class" value="'.$class.'">\'';
   //echo $source;
	?>
	<script type="text/javascript">
	function book($IATACode, $FlightNo, $DepartureTime, $ArrivalTime,$name,$price)
	{
		document.body.innerHTML += '<form id="dynForm" action="book.php" method="post"><input type="hidden" name="IATACode" value="'+$IATACode+'"><input type="hidden" name="FlightNo" value="'+$FlightNo+'"><input type="hidden" name="DepartureTime" value="'+$DepartureTime+'"><input type="hidden" name="ArrivalTime" value="'+$ArrivalTime+'"><input type="hidden" name="name" value="'+$name+'"><input type="hidden" name="price" value="'+$price+'">'+<?php echo $passData?>+'</form>';
		document.getElementById("dynForm").submit();
	}
    function sort()
	{
		$sortby = document.getElementById("sortby").value;
		if($sortby != '<?php echo $curSort; ?>') {
			document.body.innerHTML += '<form id="sForm" action="" method="post"><input type="hidden" name="SortBy" value="'+$sortby+'">'+<?php echo $passData?>+'</form>';
			document.getElementById("sForm").submit();
		}
	}
	</script>
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
									<h2>Search</h2>
									<p>Looking for other flights?</p>
									<form action="search_results.php" method="post">
										<table id="dataTable" border="5" width="100%" cellspacing="0" cellpadding="5">
											<tr>
												<input type="text" autocomplete="off" spellcheck="false" name="source" id="source" placeholder="From" value="<?php echo $source ?>"/>
											</tr>
											<tr>
												<input type="text" name="destination" id="destination" name="source" id="source" placeholder="Destination" value="<?php echo $dest ?>" />
											</tr>
											<tr>
												<input type="date" name="date" id="date" placeholder="date" value="<?php echo $date ?>"/>
											</tr>
											<tr>
												<select name="class" value="<?php echo $class ?>">
													<option value="Economy">Economy Class</option>
													<option value="Business">Business Class</option>
													<option value="First">First Class</option>
												</select>
												<br>
											</tr>
											<tr>
												<input type="submit" class="btn go small icon fa-circle-o-right" text="Search!"/>
											</tr>
										</table>

										
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
									<h3>Please select your prefered flight. </h3>
									<h4>Sort By:  <form><select id="sortby" name="sortby" onchange="sort()">
															<option value="none">None</option>
															<option value="price">Lowest Price</option>
															<option value="early">Earliest Flight Time</option>
															<option value="late">Latest Flight Time</option>
															<option value="name">Airline Name</option>
														</select></form></h4>
									<?php while ($row = mysql_fetch_assoc($queryResult)) {
									echo "<div class='flightbkg'>";
									echo	"<div class='row quarter'>";
									echo"<div class='12u'><div class='flighthead'><h4>".$row['IATACode']." ".$row['FlightNo']."</h4></div></div>";
									echo	"</div>";
									echo"<div class='row quarter'>";
									echo  "<div class='9u'><div class='flightbody'>".$row['name']."<br>Departing : ".$row['DepartureTime']."<br>Arrving: ".$row['ArrivalTime']."<br></div></div>";
									echo  "<div class='3u'><div class='flightprice'>SGD".$row['price']."<br><a href='javascript:book(\"".$row['IATACode']."\",\"".$row['FlightNo']."\",\"".$row['DepartureTime']."\",\"".$row['ArrivalTime']."\",\"".$row['name']."\",\"".$row['price']."\")' class='btn go'>Book!</a></div></div>";
									echo"</div>";
									echo"<div class='row quarter'>";
									echo  "<div class='12u'><div class='flightfooter'>Class : ".$row['classType']."</div></div>";
									echo"</div></div><br>";
									 }
									 ?> 
									</article>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<script type="text/javascript">document.getElementById("sortby").value = '<?php echo $curSort; ?>';</script>
		<?php include_once 'footer.php' ?>	

	</body>
	</html>