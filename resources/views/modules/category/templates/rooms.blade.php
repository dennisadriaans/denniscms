<div class="category rooms" itemscope itemtype="https://schema.org/BedAndBreakfast">
    <div class="row">
        <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-2">

            @foreach ($item as $item)
            <li class="small-6 column">
                <div class="card">
                    <div class="image" style="background-image: url('{{$item->Afbeelding}}');">

                    </div>

                    <div class="text">
                        <div class="title">
                            <h3 class="title" itemprop="name">{{$item->title}}</h3>
                        </div>

                        <hr/>

                        <div class="omschrijving">
                            {!! str_limit($item->Omschrijving, $limit = 150, $end = '...') !!}
                        </div>

                        <a class="right watch-now" href="/{{ trans('variables.gastenverblijven') }}/{{$item->id}}">{{ trans('variables.bekijknu') }}</a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
