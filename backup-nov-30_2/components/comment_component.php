<?php
    //this component is the VIEW for the comment component

    //INPUT: $users
    //INPUT: $comment
    
    $commentContent = $comment['cContent'];

    //GET COMMENT AUTHOR
    $commentAuthor = array_filter($users, function($element) use($comment){
        return $element['UserID']==$comment["cAuthor"];
    });
    $commentAuthor = array_values($commentAuthor)[0];

    $commentAuthorName = $commentAuthor["FName"]." ".$commentAuthor["LName"];
    $postComponent.="
        <div class='card-body'>
            <h5 class='card-title'>{$commentAuthorName}</h5>
            <p class='card-text'>{$commentContent}</p>
        </div>";
?>