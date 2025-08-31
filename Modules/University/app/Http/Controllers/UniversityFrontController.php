<?php

namespace Modules\University\Http\Controllers;

use Illuminate\Http\Request;
use Modules\University\Models\University;

class UniversityFrontController
{
    public function uni($slug)
    {
        $university = University::query()->where('slug',$slug)->first();
        if ($university) {
            return view('university::university',compact('university'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'دانشگاهی با این نام یافت نشد',
                    'alert-type' => 'error'
                ]
            ]];
            return to_route('home')->with($toasts);
        }
    }

    public function universities()
    {
        $unis = University::query()->where('state',University::VAHED)->where('type',University::SARASARI)->select('id','name','slug','logo')->take(12)->orderBy('id','DESC')->get();
        return view('university::universities',compact('unis'));
    }

    public function moreUniversities(Request $request)
    {
        $num = $request->num*12;
        $string = '';
        $unis = University::query()->where('state',University::VAHED)->where('type',University::SARASARI)->select('id','name','slug','logo')->skip($num)->take(12)->orderBy('id','DESC')->get();
        if ($unis->count()) {
            foreach ($unis as $uni) {
                if ($uni->logo) {
                    $string .= '<div class="box_item">
                    <a href="'. route('university.uni',$uni->slug) .'">
                        <img src="'. asset($uni->logo['indexArray']['full']) .'" alt="image">
                        <h3>'. $uni->name .'</h3>
                        </a>
                    </div>';
                } else {
                    $string .= '<div class="box_item">
                    <a href="'. route('university.uni',$uni->slug) .'">
                        <img src="" alt="image">
                        <h3>'. $uni->name .'</h3>
                        </a>
                    </div>';
                }
            }
            return $string;
        } else {
            return false;
        }
    }
}
