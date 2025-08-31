@extends('home::layouts.master')

@section('title','پروفایل '.$user->name)

@section('content')
    <div class="container curses-page__body mt-6">
        <div class="courses-page__sidebar">
            <div class="teacher-information__box br-.75 bg-cloud d-flex flex-column gap-5">
                    <span>
                        <img src="https://via.placeholder.com/100" alt="hello world" class="mx-auto rounded-circle">
                    </span>
                <div class="d-flex flex-column gap-2">
                    <span class="mx-auto fs-16 fw-sb le-6 color-secondary">{{ $user->name }}</span>
                    <span class="mx-auto fs-14 fw-l le-6 color-secondary text-center"><span class="badge bg-secondary">{{ implode('</span><span class="badge bg-secondary">',array_column($user->roles->select('name')->toArray(),'name')) }}</span></span>
                </div>
                <a href="{{ route('panel.ticket.send',$user->slug) }}" class="btn btn-outline-info" style="font-size: 16px">ارسال پیام</a>
            </div>
        </div>
        <div class="curses-page__content">
            <h2>دوره ها</h2>
            <div class="courses-page__course-container">
                @foreach($user->teachers as $course)
                <div class="card-test d-flex flex-column">
                    @if($course->cover)
                        <img
                            src="{{ asset($course->cover['indexArray'][$course->cover['currentImage']]) }}"
                            alt="company logo"/>
                    @else
                        <img src="{{ asset('assets-front/img/ka.png') }}" alt="company logo"/>
                    @endif
                    <div class="bottom flex-grow-1 d-flex flex-column">
                        <div class="content d-flex flex-column flex-grow-1">
                            <a href="{{ route('course.course',$course->id) }}" class="text-dark fs-14 fw-b le-6 line-clamp-2 text-right">{{ $course->name }}</a>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex flex-row justify-content-between pb-4">
                                <span class="d-flex align-items-center gap-2 color-gray-3 fs-14 fw-r le-6"><i class="fas fa-school"></i>برگزاری توسط: {{ $course->courseable->name }}</span>
                                {{--                                    <span class="d-flex align-items-center gap-2 flex-row-reverse fs-14 fw-r le-6">--}}
                                {{--                                            <i class="fas fa-star" style="color: var(--yellow)"></i>--}}
                                {{--                                            <span style="color: var(--yellow)">5.0</span>--}}
                                {{--                                        </span>--}}
                            </div>
                            <div class="d-flex flex-row justify-content-between pb-4 bb-1">
                                <span class="d-flex align-items-center gap-2 color-gray-3 fs-14 fw-r le-6"><i class="fas fa-chalkboard-teacher"></i>مدرس: {{ $course->teacher->name }}</span>
                            </div>
                            <div class="d-flex flex-row justify-content-between pb-4 mt-2">
                                    <span class="d-flex align-items-end gap-2 color-gray-3 fs-16 fw-r le-6"><i
                                            class="fas fa-users"
                                            style="padding-bottom: .5rem;"></i> <span>ظرفیت: @if($course->limit) {{ $course->limit }} نفر @else نامحدود @endif</span></span>
                                <span class="d-flex flex-column">
                                            <!--<del class="fs-14 fw-l le-8 color-gray-3">900,000</del>-->
                                            <span class="fs-16 fw-b le-6"
                                                  style="color: var(--green)">@if($course->price) {{ number_format($course->price) }} تومان @else رایگان @endif</span>
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="course-detail__comments w-100 br-.75 bg-cloud">
        <div class="course-detail__comments-header d-flex flex-row justify-content-between align-items-center">
            <h2 class="fs-20 fw-b le-6 d-flex justify-content-start gap-2 align-items-center color-primary"><i class="mdi mdi-wechat d-flex"></i>بخش نظرات</h2>
            @if(auth()->check())
                <button type="button" class="signIn-btn d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#signupModal">
                    <span>ایجاد نظر</span>
                    <span><i class="mdi mdi-chat-processing d-flex justify-content-center align-items-center"></i></span>
                </button>
            @endif
        </div>
        <div class="course-detail__comment">
            @foreach($user->comments->where('status',\Modules\Comment\Models\Comment::ACTIVE)->whereNull('parent_id') as $comment)
                <div class="comment-box">
                    <div class="gradient-bg"></div>
                    <div class="comment-header">
                        @if($comment->user->pic)
                            <img class="user-avatar" src="{{ route('user.avatarShow',[$comment->user->pic,'userAvatar']) }}" alt="تصویر کاربر" title="{{ $comment->user->name }}">
                        @else
                            <img class="user-avatar" src="{{ asset('assets/images/users/user-1.jpg') }}" alt="تصویر کاربر" title="{{ $comment->user->name }}">
                        @endif
                        <div class="user-info">
                                        <span class="d-flex flex-row align-items-center gap-2">
                                            <span class="user-name fs-16 fw-sb le-6 color-secondary">{{ $comment->user->name }}</span>
{{--                                            <span>|</span>--}}
                                            {{--                                            <span class="user-role fs-16 fw-l le-6 color-gray-3">مدیر</span>--}}
                                        </span>
                            <span class="comment-date fs-12 fw-r le-6 color-gray-1">{{ verta($comment->created_at)->formatDifference() }}</span>
                        </div>
                    </div>
                    <hr class="divider">
                    <div class="comment-body le-8">{{ $comment->body }}</div>
                    @if($comment->childs->count())
                        <div class="reply" style="padding-right: 50px">
                            @foreach($comment->childs as $child)
                                <div class="comment-box" style="background-color: skyblue">
                                    <div class="gradient-bg"></div>
                                    <div class="comment-header">
                                        @if($child->user->pic)
                                            <img class="user-avatar" src="{{ route('user.avatarShow',[$child->user->pic,'userAvatar']) }}" alt="تصویر کاربر" title="{{ $child->user->name }}">
                                        @else
                                            <img class="user-avatar" src="{{ asset('assets/images/users/user-1.jpg') }}" alt="تصویر کاربر" title="{{ $child->user->name }}">
                                        @endif
                                        <div class="user-info">
                                        <span class="d-flex flex-row align-items-center gap-2">
                                            <span class="user-name fs-16 fw-sb le-6 color-secondary">پاسخ: {{ $child->user->name }}</span>
{{--                                            <span>|</span>--}}
                                            {{--                                            <span class="user-role fs-16 fw-l le-6 color-gray-3">مدیر</span>--}}
                                        </span>
                                            <span class="comment-date fs-12 fw-r le-6 color-gray-1">{{ verta($child->created_at)->formatDifference() }}</span>
                                        </div>
                                    </div>
                                    <hr class="divider">
                                    <div class="comment-body le-8">{{ $child->body }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
            {{--                            <div class="d-flex justify-content-center align-items-center">--}}
            {{--                                <div class="signIn-btn d-flex justify-content-center align-items-center">--}}
            {{--                                    <span>مشاهده بیشتر</span>--}}
            {{--                                    <span><i class="mdi mdi-chevron-down d-flex justify-content-center align-items-center"></i></span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
        </div>
    </div>
    @if(auth()->check())
        <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-end">
                        <!--<h5 class="modal-title" id="signupModalLabel"></h5>-->
                        <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="بستن"></button>
                    </div>
                    <div class="modal-body">
                        <form id="fromComment" action="{{ route('panel.comment.createComment') }}" method="post">
                            @csrf
                            <input type="hidden" name="commentable_id" value="{{ $user->id }}">
                            <input type="hidden" name="commentable_type" value="{{ \Modules\User\Models\User::class }}">
                            <div class="mb-3">
                                <label for="feedback" class="form-label fs-16 fw-r le-6 color-secondary">نظر شما</label>
                                <textarea class="form-control" name="body" id="feedback" rows="4" placeholder="نظر خود را اینجا بنویسید"></textarea>
                            </div>
                            <div class="d-flex justify-content-star align-items-center">
                                <span class="fs-14 fw-r le-6 color-gray-1">امتیاز شما به این دوره:</span>
                                <div class="starrating d-flex justify-content-center flex-row-reverse">
                                    <input type="radio" id="star-5" name="rating" value="5">
                                    <label class="fas fa-star" for="star-5" title="5 ستاره"></label>
                                    <input type="radio" id="star-4" name="rating" value="4">
                                    <label class="fas fa-star" for="star-4" title="4 ستاره"></label>
                                    <input type="radio" id="star-3" name="rating" value="3">
                                    <label class="fas fa-star" for="star-3" title="3 ستاره"></label>
                                    <input type="radio" id="star-2" name="rating" value="2">
                                    <label class="fas fa-star" for="star-2" title="2 ستاره"></label>
                                    <input type="radio" id="star-1" name="rating" value="1">
                                    <label class="fas fa-star" for="star-1" title="1 ستاره"></label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button form="fromComment" type="submit" class="karasan-btn karasan-btn-blue" style="--btn-width: 10rem; --btn-height: 4rem;">ثبت نظر</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js')

@endsection
