<?php

namespace Modules\File\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Modules\File\Models\File;
use Modules\University\Models\University;
use Modules\User\Models\User;
use Nette\FileNotFoundException;
use Illuminate\Support\Facades\File as Fi;

class FileController extends Controller
{
    public function ticketFileShow(File $file)
    {
        $ticket = $file->fileable;
        if (auth()->user()->id == $ticket->user_id || auth()->user()->id == $ticket->receiver_id || auth()->user()->can('TicketPermission')) {
            $path = storage_path('app' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'ticketFiles' . DIRECTORY_SEPARATOR . $file->path);
            try {
                $file = Fi::get($path);
                $type = Fi::mimeType($path);
                $response = Response::make($file, 200);
                $response->header("Content-Type", $type);
                return $response;
            } catch (FileNotFoundException $exception) {
                abort(403);
            }
        } else {
            abort(403);
        }
    }

    public function incentiveFileShow(File $file)
    {
        $incentive = $file->fileable;
        $userUnis = array_column(auth()->user()->universities->select('id')->toArray(),'id');
        if(auth()->user()->can('IncentivePermission') ||
            in_array($incentive->type_id,$userUnis) ||
            in_array($incentive->ostan_id,$userUnis) ||
            in_array($incentive->university_id,$userUnis) ||
            $incentive->user_id == auth()->user()->id) {
            $path = storage_path('app' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'incentiveFiles' . DIRECTORY_SEPARATOR . $file->path);
            try {
                $file = Fi::get($path);
                $type = Fi::mimeType($path);
                $response = Response::make($file, 200);
                $response->header("Content-Type", $type);
                return $response;
            } catch (FileNotFoundException $exception) {
                abort(403);
            }
        } else {
            abort(403);
        }
    }

    public function courseFileShow(File $file)
    {
        $course = $file->fileable;
        if (DB::table('course_user')->where('course_id',$course->id)->where('user_id',auth()->user()->id)->count() > 0
        || ($course->courseable_type == 'Modules\University\Models\University' && in_array($course->courseable_id,array_column(auth()->user()->universities->select('id')->toArray(),'id')))
        || ($course->courseable_type == User::class && $course->courseable_id == auth()->user()->id || $course->teacher_id == auth()->user()->id
        || auth()->user()->can('CoursePermission'))) {
            $path = storage_path('app' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'courseFiles' . DIRECTORY_SEPARATOR . $file->path);
            try {
                ini_set('memory_limit', '2056M');
                $file = Fi::get($path);
                $type = Fi::mimeType($path);
                $response = Response::make($file, 200);
                $response->header("Content-Type", $type);
                return $response;
            } catch (FileNotFoundException $exception) {
                abort(403);
            }
        } else {
            abort(403);
        }
    }
}
