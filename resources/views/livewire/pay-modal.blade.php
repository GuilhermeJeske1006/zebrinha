

<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
    <div style="margin-top: 10%">
        <div class="row">
            <div class="col-md-12 col-lg-12 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Formas de pagamento
                        </h4>
                        <div >
                            <div class="flex-w  p-b-10">
                                <div class="wid-full respon6-next">
                                    <div class="rs1-select2 bor8 bg0">

                                        <div class="d-flex" style="height: 45px">
                                            <input type="checkbox"  style="margin-left: 2%" >
                                            <label  style="margin: auto auto auto 10px;">Pix (Aprovação imediata)</label>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="flex-w  p-b-10">
                                <div class="wid-full respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <div class="d-flex" style="height: 45px">
                                            <input type="checkbox" wire:model="Credito"  id="cartao_credito" style="margin-left: 2%" >
                                            <label style="margin: auto auto auto 10px;">Cartão de crédito</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-w  p-b-10">
                                <div class="wid-full respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <div class="d-flex" style="height: 45px">
                                            <input type="checkbox" wire:model="Debito"  style="margin-left: 2%" >
                                            <label  style="margin: auto auto auto 10px;">Cartão de débito</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @if($Credito == true)
                        <div style="margin-top: 5%" >
                            <div class="container">
                                <div class="row" style="margin-left: 3%;">
                                    <h4 class="mtext-109 cl2 p-b-30">
                                        Cadastrar cartão de credito
                                    </h4>
                                </div>
                            </div>
                            <input type="text" name="hashseller">
                            <div class="col-md-12 col-12 d-flex">
                                <div class="col-6 col-md-6">

                                    <div class="bor8 bg0 m-b-12">
                                        <input class=" ncredito stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="ncredito"
                                               placeholder="Numero do cartao">
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="bor8 bg0 m-b-12">
                                        <input class="nomecartao stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="nomecartao"
                                               placeholder="Nome no cartão">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-12 d-flex">
                                <div class="col-6 col-md-4">
                                    <div class="bor8 bg0 m-b-22">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15 bandeira" type="text" name="bandeira"
                                               placeholder="Bandeira">
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="bor8 bg0 m-b-22">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15 anoexp" type="text" name="anoexp"
                                               placeholder="Expiração">
                                    </div>
                                </div>
                                <div class="col-6 col-md-2">
                                    <div class="bor8 bg0 m-b-22">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15 ncvv" type="text" name="ncvv"
                                               placeholder="CCV">
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="{{route('finalizar_pedido')}}" class="flex-w   p-b-10">
                                @csrf
                                <div class="wid-full flex-finali flex-w flex-m respon6-next">

                                    <div class="col-md-12 col-12 d-flex">
                                        <div class="col-6 col-md-12" style="display: flex;flex-direction: row-reverse;">
                                            <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10" type="submit">
                                                Enviar
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                        @endif
                        @if($Debito == true)
                            <div style="margin-top: 5%" >
                                <div class="container">
                                    <div class="row" style="margin-left: 3%;">
                                        <h4 class="mtext-109 cl2 p-b-30">
                                            Cadastrar cartão de debito
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12 d-flex">
                                    <div class="col-6 col-md-6">
                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="city"
                                                   placeholder="Numero do cartao">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="city"
                                                   placeholder="Nome no cartão">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12 d-flex">
                                    <div class="col-6 col-md-4">
                                        <div class="bor8 bg0 m-b-22">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode"
                                                   placeholder="Bandeira">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <div class="bor8 bg0 m-b-22">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="adress"
                                                   placeholder="Expiração">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <div class="bor8 bg0 m-b-22">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="number"
                                                   placeholder="CCV">
                                        </div>
                                    </div>
                                </div>
                                <form method="POST" action="{{route('finalizar_pedido')}}" class="flex-w   p-b-10">
                                    @csrf
                                    <div class="wid-full flex-finali flex-w flex-m respon6-next">

                                        <div class="col-md-12 col-12 d-flex">
                                            <div class="col-6 col-md-12" style="display: flex;flex-direction: row-reverse;">
                                                <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10" type="submit">
                                                    Enviar
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
