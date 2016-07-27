<div class="category news">
    <div class="small-12 column">
        <div class="row">

            <h1>De Stadsboerderij Harderwijk</h1>
            <hr/>
            <h1 style="font-size: 16px; margin: 15px 0 30px 0;">Nieuws</h1>
            <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">

                @foreach ($item->sortBy('id')->reverse() as $itemDetail)
                <li>
                    <div class="card">
                        <div class="image" style="background-image: url('{{$itemDetail->Afbeelding}}');">

                        </div>

                        <div class="text">
                            <div class="date">{{date('d-m-Y', strtotime($itemDetail->created_at))}}</div>
                            <div class="title">
                                <h3 class="title" itemprop="name">{{$itemDetail->title}}</h3>
                            </div>

                            <hr>

                            <div class="omschrijving">

                                {!! str_limit($itemDetail->Omschrijving, $limit = 150, $end = '...') !!}
                            </div>

                            <a class="right watch-now" href="/{{ trans('variables.news') }}/{{$itemDetail->id}}">{{ trans('variables.bekijknu') }}</a>
                        </div>
                    </div>
                </li>
                @endforeach


                @if (count($item) < 2)

                        <li class="placeholder white-ph">
                            <div class="image" style="background-image: url('img/placeholder.png');">

                            </div>

                            <div class="date"></div>
                            <h3 class="title" itemprop="name"> </h3>
                            <h3 class="title" itemprop="name"> </h3>
                            <h3 class="title" itemprop="name"> </h3>
                            <h3 class="title" itemprop="name"> </h3>
                            <div class="date"></div>

                            <br/>
                            <hr/>
                            <br/>

                            <div class="date right"></div>
                        </li>

                @endif
                @if (count($item) < 3)

                        <li class="placeholder white-ph">
                            <div class="image" style="background-image: url('img/placeholder.png');">

                            </div>

                            <div class="date"></div>
                            <h3 class="title" itemprop="name"> </h3>
                            <h3 class="title" itemprop="name"> </h3>
                            <h3 class="title" itemprop="name"> </h3>
                            <h3 class="title" itemprop="name"> </h3>
                            <div class="date"></div>

                            <br/>
                            <hr/>
                            <br/>

                            <div class="date right"></div>
                        </li>

                @endif

            </ul>
        </div>
    </div>
</div>
