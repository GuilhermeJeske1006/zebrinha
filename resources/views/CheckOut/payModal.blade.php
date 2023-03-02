<div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
</div>

<!-- Modal1 -->
<div class="wrap-modal1  js-show-modal2 js-modal2 p-t-60 p-b-20">
<div class="overlay-modal1 js-hide-modal2 js-show-modal2"></div>

<div class="container">
    <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
        <button class="how-pos3 hov3 trans-04 js-show-modal2 js-hide-modal2">
            <img src="images/icons/icon-close.png" alt="CLOSE">
        </button>

        <div class="row">
            <div class="col-md-12 col-lg-12 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            Formas de pagamento
                        </h4>
                        <div class="p-t-33">
                            <div class="flex-w  p-b-10">
                                <div class="wid-full respon6-next">
                                    <div class="rs1-select2 bor8 bg0">

                                        <div class="d-flex" style="height: 45px">
                                            <input type="checkbox" style="margin-left: 2%" >
                                            <label  style="margin: auto auto auto 10px;">Pix (Aprovação imediata)</label>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="flex-w  p-b-10">
                                <div class="wid-full respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                            <div class="d-flex" style="height: 45px">
                                                <input type="checkbox" id="cartao_credito" style="margin-left: 2%" >
                                                <label style="margin: auto auto auto 10px;">Cartão de crédito</label>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-w  p-b-10">
                                <div class="wid-full respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <div class="d-flex" style="height: 45px">
                                            <input type="checkbox" style="margin-left: 2%" >
                                            <label  style="margin: auto auto auto 10px;">Cartão de débito</label>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div style="margin-top: 5%">
                            <div class="container">
                                <div class="row" style="margin-left: 3%;">
                                    <h4 class="mtext-109 cl2 p-b-30">
                                        Cadastrar cartão de credito
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

                                    <button
                                        type="submit"
                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                        Finalizar pagamento
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>


<style>
    .flex-finali {
        display: flex;
        flex-direction: row-reverse;
    }
</style>
