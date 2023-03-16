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

                        <form method="Get" class="d-flex col-md-12 col-sm-12" style="padding-right: 0;" action="{{route('produtos')}}">
                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search" placeholder="Procurar por nome...">
                            <button style="background: #e6e6e6;" type="submit" class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                               <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Filter -->
                <form  method="Get" action="{{route('produtos')}}" class="dis-none panel-filter w-full p-t-10">

                    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">


                        <div class="filter-col2 p-r-15 p-b-27 mr-3">
                            <div class="mtext-102 cl2 p-b-15">
                                Preço
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <label class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" for="preco_minimo">Preço mínimo:</label>
                                    <input placeholder="R$" class="form-control" type="number" name="preco_maximo" id="preco_maximo" value="{{ old('preco_maximo') }}">

                                </li>

                                <li class="p-b-6">
                                    <label class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" for="preco_maximo">Preço máximo:</label>
                                    <input placeholder="R$"  class="form-control" type="number" name="preco_maximo" id="preco_maximo" value="{{ old('preco_maximo') }}">

                                </li>
                            </ul>
                        </div>
                        <div class="filter-col2 p-r-15 p-b-27 mr-3">
                            <div class="mtext-102 cl2 p-b-15">
                                Categorias
                            </div>
                            <ul>
                                <li class="p-b-6">
                                    <label for="preco_minimo">Todas as categorias:</label>
                                    <select style="min-width: 100%;" class="custom-select" name="categoria" id="categoria">
                                        <option value="">Todas as categorias</option>
                                        @foreach ($listaCategoria as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                                        @endforeach
                                      </select>
                                </li>
                            </ul>


                        </div>
                        <div class="filter-col4 p-b-27 filtrar-btn">
                        </div>
                        <div class="filter-col4 p-b-27 filtrar-btn">
                            <button class="btn flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4" style="background: #fff;" type="submit">Filtrar</button>
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
    </div>
    <style>
        .filtrar-btn {
            align-items: end;
            display: flex;
            flex-direction: column-reverse;
        }
    </style>
    @endsection
