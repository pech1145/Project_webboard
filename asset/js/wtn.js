//    CKEDITOR.replace('details');

$(document).ready(function () {
    var id = getUrlParameter('id');
    var details_post = $('#details');

    // กำหนดเพื่อให้กดแก้ไขได้แค่ครั้งเดียว
    var edit_comment = true;
    var edit_reply = true;

    /*------------------ comment --------------------*/
    // reset post
    $('#comment_reset').click(function () {
        console.log('reset');
        details_post.val('');
        details_post.focus();
    });

    // submit post
    $('#comment_submit').click(function () {
        // console.log('submit');
        if(details_post.val() != ''){
            $.ajax({
                type: 'POST', // method
                url: 'common/add_comment.php', // ไปยัง ไฟล์
                data: {
                    id_post: id,
                    details: details_post.val()
                }, // ส่งค่า
                success: function (data) { // callback
                    // เพิ่ม element ก่อน form post
                    $('#form_post').before(data);
                    details_post.val('');
                    location.reload(); // refresh the page // refresh the page
                },
                dataType: 'html' // type callback
            });
        } else {
            // ให้ cursor มา focus ที่ tag textarea
            details_post.focus();
        }
    });

    // edit comment
    $('.edit-comment').click(function(){

        if(edit_comment){
            edit_comment = false;
            var post_id = parseInt($(this).attr('data-post-id'));
            var comment_id = parseInt($(this).parents('.panel-heading').find('.cm-id').html());
            var selector = $(this).parents('.panel-info').find('.details');


            selector.html(
                '<textarea rows="5" class="form-control">' + selector.html().trim() + '</textarea>'
                + '<div class="text-right" style="margin-top: 5px">'
                + '<input type="submit" value="อัพเดท" class="comment_update btn btn-primary">'
                + '</div>'
            );

            // เปลี่ยนเป็น form แก้ไขข้อมูล
            $('.comment_update').click(function(){
//                console.log('comment_update');
                //
                if(selector.find('textarea').val() != ''){
                    // edit table comments
                    $.ajax({
                        type: 'POST', // method
                        url: 'common/update_comment.php', // ไปยัง ไฟล์
                        data: {
                            post_id : post_id,
                            comment_id   : comment_id,
                            details: selector.find('textarea').val().trim()
                        }, // ส่งค่า
                        success: function (data) { // callback
                            selector.html(selector.find('textarea').val().trim());
                            edit_comment = true;
                            location.reload(); // refresh the page
                        }
                    });
                } else {
                    // ให้ cursor มา focus ที่ tag textarea
                    selector.find('textarea').focus();
                }
            });
        }


    });
    /*------------------ comment --------------------*/



    /*------------------ reply --------------------*/
    // click btn-reply
    $('.btn-reply').click(function(){
        var selector = $(this).parents('.panel-info').find('.reply');
        $(selector).removeClass('display-none');
        $(this).addClass('display-none');
    });

    // reply reset
    $('.reply_reset').click(function(){
        var textarea = $(this).parents('.panel-body').find('textarea');
        textarea.val(''); // value equals ''
        textarea.focus();
//            console.log('comment reset')
    });

    // reply submit
    $('.reply_submit').click(function(){
//            console.log('comment submit');
        var cm_id = $(this).parents('.panel-info').find('.cm-id');
        var textarea = $(this).parents('.panel-body').find('textarea');
        var beforReply = $(this).parents('.panel-body').find('.reply');
        var selector = $(this).parents('.panel-info').find('.reply');
        var btnReply    = $(this).parents('.panel-info').find('.btn-reply');
        // แปลง string -> number
        cm_id = parseInt(cm_id.html());
//            console.log(typeof cm_id);

        // post reply
        // check details is empty
        if(textarea.val() != ''){
            $.ajax({
                type: 'POST', // method
                url: 'common/add_reply.php', // ไปยัง ไฟล์
                data: {
                    post_id: id,
                    comment_id: cm_id,
                    details: textarea.val()
                }, // ส่งค่า
                success: function (data) { // callback
                    // เพิ่ม element ก่อน form post
                    $(beforReply).before(data);
                    textarea.val('');

                    $(selector).addClass('display-none');
                    $(btnReply).removeClass('display-none');

                    location.reload(); // refresh the page
                },
                dataType: 'html' // type callback
            });
        } else {
            // ให้ cursor มา focus ที่ tag textarea
            textarea.focus();
        }

    });

    // edit reply
    $('.edit-reply').click(function(){

        if(edit_reply) {
            edit_reply = false;
            var comment_id = $(this).attr('data-comment-id');
            var reply_id = $(this).parents('.panel-heading').find('.reply-id');

            var details = $(this).parents('.panel-success').find('.panel-body');

            comment_id = parseInt(comment_id);
            reply_id = parseInt(reply_id.html());


            // เปลี่ยนเป็น form แก้ไขข้อมูล
            details.html('<textarea rows="3" class="form-control">' + details.html().trim() + '</textarea>'
                + '<div class="text-right" style="margin-top: 5px">'
                + '<input type="submit" value="อัพเดท" class="reply_update btn btn-primary">'
                + '</div>'
            );

            // เมื่อมีการ กด update
            $('.reply_update').click(function(){
                // console.log('update');

                //  check details is empty
                if(details.find('textarea').val() != ''){
                    edit_reply = true;
                    details.html(details.find('textarea').val());

                    // update table reply
                    $.ajax({
                        type: 'POST', // method
                        url: 'common/update_reply.php', // ไปยัง ไฟล์
                        data: {
                            comment_id : comment_id,
                            reply_id   : reply_id,
                            details: details.html()
                        }, // ส่งค่า
                        success: function (data) { // callback
                            alert(data);
                            location.reload(); // refresh the page
                        }
                    });
                } else {
                    // ให้ cursor มา focus ที่ tag textarea
                    details.find('textarea').focus();
                }

            });
        }

    });

    /*------------------ reply --------------------*/
});




// อ่านค่า get จาก url
// http://stackoverflow.com/questions/19491336/get-url-parameter-jquery-or-how-to-get-query-string-values-in-js
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};