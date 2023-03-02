@extends('components.body')
@section('scriptjs')

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script type="text/javascript"
        src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>


    <script type="text/javascript">
        function abrir() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions', true, {
                headers: {                    
                "Access-Control-Allow-Origin": "*",                   
                "Access-Control-Allow-Methods": "GET,POST,OPTIONS,DELETE,PUT"
            },
            });
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    var session = this.responseText;

                    // Abre o lightbox do PagSeguro com os dados da transação
                    PagSeguroLightbox({
                        code: session,
                    });
                }
            };
            xhr.send('email=guilhermeieski@gmail.com&token=3EADF66FE76B407894FC414D33893228');
        }
        // Cria uma sessão no PagSeguro
    </script>



@section('body')
    @component('components.topWhite', ['carrinho' => $carrinho])
    @endcomponent
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('index') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                checkout
            </span>
        </div>
    </div>


    <!-- Shoping Cart -->
    <div class="bg0 p-t-75 p-b-85">
        <div class="container">
            <div class="row">
                <button onclick="abrir()" type="button">Pagar</button>


                {{-- <form>
                   @csrf

               <div class="col-6 col-md-6">
                   <div class="bor8 bg0 m-b-12">
                       <input type="text" name="hashseller" class=" hashseller stext-111 cl8 plh3 size-111 p-lr-15">
                       <input type="text" name="totalfinal" value="200" class=" totalfinal stext-111 cl8 plh3 size-111 p-lr-15">

                   </div>
               </div>
                   <div style="margin-top: 5%" >
                       <div class="container">
                           <div class="row" style="margin-left: 3%;">
                               <h4 class="mtext-109 cl2 p-b-30">
                                   Cadastrar cartão de credito
                               </h4>
                           </div>
                       </div>
                       <div class="col-md-12 col-12 d-flex">
                           <div class="col-6 col-md-6">
                               <div class="bor8 bg0 m-b-12">
                                   <input class=" ncredito stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="ncredito"
                                          placeholder="Numero do cartao">
                               </div>
                           </div>
                           <div class="col-6 col-md-6">
                               <div class="bor8 bg0 m-b-12">
                                   <input class="nparcela stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="nparcela"
                                          placeholder="parcela no cartão">
                               </div>
                           </div>

                       </div>
                       <div class="col-md-12 col-12 d-flex">
                           <div class="col-6 col-md-4">
                               <div class="bor8 bg0 m-b-22">
                                   <input class="stext-111 cl8 plh3 size-111 p-lr-15 bandeira" type="text" name="bandeira"
                                          placeholder="Bandeira">
                               </div>
                           </div>
                           <div class="col-6 col-md-6">
                               <div class="bor8 bg0 m-b-22">
                                   <input class="stext-111 cl8 plh3 size-111 p-lr-15 anoexp" type="text" name="anoexp"
                                          placeholder="Expiração">
                               </div>
                           </div>
                           <div class="col-6 col-md-2">
                               <div class="bor8 bg0 m-b-22">
                                   <input class="stext-111 cl8 plh3 size-111 p-lr-15 ncvv" type="text" name="ncvv"
                                          placeholder="CCV">
                               </div>
                           </div>
                       </div>
                       <div  class="flex-w   p-b-10">
                           <div class="wid-full flex-finali flex-w flex-m respon6-next">

                               <div class="col-md-12 col-12 d-flex">
                                   <div class="col-6 col-md-12" style="display: flex;flex-direction: row-reverse;">
                                       <input type="submit" class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10" value="pagar" >

                                   </div>

                               </div>
                           </div>
                       </div>
                   </div>
               </form> --}}

                @livewire('pay-modal')

                @component('CheckOut.resumo', ['carrinho' => $carrinho, 'endereco' => $endereco])
                @endcomponent

            </div>
        </div>

    </div>
@endsection
