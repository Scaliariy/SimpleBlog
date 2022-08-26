<?php

class Comment
{

    public $post_id;
    public $comment;
    public $visitore_name;
    public $created_at;

    public function __construct($post_id, $comment, $visitore_name, $created_at)
    {
        $this->post_id = $post_id;
        $this->comment = $comment;
        $this->visitore_name = $visitore_name;

        if (!empty($created_at)) {
            $split_created_at = explode("-", $created_at);
            $this->created_at = $split_created_at[1] . "." . $split_created_at[2] . "." . $split_created_at[0];
        }
    }

    static function postHaveComment($connection, $post_id = null)
    {
        if (!empty($post_id)) {
            $str = "SELECT comments.* FROM comments WHERE post_id = " . $post_id . " ORDER BY id DESC";
            mysqli_query($connection, $str);
            return true;
        }
        return false;
    }

    static function getPostComment($connection, $post_id = null)
    {
        if (!empty($post_id)) {
            $query = mysqli_query($connection, "SELECT comments.* FROM comments WHERE post_id = " . $post_id . " ORDER BY id DESC");
        }

        $commentArray = array();
        while ($row = mysqli_fetch_assoc($query)) {
            $comment = new Comment($row["post_id"], $row['comment'], $row['visitore_name'], $row['created_at']);
            array_push($commentArray, $comment);
        }
        return $commentArray;
    }

    public function createComment($connection)
    {
        $query = "insert into comments (post_id, comment, visitore_name, created_at) values (" . $this->post_id . ", '" . $this->comment . "', '" . $this->visitore_name . "', curdate())";
        mysqli_query($connection, $query);
    }
}