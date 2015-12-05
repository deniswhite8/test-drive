"use strict";

ymaps.ready(function() {
    function prepareMapElement($mapElement) {
        var mapElementId = $mapElement.attr('id'),
            $latInput = $(mapElementId + '_lat'),
            $longInput = $(mapElementId + '_long'),
            map = new ymaps.Map(mapElementId, {
                center: [55.751574, 37.573856],
                zoom: 10
            });

        map.geoObjects.add(new ymaps.Placemark([$latInput.val(), $longInput.val()]));
    }

    $('.js-map-input').each(function() {
        prepareMapElement($(this));
    });
});