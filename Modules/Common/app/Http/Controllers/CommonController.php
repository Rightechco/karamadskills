<?php

namespace Modules\Common\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Models\Bakhsh;
use Modules\Common\Models\Abadi;
use Modules\Common\Models\Dehestan;
use Modules\Common\Models\Shahr;
use Modules\Common\Models\Shahrestan;

class CommonController extends Controller
{
    public function getShahrestan(Request $request)
    {
        $shahrestan = Shahrestan::where('ostan_id' ,$request->ostan)->get();
        return $shahrestan;
    }

    public function getBakhsh(Request $request)
    {
        $bakhsh = Bakhsh::where('shahrestan_id' ,$request->shahrestan)->get();
        return $bakhsh;
    }

    public function getShahr(Request $request)
    {
        $shahr = Shahr::where('bakhsh_id' ,$request->bakhsh)->get();
        return $shahr;
    }

    public function getDehestan(Request $request)
    {
        $dehestan = Dehestan::where('bakhsh_id' ,$request->bakhsh)->get();
        return $dehestan;
    }

    public function getAbadi(Request $request)
    {
        $abadi = Abadi::where('dehestan_id' ,$request->dehestan)->get();
        return $abadi;
    }
}
