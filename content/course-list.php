<div class="main">

	<?php

$i=0;
		$query = $elc_db->prepare("Select Levels.level_id, Levels.level_name, Levels.level_short_name from Levels order by level_order ASC");
		$query->execute();
		$result = $query->get_result();
		echo "<div class='content-background'><div class='content'>";
		while($levels = $result->fetch_assoc()){
			

			
			echo "<div class='course_list'>";
				$course_query = $elc_db->prepare("Select Courses.course_id, Courses.course_name, Courses.level_id, Courses.course_short_name from Courses where Courses.level_id = ? order by course_order ASC");
				$course_query->bind_param('s', $levels['level_id']);
				$course_query->execute();
				$course_result=$course_query->get_result();
				
				echo "<a data-shortName='".$levels['level_short_name']."' data-name='".$levels['level_name']." 'class='level' href='levels.php#".$levels['level_short_name']."'><span>".$levels['level_name']."</span></a>";
			while($courses = $course_result->fetch_assoc()){

				$courses['course_name'] = str_replace('Fluency', '', $courses['course_name']);
				
				echo "<a data-shortName='".$courses['course_short_name']."' data-name='".$courses['course_name']."' title='".$courses['course_name']."' href='course.php?course_id=".$courses['course_id']."'><span>".$courses['course_name']."</span></a>";






			}
			echo "</div>";
		
		}
		echo "</div></div>";
		$result->free();
?>
</div>
