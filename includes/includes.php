<?php
include 'blogpost.php';
include 'comment.php';
include 'includes/db.php';

$connection = new createCon();
$connection->connect();

function printPostsAndComments($connect)
{
    foreach (BlogPost::getBlogPosts($connect) as $key => $post) {
        echo "<div id='postDiv' class='col-12 p-3 border bg-light'>";
//        echo "<p id='postId' hidden>" . $post->id . "</p>";
        echo "<p id='postNameP' >by " . $post->name . "</p>";
        echo "<p id='postPostP' >" . $post->post . "</p>";
        echo "<span id='postDateSpan' >" . $post->date . " Grade: " . "null" . " </span>";
        $values[$key] = array(
            'name_post' => $post->name,
            'post' => $post->post,
            'date_post' => $post->date,

        );
        if (Comment::postHaveComment($connect, $post->id)) {
            foreach (Comment::getPostComment($connect, $post->id) as $comm) {
                echo "<div id='commentDiv' class='col-12 p-3 border bg-white'>";
                echo "<p id='commentNameP' >by " . $comm->user_name . "</p>";
                echo "<p id='commentCommP' >" . $comm->comment . "</p>";
                echo "<span id='commentDateSpan' >" . $comm->date . "</span>";
                echo "</div>";
                $values[$key][] = array(
                    'comments' => array(
                        'name_comm' => $comm->user_name,
                        'comment' => $comm->comment,
                        'date_comm' => $comm->date,
                    ),

                );
            }
        }
        echo "<hr>";
        echo "<div id='commDiv'>";
        printFormComment($post->id);
//        echo "<hr><button type='button' class='btn btn-secondary'>Add Comment</button>";
        echo "</div>";
        echo "</div>";
    }
//    var_dump($values);
//    echo json_encode($values, JSON_FORCE_OBJECT);
    return $values;
}

function printFormComment($post_id)
{
//    echo $comm;
    echo "<!-- Button trigger modal -->
            <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#commentModal" . $post_id . "'>
                Add Comment
            </button>

            <!-- Modal -->
            <div class='modal fade' id='commentModal" . $post_id . "' tabindex='-1' aria-labelledby='commentModalLabel'
                 aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='commentModalLabel'>Comment</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <form id='commentForm'>
                            <div class='modal-body'>
                                <div class='input-group mb-3'>
                                    <label>
                                        <input class='form-control' type='text' name='name' placeholder='Your name' required/>
                                    </label>
                                        <input class='form-control' type='text' name='post_id' value='" . $post_id . "' hidden/>
                                </div>
                                <div class='mb-3 text-start'>
                                    <label for='post'>Comment:</label>
                                    <textarea class='form-control' name='comment' placeholder='Text' required></textarea>
                                </div>
                            </div>
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-primary' name='submit' id='btnCommSave'>Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>";
}





