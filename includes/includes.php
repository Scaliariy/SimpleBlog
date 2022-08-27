<?php
include 'includes/db.php';
include 'Post.php';
include 'Comment.php';
include 'Grade.php';

$connection = new Database();

function printPostsAndComments($connect)
{
    foreach (Post::getBlogPosts($connect) as $key => $post) {
        echo "<div id='postDiv' class='col-12 p-3 border bg-light'>";
        echo "<p id='postNameP' >by " . $post->visitore_name . "</p>";
        echo "<p id='postPostP' >" . $post->post . "</p>";
        $grade = Grade::getRating($post->id)->grade;
        if ($grade == 0){
            $grade = "No rating";
        }
        echo "<span id='postDateSpan' >" . $post->created_at . "</span>";
        $values[$key] = array(
            'visitore_name_post' => $post->visitore_name,
            'post' => $post->post,
            'created_at_post' => $post->created_at,

        );
        echo "<br><select class='rating' name='rating'>";
        echo "<option selected value=''>Select Rating</option>";
        for ($i = 1;$i<=5;$i++){
            if (round(Grade::getRating($post->id)->grade) == $i) {
                echo "<option selected value = '" . $i . "|" . $post->id . "' > " . str_repeat("⭐", $i) . "</option >";
            } else {
                echo "<option value = '" . $i . "|" . $post->id . "' > " . str_repeat("⭐", $i) . "</option >";
            }
        }
        echo "</select>";
        echo "<span> Average rating: " . $grade . "</span>";
        echo "<div id='commDiv'>";
        printFormComment($post->id);
        echo "</div>";
        echo "<hr>";
        if (Comment::postHaveComment($connect, $post->id)) {
            foreach (Comment::getPostComment($connect, $post->id) as $comm) {
                echo "<div id='commentDiv' class='col-12 p-3 border bg-white'>";
                echo "<p id='commentNameP' >by " . $comm->visitore_name . "</p>";
                echo "<p id='commentCommP' >" . $comm->comment . "</p>";
                echo "<span id='commentDateSpan' >" . $comm->created_at . "</span>";
                echo "</div>";
                $values[$key][] = array(
                    'comments' => array(
                        'visitore_name_comm' => $comm->visitore_name,
                        'comment' => $comm->comment,
                        'created_at_comm' => $comm->created_at,
                    ),

                );
            }
        }
        echo "</div>";
    }
    return $values;
}

function printFormComment($post_id)
{
    echo "
            <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#commentModal" . $post_id . "'>
                Add Comment
            </button>

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
                                        <input class='form-control' type='text' name='visitore_name' placeholder='Your name*'/>
                                    </label>
                                        <input class='NameComm form-control' type='text' name='post_id' value='" . $post_id . "' hidden/>
                                </div>
                                <div class='mb-3 text-start'>
                                    <textarea class='TextComm form-control' name='comment' placeholder='Text*' required></textarea>
                                </div>
                            </div>
                            <div class='modal-footer'>
                                <button type='submit' class='btnCommSave btn btn-primary' name='submit' disabled>Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>";
}





