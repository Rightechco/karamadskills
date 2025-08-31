<?php

namespace Modules\Test\Http\Services;

use Modules\Test\Models\Test;

class TestServices
{
    public static function RavenStore($answer,$user_id)
    {
        $before = Test::query()->where('user_id',$user_id)->where('type',Test::RAVEN)->first();
        if ($before) {
            $before->delete();
        }
        return Test::query()->create([
            'user_id' => $user_id,
            'type' => Test::RAVEN,
            'result' => json_encode($answer,JSON_UNESCAPED_UNICODE),
            'free' => (config('tests.raven')) ? 0 : 1,
        ]);
    }

    public static function RavenScore($result)
    {
        $answers = [4,5,1,2,6,3,6,2,1,3,4,5,2,6,2,2,1,3,5,6,4,3,4,5,8,2,3,8,7,4,5,1,7,6,1,2,4,3,3,7,8,6,5,4,1,2,5,6,7,6,8,2,1,5,2,6,1,6,3,5];
        $IQ = [50,50,50,50,50,50,50,50,51,54,58,61,62,64,66,68,69,71,72,74,75,76,78,79,80,81,82,83,85,86,87,88,89,91,92,93,94,96,97,98,100,101,102,104,106,107,109,111,112,114,116,118,120,122,124,126,127,131,133,136];
        $score = $correct = $wrong = $easy = $medium = $hard = 0;
        for ($i=0;$i<60;$i++) {
            if ($answers[$i] == $result[$i]) {
                if ($i < 21) {
                    $easy++;
                } elseif ($i < 41) {
                    $medium++;
                } else {
                    $hard++;
                }
                $score++; $correct++;
            } else {
                $wrong++;
            }
        }
        return ['score' => $IQ[$score],'correct' => $correct,'wrong' => $wrong , 'easy' => $easy , 'medium' => $medium, 'hard' => $hard];
    }

    public static function HollandStore($answer,$user_id)
    {
        $before = Test::query()->where('user_id',$user_id)->where('type',Test::HOLLAND)->first();
        if ($before) {
            $before->delete();
        }
        return Test::query()->create([
            'user_id' => $user_id,
            'type' => Test::HOLLAND,
            'result' => json_encode($answer,JSON_UNESCAPED_UNICODE),
            'free' => (config('tests.holland')) ? 0 : 1,
        ]);
    }

    public static function HollandScore($result)
    {
        $res = json_decode($result,true);
        $score['واقع گرا'] = array_sum($res[0])+array_sum($res[6])+array_sum($res[12])+$res[18]+$res[24];
        $score['جستجوگر'] = array_sum($res[1])+array_sum($res[7])+array_sum($res[13])+$res[19]+$res[25];
        $score['هنری'] = array_sum($res[2])+array_sum($res[8])+array_sum($res[14])+$res[20]+$res[26];
        $score['اجتمائی'] = array_sum($res[3])+array_sum($res[9])+array_sum($res[15])+$res[21]+$res[27];
        $score['متهور'] = array_sum($res[4])+array_sum($res[10])+array_sum($res[16])+$res[22]+$res[28];
        $score['قراردادی'] = array_sum($res[5])+array_sum($res[11])+array_sum($res[17])+$res[23]+$res[29];
        arsort($score);
        return $score;
    }

    public static function mbtiStore($answer,$user_id)
    {
        $before = Test::query()->where('user_id',$user_id)->where('type',Test::MBTI)->first();
        if ($before) {
            $before->delete();
        }
        return Test::query()->create([
            'user_id' => $user_id,
            'type' => Test::MBTI,
            'result' => json_encode($answer,JSON_UNESCAPED_UNICODE),
            'free' => (config('tests.mbti')) ? 0 : 1,
        ]);
    }

