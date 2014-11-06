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
						<div class="12u skel-cell-important">
							<div id="content">

								<!-- Content -->

								<article>
									<p><h2>Check & Modify Existing Booking</h2></p>
									<!-- Modal attempt -->
									<div class="container">
										<form action="check_result.php" method="post">
											<table id="dataTable" border="5" width="100%" cellspacing="0" cellpadding="5">
												<tr>
													<td>
														<input type="text" name="reference" id="reference" placeholder="Reference Number"/><br>
													</td>
													<td>
														<input type="text" name="passport" id="passport" placeholder="Passport Number"  /><br>
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