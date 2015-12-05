<div class="form-group">
    <label for="mark_id">{{ $title }}</label>


    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover js-input-table" id="dataTable"
                    {!! $modelItem->renderTableAttributes() !!}>
                <input type="hidden" class="js-table-input-value" name="{{ $name }}" id="{{ $name }}_tableValue">

                <thead>
                    <tr>
                        <th style="width:10px"></th>
                        @foreach ($columns as $column)
                            {!! $column->renderHeader() !!}
                        @endforeach
                    </tr>
                </thead>
                    <tbody>
                    @foreach ($rows as $row)
                        <tr>
                            <td>
                                <input @if(!$multiselect) type="checkbox" @else type="radio" @endif
                                       name="{{ $name }}_tableGroup"
                                       data-id="{{ $row->id }}"
                                       data-value-id="{{ $name }}_tableValue"
                                       class="js-table-input-group"
                                       @if(in_array($row->id, $selected)) checked @endif>
                            </td>
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