    public static function MbtiScore($result)
    {
        $res = json_decode($result,true);
        $score = [];
        foreach ($res as $re) {
            if(key_exists($re[0],$score)) {
                $score[$re[0]] += $re[1];
            } else {
                $score[$re[0]] = $re[1];
            }
        }
        arsort($score);
        $keys = [array_keys($score)[0],array_keys($score)[1],array_keys($score)[2],array_keys($score)[3]];
        if (in_array('i',$keys)) { $mbti = 'i'; } else { $mbti = 'e'; }
        if (in_array('s',$keys)) { $mbti .= 's'; } else { $mbti .= 'n'; }
        if (in_array('t',$keys)) { $mbti .= 't'; } else { $mbti .= 'f'; }
        if (in_array('j',$keys)) { $mbti .= 'j'; } else { $mbti .= 'p'; }
        $scoreArray['mbti'] = $mbti;
        $scoreArray['score'] = $score;
        return $scoreArray;
    }

    public static function eqStore($answer,$user_id)
    {
        $before = Test::query()->where('user_id',$user_id)->where('type',Test::EQ)->first();
        if ($before) {
            $before->delete();
        }
        return Test::query()->create([
            'user_id' => $user_id,
            'type' => Test::EQ,
            'result' => json_encode($answer,JSON_UNESCAPED_UNICODE),
            'free' => (config('tests.eq')) ? 0 : 1,
        ]);
    }

    public static function eqScore($result)
    {
        $res = json_decode($result,true);
        $resolvent = $happiness = $freedom = $tolerance = $selfFulfillment = $selfAwareness = $realism = $relationships = $optimism = $selfEsteem = $impulsivity = $flexibility = $responsibility = $empathy = $selfExpression = 0;
        foreach ($res as $key => $re) {
            switch(true) {
                case in_array(($key+1), [1,16,31,46,61,76]):{
                    $resolvent += $re;
                    break;
                }
                case in_array(($key+1), [2,17,32,47,62,77]):{
                    $happiness += $re;
                    break;
                }
                case in_array(($key+1), [3,18,33,48,63,78]):{
                    $freedom += $re;
                    break;
                }
                case in_array(($key+1), [4,19,49,34,64,79]):{
                    $tolerance += $re;
                    break;
                }
                case in_array(($key+1), [5,20,35,50,65,80]):{
                    $selfFulfillment += $re;
                    break;
                }
                case in_array(($key+1), [6,21,36,51,66,81]):{
                    $selfAwareness += $re;
                    break;
                }
                case in_array(($key+1), [7,22,37,52,67,82]):{
                    $realism += $re;
                    break;
                }
                case in_array(($key+1), [8,23,38,53,68,83]):{
                    $relationships += $re;
                    break;
                }
                case in_array(($key+1), [9,24,39,54,69,84]):{
                    $optimism += $re;
                    break;
                }
                case in_array(($key+1), [10,25,40,55,70,85]):{
                    $selfEsteem += $re;
                    break;
                }
                case in_array(($key+1), [11,26,41,56,71,86]):{
                    $impulsivity += $re;
                    break;
                }
                case in_array(($key+1), [12,27,42,57,72,87]):{
                    $flexibility += $re;
                    break;
                }
                case in_array(($key+1), [13,28,43,58,73,88]):{
                    $responsibility += $re;
                    break;
                }
                case in_array(($key+1), [14,29,44,59,74,89]):{
                    $empathy += $re;
                    break;
                }
                case in_array(($key+1), [15,30,45,60,75,90]):{
                    $selfExpression += $re;
                    break;
                }
                default: {
                    abort(500);
                }
            }
        }
        return [
            'resolvent' => $resolvent,
            'happiness' => $happiness,
            'freedom' => $freedom,
            'tolerance' => $tolerance,
            'selfFulfillment' => $selfFulfillment,
            'selfAwareness' => $selfAwareness,
            'realism' => $realism,
            'relationships' => $relationships,
            'optimism' => $optimism,
            'selfEsteem' => $selfEsteem,
            'impulsivity' => $impulsivity,
            'flexibility' => $flexibility,
            'responsibility' => $responsibility,
            'empathy' => $empathy,
            'selfExpression' => $selfExpression
        ];
    }
}
