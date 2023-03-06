@extends('components.body')
@section('scriptjs')

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

@endsection


@section('body')
    @component('components.topWhite', ['carrinho' => $carrinho])
    @endcomponent
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('index') }}" class="stext-109 cl8 hov-cl1 trans-04">
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
                <?php 
                include_once("../PagSeguroLibrary/PagSeguroLibrary.php");
            
                if (PagSeguroConfig::getEnvironment() == "sandbox") : ?>
                    <!--Para integração em ambiente de testes no Sandbox use este link-->
                    <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js">
                    </script>
                <?php else : ?>
                    <!--Para integração em ambiente de produção use este link-->
                    <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
                <?php endif; ?>
            
                    <form method="GET">
                        @csrf
                        <input type="submit" name="pagar" value="Pagar"/>
                    </form>
            
                    <?php

                    if(isset($_GET['pagar'])){
                        //https://m.pagseguro.uol.com.br/v3/guia-de-integracao/tutorial-da-biblioteca-pagseguro-em-php.html?_rnt=dd#configuracao
                        //https://sandbox.pagseguro.uol.com.br/
            
                        $paymentRequest = new PagSeguroPaymentRequest();  
                        $paymentRequest->addItem('0001', 'Notebook', 1, 1.00);  
                        $paymentRequest->addItem('0002', 'Mochila',  1, 1.99);  
            
                        $paymentRequest->setCurrency("BRL");  
            
                        // Referenciando a transação do PagSeguro em seu sistema  
                        $paymentRequest->setReference("REF123");  
                        
                        // URL para onde o comprador será redirecionado (GET) após o fluxo de pagamento  
                        $paymentRequest->setRedirectUrl("http://www.lojamodelo.com.br");  
                        
                        // URL para onde serão enviadas notificações (POST) indicando alterações no status da transação  
                        $paymentRequest->addParameter('notificationURL', 'https://tutoriaiseinformatica.com/sdkpagseguro/response.php');  
            
                        $paymentRequest->addParameter('senderBornDate', '07/05/1981');  
            
                        try {  
                            $onlyCheckoutCode = true;
                            $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()  
                            $checkoutUrl = $paymentRequest->register($credentials, $onlyCheckoutCode);  
                            
                            echo  "<script>PagSeguroLightbox('" . $checkoutUrl . "');</script>";
            
                        } catch (PagSeguroServiceException $e) {  
                            die($e->getMessage());  
                        } 
                    }
            ?>
            

                {{-- <form>
                   @csrf

               <div class="col-6 col-md-6">
                   <div class="bor8 bg0 m-b-12">
                       <input type="text" name="hashseller" class=" hashseller stext-111 cl8 plh3 size-111 p-lr-15">
                       <input type="text" name="totalfinal" value="200" class=" totalfinal stext-111 cl8 plh3 size-111 p-lr-15">

                   </div>
               </div>
                   <div style="margin-top: 5%" >
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
                                   <input class=" ncredito stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="ncredito"
                                          placeholder="Numero do cartao">
                               </div>
                           </div>
                           <div class="col-6 col-md-6">
                               <div class="bor8 bg0 m-b-12">
                                   <input class="nparcela stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="nparcela"
                                          placeholder="parcela no cartão">
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
                       <div  class="flex-w   p-b-10">
                           <div class="wid-full flex-finali flex-w flex-m respon6-next">

                               <div class="col-md-12 col-12 d-flex">
                                   <div class="col-6 col-md-12" style="display: flex;flex-direction: row-reverse;">
                                       <input type="submit" class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10" value="pagar" >

                                   </div>

                               </div>
                           </div>
                       </div>
                   </div>
               </form> --}}

                @livewire('pay-modal')

                @component('CheckOut.resumo', ['carrinho' => $carrinho, 'endereco' => $endereco])
                @endcomponent

            </div>
        </div>

    </div>
@endsection
