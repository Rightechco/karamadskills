@extends('home::layouts.master')

@section('title', 'مراکز هدایت شغلی')

@section('meta')
    <style>
        .box_item {
            width: 300px !important;
            margin: 30px 10px;
            padding: 55px 5px 5px 5px;
            position: relative;
            border-radius: var(--radius);
            background-color: #dcf2ff;
        }

        .box_item img {
            position: absolute;
            right: 120px;
            top: -20px;
            width: 60px;
            border-radius: var(--radius);
            background-color: #2392da;
            padding: 5px;
        }

        .box_item h3 {
            text-align: center;
            margin: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="page-title-area">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <h2>مراکز هدایت شغلی</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <div class="row mx-0 justify-content-center mt-5 mb-4" id="items">
        @foreach($unis as $uni)
            <div class="box_item">
                <a href="{{ route('university.uni',$uni->slug) }}">
                    @if($uni->logo)
                    <img src="{{ asset($uni->logo['indexArray']['medium']) }}" alt="image">
                    @endif
                    <h3>{{ $uni->name }}</h3>
                </a>
            </div>
        @endforeach
    </div>

    <div class="more-btn">
        <button type="button" id="moreBtn" url="{{ route('university.moreUniversities') }}" num="1" class="modern-shadow">
            موارد بیشتر
        </button>
    </div>
@endsection

@section('js')
    <script>
        $('#moreBtn').click(function (e) {
            $.ajax({
                type: 'POST',
                url: $(this).attr('url'),
                data: {
                    'num': $(this).attr('num'),
                    '_token': "{{ csrf_token() }}",
                },
                success: function (data) {
                    if (data) {
                        $('#items').append(data);
                        var num = $('#moreBtn').attr('num');
                        num++;
                        $('#moreBtn').attr('num', num)
                    } else {
                        toastr.info('مورد دیگری یافت نشد');
                        $('#moreBtn').remove()
                    }
                },
                error: function (data) {
                    toastr.error('خطایی رخ داده');
                },
            });
        });
    </script>
@endsection
