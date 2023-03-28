<!-- breadcrumb -->
@extends('components.body')

@section('body')
    @component('components.topWhite', ['carrinho' => $carrinho])@endcomponent
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="{{route('index')}}" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="{{route('produtos')}}" class="stext-109 cl8 hov-cl1 trans-04">
            Produtos
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
                {{$produto->nome}}
        </span>
    </div>
</div>


<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="wrap-slick3-dots"></div>
                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                        <div class="slick3 gallery-lb">
                            <div class="item-slick3" data-thumb="{{asset($produto->foto)}}">
                                <div class="wrap-pic-w pos-relative">
                                    <img src="{{asset($produto->foto)}}" alt="IMG-PRODUCT">

                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset($produto->foto)}}">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                            </div>
                            @foreach($imagens as $img)
                            <div class="item-slick3" data-thumb="{{asset($img->imagem)}}">
                                <div class="wrap-pic-w pos-relative">
                                    <img src="{{asset($img->imagem)}}" alt="IMG-PRODUCT">

                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset($img->imagem)}}">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        {{$produto->nome}}
                    </h4>

                    <span class="mtext-106 cl2">
							R${{$produto->valor}}
						</span>

                    <p class="stext-102 cl3 p-t-23">
                        {{$produto->descricao}}
                    </p>

                    <!--  -->
                    @if(count($tamanhos) != 0)
                        <form method="POST" action="{{ route('adicionar_carrinho') }}">
                            @csrf
                    <div  class="p-t-33">
                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-203 flex-c-m respon6">
                                Tamanho
                            </div>

                            <div class="size-204 respon6-next">
                                <div class="rs1-select2 bor8 bg0">
                                    <select onclick="verifica()" onchange="atualizaQuantidadeMaxima()" class="js-select2" name="tamanho" id="tamanho">
                                        <option value="">Selecione o tamanho</option>
                                        @foreach($tamanhos as $item)
                                            <option value="{{$item->tamanho}}" data-quantidade="{{$item->qtdTamanho}}">{{$item->tamanho}}</option>
                                        @endforeach
                                    </select>

                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>



                        </div>
                        </div>

                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-204 flex-w flex-m respon6-next">
                                <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </div>

                                    <input class="mtext-104 cl3 txt-center num-product" type="number"name="quantity" id="qtd" value="1" min="1">

                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div id="divAdd">
                                <a style="text-align: center;
                                font-size: 14px;color: #fff;" onclick="valid()" id="addcart" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    Adicionar ao carrinho
                            </a>
                            </div>

                        </div>
                        <br>

                        <div class="flex-w flex-r-m p-b-10" style="margin-top: 3%">
                            <div class="size-203 flex-c-m respon6" style=" margin-bottom: 5%;">
                                Frete
                            </div>

                            <div class="size-204 respon6-next">
                                <div class="bor8 bg0 m-b-22 d-flex">
                                    <input class="cep stext-111 cl8 plh3 size-111 p-lr-15" type="text"
                                           name="cep"  id="cep" placeholder="Insira o seu cep">
                                    <a
                                        onclick="calculaFrete()"
                                        class="flex-c-m stext-101 hov-btn3 p-lr-15 trans-04 pointer" >
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div>

                            </div>


                        </div>
                        <div class="flex-w flex-r-m p-b-10" style="margin-bottom: 3%; display: block;">
                            <div class=" flex-c-m respon6 displayFrete" id="card" style="flex-direction: column;">
                                <div  id="container">

                            </div>

                        </div>
                            <input type="hidden" name="produtoId" value="{{$produto->id}}">
                            <input type="hidden" name="name" value="{{$produto->nome}}">
                            <input type="hidden" name="price" value="{{$produto->valor}}">
                            <input type="hidden" name="foto" value="{{$produto->foto}}">


                        </form>
                    </div>
                    @endif
                    @if(count($tamanhos) == 0)
                        <div class="p-t-33">


                            <div class="flex-w flex-r-m p-b-10">
                                <div class=" flex-c-m respon6" style="text-align: center" >
                                   <h5>Este produto não se encontra no estoque atualmente!</h5>
                                </div>
                            </div>

                        </div>
                    @endif

                    <!--  -->
                    <div class="flex-w flex-m p-l-100 p-t-40 respon7">

                        <a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" target="_blank" data-tooltip="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="https://twitter.com/intent/tweet?url={{Request::url()}}" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" target="_blank" data-tooltip="Twitter">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{Request::url()}}" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" target="_blank" data-tooltip="Whatsapp">
                            <i class="fa fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Descrição</a>
                    </li>

                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#information" role="tab">Informação do produto</a>
                    </li>

                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-t-43">
                    <!-- - -->
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <div class="how-pos2 p-lr-15-md">
                            <p class="stext-102 cl6">
                                {{$produto->descricao_longa}}
                            </p>
                        </div>
                    </div>

                    <!-- - -->
                    <div class="tab-pane fade" id="information" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                <ul class="p-lr-28 p-lr-15-sm">
                                    @if(isset($produto->peso) && $produto->peso != null )
                                    <li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Peso
											</span>

                                        <span class="stext-102 cl6 size-206">
												{{$produto->peso}}
											</span>
                                    </li>
                                    @endif
                                    @if(isset($produto->dimensao) && $produto->dimensao != null)
                                    <li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Dimensão
											</span>

                                        <span class="stext-102 cl6 size-206">
												{{$produto->dimensao}}
											</span>
                                    </li>
                                        @endif
                                    @if(isset($produto->material) && $produto->material != null)
                                    <li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Material
											</span>

                                        <span class="stext-102 cl6 size-206">
                                            {{$produto->material}}
											</span>
                                    </li>
                                        @endif
                                        @if(isset($produto->cor) && $produto->cor != null)
                                    <li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Cores
											</span>

                                        <span class="stext-102 cl6 size-206">
												{{$produto->cor}}
											</span>
                                    </li>
                                        @endif
                                        @if(isset($produto->tamanho) && $produto->tamanho != null)
                                    <li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Tamanhos
											</span>

                                        <span class="stext-102 cl6 size-206">
												{{$produto->tamanho}}
											</span>
                                    </li>
                                        @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- - -->
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                <div class="p-b-30 m-lr-15-sm">
                                    <!-- Review -->

                                    @foreach($comentarios as $coment)

                                    <div class="flex-w flex-t p-b-68">
                                        <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                            <img src="{{asset('images/cabeca_perfil.png')}}" alt="AVATAR">
                                        </div>

                                        <div class="size-207">
                                            <div class="flex-w flex-sb-m p-b-17">
													<span class="mtext-107 cl2 p-r-20">
														{{$coment->name}}
													</span>

                                                @if($coment->estrela != null)
                                                <span class="fs-18 cl11">
                                                    @switch($coment)
                                                        @case($coment->estrela == 1)
                                                            <i class="zmdi zmdi-star zmdi-star-half"></i>
                                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                            @break
                                                        @case($coment->estrela == 2)
                                                            <i class="zmdi zmdi-star zmdi-star-half"></i>
                                                            <i class="zmdi zmdi-star zmdi-star-half"></i>
                                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                            @break
                                                        @case($coment->estrela == 3)
                                                            <i class="zmdi zmdi-star zmdi-star-half"></i>
                                                            <i class="zmdi zmdi-star zmdi-star-half"></i>
                                                            <i class="zmdi zmdi-star zmdi-star-half"></i>
                                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                            @break
                                                        @case($coment->estrela == 4)
                                                            <i class="zmdi zmdi-star zmdi-star-half"></i>
                                                            <i class="zmdi zmdi-star zmdi-star-half"></i>
                                                            <i class="zmdi zmdi-star zmdi-star-half"></i>
                                                            <i class="zmdi zmdi-star zmdi-star-half"></i>
                                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                            @break
                                                        @case($coment->estrela == 5)
                                                            <i class="zmdi zmdi-star zmdi-star-half"></i>
                                                            <i class="zmdi zmdi-star zmdi-star-half"></i>
                                                            <i class="zmdi zmdi-star zmdi-star-half"></i>
                                                            <i class="zmdi zmdi-star zmdi-star-half"></i>
                                                            <i class="zmdi zmdi-star zmdi-star-half"></i>
                                                            @break
                                                    @endswitch
													</span>

                                                @endif
                                            </div>

                                            <p class="stext-102 cl6">
                                                {{$coment->descricao}}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- Add review -->
                                    @if(Auth::check())
                                    <form action="{{route('comentar')}}" method="POST" class="w-full">
                                        @csrf
                                        <h5 class="mtext-108 cl2 p-b-7">
                                            Adicione o seu review
                                        </h5>

                                        <p class="stext-102 cl6">
                                            Seu endereço de e-mail não será publicado. Os campos obrigatórios estão marcados*
                                        </p>

                                        <div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Sua avaliação
												</span>

                                            <span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input class="dis-none" type="number" name="estrela" id="estrela">
												</span>
                                        </div>
                                        <input type="hidden" id="produto_id" value="{{$produto->id}}" name="produto_id">
                                        <input type="hidden" id="usuario_id" value="{{Auth::user()->id}}" name="usuario_id">
                                        <div class="row p-b-25">
                                            <textarea  class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="descricao" name="descricao"></textarea>
                                        </div>

                                        <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                            Enviar
                                        </button>
                                    </form>
                                    @endif
                                    @if(Auth::guest())
                                        <p class="stext-102 cl6" style="text-align: center">
                                           <b> Se você quiser comentar por favor faça o <a href="{{route('login')}}" >Login</a>
                                            ou <a href="{{route('register')}}"> registre-se</a></b>
                                        </p>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>

    <style>
        @media only screen and (max-width: 600px) {
            .displayFrete {
                display: contents;
            }
        }
    </style>

    @section('scriptjs')

        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        <script defer>
            function calculaFrete(){
                const apiKey = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM4MzdjNDg5MmZlYWJkMTU2NjhhZjVkNDg4YjI0MzdlMmE1ZWM2YmUzYzYwNGIzYTk5ZjUxNTMxMDJjOGRlZTg4NjhmZTMyNWQ5Y2Q5ODNjIn0.eyJhdWQiOiIxIiwianRpIjoiYzgzN2M0ODkyZmVhYmQxNTY2OGFmNWQ0ODhiMjQzN2UyYTVlYzZiZTNjNjA0YjNhOTlmNTE1MzEwMmM4ZGVlODg2OGZlMzI1ZDljZDk4M2MiLCJpYXQiOjE2Nzc1OTIxMjIsIm5iZiI6MTY3NzU5MjEyMiwiZXhwIjoxNzA5MTI4MTIyLCJzdWIiOiJiMjY4OTg0Yy0yZTUzLTRiZDEtYWE2MC1mNWU0ODczZjUwODUiLCJzY29wZXMiOlsiY2FydC1yZWFkIiwiY2FydC13cml0ZSIsImNvbXBhbmllcy1yZWFkIiwiY29tcGFuaWVzLXdyaXRlIiwiY291cG9ucy1yZWFkIiwiY291cG9ucy13cml0ZSIsIm5vdGlmaWNhdGlvbnMtcmVhZCIsIm9yZGVycy1yZWFkIiwicHJvZHVjdHMtcmVhZCIsInByb2R1Y3RzLWRlc3Ryb3kiLCJwcm9kdWN0cy13cml0ZSIsInB1cmNoYXNlcy1yZWFkIiwic2hpcHBpbmctY2FsY3VsYXRlIiwic2hpcHBpbmctY2FuY2VsIiwic2hpcHBpbmctY2hlY2tvdXQiLCJzaGlwcGluZy1jb21wYW5pZXMiLCJzaGlwcGluZy1nZW5lcmF0ZSIsInNoaXBwaW5nLXByZXZpZXciLCJzaGlwcGluZy1wcmludCIsInNoaXBwaW5nLXNoYXJlIiwic2hpcHBpbmctdHJhY2tpbmciLCJlY29tbWVyY2Utc2hpcHBpbmciLCJ0cmFuc2FjdGlvbnMtcmVhZCIsInVzZXJzLXJlYWQiLCJ1c2Vycy13cml0ZSIsIndlYmhvb2tzLXJlYWQiLCJ3ZWJob29rcy13cml0ZSIsInRkZWFsZXItd2ViaG9vayJdfQ.ZpXNoQJlNevstIsKb_kk0b-u8yOPaasi5mt-4nyU3Sbl6dQ8UdQxq8QJEtfSgvzywHUD6zEuCD0I5zGaYwv2-ZMXnaT9-mk1LYnQpbFUQTOnHmc8UbDs3w84IFrr-PUDOL6rxLrcwzZXj0ZF2WIfvSIx_gN62ToYgqusH0rfMz84LX_VsuWJ0oWLoqIq5eHrZueMvWyynu5tByJw0PgTBFgo4vmrUUzIqJ3_kOTcDQrGah3YpzF3SWF8ZG65mcygww5IJEy6zGcPA8IeELKLxsl6NVWG1AZbSE3BXhiJ-4PH3TGFTbbHlxLM1te5TJEhAlUZ0KnzswHn037ZH1wZRj2rNKr4-QLOHmq6HW1Tf44Fu9hBqE7ea5Y1bwEcrjxwN79Stv1bybZXZ8rImYTNcW-Oep4nEvFz5KPOHdWxdnOPsTfvb4J71jyuWzeKbcLOk0o3wOzfJpC9LuRZWHVNSgBmrJFtNVhNLmVnBveGa43m_7cDAn6NedZicvV5u_t-xyo_h69pZCY2OuyF4Y0xhogY7Bw5yUA-qqvW1-gh88aV_abjesWHN3QwdBoiFCgsfCG4sbVxKFcHuqiUX3VsoK1zcWFwB2FCdj2aBJRKIHrjvjDoGYWMyopDykmG-S6q-Hr9hk3L0uKnQqSywfLWN5m6cdzrLBbvXzJAfwMgn-Q';

                let b = document.getElementById('container')
                if(b.children.length > 1){
                    while (b.firstChild) {
                        b.removeChild(b.firstChild);
                    }
                }

                axios.get('https://melhorenvio.com.br/api/v2/me/shipment/calculate', {
                    headers: {
                        Authorization: `Bearer ${apiKey}`
                    },
                    params: {
                        from: {
                            postal_code: "88320-000"
                        },
                        to: {
                            postal_code: $(".cep").val(),
                        },
                        products: {
                            width: 11,
                            height: 17,
                            length: 11,
                            weight: 0.3,
                            quantity: 1
                        }
                    }
                })
                    .then(response => {
                        console.log(response.data.length)

                        var b = document.createElement('b');
                        b.innerHTML = "<b>Valor do Frete : </b>"
                        document.getElementById('container').appendChild(b);
                        for(let i =0; i < response.data.length; i++ ){
                            if(response.data[i].error != "Serviço econômico indisponível para o trecho." && response.data[i].price != undefined){
                                var button = document.createElement('li');
                                button.innerHTML = response.data[i].name + " = " + " R$ " + response.data[i].price
                                document.getElementById('container').appendChild(button);
                            }

                        }

                    })
                    .catch(error => {
                        console.log(error);
                    });
            }



            function valid() {
                var comboNome = document.getElementById("tamanho");
                if (comboNome.options[comboNome.selectedIndex].value == "" ){
                    addTamanho()
                    return false
                }
                else{
                    document.getElementById("addcart").style.display = "none";
                    var html = `
            <button style="text-align: center;
                            font-size: 14px;"  type="submit" id="btnaddcart" onclick="addProductcart()" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                Adicionar ao carrinho
                        </button>
            `
                    let div = document.createElement('button');
                    div.innerHTML = html;
                    document.getElementById('divAdd').appendChild(div);
                }

            }
        </script>
        <script>
            $(document).ready(() => {
                // seleciona o elemento select
                const mySelect = $("#tamanho");


                // adiciona um listener para o evento "change" do elemento select
                mySelect.change(() => {
                   let  addcart = document.getElementById('addcart')
                    if(addcart != null  || addcart != undefined)
                        addcart.remove()
                   const btnaddcart =  document.getElementById("btnaddcart");
                    const divAdd = document.getElementById("divAdd");

                    if(mySelect.val() != ""){
                        if(addcart != null  || addcart != undefined)
                            addcart.remove()
                        if(btnaddcart == null  || btnaddcart == undefined){
                            var html = `
            <button style="text-align: center;
                            font-size: 14px;"  type="submit" id="btnaddcart" onclick="addProductcart()" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                Adicionar ao carrinho
                        </button>
            `
                            let div = document.createElement('button');
                            div.innerHTML = html;
                            document.getElementById('divAdd').appendChild(div);
                        }
                    }

                    if(mySelect.val() == ""){
                        if(btnaddcart != null  || btnaddcart != undefined)
                            btnaddcart.remove()
                        if(addcart == null  || addcart == undefined){
                            var html = `
           <a style="text-align: center;
                                font-size: 14px;color: #fff;" onclick="valid(); addProductcart()" id="addcart" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    Adicionar ao carrinho
                            </a>
            `
                            let div = document.createElement('a');
                            div.innerHTML = html;
                            document.getElementById('divAdd').appendChild(div);
                        }

                    }


                });
            });
        </script>

        <script>
            function atualizaQuantidadeMaxima() {
                var selectTamanho = document.getElementById("tamanho");
                var inputQuantidade = document.getElementById("qtd");
                var maxQuantidade = parseInt(selectTamanho.options[selectTamanho.selectedIndex].dataset.quantidade);
                inputQuantidade.max = maxQuantidade;
                if (parseInt(inputQuantidade.value) > maxQuantidade) {
                    inputQuantidade.value = maxQuantidade;
                }
            }
        </script>


    @endsection
@endsection



