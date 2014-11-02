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
<style type="text/css">
.bs-example{
	font-family: sans-serif;
	position: relative;
	margin: 100px;
}
.typeahead, .tt-query, .tt-hint {
	border: 2px solid #CCCCCC;
	border-radius: 8px;
	font-size: 24px;
	height: 30px;
	line-height: 30px;
	outline: medium none;
	padding: 8px 12px;
	width: 396px;
}
.typeahead {
	background-color: #FFFFFF;
}
.typeahead:focus {
	border: 2px solid #0097CF;
}
.tt-query {
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
	color: #999999;
}
.tt-dropdown-menu {
	background-color: #FFFFFF;
	border: 1px solid rgba(0, 0, 0, 0.2);
	border-radius: 8px;
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	margin-top: 12px;
	padding: 8px 0;
	width: 422px;
}
.tt-suggestion {
	font-size: 24px;
	line-height: 24px;
	padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
	background-color: #0097CF;
	color: #FFFFFF;
}
.tt-suggestion p {
	margin: 0;
}
</style>
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
									<form>
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
												<a href="#modal" class="btn go small icon fa-circle-o-right">Seach!</a>
												</td>
												</tr>
											</table>
											
										</div>
									</form>
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