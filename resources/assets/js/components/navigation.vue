<template>
    <div style="overflow: hidden;">
        <div class="brand" @click="collapsed">书圈管理系统</div>
        <el-menu style="float:right;" :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect">
        <el-menu-item index="fullScreen">{{fullScreenText}}</el-menu-item>
        <!-- <el-submenu index="2">
        <template slot="title">我的工作台</template>
        <el-menu-item index="2-1">退出</el-menu-item>
        <el-menu-item index="2-2">选项2</el-menu-item>
        <el-menu-item index="2-3">选项3</el-menu-item>
        <el-submenu index="2-4">
        <template slot="title">选项4</template>
        <el-menu-item index="2-4-1">选项1</el-menu-item>
        <el-menu-item index="2-4-2">选项2</el-menu-item>
        <el-menu-item index="2-4-3">选项3</el-menu-item>
        </el-submenu>
        </el-submenu>
        <el-menu-item index="3" disabled>消息中心</el-menu-item>
        <el-menu-item index="4"><a href="https://www.ele.me" target="_blank">订单管理</a></el-menu-item> -->
        </el-menu>
        <div class="user-info">
            <el-dropdown @command="handleCommand">
                <span class="el-dropdown-link">
                    {{username}}<i class="el-icon-arrow-down el-icon--right"></i>
                </span>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item command="logout">退出登录</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </div>
    </div>
</template>

<script>
    import { apiLogout } from '../api/backend';

    export default {
        data() {
            return {
                isCollapse: false,
                activeIndex: '1',
                fullScreenText: '全屏显示',
            };
        },
        computed: {
            username(){
                let uInfo = localStorage.getItem('uInfo');
                try {
                    uInfo = JSON.parse(uInfo);
                } catch (err) {
                    uInfo = ''
                }

                if (uInfo)
                    return uInfo.name;
                else
                    return '';
            }
        },
        methods: {
            handleSelect(key, keyPath) {
                if (key == "fullScreen") {
                    if (!this.isFullscreen()) {
                        this.fullScreenText = '退出全屏';
                        this.setFullscreen();
                    } else {
                        this.fullScreenText = '全屏显示';
                        this.exitFullscreen();
                    }
                }
            },
            collapsed() {
                this.isCollapse = !this.isCollapse;
                bus.$emit('collapse', this.isCollapse);
            },
            handleCommand(command) {
                if (command == 'logout') {
//                    localStorage.removeItem('ms_username')
                    apiLogout().then(res => {
                        if (res.code === 1) {
                            this.$router.push({name: 'login'});
                        }
                    });
                }
            },
            // 进入全屏
            setFullscreen(element) {
                var el = element instanceof HTMLElement ? element : document.documentElement;
                var rfs = el.requestFullscreen       || 
                        el.webkitRequestFullscreen || 
                        el.mozRequestFullScreen    || 
                        el.msRequestFullscreen;
                if (rfs) {
                    rfs.call(el);
                } else if (window.ActiveXObject) {
                    var ws = new ActiveXObject("WScript.Shell");
                    ws && ws.SendKeys("{F11}");
                }
            },
            // 退出全屏
            exitFullscreen() {
                var efs = document.exitFullscreen       || 
                        document.webkitExitFullscreen || 
                        document.mozCancelFullScreen  || 
                        document.msExitFullscreen;
                if (efs) {
                    efs.call(document);
                } else if (window.ActiveXObject) {
                    var ws = new ActiveXObject("WScript.Shell");
                    ws && ws.SendKeys("{F11}");
                }
            },
            // 判断浏览器是否全屏
            isFullscreen() {
                return document.fullscreenElement    ||
                    document.msFullscreenElement  ||
                    document.mozFullScreenElement ||
                    document.webkitFullscreenElement || false;
            },

        }
    }
</script>

<style>
    .brand {
        height: 60px;
        line-height: 60px;
        float: left;
        font-size: 20px;
        margin: 0 20px;
    }

    .user-info {
        float: right;
        padding-right: 50px;
        font-size: 16px;
        color: #fff;
        height: 60px;
        line-height: 60px;
    }

    .user-info .el-dropdown-link {
        position: relative;
        display: inline-block;
        padding-left: 50px;
        /*color: #fff;*/
        cursor: pointer;
        vertical-align: middle;
    }

    .user-info .user-logo {
        position: absolute;
        left: 0;
        top: 15px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
</style>