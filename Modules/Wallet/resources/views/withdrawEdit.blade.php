@extends('panel::layouts.master')

@section('title','ویرایش برداشت')
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
                            <h4>ویرایش برداشت</h4>
                            <a href="{{ route('panel.wallet.wallet') }}" style="font-size: 35px"><i class=' fas fa-arrow-alt-circle-left text-info'></i></a>
                        </div>
                        <div class="row layout-top-spacing">
                            <div class="col-12 layout-spacing">
                                <div class="userProfile-container m-3">
                                    <div class="user-card row">
                                        <div class="col-12 col-sm-6 col-md-4 mb-1">
                                            <p class="text-dark"><strong>شماره برداشت:</strong> <span class="text-primary">{{ $withdraw->id ?? '-' }}</span></p>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 mb-1">
                                            <p class="text-dark"><strong>نام کاربر:</strong> <span class="text-primary">{{ $withdraw->wallet->user->name ?? '-' }}</span></p>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 mb-1">
                                            <p class="text-dark"><strong>تلفن تماس:</strong> <span class="text-primary">{{ $withdraw->wallet->user->mobile ?? '-' }}</span></p>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 mb-1">
                                            <p class="text-dark"><strong>استان:</strong> <span class="text-primary">{{ $withdraw->wallet->user->ostan->name ?? '-' }}</span></p>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 mb-1">
                                            <p class="text-dark"><strong>کیف پول شماره:</strong> <span class="text-primary">{{ $withdraw->wallet->id ?? '-' }}</span></p>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 mb-1">
                                            <p class="text-dark"><strong>شماره شبا:</strong> <span class="text-primary">{{ $withdraw->card->shaba_number ?? '-' }}</span></p>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 mb-1">
                                            <p class="text-dark"><strong>شماره کارت:</strong> <span class="text-primary">{{ $withdraw->card->card_number ?? '-' }}</span></p>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 mb-1">
                                            <p class="text-dark"><strong>وضعیت کارت:</strong> <span class="badge bg-{{ $withdraw->card->classStatus() }}">{{ $withdraw->card->nameStatus() }}</span></p>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 mb-1">
                                            <p class="text-dark"><strong>مقدار:</strong> <span class="text-primary">{{ number_format($withdraw->amount) ?? '-' }} تومان</span></p>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 mb-1">
                                            <p class="text-dark"><strong>تارخ درخواست برداشت:</strong> <span class="text-primary">{{ $withdraw->created_at->format('d/m/Y') ?? '-' }}</span></p>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 mb-1">
                                            <p class="text-dark"><strong>زمان درخواست برداشت:</strong> <span class="text-primary">{{ $withdraw->created_at->format('H:i:s') ?? '-' }}</span></p>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 mb-1">
                                            <p class="text-dark"><strong>کد رهگیری:</strong> <span class="text-primary">{{ $withdraw->transaction_id ?? '-' }}</span></p>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 mb-1">
                                            <p class="text-dark"><strong>وضعیت برداشت:</strong> <span class="badge bg-{{ $withdraw->classStatus() }}">{{ $withdraw->nameStatus() }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Section for Status and Transaction ID -->
                            <div class="row layout-top-spacing">
                                <div class="col-12 layout-spacing">
                                    <div class="row mx-0 m-3">
                                        <form class="col-12" action="{{ route('panel.withdraw.statusUpdate', $withdraw->id) }}" method="post">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="status">تغییر وضعیت</label>
                                                    <select class="form-control select2" name="status" id="status" style="width: 100%">
                                                        <option value="">انتخاب کنید</option>
                                                        @foreach(\Modules\Wallet\Models\Withdraw::$status as $status)
                                                            <option value="{{ $status }}" @if($withdraw->status == $status) selected @endif>{{ __('messages.'.$status) }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('status')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="transaction">کد رهگیری</label>
                                                    <input name="transaction" type="text" class="form-control" id="transaction" placeholder="کد رهگیری برداشت" value="{{ old('transaction', $withdraw->transaction_id) }}">
                                                    @error('transaction')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-info btn-block mb-4">ثبت تغییرات</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
@endsection
