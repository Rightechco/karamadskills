<?php

namespace Modules\Test\Http\Controllers;

use Modules\Test\Http\Requests\eqRequest;
use Modules\Test\Http\Requests\mbtiRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Http\Services\AuthService;
use Modules\Common\Http\Services\CommonServices;
use Modules\Test\Http\Requests\HollandRequest;
use Modules\Test\Http\Requests\RavenRequest;
use Modules\Test\Http\Services\TestServices;
use Modules\Test\Models\Test;
use Modules\User\Models\User;
use Modules\Wallet\Http\Services\WalletService;

class TestController extends Controller
{

    public function tests()
    {
        return view('test::tests');
    }

    public function raven()
    {
        $countRaven = Test::query()->where('type' , Test::RAVEN)->count();
        return view('test::raven',compact('countRaven'));
    }

    public function holland()
    {
        $countHolland = Test::query()->where('type' , Test::HOLLAND)->count();
        return view('test::holland',compact('countHolland'));
    }

    public function mbti()
    {
        $countMbti = Test::query()->where('type' , Test::MBTI)->count();
        return view('test::mbti',compact('countMbti'));
    }

    public function eq()
    {
        $countEq = Test::query()->where('type' , Test::EQ)->count();
        return view('test::eq',compact('countEq'));
    }

