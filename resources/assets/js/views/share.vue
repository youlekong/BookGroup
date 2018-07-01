<template>
    <section>
        <el-main>
            <table-filter @addRecord="handleAdd" layout="exact, input, search, add"
                          @filter="filter" :exactTypes="exactTypes"></table-filter>

            <el-table :data="list" stripe style="width: 100%">
                <el-table-column prop="id" label="id" width="50" fixed></el-table-column>
                <el-table-column prop="name" label="分享名" width="150"></el-table-column>
                <el-table-column prop="lng" label="经度" width="150"></el-table-column>
                <el-table-column prop="lat" label="纬度" width="150"></el-table-column>
                <el-table-column prop="info" label="分享描述" width="150"></el-table-column>
                <el-table-column prop="loc" label="分享点信息" width="150"></el-table-column>
                <el-table-column prop="book_count" label="书籍数量" width="150"></el-table-column>
                <el-table-column label="操作" width="180" fixed="right">
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
                <el-form-item label="分享名" prop="name">
                    <el-input v-model.trim="form.name" placeholder="请输入分享名"
                              auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="分享地" prop="loc">
                    <el-input v-model.trim="form.loc" placeholder="请输入分享地"
                              auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="分享经度" prop="lng">
                    <el-input :disabled="true" v-model.trim="form.lng" placeholder="请输入分享经度"
                              auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="分享纬度" prop="lat">
                    <el-input :disabled="true" v-model.trim="form.lat" placeholder="请输入分享纬度"
                              auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="分享说明" prop="info">
                    <el-input v-model.trim="form.info" placeholder="请输入分享说明"
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
    import pagination from '../components/pagination.vue';
    import tableFilter from '../components/tableFilter.vue';
    import { apiGetShares, apiCreateShare, apiUpdateShare,
        apiDeleteShare } from '../api/backend.js';
    import { validValue } from '../tools/lite-validator.js'
    import { ylTrim } from '../tools/common.js'

    export default {
        data() {
            return {
                list: [],
                form: {
                    'name': '',
                    'info': '',
                    'loc': '',
                    'lng': 0.0,
                    'lat': 0.0,
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
                    {type: 'name', name: '分享名'},
                    {type: 'loc', name: '分享地点'},
                ]
            }
        },
        watch: {
            'form.loc'() {
                this.geocoderAddr()
            }
        },
        methods: {
            getlist(keyword) {
                let params = {page: this.pagination.curPage };
                if (keyword)
                    params = Object.assign(params, keyword);

                let self = this;
                apiGetShares(params).then(res => {
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
            handleAdd() {
                this.form = {
                    'name': '',
                    'info': '',
                    'loc': '',
                    'lng': 0.0,
                    'lat': 0.0,
                };
                this.type = 0;
                this.showDialog = true;
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
                apiDeleteShare({id: this.uid}).then( res => {
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
                    apiCreateShare(this.form).then(res => {
                        if (res.code === 1) {
                            self.$message.success(res.msg);
                            self.getlist();
                            self.showDialog = false;
                        } else {
                            self.$message.error(res.msg);
                        }
                    }).catch(err => { console.log(err); })
                } else if (this.type === 1) {
                    apiUpdateShare(this.form).then(res => {
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

                // 书名
                if (ylTrim(this.form.name).length <= 0) {
                    this.$message.error('分享名不能为空！');
                    return false
                }
                if (!validValue.allName(this.form.name) ) {
                    this.$message.error('请输入分享，且长度为2到15！');
                    return false
                }

                // 作者
                if (ylTrim(this.form.loc).length <= 0) {
                    this.$message.error('分享点不能为空！');
                    return false
                }
                if (!validValue.allName(this.form.author) ) {
                    this.$message.error('分享点请输入中文名称或英文！');
                    return false
                }

                // 描述
                if (ylTrim(this.form.desc).length <= 0) {
                    this.$message.error('分享描述不能为空！');
                    return false
                }

                return true;
            },
            geocoderAddr() {
                var myGeo = new BMap.Geocoder();
                var str = this.form.loc;
                var self = this;
                // 将地址解析结果显示在地图上,并调整地图视野
                myGeo.getPoint(str, function(point){
                    if (point) {
//                        console.log(point);
                        self.form.lng = point.lng;
                        self.form.lat = point.lat;
                    }else{
                        console.log('您选择地址没有解析到结果!');
                    }
                });
            }
        },
        components: {
            'pagination': pagination,
            'tableFilter': tableFilter,
        },
        created() {
            this.getlist();
        }
    }
</script>