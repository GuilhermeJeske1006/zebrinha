@extends('components.body')
@section('body')
    <!-- Product -->
    @component('components.topWhite', ['carrinho' => $carrinho])@endcomponent


<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/fundo_preto.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Sobre nós
    </h2>
</section>


<!-- Content page -->
<section class="bg0 p-t-75 p-b-120">
    <div class="container">
        <div class="row p-b-148">
            <div class="col-md-7 col-lg-8">
                <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                    <h3 class="mtext-111 cl2 p-b-16">
                        Quem somos?
                    </h3>

                    <p class="stext-113 cl6 p-b-26">
                        Bem-vindo ao Zebrinha Kids, sua loja online de roupas infantis que oferece uma variedade de produtos para crianças. Acreditamos que roupas infantis devem ser confortáveis, coloridas e de alta qualidade, para garantir que as crianças se sintam bem e possam se divertir livremente.                    </p>

                    <p class="stext-113 cl6 p-b-26">
                        Nossa coleção inclui uma grande variedade de roupas para meninos e meninas, incluindo camisetas, blusas, shorts, calças, saias, vestidos e muito mais. Com uma ampla seleção de estilos e estampas, temos certeza de que você encontrará o visual perfeito para o seu filho ou filha.                    </p>

                    <p class="stext-113 cl6 p-b-26">
                        Além disso, nossas roupas são feitas de materiais de alta qualidade, garantindo que elas durem por muito tempo. Todos os nossos produtos são cuidadosamente selecionados e testados para garantir a melhor qualidade possível.               
                    </p>
                    <p class="stext-113 cl6 p-b-26">
                        Nosso objetivo é fornecer roupas infantis de alta qualidade a preços acessíveis para todos os pais e crianças. É por isso que oferecemos preços justos e competitivos, para que você possa economizar dinheiro enquanto compra roupas incríveis para seus filhos.                    </p>
                    <p class="stext-113 cl6 p-b-26">
                        Não importa se você está procurando roupas para o dia a dia ou para ocasiões especiais, o Zebrinha Kids tem tudo o que você precisa. Oferecemos uma experiência de compra fácil e segura, com envio rápido e frete grátis em pedidos acima de determinado valor.                    </p>
                    <p class="stext-113 cl6 p-b-26">
                        Não perca mais tempo procurando a roupa perfeita para seus filhos. Visite o Zebrinha Kids hoje e encontre as melhores roupas infantis para meninos e meninas!                    </p>
                </div>
            </div>

            <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
                <div class=" ">
                    <div class="hov-img0">
                        <img src="images/logo_sobre.jpg" alt="IMG">
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
