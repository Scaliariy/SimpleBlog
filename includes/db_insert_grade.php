<?php
include 'Grade.php';
include 'db.php';

$db = new Database();
$connect = $db->getMyconn();

$arr = explode("|", $_POST['rating']);
try {
    $newGrade = new Grade($arr[1], $arr[0]);
    $newGrade->createGrade($connect);
} catch (Exception) {
}






