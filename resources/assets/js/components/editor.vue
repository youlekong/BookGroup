<template>
    <!-- bidirectional data binding（双向数据绑定） -->
    <div class="wrapper">
        <quill-editor v-model="content"
                      ref="myQuillEditor"
                      :options="editorOption"
                      @blur="onEditorBlur($event)"
                      @focus="onEditorFocus($event)"
                      @ready="onEditorReady($event)"
                      @change="onEditorChange($event)">
        </quill-editor>
    </div>
</template>

<script>
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'
    import { quillEditor, Quill } from 'vue-quill-editor'
    import {container, ImageExtend, QuillWatch} from 'quill-image-extend-module'
    Quill.register('modules/ImageExtend', ImageExtend);

    export default {
        props: {
            value: ''
        },
        watch: {
            'value'(val, oldValue) {
//                console.log('val: ', val);
                this.content = val;
            }
        },
        data () {
            return {
                content: this.value || '',
                updateUrl: '/upload/image',
                editorOption: {
                    placeholder: '这里写文章...',
                    modules: {
                        ImageExtend: {
                            loading: true,  // 可选参数 是否显示上传进度和提示语
                            name: 'upload_file',  // 图片参数名
                            size: 3,  // 可选参数 图片大小，单位为M，1M = 1024kb
                            action: '/upload/image',  // 服务器地址, 如果action为空，则采用base64插入图片
                            // response 为一个函数用来获取服务器返回的具体图片地址
                            // 例如服务器返回{code: 200; data:{ url: 'baidu.com'}}
                            // 则 return res.data.url
                            response: (res) => {
//                                console.log(res);
                                return res['file_path']
                            },
                            headers: (xhr) => {
                                let token = document.head.querySelector('meta[name="csrf-token"]');
                                xhr.setRequestHeader('X-CSRF-TOKEN', token.content);
                            },  // 可选参数 设置请求头部
                            start: () => {},  // 可选参数 自定义开始上传触发事件
                            end: () => {},  // 可选参数 自定义上传结束触发的事件，无论成功或者失败
                            error: () => {},  // 可选参数 自定义网络错误触发的事件
                            change: (xhr, formData) => {
                                formData.append('folder', 'article');
                            } // 可选参数 选择图片触发，也可用来设置头部，但比headers多了一个参数，可设置formData
                        },
                        toolbar: {
                            container: container,  // container为工具栏，此次引入了全部工具栏，也可自行配置
                            handlers: {
                                'image': function () {  // 劫持原来的图片点击按钮事件
                                    QuillWatch.emit(this.quill.id)
                                }
                            }
                        }
                    }
                },
            }
        },
        // manually control the data synchronization
        // 如果需要手动控制数据同步，父组件需要显式地处理changed事件
        methods: {
            onEditorBlur(quill) {
//                console.log('editor blur!', quill)
            },
            onEditorFocus(quill) {
//                console.log('editor focus!', quill)
            },
            onEditorReady(quill) {
//                console.log('editor ready!', quill)
            },
            onEditorChange({ quill, html, text }) {
//                console.log('editor change!', quill, html, text);
                this.$emit('input', html);
            }
        },
        computed: {
            editor() {
                return this.$refs.myQuillEditor.quill
            }
        },
        mounted() {
            console.log('this is current quill instance object', this.editor)
        },
        components: {
            quillEditor
        }
    }
</script>

<style scoped>
    .wrapper {
        padding: 0;
        margin: 0;
        line-height: 1;
    }
</style>