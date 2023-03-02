@extends('components.body')
@component('components.topWhite', ['carrinho' => $carrinho])@endcomponent

@section('body')
    @component('Home.index', ["lista" => $lista])@endcomponent
@endsection
