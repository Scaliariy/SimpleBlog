<?php
include 'Comment.php';
include_once 'db.php';

$newComment = new Comment($_POST['post_id'],$_POST['comment'], $_POST['name'], null);
$newComment->createComment();







