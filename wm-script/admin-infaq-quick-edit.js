jQuery(document).ready(function ($) {

    // Function to handle cell changes
    $('.infaq-cell-input').on('change', function () {
        var $input = $(this);
        var $row = $input.closest('tr');
        var post_id = $row.attr('id').replace('post-', '');
        var field = $input.data('field');
        var value = $input.val();

        // Visual feedback: Saving...
        $input.css('border-color', '#0073aa');
        $input.prop('disabled', true);

        $.ajax({
            url: wm_infaq_vars.ajax_url,
            type: 'POST',
            data: {
                action: 'wm_save_infaq_cell',
                nonce: wm_infaq_vars.nonce,
                post_id: post_id,
                field: field,
                value: value
            },
            success: function (response) {
                if (response.success) {
                    // Success feedback
                    $input.css('border-color', '#46b450');
                    setTimeout(function () {
                        //$input.css('border-color', ''); // Reset after delay? Or keep green?
                        $input.css('border-color', '#ccc'); // Reset to default
                    }, 1000);
                } else {
                    // Error feedback
                    $input.css('border-color', '#dc3232');
                    alert('Error saving: ' + (response.data || 'Unknown error'));
                }
            },
            error: function () {
                // Network error feedback
                $input.css('border-color', '#dc3232');
                alert('Network error occurred.');
            },
            complete: function () {
                $input.prop('disabled', false);
                // Keep focus if needed? (User might have tabbed away)
            }
        });
    });

});
