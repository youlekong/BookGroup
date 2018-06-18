<template>
    <section>
        <el-main>
            <table-filter @addRecord="handleAdd"
                          @filter="filter"
                          layout="input, add, search"></table-filter>

            <el-table :data="list" stripe style="width: 100%">
                <el-table-column prop="id" label="id" width="180"></el-table-column>
                <el-table-column prop="name" label="姓名" width="180"></el-table-column>
                <el-table-column prop="c_time" label="日期" width="180"></el-table-column>
                <el-table-column label="操作">
                    <template slot-scope="scope">
                        <el-button size="mini"
                                   @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                        <el-button size="mini" type="danger"
                                   @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>

            <pagination :pagination="pagination" @nextPage="nextPage"></pagination>
        </el-main>

        <el-dialog :title="type?'编辑':'新增'" :visible.sync="showDialog">
            <el-form :model="form" label-width="80px">
                <el-form-item label="姓名" prop="name">
                    <el-input v-model.trim="form.name" :disabled="type==1" placeholder="请输入姓名" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="密码" prop="password">
                    <el-input v-model.trim="form.password" placeholder="请输入密码" type="password" auto-complete="off"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="showDialog = false">取消</el-button>
                <el-button type="primary" @click="submitForm">提交</el-button>
            </div>
        </el-dialog>

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
    import pagination from '../components/pagination.vue';
    import tableFilter from '../components/tableFilter.vue';
    import { apiGetUsers, apiCreateUser,
        apiUpdateUser, apiDeleteUser } from '../api/backend.js';
    import { validValue } from '../tools/lite-validator.js'
    import { ylTrim } from '../tools/common.js'

    export default {
        data() {
            return {
                list: [],
                form: {
                    'name': '',
                    'password': ''
                },
                pagination: {   total: 0, curPage: 1    },
                showDialog: false,
                showDelete: false,
                type: 0,        // 0:新增 1:编辑
                uid: 0,
            }
        },
        methods: {
            getUser(keyword) {
                let params = {page: this.pagination.curPage };
                if (keyword)
                    params = Object.assign(params, keyword);

                let self = this;
                apiGetUsers(params).then(res => {
                    if (res.code === 1) {
                        self.list = res.msg.data;
                        self.pagination.total = res.msg.total;
                        self.pagination.curPage = res.msg.current_page;
                    }
                }).catch(err => {
                    console.log(err);
                })
            },
            filter(keyword) {
                this.getUser(keyword);
            },
            nextPage(page) {
                this.pagination.curPage = page;
                this.getUser();
            },
            handleAdd() {
                this.form = {   'name': '', 'password': ''};
                this.type = 0;
                this.showDialog = true
            },
            handleEdit(index, row) {
                this.form = Object.assign({}, row);
                this.form.password = '';
                this.type = 1;
                this.showDialog = true;
            },
            handleDelete(index, row) {
                this.uid = row.id;
                this.showDelete = true;
            },
            delRecord() {
                let self = this;
                apiDeleteUser({id: this.uid}).then( res => {
                    if (res.code === 1) {
                        self.$message.success(res.msg);
                        self.getUser();
                        self.showDelete = false;
                    } else {
                        self.$message.error(res.msg);
                    }
                }).catch( err => { console.log(err); });
            },
            submitForm() {
                if ( !this._validateForm() )
                    return ;

                let self = this;
                if (this.type === 0) {
                    apiCreateUser(this.form).then(res => {
                        if (res.code === 1) {
                            self.$message.success(res.msg);
                            self.getUser();
                            self.showDialog = false
                        } else {
                            self.$message.error(res.msg);
                        }
                    }).catch(err => { console.log(err); })
                } else if (this.type === 1) {
                    apiUpdateUser(this.form).then(res => {
                        if (res.code === 1) {
                            self.$message.success(res.msg);
                            self.getUser();
                            self.showDialog = false
                        } else {
                            self.$message.error(res.msg);
                        }
                    }).catch( err => { console.log(err); })
                }
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
        },
        components: {
            'pagination': pagination,
            'tableFilter': tableFilter,
        },
        created() {
            this.getUser();
        }
    }
</script>