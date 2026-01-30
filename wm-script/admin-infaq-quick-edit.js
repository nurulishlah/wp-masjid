jQuery(document).ready(function ($) {
    var _edit = inlineEditPost.edit;
    inlineEditPost.edit = function (id) {
        _edit.apply(this, arguments);
        var postId = 0;
        if (typeof (id) == 'object') {
            postId = parseInt(this.getId(id));
        }
        if (postId > 0) {
            var postRow = $('#post-' + postId);
            var editRow = $('#edit-' + postId);

            var status = $('.infaq_status_value', postRow).text();
            var date = $('.infaq_date_value', postRow).text();
            var amount = $('.infaq_amount_value', postRow).text();
            var from = $('.infaq_from_value', postRow).text();
            var desc = $('.infaq_desc_value', postRow).text();

            $('select[name="_status"]', editRow).val(status);
            $('input[name="_tanginfaq"]', editRow).val(date);
            $('input[name="_juminfaq"]', editRow).val(amount);
            $('input[name="_asalinfaq"]', editRow).val(from);
            $('input[name="_ketinfaq"]', editRow).val(desc);
        }
    };
});
