<form class="form" method="post" action="/admin/modules/form/sendform">
    <div class="card">
        <div class="small-12 column">
            <h2>{{$item->title}} {{ trans('variables.aanvragen') }}</h2>

            <hr/>

            @foreach ($item->fields as $field)
                <label for="">{{$field->label}}:</label>

                @if($field->type == 'text')
                    <input type="{{$field->type}}" name="{{$field->label}}" class="form-control" id="{{$field->label}}">
                @endif

                @if($field->type == 'textarea')
                    <textarea type="{{$field->type}}" name="{{$field->label}}" class="form-control" id="{{$field->label}}"></textarea>
                @endif
            @endforeach

            <button type="submit" class="btn btn-default">{{ trans('variables.Verstuur bericht') }}</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}"/>
        </div>
    </div>
</form>