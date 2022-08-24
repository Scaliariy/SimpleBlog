<?php
include 'blogpost.php';
include 'comment.php';

$connect = new mysqli("localhost", "root", "root", "blog");

$newComment = new Comment($_POST['post_id'],$_POST['comment'], $_POST['name'], null);
$newComment->createComment($connect);







