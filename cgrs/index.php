<!DOCTYPE HTML>
<!--
	Identity by Unity Infoway
	unityinfoway.com
	..
-->
<html>
	<head>
		<title>CCMS</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>

		<style type="text/css">
			section {
				width: 60%;
			}
			section .left {
				float: left;
				width: 40%;
				/*margin: 50px;*/
				padding-right: 50px;
				border-right: solid 1px grey;
			}
			.left img {
				width: 70%;
			}
			section .right {
				float: left;
				width: 60%;
				/*margin: 50px;*/
				padding-left: 50px;
			}
			@media screen and (min-width: 240px) and (max-width: 360px) {
				section .left {
					float: none;
					width: auto;
					border-right: none;
					padding-right: 0px;
					padding-bottom: 20px;
					border-bottom: solid 1px grey;
				}
				.left img {
					/*height: 100px;*/
					width: 40%;
				}

				section .right {
					float: none;
					padding-top: 20px;
					width: 100%;
					/*margin: 50px;*/
					padding-left: 0px;
				}

			}
			@media screen and (min-width: 360px) and (max-width: 480px) {
				section .left {
					float: none;
					width: auto;
					border-right: none;
					padding-right: 0px;
					padding-bottom: 20px;
					border-bottom: solid 1px grey;
				}
				.left img {
					/*height: 10%;*/
					width: 50%;
				}

				section .right {
					float: none;
					padding-top: 20px;
					width: 100%;
					/*margin: 50px;*/
					padding-left: 0px;
				}

			}
			@media screen and (min-width: 480px) and (max-width: 576px) {
				section .left {
					float: none;
					width: auto;
					border-right: none;
					padding-right: 0px;
					padding-bottom: 20px;
					border-bottom: solid 1px grey;
				}
				.left img {
					/*height: 10%;*/
					width: 50%;
				}

				section .right {
					float: none;
					padding-top: 20px;
					width: 100%;
					/*margin: 50px;*/
					padding-left: 0px;
				}
			}
			@media screen and (min-width: 576px) and (max-width: 768px) {
				section {
					width: 90%;
				}
				section .left {
					float: left;
					width: 40%;
					/*margin: 50px;*/
					padding-right: 50px;
					border-right: solid 1px grey;
				}
				.left img {
					width: 70%;
				}
				section .right {
					float: left;
					width: 60%;
					/*margin: 50px;*/
					padding-left: 50px;
				}
			}
			@media screen and (min-width: 768px) and (max-width: 980px) {
				section {
					width: 90%;
				}
				section .left {
					float: left;
					width: 40%;
					/*margin: 50px;*/
					padding-right: 50px;
					border-right: solid 1px grey;
				}
				.left img {
					width: 70%;
				}
				section .right {
					float: left;
					width: 60%;
					/*margin: 50px;*/
					padding-left: 50px;
				}
			}
			@media screen and (min-width: 980px) and (max-width: 1200px) {
				section {
					width: 90%;
				}
				section .left {
					float: left;
					width: 40%;
					/*margin: 50px;*/
					padding-right: 50px;
					border-right: solid 1px grey;
				}
				.left img {
					width: 70%;
				}
				section .right {
					float: left;
					width: 60%;
					/*margin: 50px;*/
					padding-left: 50px;
				}
			}
			.bg {
				background-color: transparent;
			}
		</style>
	</head>
	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
						<?php
							if (isset($_GET['cmp'])) {
						?>
						<div>
							<span>Your Complaint has been Succesfully submitted</span>
							<hr>
						</div>
						<?php
							}
						?>
						<div class="left">
						<!-- <header> -->
							<!-- <span class="avatar"> -->
								<img src="images/College.png" alt="GPG" />
							<!-- </span> -->
							<h1>CCMS</h1>
							<p>College <br>Complaint Management System</p>
						<!-- </header> -->
						</div>
						<!-- <hr /> -->
						<div class="right">
						<h2>Complaint Form</h2>
						<form method="POST" action="database_index-process.php">
							<div class="field">
    							<input type="text" name="lc_name" placeholder="Student name"/ required>
							</div>
							<div class="field">
     							<input type="text" name="lc_enno" placeholder="enrollment no" required />
     						</div>
							<div class="field">
								<div class="select-wrapper">
									<select name="d_ment" required>
							          <option value="General">Department</option>
							          <option value="IT">IT</option>
							          <option value="CE">CE</option>
							          <option value="IC">IC</option>
							          <option value="EC">EC</option>
							          <option value="CH">CH</option>
							          <option value="BM">BM</option>
							          <option value="EE">EE</option>
							     	</select>
								</div>
							</div>
							<div class="field">
								<textarea name="lc_complaint" rows="4" placeholder="Type complaint" required></textarea>						
							</div>
							<!--<div class="field">
								<input type="checkbox" id="human" name="human" /><label for="human">I'm a human</label>
							</div>
							<div class="field">
								<label>But are you a robot?</label>
								<input type="radio" id="robot_yes" name="robot" /><label for="robot_yes">Yes</label>
								<input type="radio" id="robot_no" name="robot" /><label for="robot_no">No</label>
							</div> -->
							<ul class="actions">
								<li><input type="submit" class="bg" value="Lodge" name="lc_submit"></li>
							</ul>
						</form>
						</div>
						<!-- <hr />
						
						<footer>
							<ul class="icons">
								<li><a href="#" class="fa-twitter">Twitter</a></li>
								<li><a href="#" class="fa-instagram">Instagram</a></li>
								<li><a href="#" class="fa-facebook">Facebook</a></li>
							</ul>
						</footer> -->
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
							<li>&copy; CCMS</li>
							<li>Design: <a href="<?php echo $_SERVER['PHP_SELF'] ?>">Unity</a></li>
						</ul>
					</footer>
			</div>

		<!-- Scripts -->
			<!--[if lte IE 8]><script src="assets/js/respond.min.js"></script><![endif]-->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>