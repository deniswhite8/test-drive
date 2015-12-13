"use strict";

/**
 * Model model
 */
var Model = Backbone.Model.extend({
    getLabel: function() {
        return this.get('name');
    }
});

/**
 * Auto model collection
 */
var Models = Backbone.Collection.extend({
    model: Model,

    url: function() {
        return 'api/auto/mark/' + this._markId + '/models'
    },

    setMarkId: function(markId) {
        this._markId = markId;
        return this;
    }
});

/**
 * Generation model
 */
var Generation = Backbone.Model.extend({
    getLabel: function() {
        return this.get('name') +
            ' (' + this.get('start_year_production') + ' - ' +
            (this.get('end_year_production') || '...') + ')';
    }
});

/**
 * Auto generation collection
 */
var Generations = Backbone.Collection.extend({
    model: Generation,

    url: function() {
        return 'api/auto/model/' + this._modelId + '/generations'
    },

    setModelId: function(modelId) {
        this._modelId = modelId;
        return this;
    },

    getLabel: function() {
        return this.get('name') + 123;
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

    getMarkId: function() {
        return this.$_marksSelect.val();
    },

    getModelId: function() {
        return this.$_modelsSelect.val();
    },

    getGenerationId: function() {
        return this.$_generationsSelect.val();
    },

    doLoadModels: function() {
        this.$_modelsSelect.clear();

        var selectedMark = this.getMarkId();
        if (!selectedMark) return;

        var models = new Models();
        models.setMarkId(selectedMark);
        this._updateOptionsList(models, this.$_modelsSelect);
    },

    doLoadGenerations: function() {
        this.$_generationsSelect.clear();

        var selectedModel = this.getModelId();
        if (!selectedModel) return;

        var generations = new Generations();
        generations.setModelId(selectedModel);
        this._updateOptionsList(generations, this.$_generationsSelect);
    },

    doSearchSalons: function(event) {
        event.preventDefault();
        this.$_formMessage.hide();
        this._map.clearPoints();

        if (!this.getMarkId() || !this.getModelId()) {
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
                        value: entity.get('id'), label: entity.getLabel()
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
    events: {
        'click .js-appointment': 'openAppointment'
    },

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
    },

    getCurrentSalonId: function() {
        return this._currentSalonId;
    },

    openAppointment: function(event) {
        this._currentSalonId = $(event.target).data('salonId')
    }
});

/**
 * Message box view
 */
var MessageBox = Backbone.View.extend({
    _showType: function(type, text) {
        this.$el.find('.js-alert').addClass('hide');
        var row = this.$el.find('.js-' + type);
        if (text) {
            row.text(text);
        }
        row.removeClass('hide');
        this.$el.modal('show');
    },

    success: function(text) {
        this._showType('success', text);
    },

    warning: function(text) {
        this._showType('warning', text);
    },

    error: function(text) {
        this._showType('error', text);
    }
});

/**
 * Appointment form
 */
var AppointmentForm = Backbone.View.extend({
    events: {
        'submit': 'onSubmit'
    },

    initialize: function(params) {
        this._searchForm = params.searchForm;
        this.$_submitBtn = $('#appointmentFormSubmit');
        this.$_modal = params.modal;
        this._messageBox = params.messageBox;
        this._map = params.map;
    },

    onSubmit: function(event) {
        if (event.isDefaultPrevented()) {
            return;
        }

        event.preventDefault();
        var $form = this.$el,
            self = this,
            data = _.extend($form.serializeObject(), {
                'mark_id': this._searchForm.getMarkId(),
                'model_id': this._searchForm.getModelId(),
                'generation_id': this._searchForm.getGenerationId(),
                'salon_id': this._map.getCurrentSalonId()
            });

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,

            beforeSend: function() {
                self.$_submitBtn.addClass('_loading');
            },

            complete: function() {
                self.$_submitBtn.removeClass('_loading');
                self.$_modal.modal('hide');
            },

            success: function(data) {
                self._messageBox.success();
            },

            error: function(xhr) {
                if (xhr.status == 422) {
                    self._messageBox.warning(xhr.responseJSON.join(' '));
                } else {
                    self._messageBox.error();
                }
            }
        });
    }
});

// init map and search form
ymaps.ready(function() {
    var map = new YMap({el: $('#map')});

    var searchForm = new SearchForm({
        el: $('#searchForm'),
        map: map
    });

    new AppointmentForm({
        el: $('#appointmentForm'),
        searchForm: searchForm,
        modal: $('#appointmentModal'),
        messageBox: new MessageBox({el: $('#messageModal')}),
        map: map
    });

    $('#preloader').fadeOut();
});
