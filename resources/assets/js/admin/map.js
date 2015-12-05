ymaps.ready(function() {
    function prepareMapElement($mapElement) {
        var mapElementId = $mapElement.attr('id'),
            $latInput = $('#' + mapElementId + '_lat'),
            $longInput = $('#' + mapElementId + '_long'),
            $form = $mapElement.closest('form'),
            map = new ymaps.Map(mapElementId, {
                center: [55.751574, 37.573856],
                zoom: 10
            }),
            latLong = [$latInput.val(), $longInput.val()],
            currentPoint = null;

        if (latLong[0] && latLong[1]) {
            currentPoint = makePlacemark(latLong);
            map.geoObjects.add(currentPoint);
            map.setCenter(latLong);
        }

        map.events.add('click', function (e) {
            map.geoObjects.removeAll();
            currentPoint = makePlacemark(e.get('coords'));
            map.geoObjects.add(currentPoint);
        });

        $form.on('submit', function() {
            var coords = currentPoint.geometry.getCoordinates();

            $latInput.val(coords[0]);
            $longInput.val(coords[1]);
        });
    }

    function makePlacemark(coords) {
        return new ymaps.Placemark(coords, null, {
            draggable: true,
            preset: 'islands#dotIcon'
        });
    }

    $('.js-map-input').each(function() {
        prepareMapElement($(this));
    });
});