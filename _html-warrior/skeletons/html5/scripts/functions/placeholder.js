// Hide input text on click
$.fn.placeholder = function() {
    return $(this).each(function(){
        var value = $(this).val();
        var input = $(this).prev();
        input
        .focus(function() {
            if ($(this).val() == value) {
                $(this).val('');
            }
        })
        .blur(function() {
            if($(this).val() == '') {
                $(this).val(value);
            }
        })
        .closest('form').submit(function() {
            if (input.val() == value) {
                input.val('');
            }
        });
        if(input.val() == '') {
            input.val(value);
        }
    })
}