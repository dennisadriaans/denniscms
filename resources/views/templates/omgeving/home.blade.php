
@extends('shell')

@section('content')


 @include($items[0]['templ'], ['item' => $items[0]['r0c0']['items']])
<div class="row">
    <div class="small-12 column">
        @include($items[1]['templ'], ['item' => $items[1]['r1c0']['items']])
    </div>
    <div class="small-12 column padding-bottom">
        @if (isset($items[2]['templ'])) @include($items[2]['templ'], ['item' => $items[2]['r2c0']['items']]) @endif
    </div>
</div>

@endsection

