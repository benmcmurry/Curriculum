<?php
include_once("../../../connectFiles/connect_cis.php");
$course_id = $_POST['course_id'];
$net_id = $_POST['net_id'];
$course_name = $_POST['course_name'];
$course_short_name = $db ->real_escape_string($_POST['course_short_name']);
$course_description = $db ->real_escape_string($_POST['course_description']);
$course_emphasis = $db ->real_escape_string($_POST['course_emphasis']);
$course_materials = $db ->real_escape_string($_POST['course_materials']);
$learning_outcomes = $db ->real_escape_string($_POST['learning_outcomes']);
$assessment = $db ->real_escape_string($_POST['assessment']);
$learning_experiences = $db ->real_escape_string($_POST['learning_experiences']);
$google_drive_folder_id = $_POST['google_drive_folder_id'];
$needs_review = $_POST['needs_review'];


$query = $db->prepare("UPDATE Courses_Review SET needs_review= ?, course_name=?, course_short_name=?,course_description=?, course_emphasis=?,course_materials=?, learning_outcomes =?, assessment=?, learning_experiences=?, updated_by=?, google_drive_folder_id=? WHERE course_id=$course_id");
$query->bind_param("ssssssssssss", $needs_review, $course_name, $course_short_name, $course_description, $course_emphasis, $course_materials, $learning_outcomes, $assessment, $learning_experiences, $net_id, $google_drive_folder_id, $course_id);
$query->execute();
$result = $query->get_result();
		if(!$result = $db->query($query)){
			die('There was an error running the query [' . $db->error . ']');
		}
		else {
			echo "Saved ".date('l jS \of F Y h:i:s A').".";
		}
if ($needs_review == 0) {
	$query_final = $db->prepare("UPDATE Courses SET course_name=?, course_short_name=?,course_description=?, course_emphasis=?,course_materials=?, learning_outcomes =?, assessment=?, learning_experiences=?, updated_by=?, google_drive_folder_id=? WHERE course_id=?");
	$query_final->bind_param("sssssssssss", $course_name, $course_short_name, $course_description, $course_emphasis, $course_materials, $learning_outcomes, $assessment, $learning_experiences, $net_id, $google_drive_folder_id, $course_id);
	$query_final->execute();
	$result_final = $query_final->get_result();

			if(!$result_final = $db->query($query_final)){
				die('There was an error running the query [' . $db->error . ']');
			}
			else {

			}


}


$query_backup = $db->prepare("Insert into Courses_backup (course_id, course_name, course_short_name,course_description, course_emphasis,course_materials, learning_outcomes, assessment, learning_experiences, google_drive_folder_id, updated_on, updated_by) Values (?,?,?,?,?,?,?,?,?,?, now(), ? )");
$query_backup->bind_param("sssssssssss", $course_name, $course_short_name, $course_description, $course_emphasis, $course_materials, $learning_outcomes, $assessment, $learning_experiences, $net_id, $google_drive_folder_id, $course_id);
$query_backup->execute();
$result_backup = $query_backup->get_result();
if(!$result_backup = $db->query($query_backup)){
			die('There was an error running the query [' . $db->error . ']');
		}

?>