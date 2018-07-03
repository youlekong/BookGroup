<?php

namespace App\Http\Controllers\H5;

use App\Models\Rental;
use App\Http\Requests\RentalRequest;

class RentalController extends ApiController
{
    public function index(RentalRequest $request)
    {
        $params = $request->all();
//        $u_id = $params['u_id'];
//        $s_id = $params['s_id'];
//        $b_id = $params['b_id'];
//        $from_id = $params['from_id'];

    }
}