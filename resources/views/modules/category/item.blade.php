@extends('shell')

@section('content')

<div class="row">
    <div class="header" style="background-image: url('/u/images/phpcGaNwr.jpg');">

    </div>
</div>
<div class="row category-item news">
    <div class="row">
        <div class="small-12 large-8 column item">

            <img src="{{$item->Afbeelding}}" alt=""/>

            <h3>{{$item->label}}</h3>
            <h3>Verblijf: {{$item->Titel}}</h3>

            <h3>{{ trans('variables.Omschrijving') }}</h3>
            <p>{!!$item->Omschrijving!!}</p>

            <h3>{{ trans('variables.Faciliteiten') }}</h3>
            <p> {{$item->Faciliteiten}}</p>

            <h3>{{ trans('variables.Prijzen') }}</h3>
            <p> {!!$item->Prijzen!!}</p>

            <h3>{{ trans('variables.Fotos') }}</h3>

            <ul class="small-block-grid-3">
                <li>
                    <a href="http://bedandbreakfastharderwijk.com/{!!$item->Foto1!!}"><img src="{!!$item->Foto1!!}" alt=""/></a>
                </li>
                <li>
                    <a href="http://bedandbreakfastharderwijk.com/{!!$item->Foto2!!}"><img src="{!!$item->Foto2!!}" alt=""/></a>
                </li>
                <li>
                    <a href="http://bedandbreakfastharderwijk.com/{!!$item->Foto3!!}"><img src="{!!$item->Foto3!!}" alt=""/></a>
                </li>
            </ul>
        </div>

        <div class="small-12 large-4 column item-form">
            <form class="form" method="post" action="admin/modules/form/sendform">
                <div class="card">
                    <div class="small-12 column">
                        <h2>Meer informatie aanvragen</h2>

                        <hr/>

                        <label for="">Naam:</label>
                        <input type="text" name="Naam" class="form-control" id="Naam">

                        <label for="">Achternaam:</label>
                        <input type="text" name="Achternaam" class="form-control" id="Achternaam">

                        <label for="">E-mailadres:</label>
                        <input type="text" name="E-mailadres" class="form-control" id="E-mailadres">

                        <label for="">Bericht:</label>
                        <textarea type="textarea" name="Bericht" class="form-control" id="Bericht"></textarea>

                        <button type="submit" class="btn btn-default">Verstuur bericht</button>
                        <input type="hidden" name="_token" value="vvdYWxzJZeurnSvNMMZPIA8kYM5gFLqTGbQsfb5D"/>
                    </div>
                </div>
            </form>
        </div>
        <div class="small-12 large-4 column item-form related">
            <div class="card">
                <div class="small-12 medium-12 column">
                    <h4>Bekijk ook:</h4>

                    @if ($item->title == 'Tarwe')
                        <a href="/gastenverblijven/1" class="watch">
                            <div class="image" style="background-image: url('/u/images/phpImjbCP.JPG');">

                            </div>

                            <h3> Verblijf: Tarwe </h3>
                        </a>

                    @endif
                    @if ($item->title == 'Rogge')
                        <a href="/gastenverblijven/2" class="watch">

                            <div class="image" style="background-image: url('/u/images/phpGKYs3w.JPG');">

                            </div>

                            <h3> Verblijf: Rogge </h3>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

