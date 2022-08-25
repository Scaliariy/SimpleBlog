<?php

class BlogPost
{

    public $id;
    public $post;
    public $name;
    public $date;

    function __construct($id = null, $post = null, $name = null, $date = null)
    {

        if (!empty($id)) {
            $this->id = $id;
        }

        if (!empty($post)) {
            $this->post = $post;
        }

        if (!empty($date)) {
            $split_date = explode("-", $date);
            $this->date = $split_date[1] . "." . $split_date[2] . "." . $split_date[0];
        }

        if (!empty($name)) {
            $this->name = $name;
        }

    }

    public function createPost($connection)
    {
        $query = "insert into blog_posts (post, name, date_posted) values ('" . $this->post . "', '" . $this->name . "', curdate())";
        mysqli_query($connection, $query);
    }

    static function getBlogPosts($connection, $id = null)
    {
        if (!empty($id)) {
            $query = mysqli_query($connection, "SELECT * FROM blog_posts WHERE id = " . $id . " ORDER BY id DESC");
        } else {
            $query = mysqli_query($connection, "SELECT * FROM blog_posts ORDER BY id DESC");
        }

        $postArray = array();
        while ($row = mysqli_fetch_assoc($query)) {
            $myPost = new BlogPost($row["id"], $row["post"], $row['name'], $row['date_posted']);
            array_push($postArray, $myPost);
        }
        return $postArray;
    }

    static function negativePostCount($connection)
    {
        $query = mysqli_query($connection, "SELECT count(grade) FROM grades join blog_posts bp on grades.post_id = bp.id WHERE grade < 3");
        $row = mysqli_fetch_assoc($query);

        echo "Negative Posts: " . $row['count(grade)'];
    }

    static function allPostCount($connection)
    {
        $query = mysqli_query($connection, "select count(id) from blog_posts");
        $row = mysqli_fetch_assoc($query);

        echo "All Posts: " . $row['count(id)'];
    }

    static function positivePostCount($connection)
    {
        $query = mysqli_query($connection, "select count(grade) from grades join blog_posts bp on grades.post_id = bp.id WHERE grade > 3");
        $row = mysqli_fetch_assoc($query);

        echo "Positive Posts: " . $row['count(grade)'];
    }
}

