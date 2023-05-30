@extends('components.body')
@section('body')
@section('scriptjs')
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script>
     document.addEventListener('DOMContentLoaded', function() {
      // função a ser executada
      let response = document.getElementById('response').value;
      window.location.href = response;

    });
</script>
@endsection
@component('components.topWhite', ['carrinho' => $carrinho])@endcomponent
<div class="bg0 m-t-23 p-b-140">
    <div class="container">

            <div class="container">
                <div class="row" style="text-align: center;">
                    <div class="col-12">
                        <input type="hidden" id="response" value="{{$response['charges'][0]['links'][0]['href']}}">
                        <a href="">Baixar boleto</a>
                        
                    </div>

                </div>
            </div>

    </div>
</div>
@if ($error)
    {{ $error }}
@endif


@endsection
