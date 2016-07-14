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

        <form action="/comments/add_comment" method="post" class="form-group">
            <textarea name="comment_body" class="form-control"></textarea>
            <input type="hidden" name="parent_id">

            <button type="submit" class="btn btn-primary">Send Comment</button>
        </form>

        <?php } else { ?>
            <h3>Only authorized user can add comments.<br /> To login, please follow the <a href="/">link</a></h3>
        <?php }  ?>

            <?php

            function  build_tree($commentsTree,$parent_id, $userId){

                if(is_array($commentsTree) && isset($commentsTree[$parent_id])){
                    $tree = '<ul>';
                    foreach($commentsTree[$parent_id] as $comment){

                        $commentBtn = $userId > 0 ? '<p><a href="javascript:void(0)" class="showModal" data-comment-id="'.$comment['id'].'">Comment</a></p>' : '';
                        $editBtn = ($userId == $comment['fb_id'])? '<p><a href="javascript:void(0)" class="showEditModal" data-comment-id="'.$comment['id'].'">Edit</a></p>' : '';

                        $tree .= '<li>
                                    <img src="'.$comment['picture'].'">
                                    <p class="comment-body-'.$comment['id'].'">'.$comment['body'] . '</p>

                                    '.$commentBtn
                                    .$editBtn;

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