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
            <el-checkbox class="remember" v-model="form.remember">记住密码</el-checkbox>
        </el-form-item>
        <el-form-item style="width:100%;">
            <el-button @click="login" type="primary" style="width:100%;">登录</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    import { apiLogin } from '../api/backend'
    import { validValue } from '../tools/lite-validator.js'
    import { ylTrim } from '../tools/common.js'

    export default {
        data() {
            return {
                form: {
                    name: '',
                    password: '',
                    remember: false
                }
            }
        },
        methods: {
            login() {
                if ( !this._validateForm() )
                    return ;

                let self = this;
                apiLogin(this.form).then( res => {
                    if (res.code == 1){
                        self.$router.push({name: 'index'});
                    }
                }).catch( err => {
                    console.log(err);
                });
            },
            _validateForm() {
                // 姓名
                if (ylTrim(this.form.name).length <= 0) {
                    this.$message.error('用户名不能为空！');
                    return false
                }
                if (!validValue.allName(this.form.name) ) {
                    this.$message.error('请输入中文字符，且长度为2到15！');
                    return false
                }

                if (ylTrim(this.form.password).length <= 0) {
                    this.$message.error('密码不能为空！');
                    return false
                }
                if (!validValue.password(this.form.password) ) {
                    this.$message.error('请输入6-20位数字、字母、下划线，不能包含空格！');
                    return false
                }

                return true;
            }
        }
    }
</script>

<style scoped>
    .login-container {
        max-width: 350px;
        margin: 50px auto;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #efefef;
    }
</style>

