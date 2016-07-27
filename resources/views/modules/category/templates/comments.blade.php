<div class="row category comments">

    <h1 class="center">{{ trans('variables.reacties') }}:</h1>

    <hr/>

    <div class="small-12 column">
            @foreach ($item as $item)
            <div class="comment">
                <div class="date small-1 right">
                     {{ date('F d, Y', strtotime($item->created_at)) }}
                </div>

               <div class="small-11 clumn">
                    <div class="text">
                        <div class="title">
                            <h3>{{$item->title}}</h3>
                        </div>

                        <div class="omschrijving">
                            <p>{!!$item->omschrijving!!}</p>
                        </div>
                    </div>
                </div>
                <hr/>
        </div>
            @endforeach
    </div>


    <form method="post" action="admin/modules/comments">
        <div class="small-12 column small-centered ">
                <div class="small-12 column">
                    <input type="text" name="author" id="author" placeholder="{{ trans('variables.uwnaam') }} ..."/>
                </div>
                <div class="small-12 column">
                    <textarea name="comment" id="comment" placeholder="{{ trans('variables.Plaats een bericht') }} ..."></textarea>
                </div>
                <div class="small-12 column">
                    <button type="submit">{{ trans('variables.verstuur') }}</button>
                </div>
        </div>

        <input type="hidden" name="_token" value="{{Session::token()}}"/>
    </form>
</div>