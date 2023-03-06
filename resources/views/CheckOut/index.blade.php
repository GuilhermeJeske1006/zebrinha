<!-- breadcrumb -->
@extends('components.body')

@section('body')
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
                                                <div class="d-flex" style="height: 45px">
                                                    <input type="radio" checked="true" id="cartao_credito" style="margin-left: 2%" >
                                                    <label style="margin: auto auto auto 10px;">{{$ender->logradouro}}, {{$ender->numero}},
                                                        {{$ender->bairro}}, {{$ender->cidade}}, {{$ender->cep}} </label>
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
                </div>


                @component('CheckOut.resumo', ['carrinho' => $carrinho, 'endereco' => $endereco, 'cep' => $cep])@endcomponent

            </div>
        </div>

    </div>
@endsection

