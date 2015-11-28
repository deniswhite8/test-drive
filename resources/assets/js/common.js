"use strict";

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': window.CSRF_TOKEN
    }
});

$.fn.serializeObject = function() {
    var data = {};
    _.each(this.serializeArray(), function(item) {
        data[item.name] = item.value;
    });

    return data;
};

$.fn.clear = function () {
    return $(this).val(null).trigger('clear').trigger('change');
};

$(function() {
    $('select.js-combobox')
        .combobox()
        .on('refresh', function() {
            $(this).combobox('refresh');
        })
        .on('clear', function() {
            var combobox = $(this).data('combobox');
            combobox.clearTarget();
            combobox.$element.val('');
        })
    ;
});