<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
        <h4 class="mtext-109 cl2 p-b-30">
            Resumo da compra
        </h4>
        @if ($cep != null)
            <input type="hidden" id="myInput" value="{{ $cep->cep }}">
        @else
            <input type="hidden" id="myInput" value="00000-000">
        @endif
        @php $subtotal = 0; @endphp
        <ul class="header-cart-wrapitem w-full">
            @foreach ($carrinho as $indice => $cart)
                <input type="hidden" value="{{ $cart->price }}" />
                <input type="hidden" value="{{ $cart->quantity }}" />
                @php $subtotal += $cart->price * $cart->quantity ; @endphp
            @endforeach
            <input type="hidden" id="subtotal" value="{{ $subtotal }}" />

            @if (count($carrinho) == 1)
                @foreach ($carrinho as $indice => $cart)
                    <li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img">

                            <img src="{{ $admin_url . '/' . str_replace('public/', 'storage/', $cart->attributes->foto) }}"
                                alt="IMG">
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


        {{ $slot }}
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


        @if (request()->route()->getName() == 'pagamento')
            <a href="{{route('checkout')}}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer"
                style="color: #fff">
                Voltar
            </a>
        @else
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
                <div id="irPagmento"></div>

                <script>
                    $(document).ready(() => {
                        let valor = document.cookie.replace(/(?:(?:^|.*;\s*)fretevlr\s*\=\s*([^;]*).*$)|^.*$/, "$1");

                        function criarBotao(valor) {
                            if (valor == null || valor == "") {
                                let html = `
<a class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer js-addproduct"
style="color: #fff" onclick="addFrete()">
Ir para o pagamento
</a>
`
                                let div = document.createElement('a');
                                div.innerHTML = html;
                                document.getElementById('irPagmento').appendChild(div);
                            } else {
                                let html = `

                            <a href="{{ route('pagamento') }}" style="color: #fff"
        class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">

        Ir para o pagamento
    </a>
`
                                let div = document.createElement('form');
                                div.innerHTML = html;
                                document.getElementById('irPagmento').appendChild(div);
                            }
                        }

                        criarBotao(valor); // criar botão ao carregar a página

                        setInterval(() => {
                            let novoValor = document.cookie.replace(/(?:(?:^|.*;\s*)fretevlr\s*\=\s*([^;]*).*$)|^.*$/,
                                "$1");
                            if (novoValor !== valor) { // verifica se a variável valor foi atualizada
                                valor = novoValor; // atualiza a variável valor
                                $('#irPagmento').empty(); // remove o botão antigo
                                criarBotao(valor); // cria o novo botão
                            }
                        }, 1000); // verifica a cada 3 segundos (você pode ajustar o tempo de acordo com suas necessidades)
                    })
                </script>
            @endif

        @endif




    </div>
</div>
