<template>
    <div class="wrapper">
        <el-card class="box-card" shadow="never">
            <div slot="header" class="clearfix">
                <span>服务器信息</span>
                <!--<el-button style="float: right; padding: 3px 0" type="text">操作按钮</el-button>-->
            </div>

            <div v-for="(item, idx) in info" :key="idx" class="text item">
                {{ idx + ': ' + item }}
            </div>
        </el-card>
    </div>
</template>

<script>
    import { apiGetSysInfo } from '../api/backend';

    export default {
        data() {
            return {
                info: []
            }
        },
        created() {
            apiGetSysInfo().then(res => {
                if (res.code === 1)
                    this.info = res.msg
            })
        }
    }
</script>

<style>
    .wrapper {
        margin: 20px;
    }
    .text {
        font-size: 14px;
    }

    .item {
        margin-bottom: 18px;
    }

    .clearfix:before,
    .clearfix:after {
        display: table;
        content: "";
    }
    .clearfix:after {
        clear: both
    }

    .box-card {
        width: 400px;
    }
</style>