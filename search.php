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

	<!-- Main Wrapper -->
	<div id="main-wrapper">
		<div class="wrapper style2">
			<div class="inner">
				<div class="container">
					<div class="row">
						<div class="12u skel-cell-important">
							<div id="content">

								<!-- Content -->

								<article>
									<p><h2>Search for Flights</h2></p>
									<p>Where are you flying to?</p>
									<!-- Modal attempt -->
									<div class="container">
										<form action="search_results.php" method="post">
											<table id="dataTable" border="5" width="100%" cellspacing="0" cellpadding="5">
												<tr>
													<td>
														<input type="text" autocomplete="off" spellcheck="false" name="source" id="source" placeholder="From"/><br>
													</td>
													<td>
														<input type="text" name="destination" id="destination" name="source" id="source" placeholder="Destination"  /><br>
													</td>
												</tr>
												<tr>
													<td>
														<input type="date" name="date" id="date" placeholder="date"/><br>
													</td>
													<td>
														<select name="class">
															<option value="Economy">Economy Class</option>
															<option value="Business">Business Class</option>
															<option value="First">First Class</option>
														</select>
													</td>
												</tr>
												<tr>
													<td>
														<input type="submit" class="btn go small icon fa-circle-o-right" text="Search!"/>
													</td>
												</tr>
											</table>
											
											
										</form>
									</div>
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