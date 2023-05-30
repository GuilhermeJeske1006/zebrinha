@extends('components.body')
@section('body')
@section('scriptjs')
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script>
    $(document).ready(() => {
        let valor = document.cookie.replace(/(?:(?:^|.*;\s*)fretevlr\s*\=\s*([^;]*).*$)|^.*$/, "$1");

        document.getElementById("vlrFrete").value = valor;
    })
</script>
@endsection
@component('components.topWhite', ['carrinho' => $carrinho])@endcomponent
<div class="bg0 m-t-23 p-b-140">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="d-grid flex-w flex-l-m filter-tope-group m-tb-10">
                <h4 class="mtext-109 cl2 p-b-30">
                    Escaneie o Qrcode para finalizar
                </h4>
            </div>
            

        </div>

            <div class="container">
                <div class="row" style="text-align: center;">
                    <div class="col-12">
                        <input type="hidden" name="vlrFrete" id="vlrFrete">
                        <input type="hidden" value="{{$response['qr_codes'][0]['id']}}">
                        <img src="{{$response['qr_codes'][0]['links'][0]['href']}}" class="img-fluid" alt="">

                    </div>

                </div>
            </div>

    </div>
</div>
@if ($error)
    {{ $error }}
@endif


@endsection
