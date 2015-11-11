<?php

function headHTML()
{
    echo '<!DOCTYPE HTML>
            <html>
	        <head>
		        <title>NHC Control</title>
		        <meta charset="utf-8" />
		        <meta name="viewport" content="width=device-width, initial-scale=1" />
		        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		        <link rel="stylesheet" href="assets/css/main.css" />
		        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	        </head>';
}

function topHTML()
{
    
    echo '  <body class="landing">
		        <!-- Page Wrapper -->
			        <div id="page-wrapper">

				        <!-- Header -->
					        <header id="header" class="alt">
						        <h1><a href="index.php">NHC Control</a></h1>
						        <nav id="nav">
							        <ul>
								        <li class="special">
									        <a href="#menu" class="menuToggle"><span>Menu</span></a>
									        <div id="menu">
										        <ul>';
}

function topHTML2()
{
    echo '										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</header>
				<!-- Banner -->
					<section id="banner">
						<div class="inner">
							<h2>NHC Control</h2>
							<p>Control your NHC<br />
							with a simple browser<br />
							created by BKR.</p>
							<!--<ul class="actions">
								<li><a href="#" class="button special">Activate</a></li>
							</ul>-->
						</div>
						<a href="#locations" class="more scrolly">zones</a>
					</section>';
}


function footerHTML()
{
    echo '				<!-- Footer -->
					<footer id="footer">
						
						<ul class="copyright">
							<li>&copy; BKR</li>';
							
	echo '<li>'.date('l jS \of F Y H:i:s').'</li>';							
							
	echo '					</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>';


}

?>