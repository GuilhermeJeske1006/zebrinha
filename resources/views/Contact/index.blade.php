@extends('components.body')
@section('body')
    @component('components.topWhite', ['carrinho' => $carrinho])@endcomponent
<section class="bg-img1 txt-center p-lr-15 p-tb-92 " style="background-image: url('images/fundo_preto.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Contato
    </h2>
</section>


<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <div class="flex-w flex-tr">
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <form action="{{ route('enviar_email') }}" method="POST">
                    @csrf
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Entre em contato
                    </h4>

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" name="email" id="email" placeholder="Informe o seu email">
                        <img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
                    </div>

                    <div class="bor8 m-b-30">
                        <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="mensagem" id="mensagem" placeholder="Como posso ajudar?"></textarea>
                    </div>

                    <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                        Enviar
                    </button>
                </form>
            </div>

            <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                <div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

                    <div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Endereço
							</span>

                        <p class="stext-115 cl6 size-213 p-t-18">
                            Rua Mazico Ransdorf, 41 Fundos, Centro, Ilhota, 88320-000
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

                    <div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Whatsapp
							</span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            +55 (47) 99694-2420
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

                    <div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Email de contato
							</span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            <a class="cl1" href="mailto:zebrinhakidsmodainfantil@gmail.com">
                                zebrinhakidsmodainfantil@gmail.com
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
