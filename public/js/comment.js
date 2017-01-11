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

    setInterval(listenUserActivities, 2000);
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