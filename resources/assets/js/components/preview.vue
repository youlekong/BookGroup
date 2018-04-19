<template>
    <div class="newscon-wrap">
        <h2>{{_article.title}}</h2>
        <p class="time">作者：{{_article.user.name}} </p>
        <p class="time">时间：{{_article.c_time}}</p>
        <div class="c">
            <div v-html="_article.desc"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            article: ''
        },
//        data() {
//            return {
//                _article: {
//                    title: '',
//                    c_time: '',
//                    desc: ''
//                }
//            }
//        },
        computed: {
            _article() {
                if (!this.article)
                    return {
                        title: '',
                        c_time: '',
                        desc: ''
                    };

                return this.article;
            }
        },
        methods: {

        },
        data() {
            return {}
        }
    }
</script>

<style>
    .newscon-wrap{ padding-bottom: 50px; width: 100%; overflow: scroll; }
    .newscon-wrap h2{color: #333333;font-size: 28px;text-align: center;}
    .newscon-wrap .time{color: #727272;font-size: 12px;margin-top: 10px;text-align: center;}
    .newscon-wrap .c{margin-top: 20px;}
</style>

