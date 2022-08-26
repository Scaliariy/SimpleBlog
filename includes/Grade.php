<?php

class Grade
{
    public $id;
    public $post_id;
    public $grade;

    public function __construct($post_id, $grade)
    {
        $this->post_id = $post_id;
        if (empty($grade)){
            $this->grade = 0;
        } else {
            $this->grade = $grade;
        }

    }

    static function getRating($post_id)
    {
        $db = new Database();
        $connection = $db->getMyconn();
        $query = mysqli_query($connection, "select round(avg(grade),1) as grade from grades join posts bp on grades.post_id = bp.id where post_id = " . $post_id);
        $rating = mysqli_fetch_array($query);
        $postGrade = new Grade($post_id, $rating["grade"]);

        return $postGrade;
    }

    public function createGrade($connect)
    {
        $query = "insert into grades (post_id, grade) values (" . $this->post_id . ", " . $this->grade . ")";
        mysqli_query($connect, $query);
    }
}