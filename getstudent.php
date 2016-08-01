<?php 

require_once('dbFunctions.php');

if (isset($_GET['id'])) {
	$studentId = $_GET['id'];
} else {
	$studentId = 1;
}

$student = getStudent($studentId);

echo json_encode($student);

?>


