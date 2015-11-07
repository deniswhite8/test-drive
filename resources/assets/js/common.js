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

$(function() {
    $('select.js-combobox')
        .combobox()
        .on('refresh', function() {
            $(this).combobox('refresh');
        })
    ;
});