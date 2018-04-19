<template>
    <section>
        <el-main>
            <table-filter @addRecord="handleAdd"  layout="exact, input, search, add"
                          @filter="filter" :exactTypes="exactTypes"></table-filter>

            <el-table :data="list" stripe style="width: 100%">
                <el-table-column type="expand">
                    <template slot-scope="props">
                        <el-form label-position="left" inline>
                            <el-form-item prop="desc" label="书圈简介：">
                                <span>{{props.row.desc}}</span>
                            </el-form-item>
                        </el-form>
                    </template>
                </el-table-column>
                <el-table-column prop="id" label="id" width="50"></el-table-column>
                <el-table-column prop="name" label="书圈名"></el-table-column>
                <el-table-column prop="user.name" label="作者"></el-table-column>
                <!--<el-table-column prop="desc" label="描述" width="250"></el-table-column>-->
                <el-table-column prop="cate.name" label="类别" width="80"
                                 :filters="filters" :filter-method="filterFunc"></el-table-column>
                <el-table-column prop="c_time" label="添加日期"></el-table-column>
                <el-table-column label="操作" >
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
                <el-form-item label="类别" prop="c_id">
                    <el-select v-model="form.c_id" placeholder="请选择类别">
                        <el-option
                                v-for="(cate, idx) in cates"
                                :key="idx"
                                :label="cate.name"
                                :value="cate.id">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="书圈名" prop="name">
                    <el-input v-model.trim="form.name" placeholder="请输入书圈名"
                              auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="作者" prop="author">
                    <el-input v-model.trim="form.author" placeholder="请输入作者"
                              auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="描述" prop="desc">
                    <el-input v-model.trim="form.desc" placeholder="请输入描述"
                              auto-complete="off" type="textarea" rows="5"></el-input>
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
    import pagination from '../../components/pagination.vue';
    import tableFilter from '../../components/tableFilter.vue';
    import { apiGetGroups, apiCreateGroup, apiUpdateGroup,
        apiDeleteGroup, apiGetAllGroupCate } from '../../api/backend.js';
    import { validValue } from '../../tools/lite-validator.js'
    import { ylTrim } from '../../tools/common.js'

    export default {
        data() {
            return {
                filters: [],
                cates: [],
                list: [],
                form: {
//                    'name': '',
//                    'desc': '',
//                    'author': '',
//                    'c_id': 0,
                },
                pagination: {
                    total: 0,
                    curPage: 1,
                },
                showDialog: false,
                showDelete: false,
                type: 0,        // 0:新增 1:编辑
                uid: 0,
                exactTypes: [
                    {type: 'id', name: 'id'},
                    {type: 'name', name: '书圈名'},
                    {type: 'u_name', name: '作者'},
                ]
            }
        },
        methods: {
            getCates() {
                let self = this;
                apiGetAllGroupCate().then(res => {
                    if (res.code === 1) {
                        self.cates = res.msg;
                        self.initFilter(res.msg);
                    }
                }).catch(err => {console.log(err)});
            },
            getlist(keyword) {
                let params = {page: this.pagination.curPage };
                if (keyword)
                    params = Object.assign(params, keyword);

                let self = this;
                apiGetGroups(params).then(res => {
                    if (res.code === 1) {
                        self.list = res.msg.data;
                        self.pagination.total = res.msg.total;
                        self.pagination.curPage = res.msg.current_page;
                    }
                }).catch(err => {
                    console.log(err);
                })
            },
            nextPage(page) {
                this.pagination.curPage = page;
                this.getlist();
            },
            filter(keyword) {
                this.getlist(keyword);
            },
            filterFunc(value, row, column) {
                return row['c_id'] === value;
            },
            initFilter(arr) {
                let filters = [];
                arr.forEach(v => {
                    filters.push({text: v.name, value: v.id});
                });
                this.filters = filters;
            },
            handleAdd() {
                this.form = {
                    'name': '',
                    'desc': '',
                    'author': '',
                    'c_id': '',
                };
                this.type = 0;
                this.showDialog = true
            },
            handleEdit(index, row) {
                this.form = Object.assign({}, row);
                this.type = 1;
                this.showDialog = true;
            },
            handleDelete(index, row) {
                this.uid = row.id;
                this.showDelete = true;
            },
            delRecord() {
                let self = this;
                apiDeleteGroup({id: this.uid}).then( res => {
                    if (res.code === 1) {
                        self.$message.success(res.msg);
                        self.getlist();
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
                    apiCreateGroup(this.form).then(res => {
                        if (res.code === 1) {
                            self.$message.success(res.msg);
                            self.getlist();
                            self.showDialog = false;
                        } else {
                            self.$message.error(res.msg);
                        }
                    }).catch(err => { console.log(err); })
                } else if (this.type === 1) {
                    delete this.form.cate;
                    delete this.form.user;
                    apiUpdateGroup(this.form).then(res => {
                        if (res.code === 1) {
                            self.$message.success(res.msg);
                            self.getlist();
                            self.showDialog = false;
                        } else {
                            self.$message.error(res.msg);
                        }
                    }).catch( err => { console.log(err); })
                }
            },
            _validateForm() {
                // 类别
                if (ylTrim(this.form.c_id).length <= 0) {
                    this.$message.error('类别不能为空！');
                    return false
                }
                if (!validValue.numeric(this.form.c_id) ) {
                    this.$message.error('请输入类别，且为数组！');
                    return false
                }

                // 书名
                if (ylTrim(this.form.name).length <= 0) {
                    this.$message.error('书名不能为空！');
                    return false
                }
                if (!validValue.allName(this.form.name) ) {
                    this.$message.error('请输入书名，且长度为2到15！');
                    return false
                }

                // 作者
                if (ylTrim(this.form.author).length <= 0) {
                    this.$message.error('作者不能为空！');
                    return false
                }
                if (!validValue.allName(this.form.author) ) {
                    this.$message.error('请输入中文名称或英文！');
                    return false
                }

                // 描述
                if (ylTrim(this.form.desc).length <= 0) {
                    this.$message.error('用户名不能为空！');
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
            this.getCates();
            this.getlist();
        }
    }
</script>