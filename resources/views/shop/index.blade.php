@extends('components.body')
@section('body')
    <!-- Product -->
@component('components.topWhite', ['carrinho' => $carrinho])@endcomponent
    <div class="bg0 m-t-23 p-b-140">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <a href="{{route('produto_por_id', ['idcategoria' => 0])}}" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 @if($idcategoria == 0) how-active1 @endif" data-filter="*">
                        Todos
                    </a>
                    @foreach($listaCategoria as $categoria)
                    <a href="{{route('produto_por_id', ['idcategoria' => $categoria->id])}}" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 @if($categoria->id === $idcategoria) how-active1 @endif" data-filter=".women">
                        {{$categoria->categoria}}
                    </a>
                    @endforeach

                </div>


                <div class="flex-w flex-c-m m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Filtrar
                    </div>

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
                        <form method="Get" action="{{route('produtos')}}">
                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search" placeholder="Search">
                        </form>
                    </div>
                </div>

                <!-- Filter -->
                <form  method="Get" action="{{route('produtos')}}" class="dis-none panel-filter w-full p-t-10">
                    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                        <div class="filter-col1 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Ordernar por
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                        Default
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href=""  class="filter-link stext-106 trans-04">
                                        Mais antigo
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04 ">
                                        Mais novo
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        Menor preço
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        Maior preço
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-col2 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Preço
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                        Todos
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        R$0.00 - R$50.00
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        R$50.00 - R$100.00
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        R$100.00 - R$150.00
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        R$150.00 - R$200.00
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        R$200.00+
                                    </a>
                                </li>
                            </ul>
                        </div>


                        <div class="filter-col4 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Categorias
                            </div>

                            <div class="flex-w p-t-4 m-r--5">
                                @foreach($listaCategoria as $categoria)
                                <a href="{{route('produto_por_id', ['idcategoria' => $categoria->id])}}" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    {{$categoria->categoria}}
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row isotope-grid">
                @if (count($lista) > 0)
                @component('components.card', ['lista' => $lista])@endcomponent
                @else
                <div class="container">
                    <div class="col-12">
                        <div class="row d-flex " style="justify-content: center;">
                            <h3 style="text-align: end">Nenhum produto encontrado!</h3>
                        </div>
                    </div>
                    
                </div>
                @endif
                    
                  


            </div>
            @component('vendor.pagination.simple-default', ['paginator' => $lista])@endcomponent

        </div>
    </div>@endsection
