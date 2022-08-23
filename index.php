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
    <div class="container pb-5 text-center">
        <div class="row g-5">
            <div class="col">
                <div class="p-3 border bg-light">
                    <h6>
                        <?php BlogPost::negativePostCount($connection->myconn) ?>
                    </h6>
                </div>
            </div>
            <div class="col">
                <div class="p-3 border bg-light">
                    <h6><?php BlogPost::allPostCount($connection->myconn) ?></h6>
                </div>
            </div>
            <div class="col">
                <div class="p-3 border bg-light">
                    <h6><?php BlogPost::positivePostCount($connection->myconn) ?></h6>
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
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
<!--                        <form id="postform" method="post">-->
<!--                            <div class="modal-body">-->
<!--                                <div class="input-group mb-3">-->
<!--                                    <label>-->
<!--                                        <input type="text" class="form-control" name="name" id="name">-->
<!--                                    </label>-->
<!--                                </div>-->
<!--                                <div class="mb-3 text-start">-->
<!--                                    <label for="post">Post:</label>-->
<!--                                    <textarea class="form-control" id="post" rows="3" name="post"></textarea>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="modal-footer">-->
<!--                                <button type="submit" class="btn btn-primary" name="submitPost" id="submitPost">Submit-->
<!--                                </button>-->
<!--                            </div>-->
<!--                        </form>-->

                        <div id="postData"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col"><form id="myForm">
                <input type="text" name="name" placeholder="Your name" required />
                <input type="text" name="post" placeholder="Text" required />
                <input type="submit" name="submit" value="Submit Form" />
            </form></div>
    </div>
    <div id="modifiersDiv">
        <p>Start</p>
    </div>
    <div  class="row g-5 justify-content-center">

        <?php printPostsAndComments($connection->myconn);?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#myForm').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: "includes/db_insert.php",
                type: "POST",
                data: $(this).serialize(),
                // success: function(data){
                //     var jsonData = JSON.parse(data);
                //     console.log(jsonData);
                // },
                success: function (data) {
                        $.each(JSON.parse(data), function(i, field){
                            $("#modifiersDiv").append("<p>" + field.name + ", " + field.post + ", " + field.date_posted + "</p>");
                        });
                    // $.each(data, function(key, item) {
                    //     var text = "<p>" + item.name + ", " + item.post + ", " + item.date_posted + "</p>";
                        // var text = "<p>" + item.name + "</p>";
                        // var text = "<p>" + item.post + "</p>";
                        // var text = "<p>" + item.date_posted + "</p>";

                        // $(text).appendTo('#modifiersDiv');
                        // $("#modifiersDiv").html(data);
                    // });
                    // $('#addModifiers').modal('show');
                },
                error: function(){
                    alert("Form submission failed!");
                }
            });
        });
    });
</script>
</body>

</html>
