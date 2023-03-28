<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">

            <div class="col-sm-6 col-lg-4 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Categorias
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Meninas
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Meninos
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Outros
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6 col-lg-4 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Entre em contato
                </h4>

                <p class="stext-107 cl7 size-201">
                    Alguma Duvida? Entre em contato no nosso whatsapp (47) 99694-2420
                </p>

                <div class="p-t-27">
                    <a href="#" target="_blank" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-instagram"></i>
                    </a>

                    <a href="https://api.whatsapp.com/send?phone=5547996942420&text=Olá, gostaria de falar com um especialista!" target="_blank" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-whatsapp"></i>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Inscreva-se
                </h4>

                <form method="POST" action="{{route('enviar_newsletter')}}">
                    @csrf
                    <div class="wrap-input1 w-full p-b-4">
                        <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
                        <div class="focus-input1 trans-04"></div>
                    </div>

                    <div class="p-t-18">
                        <button type="submit" class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                            Enviar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="p-t-40">
            <div class="flex-c-m flex-w p-b-18">
                <a  class="m-all-1">
                   <img src="{{asset('images/icons/icon-pay-01.png')}}" alt="ICON-PAY">
                </a>

                <a  class="m-all-1">
                    <img src="{{asset('images/icons/icon-pay-02.png')}}" alt="ICON-PAY">
                </a>

               <a  class="m-all-1">
                    <img src="{{asset('images/icons/icon-pay-03.png')}}" alt="ICON-PAY">
               </a>

                <a  class="m-all-1">
                   <img src="{{asset('images/icons/icon-pay-04.png')}}" alt="ICON-PAY">
                </a>

               <a hlass="m-all-1">
                   <img src="{{asset('images/icons/icon-pay-04.png')}}" alt="ICON-PAY">
               </a>
            </div>

            <p class="stext-107 cl6 txt-center">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright ©2023 | Desenvolvido por nuzze.com.br

            </p>
        </div>
    </div>
</footer>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=5547996942420&text=Olá, gostaria de falar com a atendente." style="position:fixed;width:60px;height:60px;bottom:40px;right:40px;background-color:#25d366;color:#FFF;border-radius:50px;text-align:center;font-size:30px;box-shadow: 1px 1px 2px #888;
  z-index:1000;" target="_blank">
    <i style="margin-top:16px" class="fa fa-whatsapp"></i>
</a>

