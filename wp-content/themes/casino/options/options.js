jQuery(document).ready(function(jQuery) {

    /**
     *                      FIRST DIVIDER
     */
    jQuery('.divider_img_upl_1').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.divider_img_1').attr('src', attachment.url);
                jQuery('.divider_img_1_url').val(attachment.url);
            })
            .open();
});

    jQuery('.divider_ico_upl_1').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.divider_ico_1').attr('src', attachment.url);
                jQuery('.divider_ico_1_url').val(attachment.url);
            })
            .open();
    });

    /**
     *                               SECOND DIVIDER
     */
    jQuery('.divider_img_upl_2').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.divider_img_2').attr('src', attachment.url);
                jQuery('.divider_img_2_url').val(attachment.url);
            })
            .open();
    });

    jQuery('.divider_ico_upl_2').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.divider_ico_2').attr('src', attachment.url);
                jQuery('.divider_ico_2_url').val(attachment.url);
            })
            .open();
    });
    /**
     *                               THIRD DIVIDER
     */
    jQuery('.divider_img_upl_3').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.divider_img_3').attr('src', attachment.url);
                jQuery('.divider_img_3_url').val(attachment.url);
            })
            .open();
    });

    jQuery('.divider_ico_upl_3').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.divider_ico_3').attr('src', attachment.url);
                jQuery('.divider_ico_3_url').val(attachment.url);
            })
            .open();
    });

    /**
     *                               FOURTH DIVIDER
     */
    jQuery('.divider_img_upl_4').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.divider_img_4').attr('src', attachment.url);
                jQuery('.divider_img_4_url').val(attachment.url);
            })
            .open();
    });

    jQuery('.divider_ico_upl_4').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.divider_ico_4').attr('src', attachment.url);
                jQuery('.divider_ico_4_url').val(attachment.url);
            })
            .open();
    });

    /**
     *                               FIFTH DIVIDER
     */
    jQuery('.divider_img_upl_5').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.divider_img_5').attr('src', attachment.url);
                jQuery('.divider_img_5_url').val(attachment.url);
            })
            .open();
    });

    jQuery('.divider_ico_upl_5').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.divider_ico_5').attr('src', attachment.url);
                jQuery('.divider_ico_5_url').val(attachment.url);
            })
            .open();
    });

    /**
     *                               SIXTH DIVIDER
     */
    jQuery('.divider_img_upl_6').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.divider_img_6').attr('src', attachment.url);
                jQuery('.divider_img_6_url').val(attachment.url);
            })
            .open();
    });

    jQuery('.divider_ico_upl_6').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.divider_ico_6').attr('src', attachment.url);
                jQuery('.divider_ico_6_url').val(attachment.url);
            })
            .open();
    });

    /**
     * Top images
     */
    jQuery('.bitcoinnetw_img_upl').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.bitcoinnetw_img').attr('src', attachment.url);
                jQuery('.bitcoinnetw_img_url').val(attachment.url);
            })
            .open();
    });

    jQuery('.top_cas_img_upl').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.top_cas_img').attr('src', attachment.url);
                jQuery('.top_cas_img_url').val(attachment.url);
            })
            .open();
    });

    jQuery('.top_bitexch_img_upl').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.top_bitexch_img').attr('src', attachment.url);
                jQuery('.top_bitexch_img_url').val(attachment.url);
            })
            .open();
    });

    jQuery('.top_bitgambl_img_upl').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.top_bitgambl_img').attr('src', attachment.url);
                jQuery('.top_bitgambl_img_url').val(attachment.url);
            })
            .open();
    });

    jQuery('.adv1_img_upl').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.adv1_img').attr('src', attachment.url);
                jQuery('.adv1_img_url').val(attachment.url);
            })
            .open();
    });

    jQuery('.adv2_img_upl').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.adv2_img').attr('src', attachment.url);
                jQuery('.adv2_img_url').val(attachment.url);
            })
            .open();
    });

    jQuery('.adv3_img_upl').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery('.adv3_img').attr('src', attachment.url);
                jQuery('.adv3_img_url').val(attachment.url);
            })
            .open();
    });

});
