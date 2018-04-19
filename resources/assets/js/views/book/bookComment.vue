<template>
    <section>
        <el-main>
            <table-filter @filter="filter" :exactTypes="exactTypes" @delRecords="showDelete = true"
                          layout="del, input, search, exact"></table-filter>

            <el-table :data="list" stripe style="width: 100%" @selection-change="selsChange">
                <el-table-column type="selection" width="55"></el-table-column>
                <el-table-column prop="id" label="id" width="60"></el-table-column>
                <el-table-column prop="user.name" label="评论人"></el-table-column>
                <el-table-column prop="book.name" label="书名"></el-table-column>
                <el-table-column prop="content" label="内容"></el-table-column>
            </el-table>

            <pagination :pagination="pagination" @nextPage="nextPage"></pagination>
        </el-main>

        <el-dialog title="确认删除" :visible.sync="showDelete" width="30%">
            <span>确认删除？</span>
            <span slot="footer" class="dialog-footer">
                <el-button @click="showDelete = false">取消</el-button>
                <el-button type="primary" @click="delRecord">确定</el-button>
            </span>
        </el-dialog>
    </section>
</template>

<script>
    import pagination from '../../components/pagination.vue';
    import tableFilter from '../../components/tableFilter.vue';
    import { apiGetBookComments, apiDeleteBookComment } from '../../api/backend.js';

    export default {
        data() {
            return {
                list: [],
                pagination: {
                    total: 0,
                    curPage: 1,
                },
                showDelete: false,
                ids: 0,
                exactTypes: [
                    {type: 'id', name: 'id'},
                    {type: 'u_name', name: '评论人'},
                    {type: 'b_name', name: '书名'},
                    {type: 'content', name: '内容'}
                ]
            }
        },
        methods: {
            selsChange(val) {
                this.ids = [];
                let self = this;
                val.forEach( v => {
                    self.ids.push(v.id);
                });
            },
            getBookComment(keyword) {
                let params = {page: this.pagination.curPage};
                if (keyword)
                    params = Object.assign(params, keyword);

                let self = this;
                apiGetBookComments(params).then(res => {
                    if (res.code === 1) {
                        self.list = res.msg.data;
                        self.pagination.total = res.msg.total;
                        self.pagination.curPage = res.msg.current_page;
                    }
                }).catch(err => {console.log(err)});
            },
            filter(keyword) {
                this.getBookComment(keyword);
            },
            nextPage(page) {
                this.pagination.curPage = page;
            },
            delRecord() {
                let self = this;
                apiDeleteBookComment({ids: this.ids}).then( res => {
                    if (res.code === 1) {
                        self.$message.success(res.msg);
                        self.getBookComment();
                        self.showDelete = false;
                    } else {
                        self.$message.error(res.msg);
                    }
                }).catch( err => { console.log(err); });
            },
        },
        components: {
            'pagination': pagination,
            'tableFilter': tableFilter,
        },
        created() {
            this.getBookComment();
        }
    }
</script>