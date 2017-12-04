<?php
session_start();
	include_once("../../connectFiles/connect_cis.php");
	include_once("cas-go.php");
	include_once("teachers.php");
	$level_id=$_GET['level_id'];
	

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


<?php include("content/styles_and_scripts.html"); ?>
</head>
<body>

	<header>
		<?php include("content/header.php"); ?>
	</header>
	<div id='flex_content'>
	<nav>
		<?php include("content/nav-bar.php"); ?>
	</nav>
	<?php include("content/level-nav.php"); ?>
	<article>
	<?php

echo $level_id;
        $query = $elc_db->prepare("Select * from Levels where level_id = ?");
        $query->bind_param("s", $level_id);
            $query->execute();
            $result = $query->get_result();
        while ($levels = $result->fetch_assoc()) {
            echo "<div class='content-background' id='".$levels['level_short_name']."'><div class='content'>";
						echo "<a class='pdf_icon' target='_new' title='Save PDF' href='print_pdf.php?print_id=".$levels['level_id']."'></a>";

            echo "<h1>".$levels['level_name']."</h1>";





            echo $levels['level_descriptor'];
            echo "<h3>Courses</h3>";
                echo "<div class='course_list'>";
                $course_query = $elc_db->prepare("Select * from Courses where level_id = ? order by course_order");
								$course_query->bind_param("s",$levels['level_id']);
								$course_query->execute();
            		$courses_result = $course_query->get_result();
            while ($courses = $courses_result->fetch_assoc()) {
                echo "<a class='course_icon' style='margin-left:8px' href='course.php?course_id=".$courses['course_id']."'>".$courses['course_name']."</a> ";
            }
                echo "</div>";
            echo "</div></div>";
        }
            echo "</div>";
        $result->free();

?>
	</article>
	</div>
	<footer>
		<?php include("content/footer.html"); ?>
	</footer>

</body>
</html>
