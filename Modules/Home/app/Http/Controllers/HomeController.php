<?php

namespace Modules\Home\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Announcement\Http\Repositories\AnnouncementRepo;
use Modules\Announcement\Models\Announcement;
use Modules\Category\Models\Category;
use Modules\Common\Models\Ostan;
use Modules\Company\Models\Company;
use Modules\Course\Models\Course;
use Modules\University\Models\University;
use Modules\Post\Models\Post;

class HomeController extends Controller
{
    public function home()
    {
        $sliders = Post::query()->where('slider',1)->where('status',Post::STATUS_VERIFIED)->take(6)->orderBy('id','DESC')->get();
        $courses = Course::query()->whereIn('status',[Course::STATUS_VERIFIED,Course::STATUS_FINISHED])->take(9)->orderBy('id','DESC')->get();
        $companyPics = Company::query()->where('status',Company::STATUS_VERIFIED)->whereNotNull('logo')->select('id','name','slug','logo')->take(10)->orderBy('id','DESC')->get();
        $uniPics = University::query()->whereNotNull('logo')->select('id','name','slug','logo')->take(10)->orderBy('id','DESC')->get();
        return view('home::home',compact('courses','companyPics','uniPics','sliders'));
    }

    public function about()
    {
        return view('home::about');
    }

    public function jobSeekers()
    {
        return view('home::jobSeekers');
    }

    public function employers()
    {
        return view('home::employers');
    }

    public function consultants()
    {
        return view('home::consultants');
    }

    public function service()
    {
        return view('home::service');
    }
    public function contactUs()
    {
        return view('home::contact-us');
    }

    public function internship()
    {
        return view('home::internship');
    }

}
