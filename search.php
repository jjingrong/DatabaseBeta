<!DOCTYPE HTML>
<!--
	ZeroFour by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<?php include_once 'header.php' ?>
	<body class="left-sidebar">


	<!--Java script functions-->
	<script>
	function doSearch() {
	    var searchText = document.getElementById('searchTerm').value;
	    var targetTable = document.getElementById('dataTable');
	    var targetTableColCount;
	            
	    //Loop through table rows
	    for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
	        var rowData = '';

	        //Get column count from header row
	        if (rowIndex == 0) {
	           targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
	           continue; //do not execute further code for header row.
	        }
	                
	        //Process data rows. (rowIndex >= 1)
	        for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
	            rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).textContent;
	        }

	        //If search term is not found in row data
	        //then hide the row, else show
	        if (rowData.indexOf(searchText) == -1)
	            targetTable.rows.item(rowIndex).style.display = 'none';
	        else
	            targetTable.rows.item(rowIndex).style.display = 'table-row';
	    }
	}
	</script>	


		<!-- Header Wrapper -->
			<div id="header-wrapper">
				<div class="container">
					<div class="row">
						<div class="12u">
						
							<!-- Header -->
								<header id="header">
									<div class="inner">
									
										<!-- Logo -->
											<h1><a href="index.html" id="logo">Group 72</a></h1>
										
										<!-- Nav -->
											<nav id="nav">
												<ul>
													<li><a href="index.html">Home</a></li>
													<li class="current_page_item"><a href="bookingpage.html">Book Flights</a></li>
													<li>
														<a href="">Dropdown</a>
														<ul>
															<li><a href="#">Lorem ipsum dolor</a></li>
															<li><a href="#">Magna phasellus</a></li>
															<li>
																<a href="">Phasellus consequat</a>
																<ul>
																	<li><a href="#">Lorem ipsum dolor</a></li>
																	<li><a href="#">Phasellus consequat</a></li>
																	<li><a href="#">Magna phasellus</a></li>
																	<li><a href="#">Etiam dolore nisl</a></li>
																</ul>
															</li>
															<li><a href="#">Veroeros feugiat</a></li>
														</ul>
													</li>
													<li><a href="faq.html">FAQ</a></li>
												</ul>
											</nav>
									
									</div>
								</header>

						</div>
					</div>
				</div>
			</div>
		
		<!-- Main Wrapper -->
			<div id="main-wrapper">
				<div class="wrapper style2">
					<div class="inner">
						<div class="container">
							<div class="row">
								<div class="4u">
									<div id="sidebar">

										<!-- Sidebar -->
									
											<section>
												<header class="major">
													<h2>Search options</h2>
												</header>
												<p><b>Random PlacerHolder Text<br> Maybe include Search options below</b><br>
												Phasellus quam turpis, feugiat sit amet ornare in, hendrerit in lectus. 
												Praesent semper mod quis eget mi. Etiam eu ante risus. Aliquam erat volutpat. 
												Aliquam luctus et mattis lectus sit amet pulvinar. Nam turpis nisi 
												consequat etiam.</p>
												<footer>
													<a href="#" class="button icon fa-info-circle">Find out more</a>
												</footer>
											</section>

											<section>
												<header class="major">
													<h2>Subheading</h2>
												</header>
												<ul class="style2">
													<li><a href="#">Amet turpis, feugiat et sit amet</a></li>
													<li><a href="#">Ornare in hendrerit in lectus</a></li>
													<li><a href="#">Semper mod quis eget mi dolore</a></li>
													<li><a href="#">Quam turpis feugiat sit dolor</a></li>
													<li><a href="#">Amet ornare in hendrerit in lectus</a></li>
													<li><a href="#">Semper mod quisturpis nisi</a></li>
													<li><a href="#">Consequat etiam lorem phasellus</a></li>
													<li><a href="#">Amet turpis, feugiat et sit amet</a></li>
													<li><a href="#">Semper mod quisturpis nisi</a></li>
												</ul>
												<footer>
													<a href="#" class="button icon fa-arrow-circle-o-right">Do Something</a>
												</footer>
											</section>
								
									</div>
								</div>
								<div class="8u skel-cell-important">
									<div id="content">

										<!-- Content -->
									
											<article>
												<header class="major">
													<h2>Input booknig details</h2>
													<p>Sidebar on the left for... no reason yet</p>
												</header>

												<!-- Modal attempt -->
												<div class="container">
													<input type="text" name="name" id="name" placeholder="Name"/><br>
													<input type="text" name="blahblah" id="blahblah" placeholder="blahblah"  /><br>
													<input type="text" name="email" id="email" placeholder="Email"/><br>
													<input type="test" name="destination" id="destination" placeholder="Destination"/>
													<br><br>
													<a href="#modal" class="btn go small icon fa-circle-o-right">Book now</a>
													</div>

													<div id="modal">
														<div class="modal-content">
															<div class="header">
																<h2>Booking details</h2>
															</div>
															<div class="copy">
																<p>Confirmation details.</p>
															</div>
															<div class="cf footer">
																<a href="#" class="btn go">Confirm</a>
															</div>
														</div>
														<div class="overlay"></div>
													</div>





												<!-- Table function -->
												<p><h3>Placerholder Table search function </h3></p>
												<input type="text" id="searchTerm" class="search_box" onkeyup="doSearch()" />
												<table id="dataTable" border="5" width="100%" cellspacing="0" cellpadding="5">
												     <thead>
												         <tr>
												            <th><b><u>First Name</th>
												            <th><b><u>Last Name</th>
												            <th><b><u>Email Address</th>
												         </tr>
												     </thead>
												     <tbody>     
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
												
												<h3>More intriguing information</h3>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ac quam risus, at tempus 
												justo. Sed dictum rutrum massa eu volutpat. Quisque vitae hendrerit sem. Pellentesque lorem felis, 
												ultricies a bibendum id, bibendum sit amet nisl. Mauris et lorem quam. Maecenas rutrum imperdiet 
												vulputate. Nulla quis nibh ipsum, sed egestas justo. Morbi ut ante mattis orci convallis tempor. 
												Etiam a lacus a lacus pharetra porttitor quis accumsan odio. Sed vel euismod nisi. Etiam convallis 
												rhoncus dui quis euismod. Maecenas lorem tellus, congue et condimentum ac, ullamcorper non sapien. 
												Donec sagittis massa et leo semper a scelerisque metus faucibus. Morbi congue mattis mi. 
												Phasellus sed nisl vitae risus tristique volutpat. Cras rutrum commodo luctus.</p>

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