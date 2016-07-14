<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Comments <small>Take part in the discussion</small>
        </h1>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-md-12">


        <?php if($userId){ ?>

        <h4>Type a new comment. Have fun!</h4>
        <form action="/comments/add_comment" method="post" class="form-group">
            <textarea name="comment_body" class="form-control comment-textarea"></textarea>
            <input type="hidden" name="parent_id">

            <button type="submit" class="btn btn-primary send-comment-btn">Send Comment</button>
        </form>

        <?php } else { ?>
            <h3 class="unauth-warn">Only authorized user can add comments. To sign in, please follow the <a href="/">link</a></h3>
        <?php }  ?>

            <?php

            function  build_tree($commentsTree,$parent_id, $userId){

                if(is_array($commentsTree) && isset($commentsTree[$parent_id])){
                    $tree = '<ul class="comment-list">';
                    foreach($commentsTree[$parent_id] as $comment){


                        $editedDate = $comment['date_created'] == $comment['date_updated'] ? 'edited: <span>'.date("F j, Y, g:i a", strtotime($comment['date_updated'])) . '</span>' : '';
                        $commentBtn = $userId > 0 ? '<a href="javascript:void(0)" class="showModal" data-comment-id="'.$comment['id'].'">Comment</a>' : '';
                        $editBtn = ($userId == $comment['fb_id'])? '<a href="javascript:void(0)" class="showEditModal" data-comment-id="'.$comment['id'].'">Edit</a>' : '';


                        $tree .= '<li>
                                    <img src="'.$comment['picture'].'">
                                    <p class="user-name">'.$comment['username'] . '</p>
                                    <p class="comment-body comment-body-'.$comment['id'].'">'.$comment['body'] . '</p>
                                    <p class="comment-dates">
                                        posted: <span>'.date("F j, Y, g:i a", strtotime($comment['date_created'])) . '</span>.
                                        '.$editedDate.'
                                    </p>

                                    <div class="comment-btns">'.$commentBtn . $editBtn . '</div>';

                        $tree .=  build_tree($commentsTree,$comment['id'], $userId);
                        $tree .= '</li>';
                    }
                    $tree .= '</ul>';
                }
                else return null;
                return $tree;
            }

            echo build_tree($commentsTree,0, $userId);
            ?>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form action="/comments/add_comment" method="post" class="form-group">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>Please type your comment for:</p>
                <div class="well well-sm comment-for"></div>

                <textarea name="comment_body" class="form-control"></textarea>
                <input type="hidden" class="parent-comment-id" name="parent_id" value="">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send Comment</button>
            </div>
        </div>
    </div>
    </form>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form action="/comments/edit_comment" method="post" class="form-group">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <p>Edit your comment</p>

                    <textarea name="comment_body" class="form-control edited-txt"></textarea>
                    <input type="hidden" class="comment-id" name="comment_id" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit Comment</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $('a.showModal').click(function(){
        var commentId = $(this).data('comment-id');
        var init_comment = $('.comment-body-'+commentId).text();
        $('#myModal .comment-for').text(init_comment)
        $('#myModal input.parent-comment-id').val(commentId);
        $('#myModal').modal('show');
    })

    $('a.showEditModal').click(function(){
        var commentId = $(this).data('comment-id');
        var init_comment = $('.comment-body-'+commentId).text();
        $('#editModal .edited-txt').text(init_comment)
        $('#editModal input.comment-id').val(commentId);
        $('#editModal').modal('show');
    })
</script>