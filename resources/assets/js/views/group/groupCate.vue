<template>
    <section>
        <el-main>
            <table-filter @addRecord="handleAdd" layout="add"
                          @filter="filter"></table-filter>

            <el-table :data="list" stripe style="width: 100%">
                <el-table-column prop="id" label="id"></el-table-column>
                <el-table-column prop="icon" label="图片">
                    <template slot-scope="scope">
                        <img :src="scope.row.icon" alt="" width="60" height="60">
                    </template>
                </el-table-column>
                <el-table-column prop="name" label="名称"></el-table-column>
                <el-table-column prop="c_time" label="添加日期"></el-table-column>
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
                <el-form-item label="logo" prop="icon">
                    <el-upload
                            :data="uploadImg.data"
                            name="upload_file"
                            class="avatar-uploader"
                            action="/upload/image"
                            :show-file-list="false"
                            :on-success="handleAvatarSuccess"
                            :before-upload="beforeAvatarUpload">
                        <img v-if="form.icon" :src="form.icon" class="avatar">
                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                    </el-upload>
                </el-form-item>
                <el-form-item label="类别" prop="name">
                    <el-input v-model.trim="form.name" placeholder="请输入类别"
                              auto-complete="off"></el-input>
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
    import { apiGetGroupCates, apiCreateGroupCate, apiUpdateGroupCate,
        apiDeleteGroupCate } from '../../api/backend.js';
    import { validValue } from '../../tools/lite-validator.js'
    import { ylTrim } from '../../tools/common.js'

    export default {
        data() {
            return {
                list: [],
                form: {
                    'name': '',
                    'icon': ''
                },
                pagination: {
                    total: 0,
                    curPage: 1,
                },
                showDialog: false,
                showDelete: false,
                type: 0,        // 0:新增 1:编辑
                uid: 0,
                uploadImg: {
                    data: {folder: 'groupCate', width: 100}
                }
            }
        },
        methods: {
            getCates(keyword) {
                let params = {page: this.pagination.curPage};
                if (keyword)
                    params.keyword = keyword;

                let self = this;
                apiGetGroupCates(params).then(res => {
                    if (res.code === 1) {
                        self.list = res.msg.data;
                        self.pagination.total = res.msg.total;
                        self.pagination.curPage = res.msg.current_page;
                    }
                }).catch(err => {console.log(err)});
            },
            filter(keyword) {
                this.getBook(keyword);
            },
            nextPage(page) {
                this.pagination.curPage = page;
                this.getCates();
            },
            handleAdd() {
                this.form = {
                    'name': '',
                    'icon': ''
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
                apiDeleteGroupCate({id: this.uid}).then( res => {
                    if (res.code === 1) {
                        self.$message.success(res.msg);
                        self.getCates();
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
                    apiCreateGroupCate(this.form).then(res => {
                        if (res.code === 1) {
                            self.$message.success(res.msg);
                            self.getCates();
                            self.showDialog = false;
                        } else {
                            self.$message.error(res.msg);
                        }
                    }).catch(err => { console.log(err); })
                } else if (this.type === 1) {
                    apiUpdateGroupCate(this.form).then(res => {
                        if (res.code === 1) {
                            self.$message.success(res.msg);
                            self.getCates();
                            self.showDialog = false;
                        } else {
                            self.$message.error(res.msg);
                        }
                    }).catch( err => { console.log(err); })
                }
            },
            _validateForm() {
                // 类别
                if (ylTrim(this.form.name).length <= 0) {
                    this.$message.error('类别不能为空！');
                    return false
                }

                if (!validValue.allName(this.form.name) ) {
                    this.$message.error('请输入类别，且长度为2到15！');
                    return false
                }

                return true;
            },
            handleAvatarSuccess(res, file) {
                if (res.success) {
                    this.form.icon = res.file_path || '';
                }
            },
            beforeAvatarUpload(file) {
                const isJPG = file.type === 'image/jpeg';
                const isLt2M = file.size / 1024 / 1024 < 2;

                if (!isJPG) {
                    this.$message.error('上传头像图片只能是 JPG 格式!');
                }
                if (!isLt2M) {
                    this.$message.error('上传头像图片大小不能超过 2MB!');
                }
                return isJPG && isLt2M;
            }
        },
        components: {
            'pagination': pagination,
            'tableFilter': tableFilter,
        },
        created() {
            this.getCates();
        }
    }
</script>

<style>
    .avatar-uploader .el-upload {
        border: 1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .avatar-uploader .el-upload:hover {
        border-color: #409EFF;
    }
    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 100px;
        height: 100px;
        line-height: 100px;
        text-align: center;
    }
    .avatar {
        width: 100px;
        height: 100px;
        display: block;
    }
</style>