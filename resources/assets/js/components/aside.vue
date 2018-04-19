<template>
    <div class="sidebar">
        <el-aside width="200px" class="sidebar-el-menu">
            <el-menu unique-opened :collapse="isCollapse" router :collapse-transition="noAni">
                <template v-for="item in items">
                    <template v-if="item.subs">
                        <el-submenu :index="item.index" :key="item.index">
                            <template slot="title">
                                <i :class="item.icon"></i><span slot="title">{{ item.title }}</span>
                            </template>
                            <el-menu-item v-for="(subItem,i) in item.subs" :key="i" :index="subItem.index">
                                {{ subItem.title }}
                            </el-menu-item>
                        </el-submenu>
                    </template>
                    <template v-else>
                        <el-menu-item :index="item.index" :key="item.index">
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
                isCollapse: false,
                noAni: false
            }
        },
        created() {
            bus.$on('collapse', msg => {
                this.isCollapse = msg;
            });
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