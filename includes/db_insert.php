<?php
include 'blogpost.php';
include 'comment.php';

$connect = new mysqli("localhost", "root", "root", "blog");

$newPost = new BlogPost(null, $_POST['post'], $_POST['name'], null);
$newPost->createPost($connect);






