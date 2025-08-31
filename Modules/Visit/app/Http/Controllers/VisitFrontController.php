<?php

namespace Modules\Visit\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Visit\Models\Visit;

class VisitFrontController extends Controller
{
    public function visits()
    {
        $visits = Visit::query()->where('status',Visit::STATUS_VERIFIED)->take(9)->orderBy('id','DESC')->get();
        return view('visit::visits',compact('visits'));
    }

    public function moreVisits(Request $request)
    {
        $num = $request->num*9;
        $string = '';
        $visits = Visit::query()->where('status',Visit::STATUS_VERIFIED)->skip($num)->take(9)->orderBy('id','DESC')->get();
        if ($visits->count()) {
            foreach ($visits as $visit) {
                $string .= '<div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-virtual-visit karamad-aparat-videos">
                            <video id="player_270995_19243749" preload="metadata" class="video-js vjs-default-skin"
                                   style="max-width: 100%;" controls="">
                                <source src="'. $visit->videoLink .'" type="video/mp4"
                                        label="Original" selected="">
                            </video>
                            <div class="virtual-visit-content">
                                <h3>'. $visit->name .'</h3>';
                                if($visit->university_id) {
                $string .=  '<p>دانشگاه: '. $visit->university->name .'</p>';
                                }
                $string .=  '</div>
                        </div>
                    </div>';
            }
            return $string;
        } else {
            return false;
        }
    }
}
