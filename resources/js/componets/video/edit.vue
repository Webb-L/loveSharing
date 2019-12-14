<template>
    <div>
        <el-row>
            <el-col :span="24" class="header">
                <div class="grid-content bg-purple-dark navbar">
                    <i @click="back" class="el-icon-back"></i><span>编辑视频</span>
                </div>
            </el-col>
        </el-row>
        <el-form :label-position="labelPosition" :model="formData" label-width="80px" class="labelPosition">
            <el-form-item label="名称">
                <el-input v-model="formData.title" maxlength="10" show-word-limit></el-input>
            </el-form-item>
            <el-form-item label="缩略图">
                <el-link disabled>如果不想修改图片请不要点击选择文件</el-link>
                <input type="file" accept="image/png,image/gif,image/jpeg" ref="image" @change="uploadImages">
            </el-form-item>
            <el-form-item label="视频">
                <el-link disabled>如果不想修改视频请不要点击选择文件</el-link>
                <input type="file" accept="video/*" ref="video" @change="uploadVideo">
            </el-form-item>
            <el-button type="primary" @click="submitUpload">发布</el-button>
        </el-form>
    </div>
</template>

<script>
    export default {
        name: "edit",
        data() {
            return {
                labelPosition: 'left',
                formData: {
                    title: '',
                    image_url: '',
                    video_url: ''
                },
            }
        },
        mounted() {
            axios.get('/video/' + location.hash.split('?')[1].split('=')[1])
                .then(response => {
                    if (response.status !== 200) return this.$parent.message('服务器错误，请重试！');
                    this.formData.title = response.data.title;
                });
        },
        methods: {
            videoStatus: function () {
            },
            back() {
                history.go(-1);
                this.$parent.navbar = true;
            },
            uploadImages() {
                if (this.$refs.image.files[0]) {
                    this.$parent.fullscreenLoading = true;
                    client.put('/image/' + this.$parent.randomStr(false, 43) + "." + this.$refs.image.files[0].name.split('.')[this.$refs.image.files[0].name.split('.').length - 1], this.$refs.image.files[0])
                        .then(response => {
                            this.$parent.fullscreenLoading = false;
                            if (response.res.status !== 200) return this.$parent.message("上传失败！");
                            if (response.url) {
                                this.formData.image_url = response.url;
                                this.$parent.message('上传成功！', 'success');
                            } else {
                                this.$parent.message("返回链接失败，请重试！");
                            }
                        })
                        .catch(err => {
                            this.$parent.fullscreenLoading = false;
                            this.$parent.message("服务器错误，请重试！");
                        })
                }
            },
            uploadVideo() {
                if (this.$refs.video.files[0]) {
                    this.$parent.fullscreenLoading = true;
                    client.put('/video/' + this.$parent.randomStr(false, 43) + "." + this.$refs.video.files[0].name.split('.')[this.$refs.video.files[0].name.split('.').length - 1], this.$refs.video.files[0])
                        .then(response => {
                            this.$parent.fullscreenLoading = false;
                            if (response.res.status !== 200) return this.$parent.message("上传失败！");
                            if (response.url) {
                                this.formData.video_url = response.url;
                                this.$parent.message('上传成功！', 'success');
                            } else {
                                this.$parent.fullscreenLoading = false;
                                this.$parent.message("返回链接失败，请重试！");
                            }
                        })
                        .catch(err => {
                            this.$parent.fullscreenLoading = false;
                            this.$parent.message("服务器错误，请重试！");
                        })
                }
            },
            submitUpload() {
                if (!this.formData.title) return this.$parent.message('标题 不能为空！');
                this.$parent.fullscreenLoading = true;
                axios.post('/video/' + location.hash.split('?')[1].split('=')[1], this.formData)
                    .then(response => {
                        this.$parent.fullscreenLoading = false;
                        if (response.status !== 200) return this.$parent.message('服务器错误，请重试！');
                        if (response.data !== 200) return this.$parent.message('修改失败，请重试！');
                        this.$parent.message('修改成功！', 'success');
                    })
                    .catch(error => {
                        this.$parent.fullscreenLoading = false;
                        for (let err in error.response.data.errors) {
                            for (let errors in error.response.data.errors[err]) {
                                this.$parent.message(error.response.data.errors[err][errors]);
                            }
                        }
                    })
            },
        },
    }
</script>

<style scoped>
    .labelPosition {
        padding: 16px
    }

    .header {
        padding: 16px;
    }

    .el-icon-back {
        font-size: 2em;
    }

    .navbar {
        display: flex;
        align-items: center;
    }

    .navbar span {
        margin-left: 32px;
    }

</style>
