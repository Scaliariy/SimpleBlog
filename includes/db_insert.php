<?php
include 'blogpost.php';
include 'comment.php';
//include 'includes/includes.php';

$connect = new mysqli("localhost", "root", "root", "blog");

$newPost = new BlogPost(null, $_POST['post'], $_POST['name'], null);
$newPost->createPost($connect);

//function printPostsAndComments($connect){
//    foreach (BlogPost::getBlogPosts($connect) as $key => $post) {
////        echo "<div class='col-12 p-3 border bg-light'>";
////        echo "<p>by " . $post->name . "</p>";
////        echo "<p>" . $post->post . "</p>";
////        echo "<span>" . $post->date . " Grade: " . "null" . " </span>";
//        $values[$key] = array(
//            'name' => $post->name,
//            'post' => $post->post,
//            'date' => $post->date,
//
//        );
//        if (Comment::postHaveComment($connect, $post->id)) {
//            foreach (Comment::getPostComment($connect, $post->id) as $comm) {
////                echo "<div class='col-12 p-3 border bg-white'>";
////                echo "<p>by " . $comm->user_name . "</p>";
////                echo "<p>" . $comm->comment . "</p>";
////                echo "<span>" . $comm->date . "</span>";
////                echo "</div>";
//                $values[$key][] = array(
//                    'comments' => array(
//                        'comment_name' => $comm->user_name,
//                        'comment' => $comm->comment,
//                        'date' => $comm->date,
//                    ),
//
//                );
//            }
//        }
////        echo "<hr><button type='button' class='btn btn-secondary'>Add Comment</button>";
////        echo "</div>";
//    }
//    return $values;
//}

//echo json_encode(printPostsAndComments($connect));




