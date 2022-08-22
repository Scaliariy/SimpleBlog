<?php

include("includes/includes.php");
include("includes/db.php");

$connection = new createCon();
$connection->connect();

$blogPosts = getBlogPosts($connection->myconn);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <!--	<link rel="stylesheet" href="includes/style.css" type="text/css" media="screen" title="no title" charset="utf-8">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Simple Blog</title>
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>My Simple Blog</h1>
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
            <h1>Counter</h1>
        </div>
    </div>
    <div class="container pb-5 text-center">
        <div class="row g-5">
            <div class="col">
                <div class="p-3 border bg-light">
                    <h6>
                        <?php negativePostCount($connection->myconn) ?>
                    </h6>
                </div>
            </div>
            <div class="col">
                <div class="p-3 border bg-light">
                    <h6><?php allPostCount($connection->myconn) ?></h6>
                </div>
            </div>
            <div class="col">
                <div class="p-3 border bg-light">
                    <h6><?php positivePostCount($connection->myconn) ?></h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-end">
        <div class="col">
            <h1>Posts</h1>
        </div>
        <div class="col">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Post
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form>
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                    <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                                           aria-describedby="basic-addon1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-5 justify-content-center">

        <?php
        foreach ($blogPosts as $post) {
            echo "<div class='col-12 p-3 border bg-light'>";
            echo "<h2>" . $post->title . "</h2>";
            echo "<p>" . $post->post . "</p>";
            echo "<span>Posted By: " . $post->author . " Posted On: " . $post->datePosted . " Grade: " . $post->grade . " </span>";

            if (postHaveComment($connection->myconn, $post->id)) {
                $blogComment = getPostComment($connection->myconn, $post->id);
                foreach ($blogComment as $comm) {
                    echo "<div class='col-12 p-3 border bg-white'>";
                    echo "<h3>" . $comm->user_name . "</h3>";
                    echo "<p>" . $comm->comment . "</p>";
                    echo "<span>Posted On: " . $comm->date . "</span>";
                    echo "</div>";
                }
            }
            echo "<hr><button type='button' class='btn btn-secondary'>Add Comment</button>";
            echo "</div>";
        }
        ?>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
</body>

</html>