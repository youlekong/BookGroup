<template>
    <div>
        <navigation></navigation>
        <el-container style="border: 1px solid #eee">
            <a-side :items="items"></a-side>

            <!--<el-container class="is-vertical" :class="{'content-collapse':isCollapse}">-->
            <div class="content" :class="{'content-collapse':isCollapse}">
                <breadcrumb :items="items"></breadcrumb>

                <transition name="move" mode="out-in">
                    <router-view></router-view>
                </transition>
            </div>
            <!--</el-container>-->

        </el-container>
    </div>
</template>

<script>
    import aside from '../components/aside.vue';
    import navigation from '../components/navigation.vue';
    import breadcrumb from '../components/breadcrumb.vue';

    export default {
        data() {
            return {
                isCollapse: false,
                items: [
                    {   icon: 'el-icon-setting', index: 'index', title: '首页'},
                    {   icon: 'el-icon-tickets', index: 'user', title: '用户信息',
                        subs: [
                            {   index: 'user', title: '用户列表'    }
                        ]
                    },
                    {   icon: 'el-icon-date', index: 'book', title: '书籍信息',
                        subs: [
                            {   index: 'book', title: '书籍列表'    },
                            {   index: 'bookCate', title: '书籍分类'    },
                            {   index: 'bookComment', title: '评论列表' }
                        ]
                    },
                    {   icon: 'el-icon-star-on', index: 'article', title: '文章信息',
                        subs: [
                            {   index: 'article', title: '文章列表'    },
                            {   index: 'articleComment', title: '评论列表' }
                        ]
                    },
                    {   icon: 'el-icon-rank', index: 'group', title: '书圈信息',
                        subs: [
                            {   index: 'group', title: '书圈列表'    },
                            {   index: 'groupCate', title: '书圈分类' }
                        ]
                    },
                    {   icon: 'el-icon-warning', index: 'activity', title: '活动信息',
                        subs: [
                            {   index: 'activity', title: '活动列表'    }
                        ]
                    },
                    {   icon: 'el-icon-time', index: 'rental', title: '租赁信息',
                        subs: [
                            {   index: 'rental', title: '租赁列表'    }
                        ]
                    }
                ]
            }
        },
        created(){
            bus.$on('collapse', msg => {
                this.isCollapse = msg;
            })
        },
        components: {
            'a-side': aside,
            'navigation': navigation,
            'breadcrumb': breadcrumb,
        }
    };
</script>

<style>
    .content {
        background-color: #fff;
        position: absolute;
        left: 200px;
        right: 0;
        top: 70px;
        bottom:0;
        width: auto;
        padding:40px;
        box-sizing: border-box;
        overflow-y: scroll;
        -webkit-transition: left .3s ease-in-out;
        transition: left .3s ease-in-out;
    }
    .content-collapse {
        left: 65px;
    }

    .move-enter-active,.move-leave-active{
        transition: opacity .5s;
    }
    .move-enter,.move-leave{
        opacity: 0;
    }
</style>