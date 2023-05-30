<!DOCTYPE html>
<html lang="en">
<head>
    @if(Route::currentRouteName() != 'profile.show')
    <title>{{$title}} - Zebrinha Kids</title>
    @endif
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/icons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/icons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/icons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/icons/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('images/icons/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="Encontre as melhores roupas, calçados e acessórios infantis na Zebrinha Kids">
    <meta name="keywords" content="roupas infantis,moda infantil,calçados infantis,acessórios infantis,menino,meninas,bebês,crianças,estilo infantil,qualidade,durabilidade,conforto,conveniência,compra online,atendimento ao cliente,entrega rápida,pagamento flexível,variedade de estilos,tendências infantis,vestuário infantil,moda de qualidade para crianças.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--===============================================================================================--><!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/iconic/css/material-design-iconic-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/linearicons-v1.0.0/icon-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/MagnificPopup/magnific-popup.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.css') }}">

    @livewireStyles
    @yield('scriptjs')

    <!--===============================================================================================-->
</head>
<body class="animsition">
@yield('body')
@component('components.footer')@endcomponent
@component('components.modalAceite')@endcomponent



<!-- Back to top -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--===============================================================================================-->
<script src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>

<!--===============================================================================================-->
<script src="{{asset('vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('vendor/select2/select2.min.js')}}"></script>
<script>
    $(".js-select2").each(function(){
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });
    })
</script>
@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
<!--===============================================================================================-->
<script src="{{asset('vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('vendor/slick/slick.min.js')}}"></script>
<script src="{{asset('js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('vendor/parallax100/parallax100.js')}}"></script>
<script>
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="{{asset('vendor/MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
<script>
    $('.gallery-lb').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled:true
            },
            mainClass: 'mfp-fade'
        });
    });
</script>
<!--===============================================================================================-->
<script src="{{asset('vendor/isotope/isotope.pkgd.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "10000",
        "extendedTimeOut": "5000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
@if ($message = Session::get('success'))
    <script type="text/javascript">
        toastr.success("{{ $message }}");
    </script>

@endif


@if ($message = Session::get('error'))
    <script type="text/javascript">
        toastr.error("{{ $message }}");
    </script>
@endif


@if ($message = Session::get('warning'))
    <script type="text/javascript">
        toastr.warning("{{ $message }}");
    </script>
@endif


@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Please check the form below for errors
    </div>
@endif
<script>
    $('.js-addwish-b2').on('click', function(e){
        e.preventDefault();
    });

    $('.js-addwish-b2').each(function(){
        var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-b2');
            $(this).off('click');
        });
    });

    $('.js-addwish-detail').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-detail');
            $(this).off('click');
        });
    });

    /*---------------------------------------------*/

    function addProductcart(){
            var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
            $(this).on('click', function(){
                swal(nameProduct, "Produto adicionado ao carinho !", "success");
            });
    }

    $('.js-addadress').each(function(){
        $(this).on('click', function(){
            swal({
                title: "Atenção!",
                text: "Você precisa cadastrar um endereço antes passar para a próxima etapa!",
                icon: "warning",
                buttons: false,
                dangerMode: false,
            });
        });
    });

    $('.js-addtamanho').each(function(){
        $(this).on('click', function(){
            swal({
                title: "Atenção!",
                text: "Por favor, Selecione um tamanho antes de prosseguir!!",
                icon: "warning",
                buttons: false,
                dangerMode: false,
            });
        });
    });



    function addFrete(){
        swal({
            title: "Atenção!",
            text: "Você precisa adicionar um item ao carrinho para avançar a proxima etapa!",
            icon: "warning",
            buttons: false,
            dangerMode: false,
        });
    }

    function addTamanho(){
        swal({
            title: "Atenção!",
            text: "Por favor, Selecione um tamanho antes de prosseguir!",
            icon: "warning",
            buttons: false,
            dangerMode: false,
        });
    }

    $('.js-addproduct').each(function(){
        $(this).on('click', function(){
            swal({
                title: "Atenção!",
                text: "Você precisa adicionar um item ao carrinho para avançar a proxima etapa!",
                icon: "warning",
                buttons: false,
                dangerMode: false,
            });
        });
    });

    $('.jsaddFrete').each(function(){
        $(this).on('click', function(){
            swal({
                title: "Atenção!",
                text: "Você precisa selecionar um valor de frete para avançar a proxima etapa!",
                icon: "warning",
                buttons: false,
                dangerMode: false,
            });
        });
    });

</script>
<!--===============================================================================================-->
<script src="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script>
    $('.js-pscroll').each(function(){
        $(this).css('position','relative');
        $(this).css('overflow','hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function(){
            ps.update();
        })
    });
</script>
<!--===============================================================================================-->
<script src="{{asset('js/main.js')}}"></script>

</body>
</html>
