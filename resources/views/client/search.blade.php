@extends('layouts.master')

@section('title', 'Найти салон')

@section('head')
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script id="salonBalloonTemplate" type="text/template">
        <address>
            <p><b><%= salon.get('name') %></b></p>
            <% if (_description = salon.get('description')) { %>
                <p><%= _description %></p>
            <% } %>
            <p>
                <%= salon.get('city') %>, <%= salon.get('address') %>
                <% if (_phone = salon.get('phone')) { %>
                    <br/>
                    Тел.: <%= _phone %>
                <% } %>
                <% if (_workTime = salon.get('work_time')) { %>
                    <br/>
                    Режим работы: <%= _workTime %>
                <% } %>
            </p>
        </address>
    </script>
@stop

@section('content')
    <form class="form-inline" id="searchForm">
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

        <button type="submit" class="btn btn-primary">Найти</button>
    </form>

    <div id="map" style="width: 600px; height: 400px"></div>
@stop