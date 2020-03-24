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
            <div class="form-group">
                <textarea class="new-post-textarea form-control" name="newPostContent" placeholder="Type a new post here..." rows="4"></textarea>
            </div>
            <div class="form-group new-post-select-and-button">
                <select class="form-control new-post-permissions-select col-3" name="newPostPermissions">
                    <option value="view only">View Only</option>
                    <option value="view and comment">View and Comment</option>
                    <option value="view and edit">View and Edit</option>
                    <option value="link to other contents">Link to Other Contents</option>
                </select>
                <button type="submit" class="btn btn-primary new-post-button form-control col-1">Post</button>
            </div>

        </form>
    </div>
</div>