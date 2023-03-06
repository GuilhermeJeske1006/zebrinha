@section('scriptjs')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script>
        //  const axios = require('axios');

        function somar(subtotal, valor) {
            return parseFloat(subtotal) + parseFloat(valor);
        }
        


        const apiKey =
            'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM4MzdjNDg5MmZlYWJkMTU2NjhhZjVkNDg4YjI0MzdlMmE1ZWM2YmUzYzYwNGIzYTk5ZjUxNTMxMDJjOGRlZTg4NjhmZTMyNWQ5Y2Q5ODNjIn0.eyJhdWQiOiIxIiwianRpIjoiYzgzN2M0ODkyZmVhYmQxNTY2OGFmNWQ0ODhiMjQzN2UyYTVlYzZiZTNjNjA0YjNhOTlmNTE1MzEwMmM4ZGVlODg2OGZlMzI1ZDljZDk4M2MiLCJpYXQiOjE2Nzc1OTIxMjIsIm5iZiI6MTY3NzU5MjEyMiwiZXhwIjoxNzA5MTI4MTIyLCJzdWIiOiJiMjY4OTg0Yy0yZTUzLTRiZDEtYWE2MC1mNWU0ODczZjUwODUiLCJzY29wZXMiOlsiY2FydC1yZWFkIiwiY2FydC13cml0ZSIsImNvbXBhbmllcy1yZWFkIiwiY29tcGFuaWVzLXdyaXRlIiwiY291cG9ucy1yZWFkIiwiY291cG9ucy13cml0ZSIsIm5vdGlmaWNhdGlvbnMtcmVhZCIsIm9yZGVycy1yZWFkIiwicHJvZHVjdHMtcmVhZCIsInByb2R1Y3RzLWRlc3Ryb3kiLCJwcm9kdWN0cy13cml0ZSIsInB1cmNoYXNlcy1yZWFkIiwic2hpcHBpbmctY2FsY3VsYXRlIiwic2hpcHBpbmctY2FuY2VsIiwic2hpcHBpbmctY2hlY2tvdXQiLCJzaGlwcGluZy1jb21wYW5pZXMiLCJzaGlwcGluZy1nZW5lcmF0ZSIsInNoaXBwaW5nLXByZXZpZXciLCJzaGlwcGluZy1wcmludCIsInNoaXBwaW5nLXNoYXJlIiwic2hpcHBpbmctdHJhY2tpbmciLCJlY29tbWVyY2Utc2hpcHBpbmciLCJ0cmFuc2FjdGlvbnMtcmVhZCIsInVzZXJzLXJlYWQiLCJ1c2Vycy13cml0ZSIsIndlYmhvb2tzLXJlYWQiLCJ3ZWJob29rcy13cml0ZSIsInRkZWFsZXItd2ViaG9vayJdfQ.ZpXNoQJlNevstIsKb_kk0b-u8yOPaasi5mt-4nyU3Sbl6dQ8UdQxq8QJEtfSgvzywHUD6zEuCD0I5zGaYwv2-ZMXnaT9-mk1LYnQpbFUQTOnHmc8UbDs3w84IFrr-PUDOL6rxLrcwzZXj0ZF2WIfvSIx_gN62ToYgqusH0rfMz84LX_VsuWJ0oWLoqIq5eHrZueMvWyynu5tByJw0PgTBFgo4vmrUUzIqJ3_kOTcDQrGah3YpzF3SWF8ZG65mcygww5IJEy6zGcPA8IeELKLxsl6NVWG1AZbSE3BXhiJ-4PH3TGFTbbHlxLM1te5TJEhAlUZ0KnzswHn037ZH1wZRj2rNKr4-QLOHmq6HW1Tf44Fu9hBqE7ea5Y1bwEcrjxwN79Stv1bybZXZ8rImYTNcW-Oep4nEvFz5KPOHdWxdnOPsTfvb4J71jyuWzeKbcLOk0o3wOzfJpC9LuRZWHVNSgBmrJFtNVhNLmVnBveGa43m_7cDAn6NedZicvV5u_t-xyo_h69pZCY2OuyF4Y0xhogY7Bw5yUA-qqvW1-gh88aV_abjesWHN3QwdBoiFCgsfCG4sbVxKFcHuqiUX3VsoK1zcWFwB2FCdj2aBJRKIHrjvjDoGYWMyopDykmG-S6q-Hr9hk3L0uKnQqSywfLWN5m6cdzrLBbvXzJAfwMgn-Q';

        axios.get('https://melhorenvio.com.br/api/v2/me/shipment/calculate', {
                headers: {
                    Authorization: `Bearer ${apiKey}`
                },
                params: {
                    from: {
                        postal_code: "88360000"
                    },

                    to: {
                        postal_code: 88360000
                    },
                    products: [
                            {
                            width: 11,
                            height: 17,
                            length: 11,
                            weight: 0.3,
                            quantity: 1
                        },
                    ]
                }
            })
            .then(response => {
                console.log(response.data)
                var b = document.createElement('b');
                b.innerHTML = `<p class="mtext-101 cl2">Valores do Frete : </p>`
                document.getElementById('container').appendChild(b);
                for (let i = 0; i < response.data.length; i++) {
                    if (response.data[i].error != "Serviço econômico indisponível para o trecho." && response.data[i]
                        .price != undefined) {
                        let html =
                            `<div class="d-flex">
         <input onclick="pegarId(${response.data[i].id}, ${response.data[i].price})" id="${response.data[i].id}" type="radio"/>
         <li class="ml-2" id="${response.data[i].id}"> ${response.data[i].name + " = " + " R$ " + response.data[i].price}</li>
            </div>`
                        let div = document.createElement('div');
                        div.innerHTML = html;
                        document.getElementById('container').appendChild(div);

                        response.data.filter((el) => {
                            if(el.name == "SEDEX"){
                                document.getElementById(el.id).checked = true;
                            }
                        })

                    }
                }
                if (localStorage.getItem('preco') != null) {
                    document.getElementById("vlrdefault").style.display = "none";
                    var valor = localStorage.getItem('preco')
                    var id = localStorage.getItem('id')

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
                console.log(error);
            });





        function pegarId(id, preco) {
            document.getElementById("vlrdefault").style.display = "none";

            localStorage.setItem('preco', preco);
            localStorage.setItem('id', id);


            var valor = localStorage.getItem('preco')
            let p = document.createElement('p');
            p.innerHTML = `R$ ${valor}`
            document.getElementById('vlrfrete').appendChild(p);

            let subtotal = $("#subtotal").val()
            let soma = somar(subtotal, valor)
            console.log(soma)



        }
    </script>
@endsection

<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
        <h4 class="mtext-109 cl2 p-b-30">
            Resumo da compra
        </h4>
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
                            <input type="text" name="name" id="name" value="{{$cart->name }}">
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
            <a  class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer js-addproduct"
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

            <form method="GET">
                <button type="submit" name="pagar"
                    class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">

                    Ir para o pagamento
                </button>
            </form>

            <?php
            
            if (isset($_GET['pagar'])) {
                //https://m.pagseguro.uol.com.br/v3/guia-de-integracao/tutorial-da-biblioteca-pagseguro-em-php.html?_rnt=dd#configuracao
                //https://sandbox.pagseguro.uol.com.br/
            
                $paymentRequest = new PagSeguroPaymentRequest();
                foreach ($carrinho as $e) {
                    $paymentRequest->addItem($e->id, $e->name, intval($e->quantity), floatval($e->price));
                }
                
            
                $paymentRequest->addItem('0000', 'Frete', 1, 10.61);
                $sedexCode = PagSeguroShippingType::getCodeByType('SEDEX');
                $paymentRequest->setShippingType($sedexCode);
                foreach ($endereco as $e) {
                    $paymentRequest->setShippingAddress($e->cep, $e->logradouro, $e->numero, $e->complemento, $e->bairro, $e->cidade, $e->estado, 'BRA');
                }
                $nome = Auth::user()->name;
                $email = Auth::user()->email;
                $paymentRequest->setSender(
                    $nome,
                    $email,
                    );
                
                // $paymentRequest->setSender($nome , $email, '47', '992801006');

            
                $paymentRequest->setCurrency('BRL');
            
                // Referenciando a transação do PagSeguro em seu sistema
                $paymentRequest->setReference('REF123');
            
                // URL para onde o comprador será redirecionado (GET) após o fluxo de pagamento
                // $paymentRequest->setRedirectUrl('https://www.amazon.com.br/');
            
                // URL para onde serão enviadas notificações (POST) indicando alterações no status da transação
                $paymentRequest->addParameter('notificationURL', 'https://tutoriaiseinformatica.com/sdkpagseguro/response.php');
            
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
        @endif

    </div>
</div>
