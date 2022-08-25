<?php

class Grade
{
    public $id;
    public $post_id;
    public $grade;

    public function __construct($post_id, $grade)
    {
        $this->post_id = $post_id;
        $this->grade = $grade;
    }

    static function getRating($post_id)
    {
        $db = new createCon();
        $connection = $db->connect();
        $query = mysqli_query($connection, "select round(avg(grade),0) as grade from grades join blog_posts bp on grades.post_id = bp.id where post_id = " . $post_id);
        $rating = mysqli_fetch_array($query);
        $postGrade = new Grade($post_id, $rating["grade"]);

        return $postGrade;
    }

    public function createGrade($connect)
    {
//        $db = new createCon();
//        $connection = $db->connect();
        $query = "insert into grades (post_id, grade) values (" . $this->post_id . ", " . $this->grade . ")";
//        echo $this->post_id . ", " . $this->grade;
//        $query = "insert into grades (post_id, grade) values (1, 1)";
        mysqli_query($connect, $query);
    }
}