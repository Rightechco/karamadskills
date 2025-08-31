<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;

class CardNumberRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        if (!$this->validateCardNumber($value)) {
            $fail('The :attribute is not a valid card number.');
        }
    }

    private function validateCardNumber($value)
    {
        $irCard = true;
        $card = (string)preg_replace('/\D/', '', $value);
        $strlen = strlen($card);
        if ($irCard == true and $strlen != 16)
            return false;
        if ($irCard != true and ($strlen < 13 or $strlen > 19))
            return false;
        if (!in_array($card[0], [2, 4, 5, 6, 9]))
            return false;

        for ($i = 0; $i < $strlen; $i++) {
            $res[$i] = $card[$i];
            if (($strlen % 2) == ($i % 2)) {
                $res[$i] *= 2;
                if ($res[$i] > 9)
                    $res[$i] -= 9;
            }
        }
        return array_sum($res) % 10 == 0 ? true : false;
    }
}
