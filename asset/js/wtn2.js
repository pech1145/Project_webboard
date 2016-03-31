
// delete post
$('.btnConfirmPosts').click(function(e) {
    e.preventDefault();
    var id = $(this).attr('href');
    var form = $(this).parents('.box');

    $.smkConfirm({
        text:'คุณต้องการลบข้อมูลนี้หรือไม่ ?',
        accept:'ตกลง',
        cancel:'ยกเลิก'
    },function(res){
        // Code here
        if (res) {
            $.ajax({
                type: 'POST',
                url : 'common/delete_posts.php',
                data : {id: id},
                success : function(response){
                    if(response) {
                        // fade out
                        form.fadeOut(2000);
                        setTimeout(function(){
                            // remove elements
                            form.remove();
                        }, 2000);
                        $.smkAlert({text: 'ลบข้อมูล<strong>สำเร็จ</strong>', type:'success'});
                        setTimeout(function(){
                            window.location.href = 'index.php';
                        }, 2000);
                    } else {
                        $.smkAlert({text: 'ลบข้อมูล<strong>ไม่สำเร็จ</strong>', type:'danger'});
                    }
                }
            });

        }
    });
}); // end delete post

// add comments
$('#form_post input[type=submit]').click(function (e) {
    e.preventDefault();

    var editor = CKEDITOR.instances.comments; // get value from the CKEditor
    var datastring = $('#form_post').serializeArray();  // get value from tag form

    // ใส่ค่า editor ใน textarea
    datastring[1]['value'] = editor.getData();

    // send ajax
    $.ajax({
        type: "POST",
        url: "common/add_comment.php",
        data: datastring,
        success: function(data) {
            // console.log(data);
            // เพิ่ม element ก่อน form post
            $('#box_add_post').before(data);
            editor.setData('');

            // location.reload();
            window.location.reload(true);
            $.smkAlert({text: 'เพิ่มข้อมูล<strong>สำเร็จ</strong>', type:'success'});
        }
    });
});

// delete comments
$('.btnConfirmComments').click(function(e) {
    e.preventDefault();
    var comment_id = $(this).attr('data-comment-id');
    var post_id = $(this).attr('data-post-id');
    var form = $(this).parents('.node-comments');

    $.smkConfirm({
        text:'คุณต้องการลบข้อมูลนี้หรือไม่ ?',
        accept:'ตกลง',
        cancel:'ยกเลิก'
    },function(res){
        // Code here
        if (res) {
            $.ajax({
                type: 'POST',
                url : 'common/delete_comment.php',
                data : {comment_id: comment_id, post_id: post_id},
                success : function(response){
                    // console.log(response);
                    if(response) {
                        // fade out
                        form.fadeOut(2000);
                        setTimeout(function(){
                            // remove elements
                            form.remove();
                        }, 2000);
                        $.smkAlert({text: 'ลบข้อมูล<strong>สำเร็จ</strong>', type:'success'});
                    } else {
                        $.smkAlert({text: 'ลบข้อมูล<strong>ไม่สำเร็จ</strong>', type:'danger'});
                    }
                }
            });

        }
    });
}); // end delete comments


// click btn-reply
var post_id = $('#post_id').val();
var btn_reply = false;
var index_nodeComments = 0;
$('.btn-reply').click(function(){
    // console.log('click reply');
    var comment_id = $(this).parents('.node-comments').find('.cm-id').html();
    var form_reply = $(this).parents('.node-comments').find('.form-reply');
    var index = $(this).parents('.node-comments').index();
    var elm  = '<form method="post" id="form_reply">'
        + '<div class="form-group text-center col-md-10 col-md-offset-1">'
        + '<input type="hidden" value="'+post_id+'" name="post_id"/>'
        + '<input type="hidden" value="'+comment_id+'" name="comment_id"/>'
        + '<label for="reply">ตอบกลับ</label>'
        + '<textarea name="reply" id="reply" rows="3" class="form-control"></textarea>'
        + '<div class="text-right" style="margin-top: 5px">'
        + '<input type="submit" value="ตอบกลับ" class="btn btn-primary">'
        + '</div>'
        + '</div>'
        + '</form>';

    // check btn
    if(!btn_reply){
        // set value index
        index_nodeComments = index;

        // add elements script
        form_reply.append(elm);
        CKEDITOR.replace('reply');

        $(this).html('ยกเลิก');
        btn_reply = true;
    } else {
        // remove elements this
        if(index_nodeComments == index) {
            form_reply.find('div.form-group').remove();
            $(this).html('ตอบกลับ');
            btn_reply = false;
        } else {
            // remove elements form
            var form_open = $('.node-comments').eq(index_nodeComments - 1);
            form_open.find('form').remove();
            form_open.find('a.btn-reply').html('ตอบกลับ');

            // add elements form
            // set value index
            index_nodeComments = index;

            // add elements script
            form_reply.append(elm);
            CKEDITOR.replace('reply');

            $(this).html('ยกเลิก');
        }
    } // else btn check

    // call function
    formAddReply(this);
});

