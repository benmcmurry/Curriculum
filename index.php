<?php
session_start();
    include_once("../../connectFiles/connect_cis.php");
    include_once("cas-go.php");
    include_once("teachers.php");
?>
<!DOCTYPE html>
<html lang="">
<head>
	<title>Curriculum Portfolio - English Language Center</title>

<!-- 	Meta Information -->
	<meta charset="utf-8">
	<meta name="description" content="This section of the ELC website outlines the ELC curriculum." />
	<meta name="keywords" content="ELC, BYU, ESL, Curriculum, Levels, Learning, Outcomes" />
	<meta name="robots" content="ELC, BYU, ESL, Curriculum, Levels, Learning, Outcomes" />
	<meta name="viewport" content="width=device-width, initial-scale=1">


<?php include_once("content/styles_and_scripts.html"); ?>
</head>
<body>
	<header>
		<?php include("content/header.php"); ?>
	</header>
	<nav>
		<?php include("content/nav-bar.php"); ?>
	</nav>
	<article>
		<?php include("content/mission.php"); ?>
	</article>
	<footer>
		<?php include("content/footer.html"); ?>
	</footer>

</body>
</html>
