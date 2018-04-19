<template>
    <div class="block" style="padding: 20px; text-align: center;">
        <el-pagination
                @current-change="handleCurrentChange"
                :current-page="curPage"
                :page-size="10"
                layout="total, prev, pager, next"
                :total="total">
        </el-pagination>
    </div>
</template>
<script>
    export default {
        props: {
            pagination: ''
        },
        computed: {
            total() {
                if (this.pagination) {
                    return this.pagination.total;
                }
            },
            curPage() {
                if (this.pagination) {
                    return this.pagination.curPage;
                }
            }
        },
        methods: {
//            handleSizeChange(val) {
//                console.log(`每页 ${val} 条`);
//            },
            handleCurrentChange(val) {
//                console.log(`当前页: ${val}`);
                this.$emit('nextPage', val);
            }
        },
        data() {
            return {
            };
        },
    }
</script>