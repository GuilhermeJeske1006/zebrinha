@extends('components.body')
@section('body')

@section('scriptjs')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://assets.pagseguro.com.br/checkout-sdk-js/rc/dist/browser/pagseguro.min.js"></script>
    <script>
        $(document).ready(() => {
            const minhaDiv = document.getElementById("vlrfrete");
            const segundoParagrafo = minhaDiv.children[1];
            if (segundoParagrafo != null || segundoParagrafo != undefined)
                segundoParagrafo.remove();

            document.getElementById("vlrdefault").style.display = "none";


            // var valor = localStorage.getItem('preco')
            let p = document.createElement('p');
            let valor = document.cookie.replace(/(?:(?:^|.*;\s*)fretevlr\s*\=\s*([^;]*).*$)|^.*$/, "$1");

            p.innerHTML = `R$ ${valor}`
            document.getElementById('vlrfrete').appendChild(p);


            let subtotal = $("#subtotal").val()
            let soma = somar(subtotal, valor)
            const vlrZero = document.getElementById('vlrTotal')
            vlrZero.innerHTML = ""
            let p2 = document.createElement('p')
            p2.classList.add("destaque");

            p2.innerHTML = `R$ ${soma}`
            document.getElementById('vlrTotal').appendChild(p2);


        })


        function marcaDesmarca(caller) {
            var checks = document.querySelectorAll('input[type="checkbox"]');
            for (let i = 0; i < checks.length; i++) {
                checks[i].checked = checks[i] == caller;
            }
        }

        function somar(subtotal, valor) {
            return parseFloat(subtotal) + parseFloat(valor);
        }


        function limparCookie(nomeVariavel) {
            var dataExpiracao = new Date(); // Cria um objeto data com a data atual
            dataExpiracao.setFullYear(dataExpiracao.getFullYear() - 1); // Define a data de expiração como um ano atrás

            document.cookie = nomeVariavel + "=;expires=" + dataExpiracao.toUTCString() +
                ";path=/"; // Define o valor do cookie como uma string vazia e a mesma data de expiração do cookie original
        }

        

        function getHash() {

            let holder = document.getElementById('holder').value;
            let number = document.getElementById('number').value;
            let expMonth = document.getElementById("expMonth").value;
            let expYear = document.getElementById("expYear").value;
            let securityCode = document.getElementById("securityCode").value;
            let hash = document.getElementById("encrypted").value;

            let response = {!! json_encode($response) !!};

            var card = PagSeguro.encryptCard({
                publicKey: response.public_key,
                holder: holder,
                number: number,
                expMonth: expMonth,
                expYear: expYear,
                securityCode: securityCode
            });

            var encrypted = card.encryptedCard;
            document.getElementById("encrypted").value = encrypted

        }





        function abrirCredito() {
            let credito = document.getElementById('credito');
            credito.innerHTML = ""

            var htmlCredito = `
        <form method="POST" action="{{ route('makePayment') }}" style="margin-top: 5%" onsubmit="limparCookie('fretevlr')">
            @csrf
            <input  type="hidden" id="encrypted" name="encrypted">

                            <div class="container">
                                <div class="row" style="margin-left: 3%;">
                                    <h4 class="mtext-109 cl2 p-b-30">
                                        Cadastrar cartão de credito
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-12 col-12 display_grid d-flex">
                                <div class="col-12 col-md-6">
                                    <div class="bor8 bg0 m-b-12">
                                        <input required class="stext-111 cl8 plh3 size-111 p-lr-15" onchange="format_cpf(value)" type="text" id="cpf" name="cpf"
                                               placeholder="Numero do Cpf">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="bor8 bg0 m-b-22">
                                        <input required  class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" id="phone" name="phone"
                                               placeholder="Telefone">
                                    </div>
                                </div>

                                
                            </div>
                            
                            <div class="col-md-12 col-12 display_grid d-flex">
                                <div class="col-12 col-md-8">
                                    <div class="bor8 bg0 m-b-12">
                                        <input required class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" id="number" name="number"
                                               placeholder="Numero do cartao" onchange="getKey()">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="bor8 bg0 m-b-22">
                                        <input required  class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" id="securityCode" name="number"
                                               placeholder="CCV">
                                    </div>
                                </div>

                                
                            </div>
                            <div class="col-md-12 col-12 display_grid d-flex">
                                <div class="col-12 col-md-6">
                                    <div class="bor8 bg0 m-b-12">
                                        <input required  class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" id="holder" name="name"
                                               placeholder="Nome no cartão">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="bor8 bg0 m-b-22">
                                        <input required class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" id="expMonth" name="expMonth"
                                               placeholder="Exp mês">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="bor8 bg0 m-b-22">
                                        <input required class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" id="expYear" name="expYear"
                                               placeholder="Exp ano">
                                    </div>
                                </div>
                            </div>
                         
                            <div  class="flex-w   p-b-10">
                                <div class="wid-full flex-finali flex-w flex-m respon6-next">

                                    <button onclick="getHash()"
                                        type="submit"
                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                        Finalizar pagamento
                                    </button>
                                </div>
                            </div>
                        </div>
        `

            let div = document.createElement('div');
            div.innerHTML = htmlCredito;
            document.getElementById('credito').appendChild(div);


            let pix = document.getElementById('pix');
            let boleto = document.getElementById('boleto');
            pix.innerHTML = "";
            boleto.innerHTML = ""

        }



        function abrirBoleto() {

            let boleto = document.getElementById('boleto');
            boleto.innerHTML = ""


            let htmlBoleto = `
            <div class="mt-3">
                            <div class="container">
                                <div class="row" style="margin-left: 3%;">
                                    <h4 class="mtext-109 cl2 p-b-30">
                                        Boleto
                                    </h4>
                                    <div class="col-12 display_grid d-flex">
                                        <div class="col-6 col-md-2">
                                            <img src="{{ asset('images/boleto-icon.png') }}" class="img-fluid"
                                                alt="">

                                        </div>
                                        <div class="col-12 col-md-10">
                                            <div class="display_grid d-flex">
                                                <span style="font-size: 14px" class="mtext-105 margin_top">O pedido será confirmado
                                                    somente após a aprovação do pagamento.</span>
                                            </div>
                                            <p style="font-size: 12px" class="mtext-105 mt-1 margin_top">
                                                Tarifa de boleto = R$ 1,00
                                            </p>
                                            <p style="font-size: 10px" class="mtext-105 mt-1 margin_top">
                                                Tarifa aplicada para cobrir os custos de gestão de risco do meio de
                                                pagamento.
                                            </p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <form  action="{{ route('boleto') }}" method="POST" class="flex-w  margin_top p-b-10"  onsubmit="limparCookie('fretevlr')">
                                @csrf
                                <div class="wid-full flex-finali flex-w flex-m respon6-next">
                                    <div class="col-12 d-flex mt-3 ml-3">
                                        <div class="col-6 col-md-2">
                                        </div>
                                        <div class="col-10 d-grid">
                                        <div class="col-12">
                                            <div class="bor8 bg0 m-b-12">
                                                <input required class="stext-111 cl8 plh3 size-111 p-lr-15"  type="text" id="cpf" name="cpf"
                                                    placeholder="Numero do Cpf">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex">
                                        <div class="col-12 col-md-3 p-0">
                                            <div class="bor8 bg0 m-b-22">
                                                <input required  class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" id="ddd" name="ddd"
                                                    placeholder="DDD">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-9 pr-0">
                                        
                                            <div class="bor8 bg0 m-b-22">
                                                <input required  class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" id="phone" name="phone"
                                                    placeholder="Telefone">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                 </div>
                                    <button 
                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                        Gerar boleto
                                    </button>
                                </div>
                            </form>
                        </div>
            `

            let div = document.createElement('div');
            div.innerHTML = htmlBoleto;
            document.getElementById('boleto').appendChild(div);


            let pix = document.getElementById('pix');
            let credito = document.getElementById('credito');
            pix.innerHTML = "";
            credito.innerHTML = ""
        }


        function abrirPix() {
            let pix = document.getElementById('pix');
            pix.innerHTML = "";

            let htmlPix = ` 
            <div class="mt-3">
                            <div class="container">
                                <div class="row" style="margin-left: 3%;">
                                    <h4 class="mtext-109 cl2 p-b-30">
                                        Pix
                                    </h4>
                                    <div class="col-12 display_grid d-flex">
                                        <div class="col-md-2 col-4">
                                            <img src="{{ asset('images/logo-pix-icone-512.png') }}" class="img-fluid"
                                                alt="">

                                        </div>
                                        <div class="col-12 col-md-10">
                                            <div class="d-flex">
                                                <span style="font-size: 14px" class=" margin_top mtext-105">O pedido será confirmado
                                                    somente após a aprovação do pagamento.</span>
                                            </div>
                                       
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <form action="{{ route('pix') }}" class="flex-w margin_top  p-b-10" onsubmit="limparCookie('fretevlr')">
                                <div class="wid-full flex-finali flex-w flex-m respon6-next">

                                    <button 
                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                        Gerar pix
                                    </button>
                                </div>
                            </form>
                        </div>
            `
            let div = document.createElement('div');
            div.innerHTML = htmlPix;
            document.getElementById('pix').appendChild(div);

            let boleto = document.getElementById('boleto');
            let credito = document.getElementById('credito');
            boleto.innerHTML = "";
            credito.innerHTML = ""

        }

        function limparCookie(nome) {
            document.cookie = nome + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }
    </script>
