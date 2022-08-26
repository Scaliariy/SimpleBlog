<?php
include("includes/includes.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Simple Blog</title>
</head>

<body>
<div class="container">
    <div class="row text-center p-5">
        <div class="col">
            <h1>My Simple Blog</h1>
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
            <h1>Counter</h1>
        </div>
    </div>
    <div class="counters">
        <div class="container pb-5 text-center">
            <div class="row g-5">
                <div class="col">
                    <div class="p-3 border bg-light">
                        <h6>
                            <?php Post::negativePostCount($connection->getMyconn()) ?>
                        </h6>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3 border bg-light">
                        <h6><?php Post::allPostCount($connection->getMyconn()) ?></h6>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3 border bg-light">
                        <h6><?php Post::positivePostCount($connection->getMyconn()) ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-end">
        <div class="col">
            <h1>Posts</h1>
        </div>
        <div class="col">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Post
            </button>
        </div>
    </div>
    <div id="rowPosts" class="row g-5 justify-content-center">
        <?php printPostsAndComments($connection->getMyconn()); ?>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="postForm">
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <label>
                            <input class="form-control" type="text" name="visitore_name" placeholder="Your name"
                                   required/>
                        </label>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="post">Post:</label>
                        <textarea class="form-control" name="post" placeholder="Text" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit" id="btnSave">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.session@1.0.0/jquery.session.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#postForm').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "includes/db_insert.php",
                type: "POST",
                data: $(this).serialize(),
                success: function (data) {
                    $("#rowPosts").load(location.href + " #rowPosts>*", "", function () {
                        if ($.session.get("showRate") === "0") {
                            $(".rating").prop('disabled', true);
                        }
                    });
                    $(".counters").load(location.href + " .counters>*", "");
                    console.log("posts reloaded");
                },
                error: function () {
                    alert("Form submission failed!");
                }
            });
        });
    });
    $(document).ready(function () {
        $(document).on('submit', '.commentForm', function (e) {
            e.preventDefault();
            $.ajax({
                url: "includes/db_insert_comment.php",
                type: "POST",
                data: $(this).serialize(),
                success: function (data) {
                    $("#rowPosts").load(location.href + " #rowPosts>*", "", function () {
                        if ($.session.get("showRate") === "0") {
                            $(".rating").prop('disabled', true);
                        }
                    });
                    console.log("comments reloaded");
                },
                error: function () {
                    alert("Form submission failed!");
                }
            });

        });
    });
    $(document).ready(function () {
        $('.rating').change(function (e) {
            e.preventDefault();
            $.ajax({
                url: "includes/db_insert_grade.php",
                type: "POST",
                data: $(this).serialize(),
                success: function (data) {

                    $("#rowPosts").load(location.href + " #rowPosts>*", "", function () {
                        $.session.set("showRate", "0");
                            $(".rating").prop('disabled', true);
                            console.log("disabled ratings");
                    });
                    $(".counters").load(location.href + " .counters>*", "");
                    console.log("grades reloaded");
                },
                error: function () {
                    alert("Form submission failed!");
                }
            });
        });
    });
    $('#btnSave').click(function () {
        $('#exampleModal').modal('hide');
        console.log("post modal hidden");
    });
    $(document).on("click", ".btnCommSave", function () {
        $('.modal').modal('hide');
        console.log("comm modal hidden");
    });
    $(window).on("unload", function(e) {
        $.session.set("showRate", "1");
        console.log("showRate");
    });
</script>

</body>

</html>
