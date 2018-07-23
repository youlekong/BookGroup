<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;


class UserInfo extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'user_info';

    public $timestamps = false;

    protected $fillable = [
        'u_id',
    ];

    const SIGNIN_INTEGRAL = 'SIGNIN';
    const RENTALBOOK_INTEGRAL = 'RENTALBOOK';
    const REPAYBOOK_INTEGRAL = 'REPAYBOOK';
    const INTEGRALTYPE = array(
        'SIGNIN' => 10,
        'RENTALBOOK' => 100,
        'REPAYBOOK' => 150,
    );

    public static function updateIntegralByUidAndType($u_id, $type) 
    {
        $integral = self::INTEGRALTYPE[$type];
        $flag = DB::table('user_info')->where(['u_id' => $u_id])->increment('integral', $integral);

        // $info = self::where('u_id', $u_id)->first();
        // $integral = $integral + $info->integral;
        // self::where('u_id', $u_id)->update(['integral' => $integral]);

        return $flag;
    }
    


}