@endsection
<!-- Product -->
@component('components.topWhite', ['carrinho' => $carrinho])
@endcomponent



<div class="container">
    <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">

        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            Formas de pagamento
                        </h4>
                        <div class="p-t-33">
                            <div class="flex-w  p-b-10">
                                <div class="wid-full respon6-next">
                                    <div class="rs1-select2 bor8 bg0">

                                        <div class="d-flex" style="height: 45px">
                                            <input onclick="abrirPix(); marcaDesmarca(this)" type="checkbox"
                                                style="margin-left: 2%">
                                            <label style="margin: auto auto auto 10px;">Pix (Aprovação imediata)</label>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="flex-w  p-b-10">
                                <div class="wid-full respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <div class="d-flex" style="height: 45px">
                                            <input onclick="abrirCredito(); marcaDesmarca(this)" type="checkbox"
                                                id="cartao_credito" style="margin-left: 2%">
                                            <label style="margin: auto auto auto 10px;">Cartão de crédito</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-w  p-b-10">
                                <div class="wid-full respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <div class="d-flex" style="height: 45px">
                                            <input onclick="abrirBoleto(); marcaDesmarca(this)" type="checkbox"
                                                style="margin-left: 2%">
                                            <label style="margin: auto auto auto 10px;">Boleto</label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div id="credito"></div>

                        <div id="boleto"></div>

                        <div id="pix"></div>



                    </div>
                </div>
            </div>
            @component('CheckOut.resumo', [
                'produtos_json' => $produtos_json,
                'cep' => $cep,
                'carrinho' => $carrinho,
                'endereco' => $endereco,
            ])
                <div class="flex-w flex-t p-t-27 p-b-33 bor12">

                    <div class="size-208" style="margin-top: 5%">
                        <span class="mtext-101 cl2">
                            Valor:
                        </span>
                    </div>

                    <div class="size-209 p-t-1" style="margin-top: 5%">
                        <span class="mtext-110 cl2" id="vlrfrete">
                            <p id="vlrdefault">R$ 0</p>
                        </span>
                    </div>
                </div>
            @endcomponent

        </div>
    </div>
</div>
</div>


<style>
    .flex-finali {
        display: flex;
        flex-direction: row-reverse;
    }

    @media only screen and (max-width: 600px) {
        .display_grid {
            display: grid !important;
        }

        .margin_top {
            margin-top: 1rem
        }
    }
</style>
@endsection
