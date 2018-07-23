<?php

namespace App\Http\Controllers\H5;

use App\Models\Book;
use App\Models\UserInfo;
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
            'mark' => $params['mark'],
        );

        $result = Rental::create($rental);
        if ( !$result )
            return $this->error('新增失败');

        if (!Book::where(['id' => $params['b_id']])->update(['status' => Book::STATUS_RENTALED]) )
            return $this->error('新增失败');

        // 更新积分
        $integral = UserInfo::updateIntegralByUidAndType($params['u_id'], UserInfo::RENTALBOOK_INTEGRAL);

        return $this->success('新建成功');
    }

    public function repay(RentalRequest $request) 
    {
        $params = $request->all();
        if ( !$request->has(['u_id', 'b_id', 'from_id']) ) 
            return $this->error('参数错误');

        $uid = $params['u_id'];
        $b_id = $params['b_id'];
        $from_id = $params['from_id'];
        if ( !Rental::where(['u_id'=> $uid, 'b_id' => $b_id, 'from_id' => $from_id])->update(['status' => Rental::RENTAL_REPAY]) )
            return $this->error('归还失败');

        if ( !Book::where(['id'=> $b_id, 'u_id'=>$from_id])->update(['status' => Book::STATUS_RENTALING]) )
            return $this->error('归还失败');

        // 更新积分
        $integral = UserInfo::updateIntegralByUidAndType($params['u_id'], UserInfo::REPAYBOOK_INTEGRAL);

        return $this->success('归还成功');
    }

}