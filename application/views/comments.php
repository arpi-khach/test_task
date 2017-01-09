<html>
<head>
    <meta charset="utf-8">
    <title>view comments</title>
    <link rel="stylesheet" href="<?=base_url('public/css/style.css')?>" type="text/css"/>
    <link rel="stylesheet" href="<?=base_url('public/css/bootstrap.css')?>" type="text/css"/>
    <script type="text/javascript" src="<?=base_url('public/js/jquery-1.11.1.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('public/js/js.js')?>"></script>
</head>

<body>
<div class="container">
    <div class="alert alert-success text-center">There is/are N new comment(s). Click <a href="#">here</a> to view</div>
    <h1 class="welcome text-center">Comments</h1>
    <?php foreach ($comments as $comment){?>
        <div class="span8">
            <h1>User_<?=$comment['userid']?></h1>
            <div>
                <p><?=$comment['description']?></p>
            </div>
            <div class="clear"></div>
            <hr>
        </div>
    <?php }?>

</div>
</body>
</html>