<?php

class Comment
{

    public $post_id;
    public $comment;
    public $user_name;
    public $date;

    public function __construct($post_id, $comment, $user_name, $date)
    {
        $this->post_id = $post_id;
        $this->comment = $comment;
        if (!empty($user_name)) {
            $this->user_name = $user_name;
        } else {
            $this->user_name = "Guest";
        }
        if (!empty($date)) {
            $split_date = explode("-", $date);
            $this->date = $split_date[1] . "." . $split_date[2] . "." . $split_date[0];
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
            $comment = new Comment($row["post_id"], $row['comment'], $row['user_name'], $row['date']);
            array_push($commentArray, $comment);
        }
        return $commentArray;
    }

    public function createComment($connection)
    {
        $query = "insert into comments (post_id, comment, user_name, date) values (" . $this->post_id . ", '" . $this->comment . "', '" . $this->user_name . "', curdate())";
        mysqli_query($connection, $query);
    }

//    /**
//     * @param mixed $comment
//     */
//    public function saveComment($post_id, $comment, $user_name, $grade, $date): void
//    {
//        $this->post_id = $post_id;
//        $this->comment = $comment;
//        $this->user_name = $user_name;
//        $this->grade = $grade;
//        $this->date = $date;
//
//    }

}