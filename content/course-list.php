<div class="main">

	<?php

$i=0;
		$query = "Select Levels.level_id, Levels.level_name from Levels order by level_order ASC";
		if(!$result = $db->query($query)){
			die('There was an error running the query [' . $db->error . ']');
		}
		//echo "<div style='text-align:center' class='content'>";
		while($levels = $result->fetch_assoc()){
			echo "<div class='content-background'><div class='content'>";

			echo "<h1>".$levels['level_name']."</h1>";
			echo "<div class='course_list'>";
				$course_query = "Select Courses.course_id, Courses.course_name, Courses.level_id from Courses where Courses.level_id=".$levels['level_id']." order by course_order ASC";
					if(!$course_result = $db->query($course_query)){
						die('There was an error running the query [' . $db->error . ']');
					}

			while($courses = $course_result->fetch_assoc()){

				$courses['course_name'] = str_replace('Fluency', '', $courses['course_name']);

				echo "<a class='course_icon' href='course.php?course_id=".$courses['course_id']."'><span align='center'>".$courses['course_name']."</a>";






			}
			echo "</div>";
		echo "</div></div>";
		}
		$result->free();
?>
</div>
