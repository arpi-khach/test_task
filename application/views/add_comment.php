<html>
<head>
    <meta charset="utf-8">
    <title>Add new comment</title>
    <link rel="stylesheet" href="<?=base_url('public/css/bootstrap.css')?>" type="text/css"/>
    <link rel="stylesheet" href="<?=base_url('public/css/style.css')?>" type="text/css"/>
<body>
    <div class="container">
        <h1 class="welcome text-center">Comments</h1>
        <form method="post" action="<?=base_url('welcome/saveComment')?>">
            <textarea id="mytextarea" name="description"></textarea>
            <input type="submit"  name="submit" value="Add Comment" id="comment_submit" class="btn btn-lg btn-primary pull-right" >
        </form>
</div>

    <script type="text/javascript" src="<?=base_url('public/js/jquery-1.11.1.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('public/js/js.js')?>"></script>
    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
    <script>
        $(document).ready(function () {
            tinymce.init({
                selector: '#mytextarea'
            });
        });
    </script>
</body>
</html>