<?php
    //INPUT: $post
    //INPUT: $users
    //INPUT: $comments
    //OUTPUT: $postComponent type = html <--each post html is in a new array index

    //this file contains the VIEW for the post component
    $postContent = $post["Content"];
    $postID = $post['PostID'];

    //GET POST AUTHOR
    $postAuthor = array_filter($users, function($element) use($post){
        return $element['UserID']==$post["Author"];
    });
    $postAuthor = array_values($postAuthor)[0];

    $postAuthorName = $postAuthor["FName"]." ".$postAuthor["LName"];

    //get comments for the specific post

    $postComments = array_filter($comments, function($element) use($postID){
        return $element['postID']==$postID;
    });

    $postComments = array_values($postComments);

    $postComponent = "
    <div class='post-container'>
        <div class='card' style='width: 100%;'>
            <div class='card-body'>
                <h5 class='card-title'>{$postAuthorName}</h5>
                <p class='card-text'>{$postContent}</p>
            </div>
            <div class='comments'>";

    for($y = 0; $y < count($postComments); $y++){
        $comment = $postComments[$y];

        require('./components/comment_component.php');
    }

    $postComponent.="
        <div class='card-body'>
            <form method='POST' action=''>
                <div class='add-comment'>
                    <input type='hidden' name='postID' value='{$postID}'>
                    <div class='comment-input'>
                        <input type='text' name='newComment' class='form-control' placeholder='Enter your comment here...'></input>
                    </div>
                    <div class='add-comment-button'>
                        <button type='submit' class='btn btn-primary'>Add comment</button>
                    </div>
                </div>
            </form>
        </div>";

    $postComponent.="</div></div></div>";
?>
