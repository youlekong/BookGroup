<?php

namespace App\Http\Controllers\Admin;

class SystemController extends ApiController
{
    public function index()
    {
        // 服务器版本
        $serverVersion = php_uname('s') . php_uname('r');

        // PHP版本
        $phpVersion = PHP_VERSION;

        // 获取Zend版本：
        $zendVserion =  Zend_Version();

        // Laravel版本
        $laravelVersion = app()::VERSION;

        // 最大执行时间
        $maxCGF = get_cfg_var("max_execution_time")."秒 ";

        // 脚本运行占用最大内存
        $maxMemory = get_cfg_var("memory_limit") ?: "无";

        $data = [
            'php_version' => $phpVersion,
            'server_version' => $serverVersion,
            'zend_vserion' => $zendVserion,
            'laravel_version' => $laravelVersion,
            'max_cgf' => $maxCGF,
            'max_memory' => $maxMemory,
        ];


        return $this->success($data);
    }

}