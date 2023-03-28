@extends('components.body')
@section('body')
@component('components.topWhite', ['carrinho' => $carrinho])@endcomponent


    @component('Home.index', ["lista" => $lista])@endcomponent
@endsection
