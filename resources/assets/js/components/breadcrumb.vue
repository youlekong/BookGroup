<template>
    <header style="padding: 0 30px; border-bottom: 1px solid #e6e6e6;">
        <span>{{title}}</span>
        <div style="float:right;">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item v-for="(l,i) in list" :key="i">{{l}}</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
    </header>
</template>

<script>
    export default {
        props: {
            items: ''
        },
        data() {
            return {
                list: [],
            }
        },
        computed: {
            title() {
                let list = this.list;
                if (list.length > 0)
                    return list[1] || list[0];

                return ''
            }
        },
        methods: {
            initSelected(arr) {
                let act = location.hash.substr(7);
                let tmp = [];
                arr.forEach( v => {
                    if (v.hasOwnProperty('subs')) {
//                        self.initSelected(v.subs)
                        v.subs.forEach(sv => {
                            if (sv.index == act) {
                                tmp.push(v.title);
                                tmp.push(sv.title);
                            }
                        })
                    } else {
                        if (v.index == act)
                            tmp.push(v.title);
                    }
                });
                return tmp;
            }
        },
        created() {
            this.list = this.initSelected(this.items);

            let self = this;
            window.onhashchange = function() {
                self.list = self.initSelected(self.items);
            }
        }
    }
</script>

<style>

</style>