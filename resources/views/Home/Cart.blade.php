<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Seu carrinho
				</span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        @php $total = 0; @endphp
        <div class="header-cart-content flex-w js-pscroll">
            @if(isset($carrinho) && count($carrinho) > 0)
            <ul class="header-cart-wrapitem w-full">
                @foreach($carrinho as $indice => $cart)

                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img">
                       
                        <img src="{{$admin_url . '/' . str_replace('public/', 'storage/', $cart->attributes->foto) }}" alt="IMG">

                    </div>

                    <div class="header-cart-item-txt p-t-8">
                        <a href="{{route('details',  [$cart->attributes->produtoId])}}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            {{$cart->name}} 
                        </a>
                        <div>
                            <span class="header-cart-item-info">
								 <b>{{$cart->attributes->cor}} </b>
							</span>
                        </div>
                        <div class="d-flex">
                            <span class="header-cart-item-info">
								{{$cart->quantity}} x R$ {{$cart->price}}
							</span>
                            <span class="header-cart-item-info" style="margin-left: 3%">- {{$cart->attributes->tamanho}}</span>
                            <form action="{{route('excluir_carrinho')}}" method="POST" style="margin-left: 50%;">
                                @csrf
                                <input type="hidden" value="{{$cart->id}}" name="id">
                            <button type="submit" class="header-cart-item-info" style="margin-left: 50%;">
                                <i class="fa fa-trash-o"></i>
							</button>
                            </form>
                        </div>


                    </div>
                </li>
                    @php $total += $cart->price * $cart->quantity ; @endphp
                @endforeach
            </ul>
            @else
                <div class="container">
                    <div class="row">
                        <h5 style="text-align: center"><b>Nenhum item encontrado no carrinho.</b></h5>

                    </div>
                </div>
            @endif

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Total: R$ {{$total}}
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="{{route('checkout')}}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        Finalizar carrinho
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>




