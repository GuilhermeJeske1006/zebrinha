<!-- breadcrumb -->
@extends('components.body')
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
        <div class="col-lg-10 col-xl-10 m-lr-auto m-b-50">

            <div >
                <div class="container">
                    <div class="row" style="margin-left: 3%;">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Minhas compras
                        </h4>
                    </div>
                </div>
                <div class="d-flex" style="height: 45px">
                    <div class="wid-full respon6-next">
                        <div class="rs1-select2 bor8 bg0">
                            <div class="d-flex" style="height: 45px">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($listaPedido as $pedido)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scriptjs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function calculaFrete(){
            $("#cep").blur(function (e) {
                let cep = this.value
                console.log('cep', cep)


                fetch(`https://www.cepcerto.com/ws/json-frete/8836000/${cep}/500`)
                    .then(response => {
                        response.json()
                            .then(data => showData(data))
                        const showData = (result) => {
                            for(const campo in result){
                                console.log(campo)
                            }
                        }

                    })
            })
        }

    </script>
@endsection
