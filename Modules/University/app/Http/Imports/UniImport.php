<?php

namespace Modules\University\Http\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Modules\University\Models\University;

class UniImport implements ToArray
{
    public function array(array $array)
    {
        return $array;
    }
}
