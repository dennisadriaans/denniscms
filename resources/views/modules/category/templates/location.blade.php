<div class="row category omgeving">
    <ul class="small-block-grid-3">

        @foreach ($item->sortBy('id')->reverse() as $item)
           <li class="small-6 column">
                <div class="card">
                    <div class="image" style="background-image: url('{{$item->Afbeelding}}');">

                    </div>

                    <div class="text">
                        <div class="title">
                            <h3>{{$item->title}}</h3>
                        </div>

                        <hr/>

                        <div class="omschrijving">
                            {!!$item->Omschrijving!!}
                        </div>

                        <a class="right watch-now" target="_blank" href="{!!$item->Url!!}">{{ trans('variables.bekijknu') }}</a>
                    </div>
                </div>
            </li>
        @endforeach

    </ul>
</div>