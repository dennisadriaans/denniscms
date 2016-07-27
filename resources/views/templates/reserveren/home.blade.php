@extends('shell')

@section('content')
@include($items[0]['templ'], ['item' => $items[0]['r0c0']['items']])
<div class="row">
    <div class="small-12 large-4 column">
        @include($items[1]['templ'], ['item' => $items[1]['r1c0']['items']])
    </div>
    <div class="small-12 large-8 column hide-for-small-only">
        @include($items[2]['templ'], ['item' => $items[2]['r1c1']['items']])
    </div>
</div>

@endsection

