@extends('panel::layouts.master')

@section('title','آزمون')
@section('meta')

@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="card-body">
                    <div class="row justify-content-between mx-0 mb-3 align-items-center">
                        <h4 class="header-title mb-3 px-1">آزمون {{ $exam->name }} از دوره {{ $exam->course->name }}</h4>
                        <div class="badge bg-first-100" style="font-size: 20px">
                            <span class="">زمان باقیمانده: <span class="timer">{{ $exam->time }}:00</span></span><i class="mdi mdi-clock-outline mx-2"></i>
                        </div>
                    </div>
                    <form action="{{ route('panel.exam.takeExamStore',$exam->id) }}" method="post">
                        @csrf
                        <div id="progressbarwizard">
                            @php $questions = json_decode($exam->exam) @endphp
                            <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-2">
                                <li class="nav-item">
                                    <a href="#start" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="mdi mdi-comment-question mr-1"></i>
                                        <span class="d-none d-sm-inline">شروع</span>
                                    </a>
                                </li>
                                @for($i = 0;$i < count($questions);$i++)
                                <li class="nav-item">
                                    <a href="#q{{ $questions[$i]->name }}" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="mdi mdi-comment-question-outline mr-1"></i>
                                        <span class="d-none d-sm-inline">{{ $i+1 }}</span>
                                    </a>
                                </li>
                                @endfor
                                <li class="nav-item">
                                    <a href="#finish" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="mdi mdi-comment-question mr-1"></i>
                                        <span class="d-none d-sm-inline">پایان</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content border-0 mb-0">

                                <div id="bar" class="progress mb-3" style="height: 7px;">
                                    <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                                </div>
                                <div class="tab-pane active" id="start">
                                    <div class="row justify-content-center">
                                        <div class="border p-4 d-flex flex-column align-items-center justify-content-center" style="border-radius: var(--radius); background-color: var(--gray-200)">
                                            <h4 class="mt-2 mb-4">به آزمون {{ $exam->name }} از دوره {{ $exam->course->name }} خوش آمدید</h4>
                                            <span>زمان آزمون: {{ $exam->time }} دقیقه</span>
                                            <br>
                                            <button type="button" onclick="startExam()" class="btn btn-info">شروع آزمون</a>
                                        </div>
                                    </div>
                                </div>
                                @for($i = 0;$i < count($questions);$i++)
                                <div class="tab-pane" id="q{{ $questions[$i]->name }}">
                                    <div class="row justify-content-center">
                                        <div class="border p-4 d-flex flex-column align-items-center justify-content-center" style="border-radius: var(--radius); background-color: var(--gray-200)">
                                            <h4 class="my-2">{{ $questions[$i]->name }}</h4>
                                            <span>نمره سوال: {{ $questions[$i]->rate }}</span>
                                            <br>
                                            @for($j = 1;$j <= 4;$j++)
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" value="{{ $j }}" id="answer{{ $i }}{{ $j }}" name="answer{{ $i }}" class="custom-control-input">
                                                    <label onclick="next()" class="custom-control-label" for="answer{{ $i }}{{ $j }}">{{ $questions[$i]->options[$j-1] }}</label>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                @endfor
                                <div class="tab-pane" id="finish">
                                    <div class="row justify-content-center">
                                        <div class="border p-4 d-flex flex-column align-items-center justify-content-center" style="border-radius: var(--radius); background-color: var(--gray-200)">
                                            <h4 class="mt-2 mb-4">آزمون به پایان رسید!</h4>
                                            <br>
                                            <button class="btn btn-info" type="submit" id="finishBtn">ثبت</button>
                                        </div>
                                    </div>
                                </div>

                                <ul class="list-inline mb-0 wizard mt-3">
                                    <li class="previous list-inline-item">
                                        <a href="javascript: void(0);" class="btn btn-secondary">قبلی</a>
                                    </li>
                                    <li class="next list-inline-item float-right mx-2">
                                        <a id="next" href="javascript: void(0);" class="btn btn-secondary">بعدی</a>
                                    </li>
                                </ul>

                            </div> <!-- tab-content -->
                        </div> <!-- end #basicwizard-->
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-wizard.init.js') }}"></script>
    <script>
        $(document).ready(function () {

        });

        function next() {
            $('#next').click();
        }

        function startExam() {
            $('#next').click();
            var timer2 = "{{ $exam->time }}:00";
            var interval = setInterval(function() {
                var timer = timer2.split(':');
                var minutes = parseInt(timer[0], 10);
                var seconds = parseInt(timer[1], 10);
                --seconds;
                minutes = (seconds < 0) ? --minutes : minutes;
                if (minutes < 0) clearInterval(interval);
                seconds = (seconds < 0) ? 59 : seconds;
                seconds = (seconds < 10) ? '0' + seconds : seconds;
                //minutes = (minutes < 10) ?  minutes : minutes;
                $('.timer').html(minutes + ':' + seconds);
                timer2 = minutes + ':' + seconds;
            }, 1000);
            setTimeout(function(){
                $('#finishBtn').click();
            }, {{ $exam->time*60000 }});
        }
    </script>
@endsection

