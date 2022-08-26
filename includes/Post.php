<?php

class Post
{

    public $id;
    public $post;
    public $visitore_name;
    public $created_at;

    function __construct($id = null, $post = null, $visitore_name = null, $created_at = null)
    {

        if (!empty($id)) {
            $this->id = $id;
        }

        if (!empty($post)) {
            $this->post = $post;
        }

        if (!empty($created_at)) {
            $split_created_at = explode("-", $created_at);
            $this->created_at = $split_created_at[1] . "." . $split_created_at[2] . "." . $split_created_at[0];
        }

        if (!empty($visitore_name)) {
            $this->visitore_name = $visitore_name;
        }

    }

    public function createPost($connection)
    {
        $query = "insert into posts (post, visitore_name, created_at) values ('" . $this->post . "', '" . $this->visitore_name . "', curdate())";
        mysqli_query($connection, $query);
    }

    static function getBlogPosts($connection, $id = null)
    {
        if (!empty($id)) {
            $query = mysqli_query($connection, "SELECT * FROM posts WHERE id = " . $id . " ORDER BY id DESC");
        } else {
            $query = mysqli_query($connection, "SELECT * FROM posts ORDER BY id DESC");
        }

        $postArray = array();
        while ($row = mysqli_fetch_assoc($query)) {
            $myPost = new Post($row["id"], $row["post"], $row['visitore_name'], $row['created_at']);
            array_push($postArray, $myPost);
        }
        return $postArray;
    }

    static function negativePostCount($connection)
    {
        $query = mysqli_query($connection, "select count(DISTINCT post_id) as posts from grades join posts bp on grades.post_id = bp.id where grade < 3");
        $row = mysqli_fetch_assoc($query);

        echo "Negative Posts: " . $row['posts'];
    }

    static function allPostCount($connection)
    {
        $query = mysqli_query($connection, "select count(id) as posts from posts");
        $row = mysqli_fetch_assoc($query);

        echo "All Posts: " . $row['posts'];
    }

    static function positivePostCount($connection)
    {
        $query = mysqli_query($connection, "select count(DISTINCT post_id) as posts from grades join posts bp on grades.post_id = bp.id WHERE grade > 3");
        $row = mysqli_fetch_assoc($query);

        echo "Positive Posts: " . $row['posts'];
    }
}