// add reply
function formAddReply(thisi) {
    $('#form_reply input[type=submit]').click(function (e) {
        e.preventDefault();

        var editor = CKEDITOR.instances.reply; // get value from the CKEditor
        var datastring = $('#form_reply').serializeArray();  // get value from tag form

        // ใส่ค่า editor ใน textarea
        datastring[2]['value'] = editor.getData();

        // send ajax
        $.ajax({
            type: "POST",
            url: "common/add_reply.php",
            data: datastring,
            success: function(data) {
                // console.log(data);
                // เพิ่ม element ก่อน form post
                $(thisi).parents('.node-comments').find('.form-reply').before(data);
                $.smkAlert({text: 'เพิ่มข้อมูล<strong>สำเร็จ</strong>', type:'success'});
                // location.reload();
                editor.setData('');
            }
        });
    });
}

// delete reply
$('.btnConfirmReply').click(function(e) {
    e.preventDefault();
    var post_id = $(this).attr('data-post-id');
    var comment_id = $(this).attr('data-comment-id');
    var reply_id = $(this).attr('data-reply-id');
    var form = $(this).parents('.node-reply');

    $.smkConfirm({
        text:'คุณต้องการลบข้อมูลนี้หรือไม่ ?',
        accept:'ตกลง',
        cancel:'ยกเลิก'
    },function(res){
        // Code here
        if (res) {
            $.ajax({
                type: 'POST',
                url : 'common/delete_reply.php',
                data : {
                    comment_id: comment_id,
                    post_id: post_id,
                    reply_id: reply_id
                },
                success : function(response){
                    // console.log(response);
                    if(response) {
                        // fade out
                        form.fadeOut(2000);
                        setTimeout(function(){
                            // remove elements
                            form.remove();
                        }, 2000);
                        $.smkAlert({text: 'ลบข้อมูล<strong>สำเร็จ</strong>', type:'success'});
                    } else {
                        $.smkAlert({text: 'ลบข้อมูล<strong>ไม่สำเร็จ</strong>', type:'danger'});
                    }
                }
            });

        }
    });
}); // end delete reply


// update comment
$('.editComment').click(function(e) {
    e.preventDefault();
    var comment_id = $(this).attr('data-comment-id');
    var post_id = $(this).attr('data-post-id');
    var box = $(this).parents('.node-comments').find('.details');

    box.html('<form method="post" id="formEditComment">' +
        '<input type="hidden" name="post_id" value="'+ post_id +'"/>' +
        '<input type="hidden" name="comment_id" value="'+ comment_id +'"/>' +
        '<textarea name="comment" rows="3" id="comment">' + box.html() + '</textarea>' +
        '<div class="text-right" style="margin-top: 10px">' +
        '<input type="submit" value="บันทึก" class="btn btn-primary">' +
        '</div>' +
        '</form>');
    CKEDITOR.replace('comment');

    submitUpdateComment(box);
});

// click submit update comment
function submitUpdateComment(box) {
    $('#formEditComment input[type=submit]').click(function(e){
        e.preventDefault();

        var editor = CKEDITOR.instances.comment.getData(); // get value from the CKEditor
        var datastring = $('#formEditComment').serializeArray();  // get value from tag form

        // ใส่ค่า editor ใน textarea
        datastring[2]['value'] = editor;

        // send ajax
        $.ajax({
            type: "POST",
            url: "common/update_comment.php",
            data: datastring,
            success: function(data) {
                // console.log(data);
                // เพิ่ม element ก่อน form post
                box.html(data);
                $.smkAlert({text: 'เพิ่มข้อมูล<strong>สำเร็จ</strong>', type:'success'});
            }
        });

    });
}


// update reply
$('.editReply').click(function(e) {
    e.preventDefault();
    var reply_id = $(this).attr('data-reply-id');
    var comment_id = $(this).attr('data-comment-id');
    var post_id = $(this).attr('data-post-id');
    var box = $(this).parents('.node-reply').find('.details-reply');

    box.html('<form method="post" id="formEditReply">' +
        '<input type="hidden" name="post_id" value="'+ post_id +'"/>' +
        '<input type="hidden" name="comment_id" value="'+ comment_id +'"/>' +
        '<input type="hidden" name="reply_id" value="'+ reply_id +'"/>' +
        '<textarea name="details" rows="3" id="details">' + box.html() + '</textarea>' +
        '<div class="text-right" style="margin-top: 10px">' +
        '<input type="submit" value="บันทึก" class="btn btn-primary">' +
        '</div>' +
        '</form>');
    CKEDITOR.replace('details');

    submitUpdateReply(box);
});

// click submit update reply
function submitUpdateReply(box){
    $('#formEditReply input[type=submit]').click(function(e){
        e.preventDefault();

        var editor = CKEDITOR.instances.details.getData(); // get value from the CKEditor
        var datastring = $('#formEditReply').serializeArray();  // get value from tag form

        // ใส่ค่า editor ใน textarea
        datastring[3]['value'] = editor;

        // send ajax
        $.ajax({
            type: "POST",
            url: "common/update_reply.php",
            data: datastring,
            success: function(data) {
                // console.log(data);
                // เพิ่ม element ก่อน form post
                box.html(data);
                $.smkAlert({text: 'เพิ่มข้อมูล<strong>สำเร็จ</strong>', type:'success'});
            }
        });

    });
}