jQuery(function($) {
    $('.js-input-table').on('change', 'input.js-table-input-group', function() {
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
    }).each(function() { // copy-paste from sleeping-owl,
                         // change disabled column from last to first,
                         // and prepare first column before load
        var container = $(this),
            order = [],
            columns = [];

        container.find('th').each(function (i) {
            var column = {};
            column.orderable = $(this).data('sortable');
            if (column.orderable == undefined) {
                column.orderable = true;
            }
            // disable search in first column
            var searchable = $(this).data('searchable');
            if (searchable === undefined) {
                searchable = true;
            }
            if (searchable === false) {
                searchable = false;
            }
            column.orderable = column.orderable && !$(this).is(':first-child');
            column.searchable = searchable && !$(this).is(':first-child');

            if ($(this).data('sortable-default')) {
                order.push([i, $(this).data('sortable-default')]);
            }
            columns.push(column);
        });

        var params = {
            language: window.admin.lang.table,
            stateSave: container.data('statesave'),
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, window.admin.lang.table.all]
            ],
            ordering: container.data('ordering'),
            columns: columns
        };

        if (order.length > 0) {
            params.order = order;
        }

        var ajax;
        if (ajax = container.data('ajax')) {
            params.serverSide = true;
            params.processing = true;
            params.ajax = {
                "url": ajax,
                "data": function (d) {
                    d.datatable_request = 'true';
                }
            };
        }

        container.on('xhr.dt', function (event, settings, json, xhr) {
            var dataInput = container.find('.js-table-input-value'),
                selected = dataInput.val().split(','),
                isMultiselect = dataInput.data('multiselect'),
                name = dataInput.attr('name');

            $.each(json.data, function(i, row) {
                row.pop();
                var id = row[0].match(/\d+/)[0];
                row.unshift('<input class="js-table-input-group"' +
                        ' data-id="' + id + '"' +
                        ' name="' + name + '_tableGroup"' +
                        ' data-value-id="' + name + '_tableValue"' +
                        ' type="' + (isMultiselect ? 'checkbox' : 'radio') + '"' +
                        (selected.indexOf(id) != -1 ? ' checked' : '') + '/>');
            });
        }).on('init.dt', function () {
            container.find('input.js-table-input-group[checked]').prop('checked', true);
        });

        container.dataTable(params);
    });
});