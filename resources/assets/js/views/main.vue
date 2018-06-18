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
                actIdx: '1',
                isCollapse: false,
                items: [
                    {   icon: 'el-icon-setting', index: '1', title: '首页', router: 'index' },
                    {   icon: 'el-icon-tickets', index: '2', title: '用户信息', router: 'user',
                        subs: [
                            {   index: '2-1', title: '用户列表', router: 'user',   }
                        ]
                    },
                    {   icon: 'el-icon-date', index: '3', title: '书籍信息', router: 'book',
                        subs: [
                            {   index: '3-1', title: '书籍列表', router: 'book',    },
                            {   index: '3-2', title: '书籍分类', router: 'bookCate',    },
                            {   index: '3-3', title: '评论列表', router: 'bookComment', }
                        ]
                    },
                    {   icon: 'el-icon-star-on', index: '4', title: '文章信息', router: 'article',
                        subs: [
                            {   index: '4-1', title: '文章列表', router: 'article',    },
                            {   index: '4-2', title: '评论列表', router: 'articleComment', }
                        ]
                    },
                    {   icon: 'el-icon-rank', index: '5', title: '书圈信息', groupCate: 'group',
                        subs: [
                            {   index: '5-1', title: '书圈列表', router: 'group',    },
                            {   index: '5-2', title: '书圈分类', router: 'groupCate', }
                        ]
                    },
                    {   icon: 'el-icon-warning', index: '6', title: '活动信息', router: 'activity',
                        subs: [
                            {   index: '6-1', title: '活动列表', router: 'activity',    }
                        ]
                    },
                    {   icon: 'el-icon-time', index: '7', title: '租赁信息', router: 'rental',
                        subs: [
                            {   index: '7-1', title: '租赁列表', router: 'rental',    }
                        ]
                    },
                    {   icon: 'el-icon-view', index: '8', title: '分享信息', router: 'share',
                        subs: [
                            {   index: '8-1', title: '分享列表', router: 'share',    }
                        ]
                    }
                ]
            }
        },
        created(){
            bus.$on('collapse', msg => {
                this.isCollapse = msg;
            });
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