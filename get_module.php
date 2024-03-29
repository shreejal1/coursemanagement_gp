<?php
require 'database.php';
// Getinmg the course ID from the query string parameter
$courseId = $_GET['id'];
// Prepareing and executeing a SQL statement to get the modules for the selected course
$sql = "SELECT id, name FROM module WHERE course_id = :course_id AND status = 'ACTIVE'";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':course_id', $courseId, PDO::PARAM_STR);
$stmt->execute();
// Fetchinmg the result as an associative array
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Returningg the result as a JSON string
echo json_encode($modules);
$pdo = null;
?>