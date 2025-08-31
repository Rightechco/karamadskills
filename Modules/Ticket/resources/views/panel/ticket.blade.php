@extends('panel::layouts.master')

@section('title','پیام شماره '.$ticket->id)
@section('meta')

@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="row justify-content-between mx-0 align-items-center">
                            <div><h4>پیام شماره {{ $ticket->id }}</h4></div>
                        </div>
                        <h4 class="d-block w-100 text-center">{{ $ticket->name }}</h4>
                        <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem; background-image: url('{{ asset("assets/images/ticket.jpg") }}')">
                            <div class="w-100 d-flex"><div class="message-box @if($ticket->user_id != auth()->user()->id) message-box-left @endif">
                                {{ $ticket->text }}
                                <div class="row mx-0 justify-content-between flex-row-reverse border-top pt-1 mt-4">
                                    <div class="date small">{{ verta($ticket->created_at)->formatDifference() }}</div>
                                    <div class="file">
                                        @if($ticket->files->count())
                                            @foreach($ticket->files as $file)
                                                <a href="{{ route('panel.file.ticketFileShow',$file->id) }}" target="_blank" class="text-black"><i class="fe-file text-black"></i></a>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="message-sender">{{ $ticket->user->name }}:</div>
                            </div></div>
                            @if($ticket->childs->count())
                                @foreach($ticket->childs as $child)
                                    <div class="w-100 d-flex"><div class="message-box @if($child->user_id != auth()->user()->id) message-box-left @endif">
                                        {{ $child->text }}
                                        <div class="row mx-0 justify-content-between flex-row-reverse border-top pt-1 mt-4">
                                            <div class="date small">{{ verta($child->created_at)->formatDifference() }}</div>
                                            <div class="file">
                                                @if($child->files->count())
                                                    @foreach($child->files as $file)
                                                        <a href="{{ route('panel.file.ticketFileShow',$file->id) }}" target="_blank" class="text-black"><i class="fe-file text-black"></i></a>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="message-sender">{{ $child->user->name }}:</div>
                                    </div></div>
                                @endforeach
                            @endif
                        </div>
                        <form action="{{ route('panel.ticket.sendReply') }}" method="post" class="row mt-1 mb-4 p-2" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $ticket->id }}">
                            <div class="col-12 my-1 px-0">
                                <label for="text">پاسخ</label><span class="text-danger">*</span>
                                <textarea style="height: 200px" required name="text" type="text" id="text" class="form-control" placeholder="متن پیام">{{ old('name') }}</textarea>
                                @error('text')
                                <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div id="addedFilesDiv" class="row mx-0 col-11 px-0">

                            </div>
                            <div class="my-1 addFile col-1">
                                <i class="mdi mdi-plus" id="addedFiles" data-toggle="tooltip" data-placement="top" title="افزودن فایل ، حداکثر 4MB"></i>
                            </div>
                            @error('input.*')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                            <button class="btn btn-primary btn-block mb-4 mr-2 mt-4">ارسال</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $("#addedFiles").on('click', function (e) {
            $('#addedFilesDiv').append('<div class="col-12 col-ms-6 col-lg-6 my-1 mx-0 px-0 pr-lg-1" style="min-width: 300px"><div class="file-area"><input type="file" required name="input[]"> <div class="file-dummy"> <span class="default">فایل مورد نظر خود انتخاب کنید</span><span class="success">فایل شما انتخاب شد</span></div><i class="mdi mdi-close text-danger" id="remove-image" onclick="removeImage(this)"></i></div></div>');
        })
        function removeImage(e){
           $(e).parent().parent().remove();
        };
    </script>
@endsection
