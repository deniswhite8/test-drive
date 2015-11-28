"use strict";

/**
 * Auto model collection
 */
var Models = Backbone.Collection.extend({
    url: function() {
        return 'api/auto/mark/' + this._markId + '/models'
    },

    setMarkId: function(markId) {
        this._markId = markId;
        return this;
    }
});

/**
 * Auto generation collection
 */
var Generations = Backbone.Collection.extend({
    url: function() {
        return 'api/auto/model/' + this._modelId + '/generations'
    },

    setModelId: function(modelId) {
        this._modelId = modelId;
        return this;
    }
});

var Salon = Backbone.Model.extend({
    getCoordinates: function() {
        return [this.get('latitude'), this.get('longitude')];
    }
});

/**
 * Searched salons collection
 */
var Salons = Backbone.Collection.extend({
    url: 'api/search',
    model: Salon,

    search: function(data, params) {
        this.fetch(_.extend({
            type: 'post',
            data: data
        }, params));

        return this;
    }
});

/**
 * Search form view
 */
var SearchForm = Backbone.View.extend({
    events: {
        'change #autoMark': 'doLoadModels',
        'change #autoModel': 'doLoadGenerations',
        'submit': 'doSearchSalons'
    },

    initialize: function(params) {
        this._optionTemplate = _.template('<option value="<%= value %>" ><%= label %></option>');
        this.$_marksSelect = $('#autoMark');
        this.$_modelsSelect = $('#autoModel');
        this.$_generationsSelect = $('#autoGeneration');
        this.$_formMessage = $('#searchFormMessage');
        this.$_submitBtn = $('#searchFormSubmit');
        this._map = params.map;

        this.$_formMessage.hide();
    },

    doLoadModels: function() {
        this.$_modelsSelect.clear();

        var selectedMark = this.$_marksSelect.val();
        if (!selectedMark) return;

        var models = new Models();
        models.setMarkId(selectedMark);
        this._updateOptionsList(models, this.$_modelsSelect);
    },

    doLoadGenerations: function() {
        this.$_generationsSelect.clear();

        var selectedModel = this.$_modelsSelect.val();
        if (!selectedModel) return;

        var generations = new Generations();
        generations.setModelId(selectedModel);
        this._updateOptionsList(generations, this.$_generationsSelect);
    },

    doSearchSalons: function(event) {
        event.preventDefault();
        this.$_formMessage.hide();
        this._map.clearPoints();

        if (!this.$_marksSelect.val() || !this.$_modelsSelect.val()) {
            this.$_formMessage.text(this.$_formMessage.data('refineSearch')).show();
            return;
        }

        var salons = new Salons(),
            self = this;

        salons.search(this.$el.serializeObject(), {
            beforeSend: function() {
                self.$_submitBtn.addClass('_loading');
            },

            complete: function() {
                self.$_submitBtn.removeClass('_loading');
            },

            success: function() {
                var points = [];

                salons.each(function(salon) {
                    self._map.addSalonPoint(salon);
                    points.push(salon.getCoordinates());
                });

                if (points.length) {
                    self._map.setBoundsByPoints(points);
                } else {
                    self.$_formMessage.text(self.$_formMessage.data('notFoundString')).show();
                }
            }
        });
    },

    _updateOptionsList: function(collection, $selectElement) {
        var self = this;

        collection.fetch({
            beforeSend: function() {
                $selectElement.children().not(':first').remove();
                self.$_submitBtn.addClass('_loading');
            },

            complete: function() {
                self.$_submitBtn.removeClass('_loading');
            },

            success: function() {
                collection.each(function (entity) {
                    $selectElement.append(self._optionTemplate({
                        value: entity.get('id'), label: entity.get('name')
                    }));
                });
                $selectElement.trigger('refresh');
            }
        });
    }
});

/**
 * Yandex map view
 */
var YMap = Backbone.View.extend({
    initialize: function() {
        var map = this._map = new ymaps.Map(this.el.id, {
            center: [55.751574, 37.573856],
            zoom: 10
        });

        ymaps.geolocation.get({
            provider: 'browser',
            mapStateAutoApply: true
        }).then(function (result) {
            map.setCenter(result.geoObjects.get(0).geometry.getCoordinates());
        });

        this._salonBalloonTemplate = _.template($('#salonBalloonTemplate').html());
    },

    clearPoints: function() {
        this._map.geoObjects.removeAll();
    },

    addSalonPoint: function(salon) {
        this._addPoint(salon.getCoordinates(), this._salonBalloonTemplate({salon: salon}));
    },

    _addPoint: function(coordinates, balloonContent) {
        this._map.geoObjects.add(new ymaps.Placemark(
            coordinates, {
                balloonContent: balloonContent
            }
        ));
    },

    setBoundsByPoints: function(points) {
        var minLat, minLon, maxLat, maxLon;
        minLat = maxLat = points[0][0];
        minLon = maxLon = points[0][1];

        _.each(points, function(point) {
            if (point[0] < minLat) minLat = point[0];
            if (point[1] < minLon) minLon = point[1];
            if (point[0] > maxLat) maxLat = point[0];
            if (point[1] > maxLon) maxLon = point[1];
        });

        this._map.setBounds([[minLat, minLon], [maxLat, maxLon]], {
            checkZoomRange: true
        });
    }
});


// init map and search form
ymaps.ready(function() {
    new SearchForm({
        el: $('#searchForm'),
        map: new YMap({el: $('#map')})
    });

    $('#preloader').fadeOut();
});