    public function ravenStore(RavenRequest $request)
    {
        if (auth()->check()) {
            $user = auth()->user();
        } else {
            if (is_null($request->mobile) || is_null($request->name)) {
                $toasts = ['toast' => [
                    [
                        'message' => 'وارد کردن نام و شماره موبایل الزامی می باشد',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('test.raven')->with($toasts);
            }
            $user = User::query()->where('mobile', $request->mobile)->first();
            if (is_null($user)) {
                $user = AuthService::createUserTest($request->mobile,$request->name);
            }
            Auth::loginUsingId($user->id);
        }
        $answer = [];
        for ($i = 1; $i <= 60; $i++) {
            $answer[] = $request->{"raven" . $i};
        }
        $raven = TestServices::RavenStore($answer,$user->id);
        if (config('tests.raven')) {
            return CommonServices::pay(config('tests.raven'),route('test.ravenResult',$raven->id));
        } else {
            return to_route('test.ravenResultShow',$raven->id);
        }
    }

    public function ravenResult(Request $request, $id)
    {
        if ($request->Status == 'OK') {
            $test = Test::query()->where('id', $id)->first();
            if (is_null($test)) {
                $toasts = ['toast' => [
                    [
                        'message' => 'تست ناموفق! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('test.raven')->with($toasts);
            }
            $verify = CommonServices::verify(config('tests.raven'), $request->Authority);
            if ($verify) {
                $test->pay_id = $verify;
                $test->save();
                WalletService::deposit(1,config('tests.raven'),'پرداخت هزینه آزمون شماره '.$test->id);
                return to_route('test.ravenResultShow',$test->id);
            } else {
                $toasts = ['toast' => [
                    [
                        'message' => 'پرداخت شما ناموفق بود! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('test.raven')->with($toasts);
            }
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'پرداخت شما ناموفق بود! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('test.raven')->with($toasts);
        }
    }

    public function ravenResultShow(Test $test)
    {
        if (auth()->check() &&  ($test->free || $test->pay_id && $test->pay->ref)) {
            $scoreArray = TestServices::RavenScore(json_decode($test->result));
            return view('test::ravenResult',compact('scoreArray'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'خطایی رخ داده است',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('test.raven')->with($toasts);
        }
    }

    public function hollandStore(HollandRequest $request)
    {
        if (auth()->check()) {
            $user = auth()->user();
        } else {
            if (is_null($request->mobile) || is_null($request->name)) {
                $toasts = ['toast' => [
                    [
                        'message' => 'وارد کردن نام و شماره موبایل الزامی می باشد',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('test.holland')->with($toasts);
            }
            $user = User::query()->where('mobile', $request->mobile)->first();
            if (is_null($user)) {
                $user = AuthService::createUserTest($request->mobile,$request->name);
            }
            Auth::loginUsingId($user->id);
        }
        $answer = [];
        for ($i = 1; $i <= 30; $i++) {
            $answer[] = $request->{"check" . $i};
        }
        $holland = TestServices::HollandStore($answer,$user->id);
        if (config('tests.holland')) {
            return CommonServices::pay(config('tests.holland'),route('test.hollandResult',$holland->id));
        } else {
            return to_route('test.hollandResultShow',$holland->id);
        }
    }

    public function hollandResult(Request $request, $id)
    {
        if ($request->Status == 'OK') {
            $test = Test::query()->where('id', $id)->first();
            if (is_null($test)) {
                $toasts = ['toast' => [
                    [
                        'message' => 'تست ناموفق! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('test.holland')->with($toasts);
            }
            $verify = CommonServices::verify(config('tests.holland'), $request->Authority);
            if ($verify) {
                $test->pay_id = $verify;
                $test->save();
                WalletService::deposit(1,config('tests.holland'),'پرداخت هزینه آزمون شماره '.$test->id);
                return to_route('test.hollandResultShow',$test->id);
            } else {
                $toasts = ['toast' => [
                    [
                        'message' => 'پرداخت شما ناموفق بود! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('test.holland')->with($toasts);
            }
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'پرداخت شما ناموفق بود! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('test.holland')->with($toasts);
        }
    }

    public function hollandResultShow(Test $test)
    {
        if (auth()->check() &&  ($test->free || $test->pay_id && $test->pay->ref)) {
            $scoreArray = TestServices::HollandScore($test->result);
            return view('test::hollandResult',compact('scoreArray'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'خطایی رخ داده است',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('test.holland')->with($toasts);
        }
    }

    public function mbtiStore(mbtiRequest $request)
    {
        if (auth()->check()) {
            $user = auth()->user();
        } else {
            if (is_null($request->mobile) || is_null($request->name)) {
                $toasts = ['toast' => [
                    [
                        'message' => 'وارد کردن نام و شماره موبایل الزامی می باشد',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('test.mbti')->with($toasts);
            }
            $user = User::query()->where('mobile', $request->mobile)->first();
            if (is_null($user)) {
                $user = AuthService::createUserTest($request->mobile,$request->name);
            }
            Auth::loginUsingId($user->id);
        }
        $answer = [];
        for ($i = 1; $i <= 87; $i++) {
            $answer[] = $request->{"radio" . $i};
        }
        $mbti = TestServices::mbtiStore($answer,$user->id);
        if (config('tests.mbti')) {
            return CommonServices::pay(config('tests.mbti'),route('test.mbtiResult',$mbti->id));
        } else {
            return to_route('test.mbtiResultShow',$mbti->id);
        }
    }

    public function mbtiResult(Request $request,$id)
    {
        if ($request->Status == 'OK') {
            $test = Test::query()->where('id', $id)->first();
            if (is_null($test)) {
                $toasts = ['toast' => [
                    [
                        'message' => 'تست ناموفق! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('test.mbti')->with($toasts);
            }
            $verify = CommonServices::verify(config('tests.mbti'), $request->Authority);
            if ($verify) {
                $test->pay_id = $verify;
                $test->save();
                WalletService::deposit(1,config('tests.mbti'),'پرداخت هزینه آزمون شماره '.$test->id);
                return to_route('test.mbtiResultShow',$test->id);
            } else {
                $toasts = ['toast' => [
                    [
                        'message' => 'پرداخت شما ناموفق بود! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('test.mbti')->with($toasts);
            }
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'پرداخت شما ناموفق بود! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('test.mbti')->with($toasts);
        }
    }

    public function mbtiResultShow(Test $test)
    {
        if (auth()->check() &&  ($test->free || $test->pay_id && $test->pay->ref)) {
            $scoreArray = TestServices::MbtiScore($test->result);
            return view('test::mbtiResult',compact('scoreArray'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'خطایی رخ داده است',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('test.mbti')->with($toasts);
        }
    }

    public function eqStore(eqRequest $request)
    {
        if (auth()->check()) {
            $user = auth()->user();
        } else {
            if (is_null($request->mobile) || is_null($request->name)) {
                $toasts = ['toast' => [
                    [
                        'message' => 'وارد کردن نام و شماره موبایل الزامی می باشد',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('test.mbti')->with($toasts);
            }
            $user = User::query()->where('mobile', $request->mobile)->first();
            if (is_null($user)) {
                $user = AuthService::createUserTest($request->mobile,$request->name);
            }
            Auth::loginUsingId($user->id);
        }
        $answer = [];
        foreach ($request->kh as $kh) {
            $answer[] = explode('-',$kh)[1];
        }
        $eq = TestServices::eqStore($answer,$user->id);
        if (config('tests.eq')) {
            return CommonServices::pay(config('tests.eq'),route('test.eqResult',$eq->id));
        } else {
            return to_route('test.eqResultShow',$eq->id);
        }
    }

    public function eqResult(Request $request,$id)
    {
        if ($request->Status == 'OK') {
            $test = Test::query()->where('id', $id)->first();
            if (is_null($test)) {
                $toasts = ['toast' => [
                    [
                        'message' => 'تست ناموفق! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('test.eq')->with($toasts);
            }
            $verify = CommonServices::verify(config('tests.eq'), $request->Authority);
            if ($verify) {
                $test->pay_id = $verify;
                $test->save();
                WalletService::deposit(1,config('tests.eq'),'پرداخت هزینه آزمون شماره '.$test->id);
                return to_route('test.eqResultShow',$test->id);
            } else {
                $toasts = ['toast' => [
                    [
                        'message' => 'پرداخت شما ناموفق بود! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                        'alert-type' => 'error'
                    ]
                ]];
                return to_route('test.eq')->with($toasts);
            }
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'پرداخت شما ناموفق بود! ; پرداخت شما طی 48 ساعت به حساب شما عودت داده می شود',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('test.eq')->with($toasts);
        }
    }

    public function eqResultShow(Test $test)
    {
        if (auth()->check() && ($test->free || $test->pay_id && $test->pay->ref)) {
            $scoreArray = TestServices::eqScore($test->result);
            return view('test::eqResult',compact('scoreArray'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'خطایی رخ داده است',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('test.eq')->with($toasts);
        }
    }
}
