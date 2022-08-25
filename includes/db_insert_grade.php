<?php
include 'Grade.php';
//include_once 'db.php';

var_dump($_POST);
$newGrade = new Grade($_POST['post_id'],$_POST['grade']);
$newGrade->createGrade();







