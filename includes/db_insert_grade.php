<?php
include 'Grade.php';
//include_once 'db.php';

$connect = new mysqli("localhost", "root", "root", "blog");
$arr = explode("|",$_POST['rating']);
$newGrade = new Grade($arr[1],$arr[0]);
$newGrade->createGrade($connect);




