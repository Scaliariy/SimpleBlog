<?php
include 'blogpost.php';
include 'comment.php';

function getBlogPosts($connection, $inId = null, $inTagId = null)
{
    if (!empty($inId)) {
        $query = mysqli_query($connection, "SELECT * FROM blog_posts WHERE id = " . $inId . " ORDER BY id DESC");
    } else if (!empty($inTagId)) {
        $query = mysqli_query($connection, "SELECT blog_posts.* FROM blog_post_tags LEFT JOIN (blog_posts) ON (blog_post_tags.blog_post_id = blog_posts.id) WHERE blog_post_tags.tag_id =" . $inTagId . " ORDER BY blog_posts.id DESC");
    } else {
        $query = mysqli_query($connection, "SELECT * FROM blog_posts ORDER BY id DESC");
    }

    $postArray = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $myPost = new BlogPost($connection, $row["id"], $row['title'], $row['post'], $row["author_id"], $row["grade"], $row['date_posted']);
        array_push($postArray, $myPost);
    }
    return $postArray;
}

function postHaveComment($connection, $post_id = null)
{
    if (!empty($post_id)) {
        $str = "SELECT comments.* FROM comments WHERE post_id = " . $post_id . " ORDER BY id DESC";
        mysqli_query($connection, $str);
        return true;
    }
    return false;
}

function getPostComment($connection, $post_id = null)
{
    if (!empty($post_id)) {
        $query = mysqli_query($connection, "SELECT comments.* FROM comments WHERE post_id = " . $post_id . " ORDER BY id DESC");
    }

    $commentArray = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $comment = new Comment($row["post_id"], $row['comment'], $row['user_name'], $row["grade"], $row['date']);
        array_push($commentArray, $comment);
    }
    return $commentArray;
}

function negativePostCount($connection)
{
    $query = mysqli_query($connection, "SELECT count(grade) FROM blog_posts WHERE grade < 3");
    $row = mysqli_fetch_assoc($query);

    echo "Negative Posts: " . $row['count(grade)'];
}

function allPostCount($connection)
{
    $query = mysqli_query($connection, "SELECT count(grade) FROM blog_posts");
    $row = mysqli_fetch_assoc($query);

    echo "All Posts: " . $row['count(grade)'];
}

function positivePostCount($connection)
{
    $query = mysqli_query($connection, "SELECT count(grade) FROM blog_posts WHERE grade > 3");
    $row = mysqli_fetch_assoc($query);

    echo "Positive Posts: " . $row['count(grade)'];
}