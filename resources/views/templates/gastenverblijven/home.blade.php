@extends('shell')

@section('content')

@include($items[0]['templ'], ['item' => $items[0]['r0c0']['items']])

<div class="row">

    <div class="small-12 column">
        @if ($pageInfo->title == 'gastenverblijven')
        <div class="small-12 column">
            <div class="row">
                <h1>De gastenverblijven</h1>
            </div>
        </div>
        @endif
        <hr/>
        <div class="small-12 large-8 column">
            @include($items[1]['templ'], ['item' => $items[1]['r1c0']['items']])
        </div>
        <div class="small-12 large-4 column right">
            @include($items[2]['templ'], ['item' => $items[2]['r1c1']['items']])
        </div>
    </div>
</div>
@endsection

