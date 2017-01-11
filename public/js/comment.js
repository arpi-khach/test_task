$(document).ready(function () {
    tinymce.init({
        selector: '#mytextarea',
        setup: function(editor) {
            editor.on('focus', function(e) {
                editorOnFocus(e);
            });

            editor.on('blur', function(e) {
                editorOnBlur(e);
            });
        }
    });

    setInterval(function () {
        listenUserActivities();
        checkNewComments();
    }, 2000);

    $('#show-new-comments').on('click', function () {
        showNewComments();
    });
});

function editorOnFocus(e) {
    var userId   = $('#mytextarea').data('user-id');
    var username = 'User_' + userId;
    var itemId   = $('input[name="item-id"]').val();

    $.ajax({
        type: "POST",
        url: '/log-comment-activity',
        data: {itemId: itemId, userId: userId, username: username},
        dataType: 'json'
    });
}

function editorOnBlur(e) {
    var userId   = $('#mytextarea').data('user-id');
    var itemId   = $('input[name="item-id"]').val();

    $.ajax({
        type: "POST",
        url: '/update-comment-activity-status',
        data: {itemId: itemId, userId: userId, status: 0},
        dataType: 'json'
    });
}

function listenUserActivities() {
    var itemId   = $('input[name="item-id"]').val();

    $.ajax({
        type: "POST",
        url: '/get-comment-activities',
        data: {itemId: itemId},
        success: function (result) {
            var response = $.parseJSON(result);
            var appendHtml = "";
            var typingContainer = $('#typing');

            $.each(response, function(i, user) {
                console.log(user.user_name);
                appendHtml += "<span>" + user.user_name + " is typing a response...</span><br>";
            });

            if(appendHtml.length > 0){
                typingContainer.html(appendHtml).show();
            }else{
                typingContainer.html('').hide();
            }
        },
        dataType: 'json'
    });
}

function checkNewComments() {
    var oldCommentsCount = $('#comments-container').data('comments-count');
    var itemId         = $('input[name="item-id"]').val();
    var unreadCount    = $('#unread-count');
    var unreadComments = $('#unread-comments');
    var isOrAre = 'are';
    var comment_s = 'comments';

    $.ajax({
        type: "POST",
        url: '/check-for-new-comments',
        data: {itemId: itemId, oldCommentsCount: oldCommentsCount},
        success: function (result) {
            var response = $.parseJSON(result);
            var appendHtml = "";

            if(response.length > 0){
                if (response.length == 1){
                    isOrAre   = 'is';
                    comment_s = 'comment';
                }

                var text = isOrAre + ' ' + response.length + ' new ' + comment_s;
                unreadCount.html(text);
                unreadComments.show();

                newComments = response;
            }
        },
        dataType: 'json'
    });
}

function showNewComments() {
    var oldCommentsCount = $('#comments-container').data('comments-count');
    var unreadComments    = $('#unread-comments');
    var commentsContainer = $('#comments-container');
    var appendHtml        = '';

    $.each(newComments, function(i, comment) {
        appendHtml += '<div class="span8" id="comment-' + comment.commentid +'">' +
        '<h1>User_' + comment.userid + '</h1>' +
        '<div><p>' + comment.description + '</p>' +
        '</div><div class="clear"></div><hr></div>';
    });

    commentsContainer.append(appendHtml);
    commentsContainer.data('comments-count', oldCommentsCount + newComments.length);
    unreadComments.hide();

    $('html, body').animate({
        scrollTop: $("#comment-" + newComments[0].commentid ).offset().top
    }, 2000);
}