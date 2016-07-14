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


        <form action="/comments/add_comment" method="post" class="form-group">
            <textarea name="comment_body" class="form-control"></textarea>
            <input type="hidden" name="parent_id">

            <button type="submit" class="btn btn-primary">Send Comment</button>
        </form>


            <?php

            function  build_tree($commentsTree,$parent_id){
                if(is_array($commentsTree) && isset($commentsTree[$parent_id])){
                    $tree = '<ul>';
                    foreach($commentsTree[$parent_id] as $comment){
                        $tree .= '<li>
                                    <img src="'.$comment['picture'].'">
                                    <p class="comment-body-'.$comment['id'].'">'.$comment['body'] . '</p>
                                    <p><a href="javascript:void(0)" class="showModal" data-comment-id="'.$comment['id'].'">Comment</a></p>
                                    ';

                        $tree .=  build_tree($commentsTree,$comment['id']);
                        $tree .= '</li>';
                    }
                    $tree .= '</ul>';
                }
                else return null;
                return $tree;
            }

            echo build_tree($commentsTree,0);
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
                <input type="hidden" class="comment-id" name="parent_id" value="">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send Comment</button>
            </div>
        </div>
    </div>
    </form>
</div>

<script>
    $('a.showModal').click(function(){
        var commentId = $(this).data('comment-id');
        var init_comment = $('.comment-body-'+commentId).text();
        $('.comment-for').text(init_comment)
        $('input.comment-id').val(commentId);
        $('#myModal').modal('show');
    })
</script>