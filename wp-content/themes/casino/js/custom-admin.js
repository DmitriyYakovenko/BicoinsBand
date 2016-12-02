
jQuery(document).ready( function( $ ) {
    var check_1 = 0;
    var check_2 = 0;
    var check_3 = 0;

    $('#upload_image_button').click(function() {
        formfield = $('#upload_image').attr('name');
        tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
        //check_1 += 1;

        window.send_to_editor = function(html) {
            imgurl = $('img',html).attr('src');
            $('#upload_image').val(imgurl);
            tb_remove();
        };

        return false;
    });

    $('#upload_logo_button').click(function(){
        formfield = $('#upload_casino_logo').attr('name');
        tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
        //check_2 += 1;

        window.send_to_editor = function(html) {
            imgurl = $('img',html).attr('src');
            $('#upload_casino_logo').val(imgurl);
            tb_remove();
        };

        return false;
    });

    $('#upload_divider_img').click(function(){
        formfield = $('#table_divider_img').attr('name');
        tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
        //check_3 += 1;

        window.send_to_editor = function(html) {
            imgurl = $('img',html).attr('src');
            $('#table_divider_img').val(imgurl);
            tb_remove();
        };

        return false;
    });

    $('#upload_top_img').click(function(){
        formfield = $('#top_img').attr('name');
        tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
        //check_3 += 1;

        window.send_to_editor = function(html) {
            imgurl = $('img',html).attr('src');
            $('#top_img').val(imgurl);
            tb_remove();
        };

        return false;
    });


        //window.send_to_editor = function(html) {
        //
        //    if( check_1 == 1 ) {
        //        check_1 -= 1;
        //        imgurl = $('img',html).attr('src');
        //        $('#upload_image').val(imgurl);
        //        tb_remove();
        //    }
        //    if( check_2 == 1 ) {
        //        check_2 -= 1;
        //        imgurl = $('img',html).attr('src');
        //        $('#upload_casino_logo').val(imgurl);
        //        tb_remove();
        //    }
        //    if( check_3 == 1 ) {
        //        check_3 -= 1;
        //        imgurl = $('img',html).attr('src');
        //        $('#table_divider_img').val(imgurl);
        //        tb_remove();
        //    }
        //
        //
        //};


});