<html>
<head>
    <meta charset="utf-8">
    <title>view comments</title>
    <link rel="stylesheet" href="<?=base_url('public/css/style.css')?>" type="text/css"/>
    <link rel="stylesheet" href="<?=base_url('public/css/bootstrap.css')?>" type="text/css"/>
</head>

<body>
<div class="container">
    <h1 class="welcome text-center">Comments</h1>
    <div class="alert alert-success text-center" id="unread-count">There is/are <span>N</span> new comment(s). Click <a href="#">here</a> to view</div>
    <?php foreach ($comments as $comment){?>
        <div class="span8">
            <h1>User_<?=$comment['userid']?></h1>
            <div>
                <p><?=$comment['description']?></p>
            </div>
            <div class="clear"></div>
            <hr>
        </div>
    <?php } ?>

    <div class="container">
        <h1 class="welcome text-center">Add new comment</h1>
        <form method="post" action="<?=base_url('comment/saveComment')?>">
            <div class="" id="typing"></div>
            <textarea id="mytextarea" name="description" data-user-id="<?=$userId; ?>"></textarea>
            <input type="hidden" name="item-id" value="<?=$itemId; ?>">
            <input type="submit"  name="submit" value="Add Comment" id="comment_submit" class="btn btn-lg btn-primary pull-right" >
        </form>
    </div>

    <script type="text/javascript" src="<?=base_url('public/js/jquery-1.11.1.min.js')?>"></script>
    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
    <script src="<?=base_url('public/js/comment.js')?>"></script>
</div>
</body>
</html>