<?php
include 'Post.php';
include 'Comment.php';
include 'db.php';

$db = new Database();
$connect = $db->getMyconn();

$newComment = new Comment($_POST['post_id'],$_POST['comment'], $_POST['visitore_name'], null);
$newComment->createComment($connect);







