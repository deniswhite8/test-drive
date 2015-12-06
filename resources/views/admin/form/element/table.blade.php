<div class="form-group">
    <label for="mark_id">{{ $title }}</label>


    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover js-input-table"
                    {!! $modelItem->renderTableAttributes() !!}>
                <input type="hidden" class="js-table-input-value"
                       value="{{ implode(',', $selected) }}"
                       @if ($multiselect) data-multiselect="1" @endif
                       name="{{ $name }}" id="{{ $name }}_tableValue">
                <input type="hidden" name="{{$name}}_multiselect" value="{{ (int)$multiselect }}">

                <thead>
                    <tr>
                        @foreach ($columns as $column)
                            {!! $column->renderHeader() !!}
                        @endforeach
                    </tr>
                </thead>
                    <tbody>
                    @foreach ($rows as $row)
                        <tr>
                            @foreach ($columns as $column)
                                {!! $column->render($row, count($rows)) !!}
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
