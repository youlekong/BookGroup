<template>
    <div style="overflow: hidden;">
        <div class="brand" @click="collapsed">书圈管理系统</div>
        <!--<el-menu style="float:right;" :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect">-->
            <!--<el-menu-item index="1">处理中心</el-menu-item>-->
            <!--<el-submenu index="2">-->
                <!--<template slot="title">我的工作台</template>-->
                <!--<el-menu-item index="2-1">退出</el-menu-item>-->
                <!--<el-menu-item index="2-2">选项2</el-menu-item>-->
                <!--<el-menu-item index="2-3">选项3</el-menu-item>-->
                <!--<el-submenu index="2-4">-->
                    <!--<template slot="title">选项4</template>-->
                    <!--<el-menu-item index="2-4-1">选项1</el-menu-item>-->
                    <!--<el-menu-item index="2-4-2">选项2</el-menu-item>-->
                    <!--<el-menu-item index="2-4-3">选项3</el-menu-item>-->
                <!--</el-submenu>-->
            <!--</el-submenu>-->
            <!--<el-menu-item index="3" disabled>消息中心</el-menu-item>-->
            <!--<el-menu-item index="4"><a href="https://www.ele.me" target="_blank">订单管理</a></el-menu-item>-->
        <!--</el-menu>-->
        <div class="user-info">
            <el-dropdown trigger="click" @command="handleCommand">
                <span class="el-dropdown-link">
                    <!--<img class="user-logo" src="">-->
                    {{username}}
                </span>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item command="loginout">退出登录</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isCollapse: false,
            };
        },
        computed:{
            username(){
                let username = localStorage.getItem('ms_username');
                return username ? username : this.name;
            }
        },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath);
            },
            collapsed() {
                this.isCollapse = !this.isCollapse;
                bus.$emit('collapse', this.isCollapse);
            },
            handleCommand() {
                if(command == 'loginout'){
//                    localStorage.removeItem('ms_username')
                    this.$router.push('/login');
                }
            },
            loginout() {

            }
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
    }
    .user-info .el-dropdown-link{
        position: relative;
        display: inline-block;
        padding-left: 50px;
        color: #fff;
        cursor: pointer;
        vertical-align: middle;
    }
    .user-info .user-logo{
        position: absolute;
        left:0;
        top:15px;
        width:40px;
        height:40px;
        border-radius: 50%;
    }
    .el-dropdown-menu__item{
        text-align: center;
    }
</style>