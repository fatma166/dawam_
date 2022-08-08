<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    //
    public function Index(Request $request)
    {
        $shifts = [];
        $userShifts = $request->user()->userShifts;
       
        foreach ($userShifts as $key => $userShift) {
            # code...
            $shift=$userShift->shift;
            array_push($shifts, $shift);
        }

        return $shifts;
    }
}
