<div class="new-post-container card">
    <div class="card-body">
        <h4>New post</h4>
        <form method='POST' action=''>
            <?if(isset($groupID)){
                ?><input hidden name="groupID" value="<?=$groupID?>"><?
            }
            else{
                ?><input hidden name="eventID" value="<?=$eventID?>"><?
            }?>
            <textarea class="new-post-textarea" name="newPostContent" placeholder="Type a new post here..."></textarea>
            <br />
            <button type="submit" class="btn btn-primary new-post-button">Post</button>
        </form>
    </div>
</div>