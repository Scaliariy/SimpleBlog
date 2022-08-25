<?php
include 'includes/db.php';
include 'Post.php';
include 'Comment.php';
include 'Grade.php';


function printPostsAndComments()
{
    foreach (BlogPost::getBlogPosts() as $key => $post) {
        echo "<div id='postDiv' class='col-12 p-3 border bg-light'>";
        echo "<p id='postNameP' >by " . $post->name . "</p>";
        echo "<p id='postPostP' >" . $post->post . "</p>";
        echo "<p id='postDateSpan' >" . $post->date . "</p>";
        echo "<p id='postDateSpan' >Grade: " . Grade::getRating($post->id)->grade . " </p>";
        $values[$key] = array(
            'name_post' => $post->name,
            'post' => $post->post,
            'date_post' => $post->date,

        );
        echo "<select class='rating' id='rating_" . $post->id . "' data-id='rating_" . $post->id . "'>";
        for ($i = 1;$i<=5;$i++){
            if (Grade::getRating($post->id)->grade == $i) {
                echo "<option selected value = '" . $i . "' > " . $i . "</option >";
            } else {
                echo "<option = '" . $i . "' > " . $i . "</option >";
            }
        }
        echo "</select > ";
        echo "<div id = 'commDiv' > ";
        printFormComment($post->id);
        echo "</div > ";
        echo "<hr > ";
        if (Comment::postHaveComment($post->id)) {
            foreach (Comment::getPostComment($post->id) as $comm) {
                echo "<div id = 'commentDiv' class='col-12 p-3 border bg-white' > ";
                echo "<p id = 'commentNameP' > by " . $comm->user_name . " </p > ";
                echo "<p id = 'commentCommP' > " . $comm->comment . "</p > ";
                echo "<span id = 'commentDateSpan' > " . $comm->date . "</span > ";
                echo "</div > ";
                $values[$key][] = array(
                    'comments' => array(
                        'name_comm' => $comm->user_name,
                        'comment' => $comm->comment,
                        'date_comm' => $comm->date,
                    ),

                );
            }
        }
        echo "</div > ";
    }
    return $values;
}

function printFormComment($post_id)
{
    echo "<!-- Button trigger modal -->
            <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#commentModal" . $post_id . "'>
                Add Comment
            </button>

            <!-- Modal -->
            <div class='modal' id='commentModal" . $post_id . "' tabindex='-1' aria-labelledby='commentModal" . $post_id . "Label'
                 aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='commentModal" . $post_id . "Label'>Comment</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <form class='commentForm'>
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
                                <button type='submit' class='btnCommSave btn btn-primary' name='submit'>Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>";
}





