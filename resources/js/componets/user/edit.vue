<template>
    <div>
        <el-row>
            <el-col :span="24" class="header">
                <div class="grid-content bg-purple-dark navbar">
                    <i @click="back" class="el-icon-back"></i><span>我的信息</span>
                </div>
            </el-col>
        </el-row>
        <el-form ref="form" :model="form">
            <label for="image">
                <el-row class="demo-avatar demo-basic" id="center">
                    <el-avatar :size="150" :src="avatar"></el-avatar>
                    <input type="file" accept="image/*" ref="image" id="image" class="none" @change="uploadImages">
                </el-row>
            </label>
            <el-form-item label="用户名">
                <el-input v-model="form.name"></el-input>
            </el-form-item>
            <el-link type="info" :underline="false" class="prompt" v-show="prompt" v-text="promptContent"
                     @click="verify_mail"></el-link>
            <el-form-item>
                <el-button type="primary" @click="onSubmit">提交</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
    export default {
        name: "edit",
        data() {
            return {
                prompt: false,
                promptContent: "请验证邮箱后才能正常使用！",
                form: {
                    name: '',
                    image: '',
                },
                avatar: 'https://cube.elemecdn.com/3/7c/3ea6beec64369c2642b92c6726f1epng.png',
                status: '',
                id: '',
            }
        },
        mounted() {
            axios.get('/user')
                .then(response => {
                    if (response.status !== 200) this.$parent.message("验证信息错误，请重新登录！");
                    if (response.data === 0) {
                        this.$parent.message("登录信息已失效，请重新登录，2.5秒后跳转！");
                        setTimeout(function () {
                            location.href = "#/login"
                        }, 2500)
                    } else {
                        this.form.name = response.data[0];
                        this.downshow = !location.hash.split('?')[1] ? true : false;
                        this.avatar = response.data[1];
                        this.prompt = !response.data[2];
                        this.status = response.data[3];
                        this.id = response.data[4];
                    }
                });
        },
        methods: {
            back() {
                history.go(-1);
                this.$parent.navbar = true;
            },
            uploadImages() {
                if (this.$refs.image.files[0]) {
                    this.$parent.fullscreenLoading = true;
                    client.put('/avatar/' + this.$parent.randomStr(false, 43) + "." + this.$refs.image.files[0].name.split('.')[this.$refs.image.files[0].name.split('.').length - 1], this.$refs.image.files[0])
                        .then(response => {
                            this.$parent.fullscreenLoading = false;
                            if (response.res.status !== 200) return this.$parent.message("上传失败！");
                            if (response.url) {
                                this.form.image = response.url;
                                this.$parent.message('上传成功！', 'success');
                                this.$prompt.postMessage("用户操作", "success", "头像上传成功！");
                            } else {
                                this.$parent.message("返回链接失败，请重试！");
                            }
                        })
                        .catch(() => {
                            this.$parent.fullscreenLoading = false;
                            this.$parent.message("服务器错误，请重试！");
                        })
                }
            },
            verify_mail() {
                this.$parent.fullscreenLoading = true;
                axios.post('/email')
                    .then(response => {
                        if (response.status !== 200) this.$parent.message("验证信息错误，请重新登录！");
                        if (response.data === 200) {
                            this.$parent.message("发送成功，请打开邮箱查看！", "primary");
                            this.$parent.fullscreenLoading = false;
                        }
                    })
            },
            onSubmit() {
                if (!this.form.name) return this.$parent.message('用户名不能为空！');
                this.$parent.fullscreenLoading = true;
                axios.post('/user/' + this.id, this.form)
                    .then(response => {
                        this.$parent.fullscreenLoading = false;
                        if (response.status !== 200) return this.$parent.message('服务器错误，请重试！');
                        if (response.data !== 200) return this.$parent.message('修改失败！');
                        this.$parent.message('修改成功，1.5秒后自动刷新网页！', 'success');
                        this.$prompt.postMessage("用户操作", "success", "资料更新成功！");
                        setTimeout(function () {
                            location.reload();
                        }, 1500)
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
        }
    }
</script>

<style scoped>
    .el-form-item {
        margin: 0 16px 35px;
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

    #center {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .name {
        text-align: center;
    }

    .prompt {
        text-align: center;
        width: 100%;
    }

    .title h1,
    .el-icon-video-play {
        margin: 10px
    }

    h2 {
        margin-top: 10vh;
        margin-left: 16px;
    }

    .none {
        display: none !important;
    }
</style>
