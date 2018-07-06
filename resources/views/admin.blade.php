<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/nprogress.css') }}">
        <!-- 引入样式 -->
        <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">

        <script src="//cdn.bootcss.com/vue/2.5.7/vue.js"></script>
        {{--<script src="//cdn.bootcss.com/vue-router/3.0.1/vue-router.min.js"></script>--}}
        <!-- 引入组件库 -->
        <script src="https://unpkg.com/element-ui/lib/index.js"></script>
        <script src="//cdn.bootcss.com/axios/0.17.1/axios.min.js"></script>
        <title>后台管理</title>
    </head>
    <body>
        <div id="app">
            <router-view></router-view>
        </div>
    </body>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=Ous0WkmOlcCTgrswniPozXe9q8LDICby"></script>
    <script src="{{ asset('js/nprogress.js') }}"></script>
    <script src="{{ asset('js/cookie.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
