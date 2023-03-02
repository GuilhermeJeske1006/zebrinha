                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <td class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Produto</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Preço</th>
                                    <th class="column-4">Quantidade</th>
                                    <th class="column-5">Total</th>
                                </tr>
                                @php $total = 0; @endphp
                            @foreach ($carrinho as $indice => $cart)
                                    <tr class="table_row">
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                <img src="{{ asset($cart->foto) }}" alt="IMG">
                                            </div>
                                        </td>
                                        <td class="column-2">{{ $cart->nome }}</td>
                                        <td class="column-3">R$ {{ $cart->valor }}</td>
                                        <td class="column-4">
                                            <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>

                                                <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                    name="num-product1" value="1">

                                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
                    </td>
                        <td class="column-5">R$ 36,00</td>
                        <td class="column-6">
                            <a href="{{route('excluir_carrinho', ['indice' => $indice])}}" class="header-cart-item-info" style="margin-left: 50%;">
                                <i class="fa fa-trash-o"></i>
                            </a>
                        </td>

                        </tr>
                                    @php $total += $cart->valor ; @endphp
                                @endforeach
                        </table>
                    </div>
