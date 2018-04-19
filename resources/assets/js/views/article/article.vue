<template>
    <section>
        <el-main>
            <table-filter @addRecord="handleAdd" layout="exact, add, input, search"
                          @filter="filter" :exactTypes="exactTypes"></table-filter>

            <el-table :data="list" stripe style="width: 100%">
                <el-table-column type="expand">
                    <template slot-scope="props">
                        <el-form label-position="left" inline>
                            <el-form-item prop="desc" label="文章内容：">
                                <span>{{props.row.desc}}</span>
                            </el-form-item>
                        </el-form>
                    </template>
                </el-table-column>
                <el-table-column prop="id" label="id" width="50"></el-table-column>
                <el-table-column prop="title" label="标题"></el-table-column>
                <el-table-column prop="user.name" label="作者"></el-table-column>
                <el-table-column prop="c_time" label="添加日期"></el-table-column>
                <el-table-column label="操作" width="250">
                    <template slot-scope="scope">
                        <el-button size="mini"
                                   @click="handlePreview(scope.$index, scope.row)">查看</el-button>
                        <el-button size="mini"
                                   @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                        <el-button size="mini" type="danger"
                                   @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>

            <pagination :pagination="pagination" @nextPage="nextPage"></pagination>
        </el-main>

        <el-dialog :title="type?'编辑':'新增'" :visible.sync="showDialog" :fullscreen=true>
            <el-form :model="form" label-width="80px">
                <el-form-item label="标题" prop="title">
                    <el-input v-model.trim="form.title" placeholder="请输入文章标题"
                              auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="作者" prop="author">
                    <el-input v-model.trim="form.u_name" placeholder="请输入文章作者"
                              auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="内容" prop="desc">
                    <editor v-model.trim="form.desc"></editor>
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

        <el-dialog title="文章预览" :visible.sync="showPreview" width="70%">
            <el-container>
                <preview :article="article"></preview>
            </el-container>
        </el-dialog>
    </section>
</template>

<script>
    import pagination from '../../components/pagination.vue';
    import tableFilter from '../../components/tableFilter.vue';
    import editor from '../../components/editor.vue';
    import preview from '../../components/preview.vue';
    import { apiGetArticles, apiCreateArticle, apiUpdateArticle,
        apiDeleteArticle } from '../../api/backend.js';
    import { validValue } from '../../tools/lite-validator.js'
    import { ylTrim } from '../../tools/common.js'

    export default {
        data() {
            return {
                list: [],
                form: {
                    'title': '',
                    'desc': '',
                    'u_name': ''
                },
                pagination: {   total: 0, curPage: 1    },
                showDialog: false,
                showDelete: false,
                showPreview: false,
                type: 0,        // 0:新增 1:编辑
                uid: 0,
                article: {},
                exactTypes: [
                    {type: 'id', name: 'id'},
                    {type: 'title', name: '标题'},
                    {type: 'u_name', name: '作者'},
                    {type: 'desc', name: '内容'}
                ]
            }
        },
        methods: {
            getList(keyword) {
                let params = {page: this.pagination.curPage };
                if (keyword)
                    params = Object.assign(params, keyword);

                let self = this;
                apiGetArticles(params).then(res => {
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
                this.getList();
            },
            filter(keyword) {
                this.getList(keyword);
            },
            handlePreview(index, row) {
                this.article = Object.assign({}, row);
                this.showPreview = true;
            },
            handleAdd() {
                this.form = {
                    'title': '',
                    'desc': '',
                    'u_name': ''
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
                apiDeleteArticle({id: this.uid}).then( res => {
                    if (res.code === 1) {
                        self.$message.success(res.msg);
                        self.getList();
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
                    apiCreateArticle(this.form).then(res => {
                        if (res.code === 1) {
                            self.$message.success(res.msg);
                            self.getList();
                            self.showDialog = false;
                        } else {
                            self.$message.error(res.msg);
                        }
                    }).catch(err => { console.log(err); })
                } else if (this.type === 1) {
                    let form = {
                        id: this.form.id,
                        u_id: 1,
                        b_id: this.form.b_id,
                        title: this.form.title,
                        desc: this.form.desc,
                    };
                    apiUpdateArticle(form).then(res => {
                        if (res.code === 1) {
                            self.$message.success(res.msg);
                            self.getList();
                            self.showDialog = false;
                        } else {
                            self.$message.error(res.msg);
                        }
                    }).catch( err => { console.log(err); })
                }
            },
            _validateForm() {
                // 类别
//                if (ylTrim(this.form.c_id).length <= 0) {
//                    this.$message.error('类别不能为空！');
//                    return false
//                }
//                if (!validValue.numeric(this.form.c_id) ) {
//                    this.$message.error('请输入类别，且为数组！');
//                    return false
//                }

                // 标题
                if (ylTrim(this.form.title).length <= 0) {
                    this.$message.error('标题不能为空！');
                    return false
                }
                if (!validValue.chinese(this.form.title) ) {
                    this.$message.error('请输入标题，且长度为2到15！');
                    return false
                }

                // 作者
                if (ylTrim(this.form.u_name).length <= 0) {
                    this.$message.error('作者不能为空！');
                    return false
                }
                if (!validValue.allName(this.form.u_name) ) {
                    this.$message.error('请输入中文名称或英文！');
                    return false
                }

                // 描述
                if (ylTrim(this.form.desc).length <= 0) {
                    this.$message.error('内容不能为空！');
                    return false
                }

                return true;
            }
        },
        components: {
            'pagination': pagination,
            'tableFilter': tableFilter,
            'editor': editor,
            'preview': preview
        },
        created() {
            this.getList();
        }
    }
</script>