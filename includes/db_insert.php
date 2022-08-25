<?php
include 'Post.php';
include_once 'db.php';

$newPost = new BlogPost(null, $_POST['post'], $_POST['name'], null);
$newPost->createPost();






