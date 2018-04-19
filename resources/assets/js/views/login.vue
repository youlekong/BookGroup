<template>
    <el-form :model="form" ref="form"
             label-position="left" label-width="0px" class="login-container">
        <h2 class="title">系统登录</h2>
        <el-form-item prop="account">
            <el-input type="text" v-model="form.name"
                      auto-complete="off" placeholder="账号"></el-input>
        </el-form-item>
        <el-form-item prop="checkPass">
            <el-input type="password" v-model="form.password"
                      auto-complete="off" placeholder="密码"></el-input>
        </el-form-item>
        <el-form-item prop="remember">
            <el-checkbox class="remember">记住密码</el-checkbox>
        </el-form-item>
        <el-form-item style="width:100%;">
            <el-button type="primary" style="width:100%;">登录</el-button>
        </el-form-item>
    </el-form>
</template>

<script>

    export default {
        data() {
            return {
                form: {
                    name: '',
                    password: ''
                }
            }
        },
        methods: {

        }
    }
</script>

<style scoped>
    .login-container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background-color: #efefef;
        border-radius: 10px;
    }
</style>

