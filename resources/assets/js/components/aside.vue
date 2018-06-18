<template>
    <div class="sidebar">
        <el-aside width="200px" class="sidebar-el-menu">
            <el-menu unique-opened :collapse="isCollapse" router :collapse-transition="noAni" :default-active="actIdx">
                <template v-for="item in items">
                    <template v-if="item.subs">
                        <el-submenu :index="item.index" :key="item.index">
                            <template slot="title">
                                <i :class="item.icon"></i><span slot="title">{{ item.title }}</span>
                            </template>
                            <el-menu-item v-for="(subItem,i) in item.subs" :key="i" :index="subItem.router">
                                {{ subItem.title }}
                            </el-menu-item>
                        </el-submenu>
                    </template>
                    <template v-else>
                        <el-menu-item :index="item.router" :key="item.router">
                            <i :class="item.icon"></i><span slot="title">{{ item.title }}</span>
                        </el-menu-item>
                    </template>
                </template>
            </el-menu>
        </el-aside>
    </div>
</template>

<script>
    export default {
        props: {
            items: ''
        },
        data() {
            return {
                actIdx: 'index',
                isCollapse: false,
                noAni: false
            }
        },
        methods: {
            initActIdx(arr) {
                let act = location.hash.substr(7);
                let tmp = [];
                arr.forEach( v => {
                    if (v.hasOwnProperty('subs')) {
                        v.subs.forEach(sv => {
                            if (sv.router == act) {
                                tmp.push(v.router);
                                tmp.push(sv.router);
                            }
                        })
                    } else {
                        if (v.router == act)
                            tmp.push(v.router);
                    }
                });
                return tmp;
            }
        },
        created() {
            bus.$on('collapse', msg => {
                this.isCollapse = msg;
            });

            var actIdxs = this.initActIdx(this.items);
            this.actIdx = actIdxs.pop();
        }
    };
</script>

<style>
    .el-header {
        background-color: #B3C0D1;
        color: #333;
        line-height: 60px;
    }

    .el-aside {
        color: #333;
    }

    .sidebar{
        display: block;
        position: absolute;
        left: 0;
        top: 70px;
        bottom:0;
    }
    .sidebar > ul {
        height:100%;
    }
</style>