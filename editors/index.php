<?php

include_once("../../../connectFiles/connect_cis.php");
include_once("cas-go.php");
include_once("admins.php");
?>

<!DOCTYPE html>
<html lang="">
<head>
	<title>Curriculum Editor</title>

<!-- 	Meta Information -->
	<meta charset="utf-8">
	<meta name="description" content="This section of the ELC website outlines the ELC curriculum." />
	<meta name="keywords" content="ELC, BYU, ESL, Curriculum, Levels, Learning, Outcomes" />
	<meta name="robots" content="ELC, BYU, ESL, Curriculum, Levels, Learning, Outcomes" />
	<meta name="viewport" content="width=device-width, initial-scale=1">


<?php include("styles_and_scripts.html"); ?>

<!-- 	Javascript -->
	<script>
	$(document).ready(function() {



});


</script>
</head>
<body>
	<header>
				<div>
			<h1>Curriculum Editor</h1>
			<a class="button" id="go_back" href="https://elc.byu.edu/curriculum/">View the Curriculum Portfolio</a>
</div>
			<div id="user">
				<?php
if ($auth) {echo phpCAS::getUser()." | <a href='?logout='>Logout</a>";}
else {echo "<a href='?login='>Login</a>";}
				?>
			</div>
			

</header>
<article>
		<?php
    echo $message;
    if ($auth && $access) { ?>
			<hr />

			<div class="content">
			<h2> Levels and Courses </h2>
			<?php
                $query = $elc_db->prepare("Select Levels.level_id, Levels.level_name from Levels order by level_order ASC");
								$query->execute();
								$result = $query->get_result();




        while ($levels = $result->fetch_assoc()) {
            echo "<div class='course_list'>";
            echo "<a class='level' href='level-edit.php?level_id=".$levels['level_id']."'>".$levels['level_name']."</a>";
            $course_query = "Select Courses.course_id, Courses.course_name,Courses.course_short_name, Courses.level_id from Courses where Courses.level_id=".$levels['level_id']." order by course_order ASC";
            if (!$course_result = $elc_db->query($course_query)) {
                die('There was an error running the query [' . $elc_db->error . ']');
            }

            while ($courses = $course_result->fetch_assoc()) {
				echo "<a data-shortName='".$courses['course_short_name']."' data-name='".$courses['course_name']."' title='".$courses['course_name']."' href='course-edit.php?course_id=".$courses['course_id']."'><span>".$courses['course_name']."</span></a>";
            }
            echo "</div>";
        }
		$result->free();
		?>
		<hr /><h2>Learning Experiences</h2>
		<a id='new_le' class='button' href='le-edit.php?learningExperienceId=new'> + Learning Experience<a><br />
		<?php 
		$learningExperienceQuery = $elc_db->prepare("Select * from Learning_experiences order by name ASC");
		$learningExperienceQuery->execute();
		$result = $learningExperienceQuery->get_result();
  	while ($learningExperience = $result->fetch_assoc()) {
		echo "<a href='le-edit.php?learningExperienceId=".$learningExperience['learning_experience_id']."'>".$learningExperience['name']."</a><br />";
		
	}
	  ?>
<?php
if (phpCAS::getUser() == "blm39") {
    ?>
		<hr /><h2> Review Submitted Changes </h2>
		<?php



		$review_query = $elc_db->prepare("Select * from Courses_review where needs_review = 1");
		$review_query->execute();
		$result = $review_query->get_result();
  	while ($Courses_review = $result->fetch_assoc()) {
      echo "<a href='review-edits.php?course_id=".$Courses_review['course_id']."'>".$Courses_review['course_name']."</a><br />";
  	}

		$review_level_query = $elc_db->prepare("Select * from Levels_review where needs_review = 1");
		$review_level_query->execute();
		$review_level_query_results = $review_level_query->get_result();

  	while ($level_review = $review_level_query_results->fetch_assoc()) {
      echo "<a href='review-level-edits.php?level_id=".$level_review['level_id']."'>".$level_review['level_name']."</a><br />";
  	}

}

?>
			</div>
	<hr />
<?php } else {?> <p></p><?php } ?>
	</article>
</body>
</html>
