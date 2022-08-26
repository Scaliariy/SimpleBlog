<?php
include 'Post.php';
//include 'Comment.php';
include 'db.php';

$db = new Database();
$connect = $db->getMyconn();

$newPost = new Post(null, $_POST['post'], $_POST['visitore_name'], null);
$newPost->createPost($connect);






