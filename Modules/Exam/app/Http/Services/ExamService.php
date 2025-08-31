<?php

namespace Modules\Exam\Http\Services;

use Modules\Exam\Models\Exam;

class ExamService
{
    public static function create($request,$courseId)
    {
        $questions = [];
        for($i=0;$i < count($request['qname']);$i++){
            $questions[$i] = [
              'name' => $request['qname'][$i],
              'rate' => $request['qrate'][$i],
              'correct' => $request['qcorrect'][$i],
              'options' => [$request['qoption'][$i*4],$request['qoption'][($i*4)+1],$request['qoption'][($i*4)+2],$request['qoption'][($i*4)+3]]
            ];
        }
        return Exam::query()->create([
            'course_id' => $courseId,
            'name' => $request['name'],
            'slug' => $request['slug'] ?? null,
            'time' => $request['time'],
            'pass' => $request['pass'],
            'exam' => json_encode($questions,JSON_UNESCAPED_UNICODE),
            'certificate' => $request['certificate'] ?? 0,
        ]);
    }

    public static function sumRates(Exam $exam)
    {
        $exam = json_decode($exam->exam,true);
        $rates = array_column($exam,'rate');
        return array_sum($rates);
    }
}
