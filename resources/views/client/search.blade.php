@extends('layouts.master')

    

@section('head')
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script id="salonBalloonTemplate" type="text/template">
        <div class="salon-balloon thumbnail">
            <% if (_image = salon.get('image_thumbnail')) { %>
                <img class="_image" src="<%= _image %>"
                     alt="<%= salon.get('name') %>"/>
            <% } %>

            <div class="caption">
                <h3><%= salon.get('name') %></h3>

                <% if (_description = salon.get('description')) { %>
                    <p><%= _description %></p>
                    <br>
                <% } %>
                <p>
                    <%= salon.get('city').name %>, <%= salon.get('address') %>
                    <% if (_phone = salon.get('phone')) { %>
                    <br/>
                    Тел.: <%= _phone %>
                    <% } %>
                    <% if (_workTime = salon.get('work_time')) { %>
                    <br/>
                    Режим работы: <%= _workTime %>
                    <% } %>
                </p>

                <p>
                    <button type="submit" class="btn btn-default js-appointment"
                            data-salon-id="<%= salon.get('id') %>"
                            data-toggle="modal" data-target="#appointmentModal">Записаться</button>
                </p>
            </div>
        </div>
    </script>
@stop

@section('content')
    <div class="ajax-loader" id="preloader"></div>

    <form class="form-inline ajax-form" id="searchForm">
        <div class="form-group">
            <select name="auto[mark]" id="autoMark" class="form-control js-combobox">
                <option value="" selected disabled hidden>Марка</option>
                @foreach($marks as $mark)
                    <option value="{{$mark->id}}">{{$mark->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <select name="auto[model]" id="autoModel" class="form-control js-combobox">
                <option value="" selected disabled hidden>Модель</option>
            </select>
        </div>

        <div class="form-group">
            <select name="auto[generation]" id="autoGeneration" class="form-control js-combobox">
                <option value="" selected>Поколение</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary" id="searchFormSubmit">
            <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
            <span class="_text">Найти</span>
        </button>

        <span id="searchFormMessage"
              data-not-found-string="Ничего не найдено"
              data-refine-search="Уточните критерии поиска"
              class="help-block"></span>
    </form>

    <div class="salon-map" id="map"></div>

    <div class="modal fade" id="appointmentModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Оставить заявку</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('api/appointment') }}" class="ajax-form" data-toggle="validator"
                          role="form" method="post" id="appointmentForm">
                        <div class="form-group">
                            <label for="contacts">Ваши контактные данные (телефон или email)</label>
                            <input type="text" class="form-control"
                                   data-error="укажите контактные данные по которым мы сможем с вами связаться"
                                   id="contacts" name="contacts" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="datetime">Дата и время</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="datetimeInputAddon">
                                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                </span>
                                <input type="text" class="form-control js-datetime" required
                                       data-error="выберете желамую дату и время для записи"
                                       aria-describedby="datetimeInputAddon"
                                       id="datetime" name="datetime">
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="comment">Дополнительные пожелания</label>
                            <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" id="appointmentFormSubmit">
                                <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
                                <span class="_text">Готово</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade message-modal" id="messageModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="js-alert alert alert-success hide js-success" role="alert">
                        <strong>Спасибо!</strong> Ваша заявка принята.
                    </div>
                    <div class="js-alert alert alert-warning hide js-warning" role="alert"></div>
                    <div class="js-alert alert alert-danger hide js-error" role="alert">
                        <strong>Внутренняя ошибка сервера.</strong> Пожалуйста, повторите попытку позже.
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop