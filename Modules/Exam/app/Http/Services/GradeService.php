<?php

namespace Modules\Exam\Http\Services;

use Modules\Exam\Models\Grade;

class GradeService
{
    public static function create($answer,$examId,$userId)
    {
        return Grade::query()->create([
           'exam_id' => $examId,
            'user_id' => $userId,
            'grade' => json_encode($answer,JSON_UNESCAPED_UNICODE)
        ]);
    }

    public static function getGrade(Grade $grade)
    {
        $exam = json_decode($grade->exam->exam,true);
        $answers = array_column($exam,'correct');
        $rates = array_column($exam,'rate');
        $userA = json_decode($grade->grade,true);
        $grade = 0;
        for ($i = 0; $i < count($answers); $i++) {
            if ($answers[$i] == $userA[$i]) {
                $grade += $rates[$i];
            }
        }
        return $grade;
    }
}
