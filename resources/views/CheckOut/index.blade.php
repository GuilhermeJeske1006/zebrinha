<!-- breadcrumb -->
@extends('components.body')


@section('body')
    @section('scriptjs')
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        <script>
            function edit() {
                document.getElementById("editbutao").style.display = "none";
                var btn = `
                  <button id="notedit"  onclick="notedit()" class="display-edit">Cancelar</button>
                `
                let button = document.createElement('button');
                button.innerHTML = btn;
                document.getElementById('removeShow').appendChild(button);

                var html = `
            <form  action="{{route('endereco.edit')}}" method="POST" >
                        @csrf
                @method('PUT')
                <div class="container">
                    <div class="row" style="margin-left: 3%;">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Editar seu endereço
                        </h4>
                    </div>
                </div>
                <input type="hidden" id="usuario_id" value="{{Auth::user()->id}}" name="usuario_id">
                        <input type="hidden" id="id" value="{{$cep->id}}" name="id">

                        <div class="col-md-12 col-12 d-flex">
                            <div class="col-6 col-md-6">
                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12">
                                    <select  class="js-select2 size-111" name="estado" style="border: none;">
                                        <option>Estado...</option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                        <option value="EX">Estrangeiro</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" value="{{$cep->cidade}}" type="text" name="cidade" id="cidade"
                                           placeholder="Cidade">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-12 d-flex">
                            <div class="col-6 col-md-3">
                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" value="{{$cep->cep}}"  type="text" name="cep" id="cep"
                                           placeholder="Cep">
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" value="{{$cep->bairro}}" type="text" name="bairro" id="bairro"
                                           placeholder="Bairro">
                                </div>
                            </div>
                            <div class="col-6 col-md-5">
                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" value="{{$cep->logradouro}}"  type="text" name="logradouro" id="logradouro"
                                           placeholder="Rua">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-12 d-flex">
                            <div class="col-6 col-md-8">
                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" value="{{$cep->complemento}}" type="text" name="complemento" id="complemento"
                                           placeholder="Complemento">
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" value="{{$cep->numero}}" type="text" name="numero" id="numero"
                                           placeholder="Numero">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12 col-12 d-flex">
                            <div class="col-6 col-md-12" style="display: flex;flex-direction: row-reverse;">
                                <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10" type="submit">
                                    Enviar
                                </button>
                            </div>

                        </div>

                    </form>
            `
                let div = document.createElement('div');
                div.innerHTML = html;
                document.getElementById('edit').appendChild(div);

            }

            function notedit(){
               let edit =  document.getElementById("edit");
               edit.innerHTML = ""
                document.getElementById("notedit").style.display = "none";
                document.getElementById("editbutao").style.display = "block";

            }
        </script>

        <script>
            $(document).ready(() => {
                //  const axios = require('axios');

                // seleciona o elemento input
                const myInput = $("#myInput");

                // recupera o valor do input
                var inputValue = myInput.val();
                console.log(inputValue); // exibe o valor do input no console



                const apiKey =
                    'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM4MzdjNDg5MmZlYWJkMTU2NjhhZjVkNDg4YjI0MzdlMmE1ZWM2YmUzYzYwNGIzYTk5ZjUxNTMxMDJjOGRlZTg4NjhmZTMyNWQ5Y2Q5ODNjIn0.eyJhdWQiOiIxIiwianRpIjoiYzgzN2M0ODkyZmVhYmQxNTY2OGFmNWQ0ODhiMjQzN2UyYTVlYzZiZTNjNjA0YjNhOTlmNTE1MzEwMmM4ZGVlODg2OGZlMzI1ZDljZDk4M2MiLCJpYXQiOjE2Nzc1OTIxMjIsIm5iZiI6MTY3NzU5MjEyMiwiZXhwIjoxNzA5MTI4MTIyLCJzdWIiOiJiMjY4OTg0Yy0yZTUzLTRiZDEtYWE2MC1mNWU0ODczZjUwODUiLCJzY29wZXMiOlsiY2FydC1yZWFkIiwiY2FydC13cml0ZSIsImNvbXBhbmllcy1yZWFkIiwiY29tcGFuaWVzLXdyaXRlIiwiY291cG9ucy1yZWFkIiwiY291cG9ucy13cml0ZSIsIm5vdGlmaWNhdGlvbnMtcmVhZCIsIm9yZGVycy1yZWFkIiwicHJvZHVjdHMtcmVhZCIsInByb2R1Y3RzLWRlc3Ryb3kiLCJwcm9kdWN0cy13cml0ZSIsInB1cmNoYXNlcy1yZWFkIiwic2hpcHBpbmctY2FsY3VsYXRlIiwic2hpcHBpbmctY2FuY2VsIiwic2hpcHBpbmctY2hlY2tvdXQiLCJzaGlwcGluZy1jb21wYW5pZXMiLCJzaGlwcGluZy1nZW5lcmF0ZSIsInNoaXBwaW5nLXByZXZpZXciLCJzaGlwcGluZy1wcmludCIsInNoaXBwaW5nLXNoYXJlIiwic2hpcHBpbmctdHJhY2tpbmciLCJlY29tbWVyY2Utc2hpcHBpbmciLCJ0cmFuc2FjdGlvbnMtcmVhZCIsInVzZXJzLXJlYWQiLCJ1c2Vycy13cml0ZSIsIndlYmhvb2tzLXJlYWQiLCJ3ZWJob29rcy13cml0ZSIsInRkZWFsZXItd2ViaG9vayJdfQ.ZpXNoQJlNevstIsKb_kk0b-u8yOPaasi5mt-4nyU3Sbl6dQ8UdQxq8QJEtfSgvzywHUD6zEuCD0I5zGaYwv2-ZMXnaT9-mk1LYnQpbFUQTOnHmc8UbDs3w84IFrr-PUDOL6rxLrcwzZXj0ZF2WIfvSIx_gN62ToYgqusH0rfMz84LX_VsuWJ0oWLoqIq5eHrZueMvWyynu5tByJw0PgTBFgo4vmrUUzIqJ3_kOTcDQrGah3YpzF3SWF8ZG65mcygww5IJEy6zGcPA8IeELKLxsl6NVWG1AZbSE3BXhiJ-4PH3TGFTbbHlxLM1te5TJEhAlUZ0KnzswHn037ZH1wZRj2rNKr4-QLOHmq6HW1Tf44Fu9hBqE7ea5Y1bwEcrjxwN79Stv1bybZXZ8rImYTNcW-Oep4nEvFz5KPOHdWxdnOPsTfvb4J71jyuWzeKbcLOk0o3wOzfJpC9LuRZWHVNSgBmrJFtNVhNLmVnBveGa43m_7cDAn6NedZicvV5u_t-xyo_h69pZCY2OuyF4Y0xhogY7Bw5yUA-qqvW1-gh88aV_abjesWHN3QwdBoiFCgsfCG4sbVxKFcHuqiUX3VsoK1zcWFwB2FCdj2aBJRKIHrjvjDoGYWMyopDykmG-S6q-Hr9hk3L0uKnQqSywfLWN5m6cdzrLBbvXzJAfwMgn-Q';

                axios.get('https://melhorenvio.com.br/api/v2/me/shipment/calculate', {
                    headers: {
                        Authorization: `Bearer ${apiKey}`
                    },
                    params: {
                        from: {
                            postal_code: "88320-000"
                        },

                        to: {
                            postal_code: inputValue
                        },
                        products: [{
                            width: 11,
                            height: 17,
                            length: 11,
                            weight: 0.3,
                            quantity: 1
                        }, ]
                    }
                })
                    .then(response => {
                        var b = document.createElement('b');
                        b.innerHTML = `<span class="mtext-101 cl2">Valores do Frete : </span>`
                        document.getElementById('container').appendChild(b);
                        for (let i = 0; i < response.data.length; i++) {
                            if (response.data[i].error != "Serviço econômico indisponível para o trecho." && response.data[i]
                                .price != undefined) {
                                let html =
                                    `<div class="d-flex">
         <input onclick="pegarId(${response.data[i].id}, ${response.data[i].price}); marcaDesmarca(this)" id="${response.data[i].id}" type="checkbox"/>
         <li class="ml-2" id="${response.data[i].id}"> ${response.data[i].name + " = " + " R$ " + response.data[i].price}</li>
            </div>`
                                let div = document.createElement('div');
                                div.innerHTML = html;
                                document.getElementById('container').appendChild(div);



                            }
                        }
                        let valor = document.cookie.replace(/(?:(?:^|.*;\s*)fretevlr\s*\=\s*([^;]*).*$)|^.*$/, "$1");
                        let id = document.cookie.replace(/(?:(?:^|.*;\s*)freteId\s*\=\s*([^;]*).*$)|^.*$/, "$1");

                        if (valor != "") {
                            document.getElementById("vlrdefault").style.display = "none";

                            let p = document.createElement('p');
                            p.innerHTML = `R$ ${valor}`
                            document.getElementById('vlrfrete').appendChild(p);


                            document.getElementById("vlrTotaldefault").style.display = "none";
                            let subtotal = $("#subtotal").val()
                            let soma = somar(subtotal, valor)
                            let p2 = document.createElement('p');
                            p2.innerHTML = `R$ ${soma}`
                            document.getElementById('vlrTotal').appendChild(p2);


                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });

                var iframe = document.getElementById("UolPS-lightbox");
                console.log(iframe)
                // Obtém o documento dentro do iframe
                var iframeDoc = iframe.contentWindow.document;

                // Obtém o botão dentro do documento pelo seu ID
                var botao = iframeDoc.getElementById("meuBotao");

                // Adiciona um ouvinte de evento para o botão
                botao.addEventListener("click", function() {
                    // Coloque aqui o código que será executado ao clicar no botão
                    console.log("Botão clicado!");
                });
            });
        </script>

        <script>



            function marcaDesmarca(caller) {
                var checks = document.querySelectorAll('input[type="checkbox"]');
                for(let i = 0; i < checks.length; i++) {
                    checks[i].checked = checks[i] == caller;
                }
            }
            function somar(subtotal, valor) {
                return parseFloat(subtotal) + parseFloat(valor);
            }

            function pegarId(id, preco) {

                const minhaDiv = document.getElementById("vlrfrete");
                const segundoParagrafo = minhaDiv.children[1];
                if(segundoParagrafo != null || segundoParagrafo != undefined)
                    segundoParagrafo.remove();

                document.getElementById("vlrdefault").style.display = "none";
                //document.getElementById("btnNotFrete").style.display = "none";
                // localStorage.setItem('preco', preco);
                // localStorage.setItem('id', id);

                // Define a variável que deseja armazenar nos cookies
                let fretevlr = preco;
                let freteId = id;


                // Define a data de expiração do cookie (opcional)
                let dataExpiracao = new Date();
                dataExpiracao.setTime(dataExpiracao.getTime() + (10 * 60 * 1000)); // expira em 10 minutos

                // Armazena a variável nos cookies
                document.cookie = "fretevlr=" + fretevlr + "; expires=" + dataExpiracao.toUTCString() + "; path=/";
                document.cookie = "freteId=" + freteId + "; expires=" + dataExpiracao.toUTCString() + "; path=/";



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

            }
        </script>
    @endsection
    @component('components.topWhite', ['carrinho' => $carrinho])
    @endcomponent
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('index') }}"  class="stext-109 cl8 hov-cl1 trans-04">
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
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">

                    <div style="margin-top: 10%">
                        @if($endereco != null)
                        <div class="container">
                            <div class="row" style="margin-left: 3%;">
                                <h4 class="mtext-109 cl2 p-b-30">
                                    Seu endereço
                                </h4>
                            </div>
                        </div>
                            @foreach($endereco as $ender)
                            <div class="container">
                                <div class="col-12 col-md-12" style="width: 100%">
                                    <div class="flex-w  p-b-10">
                                        <div class="wid-full respon6-next">
                                            <div class="rs1-select2 bor8 bg0">
                                                <div id="removeShow" class="d-flex" style="height: 45px">
                                                    <input type="radio" checked="true" id="cartao_credito" style="margin-left: 2%" >
                                                    <label  style="margin: auto auto auto 10px;">{{$ender->logradouro}}, {{$ender->numero}},
                                                        {{$ender->bairro}}, {{$ender->cidade}}, {{$ender->cep}} </label>
                                                    <button id="editbutao" onclick="edit()" class="display-edit">Editar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                        <form  action="{{route('adicionar_endereco')}}" method="POST" >
                                @csrf
                                <div class="container">
                                    <div class="row" style="margin-left: 3%;">
                                        <h4 class="mtext-109 cl2 p-b-30">
                                            Cadastre um endereço
                                        </h4>
                                    </div>
                                </div>
                                <input type="hidden" id="usuario_id" value="{{Auth::user()->id}}" name="usuario_id">
                                <div class="col-md-12 col-12 d-flex">
                                    <div class="col-6 col-md-6">
                                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12">
                                            <select class="js-select2" name="estado">
                                                <option>Estado...</option>
                                                <option value="AC">Acre</option>
                                                <option value="AL">Alagoas</option>
                                                <option value="AP">Amapá</option>
                                                <option value="AM">Amazonas</option>
                                                <option value="BA">Bahia</option>
                                                <option value="CE">Ceará</option>
                                                <option value="DF">Distrito Federal</option>
                                                <option value="ES">Espírito Santo</option>
                                                <option value="GO">Goiás</option>
                                                <option value="MA">Maranhão</option>
                                                <option value="MT">Mato Grosso</option>
                                                <option value="MS">Mato Grosso do Sul</option>
                                                <option value="MG">Minas Gerais</option>
                                                <option value="PA">Pará</option>
                                                <option value="PB">Paraíba</option>
                                                <option value="PR">Paraná</option>
                                                <option value="PE">Pernambuco</option>
                                                <option value="PI">Piauí</option>
                                                <option value="RJ">Rio de Janeiro</option>
                                                <option value="RN">Rio Grande do Norte</option>
                                                <option value="RS">Rio Grande do Sul</option>
                                                <option value="RO">Rondônia</option>
                                                <option value="RR">Roraima</option>
                                                <option value="SC">Santa Catarina</option>
                                                <option value="SP">São Paulo</option>
                                                <option value="SE">Sergipe</option>
                                                <option value="TO">Tocantins</option>
                                                <option value="EX">Estrangeiro</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="cidade" id="cidade"
                                                   placeholder="Cidade">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12 d-flex">
                                    <div class="col-6 col-md-3">
                                        <div class="bor8 bg0 m-b-22">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="cep" id="cep"
                                                   placeholder="Cep">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="bor8 bg0 m-b-22">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="bairro" id="bairro"
                                                   placeholder="Bairro">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-5">
                                        <div class="bor8 bg0 m-b-22">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="logradouro" id="logradouro"
                                                   placeholder="Rua">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12 d-flex">
                                    <div class="col-6 col-md-8">
                                        <div class="bor8 bg0 m-b-22">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="complemento" id="complemento"
                                                   placeholder="Complemento">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="bor8 bg0 m-b-22">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="numero" id="numero"
                                                   placeholder="Numero">
                                        </div>
                                    </div>

                                </div>
                            <div class="col-md-12 col-12 d-flex">
                                <div class="col-6 col-md-12" style="display: flex;flex-direction: row-reverse;">
                                    <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10" type="submit">
                                        Enviar
                                    </button>
                                </div>

                            </div>

                            </form>
                        @endif
                    </div>
                    <div id="edit">

                    </div>

                </div>




                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Resumo da compra
                        </h4>
                        @if($cep != null)
                            <input type="hidden" id="myInput" value="{{$cep->cep}}">
                        @else
                            <input type="hidden" id="myInput" value="00000-000">

                        @endif
                        @php $subtotal = 0; @endphp
                        <ul class="header-cart-wrapitem w-full">
                            @foreach ($carrinho as $indice => $cart)
                                <input type="hidden" value="{{ $cart->price }}" />
                                <input type="hidden" value="{{ $cart->quantity }}" />
                                @php $subtotal += $cart->price * $cart->quantity ; @endphp
                                <input type="hidden" id="subtotal" value="{{ $subtotal }}" />
                            @endforeach
                            @if (count($carrinho) == 1)
                                @foreach ($carrinho as $indice => $cart)
                                    <li class="header-cart-item flex-w flex-t m-b-12">
                                        <div class="header-cart-item-img">
                                            <img src="{{ asset($cart->attributes->foto) }}" alt="IMG">
                                        </div>

                                        <div class="header-cart-item-txt p-t-8">
                                            <a href="{{ route('details', [$cart->id]) }}"
                                               class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                                {{ $cart->name }}
                                            </a>
                                            <div class="d-flex">
                                <span class="header-cart-item-info">
                                    {{ $cart->quantity }} x R${{ $cart->price }}
                                </span>
                                            </div>

                                        </div>
                                    </li>
                                    @php $subtotal += $cart->valor ; @endphp
                                @endforeach
                            @else
                                <div class="flex-w flex-t p-t-27 p-b-33 bor12">
                                    <div class="size-208">
                        <span class="mtext-101 cl2">
                            Produtos ({{ count($carrinho) }}):
                        </span>
                                    </div>

                                    <div class="size-209 p-t-1">
                        <span class="mtext-110 cl2">
                            R$ {{ $subtotal }}
                        </span>
                                    </div>
                                </div>

                            @endif

                        </ul>


                        <div class="flex-w flex-t p-t-27 p-b-33 bor12">
                            <div class="container" id="container" style="padding-left: 0;">

                            </div>
                            <div class="size-208" style="margin-top: 5%">
                <span class="mtext-101 cl2">
                    Frete:
                </span>
                            </div>

                            <div class="size-209 p-t-1" style="margin-top: 5%">
                <span class="mtext-110 cl2" id="vlrfrete">
                    <p id="vlrdefault">R$ 0</p>
                </span>
                            </div>
                        </div>
                        <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208">
                <span class="mtext-101 cl2">
                    Total:
                </span>
                            </div>

                            <div class="size-209 p-t-1">
                <span class="mtext-110 cl2" id="vlrTotal">
                    <p id="vlrTotaldefault">R$ {{ $subtotal }}</p>

                </span>
                            </div>
                        </div>


                        @if ($endereco == null)
                            <a class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer js-addadress"
                               style="color: #fff">
                                Ir para o pagamento
                            </a>
                        @elseif(count($carrinho) == 0)
                            <a class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer js-addproduct"
                               style="color: #fff">
                                Ir para o pagamento
                            </a>

                        @else
                                <?php
                                include_once("../PagSeguroLibrary/PagSeguroLibrary.php");

                            if (PagSeguroConfig::getEnvironment() == "sandbox") : ?>
                                <!--Para integração em ambiente de testes no Sandbox use este link-->
                            <script type="text/javascript"
                                    src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
                            <?php else : ?>
                                <!--Para integração em ambiente de produção use este link-->
                            <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js">
                            </script>
                            <?php endif; ?>
                                <?php

                                if (isset($_GET['pagar'])) {
                                    //https://m.pagseguro.uol.com.br/v3/guia-de-integracao/tutorial-da-biblioteca-pagseguro-em-php.html?_rnt=dd#configuracao
                                    //https://sandbox.pagseguro.uol.com.br/

                                    $paymentRequest = new PagSeguroPaymentRequest();
                                    foreach ($carrinho as $e) {
                                        $paymentRequest->addItem($e->id, $e->name, intval($e->quantity), floatval($e->price));
                                    }


                                    $vlrFrete = $_COOKIE['fretevlr'];
                                    $paymentRequest->addItem('0000', 'Frete', 1, floatval($vlrFrete));
                                    $sedexCode = PagSeguroShippingType::getCodeByType('SEDEX');
                                    $paymentRequest->setShippingType($sedexCode);
                                    foreach ($endereco as $e) {
                                        $paymentRequest->setShippingAddress($e->cep, $e->logradouro, $e->numero, $e->complemento, $e->bairro, $e->cidade, $e->estado, 'BRA');
                                    }
                                    $nome = Auth::user()->name;
                                    $email = Auth::user()->email;
                                    $paymentRequest->setSender($nome, $email);

                                    $paymentRequest->setSender($nome , $email, '47', '992801006');

                                    $paymentRequest->setCurrency('BRL');

                                    // Referenciando a transação do PagSeguro em seu sistema
                                    $paymentRequest->setReference('REF123');

                                    // URL para onde o comprador será redirecionado (GET) após o fluxo de pagamento
                                    $paymentRequest->setRedirectUrl('https://zebrinha.gjdesenvolvimento.com.br');

                                    // URL para onde serão enviadas notificações (POST) indicando alterações no status da transação
                                    $paymentRequest->addParameter('notificationURL', 'https://zebrinha.gjdesenvolvimento.com.br/checkout/pagamento');

                                    $paymentRequest->addParameter('senderBornDate', '07/05/1981');

                                    try {
                                        $onlyCheckoutCode = true;
                                        $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()
                                        $checkoutUrl = $paymentRequest->register($credentials, $onlyCheckoutCode);

                                        echo "<script>PagSeguroLightbox('" . $checkoutUrl . "');</script>";

                                    } catch (PagSeguroServiceException $e) {
                                        die($e->getMessage());
                                    }

                                }
                                ?>
                            <form  method="GET">
                                <button type="submit" name="pagar"
                                        class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">

                                    Ir para o pagamento
                                </button>
                            </form>



                        @endif



                    </div>
                </div>
            </div>
        </div>

    </div>
    <style>
        .display-edit{
            display: flex;
            align-content: center;
            flex-wrap: wrap;
            padding-right: 1rem;
        }
    </style>
@endsection

