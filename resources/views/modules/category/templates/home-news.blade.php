<div class="row home-news">
    <div class="small-12 medium-7 large-6 left">
        <div class="white">

            <hr/>

            <h2>{{$item[count($item) - 1]->title}}</h2>

            <div class="omschrijving">
                {!! str_limit($item[count($item) - 1]->Omschrijving, $limit = 250, $end = '...') !!}

            </div>

            <hr/>

            <a href="/nieuws/{{$item[count($item) - 1]->id}}" class="button card">
                Lees meer
            </a>
        </div>
    </div>
    <div class="small-12 medium-5 large-6 left half">
        <div class="image" style="background-image: url('{{$item[count($item) - 1]->Afbeelding}}');">

        </div>
    </div>
</div>


<div class="more-news category">
    <div class="row">
        <div class="vlak">
            <h3 class="more">Meer nieuws</h3>

            <hr/>

            <ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-3">
                @foreach ($item->sortBy('id')->reverse() as $itemDetail)

                    <li>
                        <div class="image" style="background-image: url('{{$itemDetail->Afbeelding}}');">

                        </div>

                        <div class="text">
                            <div class="date">{{date('d-m-Y', strtotime($itemDetail->created_at))}}</div>
                            <div class="title">
                                <h3 class="title" itemprop="name"> {{$itemDetail->title}}</h3>
                            </div>

                            <div class="omschrijving">
                                {!! str_limit($itemDetail->Omschrijving, $limit = 100, $end = '...') !!}
                            </div>

                            <hr/>

                            <a class="button card left" href="/nieuws/{{$itemDetail->id}}">Lees meer</a>
                        </div>
                    </li>

                @endforeach

                @if (count($itemDetail) < 3 && count($itemDetail) != 2)
                    <li class="placeholder">
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
                        <li class="placeholder">
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

<div class="small-12 column">
    <div class="row">
        <div class="table">
            <div class="table-cell">
                <a class="button" href="/nieuws">
                    Meer nieuws laden
                </a>
            </div>
        </div>
    </div>
</div>
