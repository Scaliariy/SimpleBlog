<?php

class Comment
{

    public $post_id;
    public $comment;
    public $user_name;
    public $grade;
    public $date;

    public function __construct($post_id, $comment, $user_name, $grade, $date)
    {
        $this->post_id = $post_id;
        $this->comment = $comment;
        if(!empty($user_name)) {
            $this->user_name = $user_name;
        } else {
            $this->user_name = "Guest";
        }
        $this->grade = $grade;
        $this->date = $date;
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