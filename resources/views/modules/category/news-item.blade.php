@extends('shell')

@section('content')

<div class="news-item">
    <div class="row">
        <h1 class="text-center">Bed and breakfast Harderwijk</h1>
        <hr/>
        <h3 class="title lighter">Nieuws</h3>
    </div>

    <div class="row">
        <div class="row">
            <div class="small-12 large-12 column item">
                <div class="card">
                    <div class="img" style="background-image:url('{{$item->Afbeelding}}')"></div>

                    <div class="text">
                        <div class="date">{{date('d-m-Y', strtotime($item->created_at))}}</div>
                        <h3 class="title">{{$item->Titel}}</h3>

                        {!!$item->Omschrijving!!}

                    </div>
                </div>

                <a class="button" href="/nieuws">terug naar overzicht</a>
            </div>

        </div>
    </div>
</div>

@endsection

