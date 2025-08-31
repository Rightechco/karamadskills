@extends('panel::layouts.master')

@section('title','کیف پول')
@section('meta')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/custom_dt_custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-front/css/swipper.style.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    <div class="widget-content widget-content-area br-6">
                        <div class="row justify-content-between mx-0 align-items-center">
                            <h4>لیست کارت های بانکی</h4>
                            <a href="{{ route('panel.wallet.wallet') }}" style="font-size: 35px"><i class=' fas fa-arrow-alt-circle-left text-info'></i></a>
                        </div>
                        <form action="{{ route('panel.card.postCard', auth()->user()->id) }}" method="post" class="col-12 d-flex flex-wrap w-100 justify-content-between border mt-2 mb-3 p-2 p-lg-4"style="border-radius: 8px">
                            @csrf
                            <div class="col-12 col-lg-5 col-md-6 col-sm-12 my-1">
                                <input name="card_number" type="text" class="w-100 form-control card-number" id="cartNum" placeholder="شماره کارت">
                                <img class="position-absolute d-none w-auto" id="logoBank" src="" alt="" style="height:26px; left:7%; top:15%;">
                                @error('card_number')
                                <small class="form-text text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 col-lg-5 col-md-6 col-sm-12 my-1">
                                <input name="shaba_number" type="text" class="w-100 form-control" id="" placeholder="شماره شبا">
                                @error('shaba_number')
                                <small class="form-text text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 col-lg-2 col-md-12 col-sm-12 my-1">
                                <button type="submit" class="btn btn-info w-100" style="width: 20%;">افزودن</button>
                            </div>
                        </form>
                        @if($cards)
                            <div class="container swiper m-1 col-12" id="card-swiper">
                                <div class="swiper-wrapper py-5">
                                    @foreach($cards as $card)
                                        <div class="cart swiper-slide d-flex flex-column justify-content-between align-items-center text-center">
                                            <div class="cart-header d-flex justify-content-end w-100 p-2" style="height: 25%;">
                                                <img class="bankLogo d-none mr-auto" src="" alt="" style="width: 13%; height:100%">
                                                <img src="{{asset('assets/img/bank/Shetab.png')}}" style="width: 18%; height:100%">
                                            </div>
                                            <h4 class="mt-2 mb-0">
                                                <span class="cart-num1">{{ str_split($card->card_number, 4)[0] }}</span>
                                                <span class="cart-num2">{{ str_split($card->card_number, 4)[1] }}</span>
                                                <span>{{ str_split($card->card_number, 4)[2] }}</span>
                                                <span>{{ str_split($card->card_number, 4)[3] }}</span>
                                            </h4>
                                            <h5 class="">IR {{ $card->shaba_number ?? '-' }}</h5>
                                            <div class="cart-footer w-100 d-flex justify-content-between align-items-end">
                                                @if($card->default)
                                                    <span class="mb-2 p-1" style="border-radius: 4px; color: #fff;background-color:#e4e4e44d;box-shadow: 0px 0px 4px 2px #f5f5f5;">پیشفرض</span>
                                                @else
                                                    <a href="{{ route('panel.card.default',$card->id) }}" class="btn-outline-info mb-2 p-1" style="border-radius: 4px;">پیشفرض</a>
                                                @endif
                                                <a class="cart-status p-1">{{ __('messages.'.$card->status) }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script src="{{ asset('assets-front/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/datatables.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/datatables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/datatables.responsive.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/responsive.dataTables.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/responsive.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/button-ext/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/button-ext/buttons.print.min.js') }}"></script>
    <script>
        var number1 = document.querySelectorAll('.cart-num1');
        number1.forEach(function(element){
            var num1 = $(element).text();
            var number2 = $(element).siblings('.cart-num2').text();
            var num2 = number2.slice(0, 2);
            var number = num1 + num2;
            if (number === '603799') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src',"{{ asset('assets/img/bank/meli.png') }}");$(element).parent('h4').parent().addClass('cart-blue');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none'); }
            if (number === '589210') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/sepah.png') }}");$(element).parent('h4').parent().addClass('cart-silver');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '627961') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/sanatmadan.png') }}");$(element).parent('h4').parent().addClass('cart-silver');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '603770') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/keshavarsi.png') }}");$(element).parent('h4').parent().addClass('cart-black');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '628023') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/maskan.png') }}");$(element).parent('h4').parent().addClass('cart-cherry');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '627760') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/postbank.png') }}");$(element).parent('h4').parent().addClass('cart-gold');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '502908') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/tosee.png') }}");$(element).parent('h4').parent().addClass('cart-black');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '627412') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/eghtesad.png') }}");$(element).parent('h4').parent().addClass('cart-silver');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '622106') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/parsian.png') }}");$(element).parent('h4').parent().addClass('cart-gold');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '502229') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/pasargad.png') }}");$(element).parent('h4').parent().addClass('cart-cherry');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '627488') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/karafarin.png') }}");$(element).parent('h4').parent().addClass('cart-silver');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '621986') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/saman.png') }}");$(element).parent('h4').parent().addClass('cart-cherry');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '639346') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/sina.png') }}");$(element).parent('h4').parent().addClass('cart-gold');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '639607') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/sarmaye.png') }}");$(element).parent('h4').parent().addClass('cart-blue');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '502806' || number === '504706') { $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/shahr.png') }}");$(element).parent('h4').parent().addClass('cart-black');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '502938') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/day.png') }}");$(element).parent('h4').parent().addClass('cart-gold');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '603769') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/saderat.png') }}");$(element).parent('h4').parent().addClass('cart-green');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '610433') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/mellat.png') }}");$(element).parent('h4').parent().addClass('cart-blue');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '627353' ||number === '585983') { $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/tejarat.png') }}");$(element).parent('h4').parent().addClass('cart-silver');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '589463') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/refah.png') }}");$(element).parent('h4').parent().addClass('cart-blue');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '627381') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/ansar.png') }}");$(element).parent('h4').parent().addClass('cart-black');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '639370') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/mehreqtesad.png') }}");$(element).parent('h4').parent().addClass('cart-green');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '639599') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/ghavamin.png') }}");$(element).parent('h4').parent().addClass('cart-black');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '504172') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/resalat.png') }}");$(element).parent('h4').parent().addClass('cart-gold');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
            if (number === '636214') {$(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/ayandeh.png') }}");$(element).parent('h4').parent().addClass('cart-gold');$(element).parent('h4').siblings('.cart-header').children('.bankLogo').removeClass('d-none');}
        });
        var swiper = new Swiper("#card-swiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            }
        });
        $(document).on('input', "#cartNum", function () {
            textNumber = $('#cartNum').val();
            text = textNumber.slice(0, 6);
            if (text === '603799') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/meli.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '589210') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/sepah.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '627961') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/sanatmadan-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '603770') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/keshavarsi.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '628023') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/maskan-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '627760') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/postbank-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '502908') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/tosee-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '627412') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/eghtesad-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '622106') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/parsian-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '502229') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/pasargad-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '627488') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/karafarin-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '621986') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/saman-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '639346') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/sina-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '639607') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/sarmaye-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '502806' || text === '504706') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/shahr-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '502938') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/day-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '603769') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/saderat-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '610433') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/mellat-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '627353' ||text === '585983') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/tejarat-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '589463') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/refah-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '627381') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/ansar-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '639370') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/mehreqtesad-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '639599') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/ghavamin-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '504172') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/resalat-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
            if (text === '636214') {$('img#logoBank').attr('src', "{{ asset('assets/img/bank/ayandeh-ico.png') }}"); $('img#logoBank').removeClass('d-none');}
            else {if(textNumber.length < 6){$('img#logoBank').attr('src', ""); $('img#logoBank').addClass('d-none');}}
        });
    </script>
@endsection
