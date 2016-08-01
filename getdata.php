<?php 

require_once('dbFunctions.php');

$students = getAllStudents();

echo json_encode($students);

?>


