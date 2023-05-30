

@extends('components.body')
@section('body')
    <!-- Product -->
@component('components.topWhite', ['carrinho' => $carrinho])@endcomponent
    <div class="bg0 m-t-23 p-b-140">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Minhas compras
                    </h4>

                </div>


                <div class="flex-w flex-c-m m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Procurar
                    </div>
                </div>

                <!-- Search product -->

                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <div class="bor8 dis-flex p-l-15">
                        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                        <form method="Get" action="{{route('compra_historico')}}">
                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search" placeholder="Search">
                        </form>
                    </div>
                </div>

            </div>

            @if(count($listaPedido) == 0)
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="mtext-109 cl2 p-b-30" style="text-align: center;">
                                Nenhum Pedido encontrado.
                            </h4>
                        </div>

                    </div>
                </div>
            @else
            <div class="row d-flex">
                @foreach ($listaPedido as $item)
                <div class="col-sm-12 col-md-12 col-lg-12 p-b-35 isotope-item women">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="card">
                            <div class="card-header">
                                {{ date('d/m/Y H:i', strtotime($item->dt_item)) }}
                              </div>
                            <div class="card-body">
                                <div class="col-12 col-md-12 display_history d-flex">
                                    <div class="col-12 col-sm-3">
                                        <div class="d-flex ml-4">
                                        
                                            <img src="{{ $admin_url . '/' . str_replace('public/', 'storage/', $item->foto) }}" style="max-width: 15%;" alt="..." class="img-thumbnail">
                                            <div class="d-grid">
                                        <div class="d-grid ml-3">
                                            <p class="stext-107 "><b class="black">{{$item->nome}}</b> </p>
                                        </div>
                                        <div class="d-grid ml-3">
                                            <p class="stext-107 "> {{$item->cor}}</p>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-sm-2 col-12">
                                        <p class="stext-107 p_display">
                                            Tamanho: {{$item->tamanho}}
                                        </p>

                                    </div>

                                    <div class="col-sm-2 col-12">
                                        <p class="stext-107 p_display">
                                            Quantidade: {{$item->quantidade}}
                                        </p>

                                    </div>
                                    <div class="col-sm-3 col-12">
                                        <p class="stext-107 p_display">
                                            Status:
                                            @switch($item->status)
                                                @case('WAITING_PAYMENT')
                                                    Aguardando pagamento
                                                @break
                                                @case('PAID')
                                                    Pago
                                                    @break
                                                @case('AVAILABLE')
                                                    Disponível
                                                    @break
                                                @case('IN_DISPUTE')
                                                    Em disputa
                                                    @break
                                                @case('CANCELLED')
                                                    Cancelado
                                                    @break
                                                @case('REFUNDED')
                                                    Devolvido
                                                    @break
                                            @endswitch
                                        </p>

                                    </div>
                                    <div class="col-sm-2 col-12">
                                        <a class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" style="height: 30px" href="{{route('details',  ['id' => $item->id])}}">Ver Produto</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach




            </div>
            @component('vendor.pagination.simple-default', ['paginator' => $listaPedido])@endcomponent
            @endif
        </div>
    </div>

    <style>
        @media only screen and (max-width: 600px) {
            .display_history {
                display: grid !important;
            }
            .p_display {
                text-align: center;
                padding: 10px;
            }
        }

    </style>
    @endsection
