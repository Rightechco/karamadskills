@extends('home::layouts.master')

@section('title', 'مقالات')
@section('meta')
    <style>
        .post-container {
            background-color: #f8f8f8;
            padding: 30px 8px;
            background-size: auto;
            text-align: center;
            border-radius: 15px;
            margin-bottom: 25px;
            width: 350px !important;
            height: 400px;
            overflow: hidden;
        }

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
                    <h2>مطالب</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <div class="row mx-0 justify-content-between mt-5 mb-4" id="items">
        @foreach($posts as $post)
            <div class="post-container">
                <img src="{{ asset($post->image['indexArray']['medium']) }}" alt="">
                <h3 class="my-2">{{ $post->name }}</h3>
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#postDes" lll="{{ route('post.postsContent',$post->id) }}" onclick="setPost({{ $post->id }},this)">
                    مشاهده خبر
                </button>
            </div>
        @endforeach
    </div>

    <div class="more-btn">
        <button type="button" id="moreBtn" url="{{ route('post.morePosts') }}" num="1" class="modern-shadow">
            موارد بیشتر
        </button>
    </div>

    <div class="modal fade" id="postDes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
                <div class="modal-body my-3" id="postContent">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function setPost(id,e) {
            var url = $(e).attr('lll');
            $('#postContent').html('<td>لطفا صبر کنید ...</td>');
            $.ajax({
                type: 'get',
                url: url,
                success: function (list) {
                    $('#postContent').html(list);
                }
            });
        }

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
