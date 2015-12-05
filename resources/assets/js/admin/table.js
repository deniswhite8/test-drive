jQuery(function($) {
    $('.js-input-table').on('change', '.js-table-input-group', function() {
        debugger;

        var input = $(this),
            valueInput = $('#' + input.data('valueId')),
            inputId = input.data('id');

        if (input.attr('type') == 'radio') {
            valueInput.val(inputId);
        } else {
            var values = valueInput.val().split(',').filter(function(el) {
                return el;
            });

            if (input.is(':checked')) {
                values.push(inputId);
            } else {
                values = values.filter(function(el) {
                    return el != inputId;
                });
            }

            valueInput.val(values.join(','));
        }
    });
});