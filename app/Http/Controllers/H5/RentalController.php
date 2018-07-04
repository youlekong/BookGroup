<?php

namespace App\Http\Controllers\H5;

use App\Models\Rental;
use App\Http\Requests\RentalRequest;

class RentalController extends ApiController
{
    public function index(RentalRequest $request)
    {
        $params = $request->all();
        $rental = array(
            'from_id' => $params['from_id'],
            'u_id' => $params['u_id'],
            'b_id' => $params['b_id'],
            'start_time' => $params['start_time'],
            'end_time' => $params['end_time'],
            'mark' => $params['mark']
        );

        $result = Rental::create($rental);
        if ( !$result )
            return $this->error('新增失败');

        return $this->success('新建成功');
    }
}