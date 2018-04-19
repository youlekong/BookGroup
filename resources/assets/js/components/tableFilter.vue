<template>
    <div>
        <el-row :gutter="20">
            <!--// del, exact, input, datetime, search, add-->
            <el-col :span="2" v-if="comps.indexOf('del') !== -1">
                <el-button type="danger" size="small" plain @click="delRecords">删除</el-button>
            </el-col>
            <el-col :span="3" v-if="comps.indexOf('exact') !== -1">
                <el-select v-model="exactKey" placeholder="请选择" size="small">
                    <el-option
                            v-for="(exact, idx) in exactTypes"
                            :key="idx"
                            :label="exact.name"
                            :value="exact.type">
                    </el-option>
                </el-select>
            </el-col>
            <el-col :span="4" v-if="comps.indexOf('input') !== -1">
                <el-input :placeholder="placeholder" size="small" v-model="keyword">
                    <i slot="prefix" class="el-input__icon el-icon-search"></i>
                </el-input>
            </el-col>
            <slot name="otherCol"></slot>
            <el-col :span="9" v-if="comps.indexOf('datetime') !== -1">
                <el-date-picker
                        size="small"
                        v-model="dateTime"
                        type="daterange"
                        range-separator="至"
                        start-placeholder="开始日期"
                        value-format="yyyy-MM-dd"
                        end-placeholder="结束日期">
                </el-date-picker>
            </el-col>
            <el-col :span="2" v-if="comps.indexOf('search') !== -1">
                <el-button size="small" type="primary" plain @click="filterAct">搜索</el-button>
            </el-col>
            <el-col :span="2" style="float: right;" v-if="comps.indexOf('add') !== -1">
                <el-button size="small" @click="addRecord" type="primary">新增</el-button>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        props: {
            layout: '', // del, exact, input, datetime, search, add
            exactTypes: '',
            placeholder: {
                type: String,
                default: '搜索内容'
            }
        },
        computed: {
            comps() {
                if (this.layout)
                    return this.layout.split(',').map((item) => item.trim());
                return '';
            },
        },
        data() {
            return {
                keyword: '',        // input
                dateTime: '',
                exactKey: ''
            }
        },
        methods: {
            filterAct() {
                let params = {};
                if (this.dateTime instanceof Array) {
                    let val = this.dateTime;
                    params.start_time = val[0];
                    params.end_time = val[1];
                }

                if (this.keyword.trim().length > 0) {
                    if (this.exactKey) {
                        params[this.exactKey] = this.keyword.trim();
                    } else {
                        params.keyword = this.keyword.trim();
                    }
                }

                this.$emit('filter', params);
            },
            addRecord() {
                this.$emit('addRecord')
            },
            delRecords() {
                this.$emit('delRecords');
            }
        },
        created() {
            if (this.exactTypes)
                this.exactKey = 'id';
        }
    }
</script>

<style>

</style>