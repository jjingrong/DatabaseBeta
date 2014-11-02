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
	include_once 'dbConnection.php';
	//$queryResult = mysql_query("CALL SearchFlights(".$source.",".$dest.",".$date.",".$class.")");
	//$queryResult = mysql_query("CALL cs2102.SearchFlights('Singapore','Hong Kong','2014-11-09','Economy');");
	$queryResult = mysql_query($query);
	
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
									<h2>Search</h2>
									<p>Looking for other flights?</p>
									<form action="search_results.php" method="post">
										<table id="dataTable" border="5" width="100%" cellspacing="0" cellpadding="5">
											<tr>
												<input type="text" autocomplete="off" spellcheck="false" name="source" id="source" placeholder="From"/>
											</tr>
											<tr>
												<input type="text" name="destination" id="destination" name="source" id="source" placeholder="Destination"  />
											</tr>
											<tr>
												<input type="date" name="date" id="date" placeholder="date"/>
											</tr>
											<tr>
												<select name="class">
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
									<h2>Flights Found:</h2>
									<!-- Table function -->
									<p><h3>Placerholder Table search function </h3></p>
									<table id="table-format">
										
									</table>
									<table id="dataTable" border="5" width="100%" cellspacing="0" cellpadding="5">
										<thead>
											<tr>
												<th><b><u>First Name</th>
												<th><b><u>Last Name</th>
												<th><b><u>Email Address</th>
											</tr>
										</thead>
										<tbody>   

											<?php while ($row = mysql_fetch_assoc($queryResult)) {
												echo "<tr><td>".$row['FlightNo']."</td><td>".$row['name']."</td><td>".$row['IATACode']."</td></tr>";}
												?>  
												<tr>
													<td>Nikhil</td>
													<td>Vartak</td>
													<td>nikhil.vartak@hotmail.co.in</td>
												</tr>
												<tr>
													<td>Peter</td>
													<td>James</td>
													<td>james_peter@hotmail.com</td>
												</tr>
												<tr>
													<td>Nikhil</td>
													<td>Vartak</td>
													<td>nikhilvartak@yahoo.com</td>
												</tr>
												<tr>
													<td>Jing Rong</td>
													<td>Lim</td>
													<td>jingrong@nus.edu.sg</td>
												</tr>
											</tbody>
										</table>

									</article>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>

		<?php include_once 'footer.php' ?>	

	</body>
	</html>