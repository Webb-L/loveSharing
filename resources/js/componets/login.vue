<template>
    <div v-loading.fullscreen.lock="fullscreenLoading">
        <el-main>
            <h1>登录</h1>
            <div style="margin: 20px;"></div>
            <el-form :label-position="labelPosition" label-width="80px" :model="formLabelAlign">
                <el-form-item label="邮箱">
                    <el-input v-model="formLabelAlign.email"></el-input>
                </el-form-item>
                <el-form-item label="密码">
                    <el-input v-model="formLabelAlign.password" maxlength="16" show-password></el-input>
                </el-form-item>
                <el-form-item label="是否记住我">
                    <el-row>
                        <el-col :span="12">
                            <el-checkbox v-model="formLabelAlign.check" label="true">是</el-checkbox>
                        </el-col>
                        <el-col :span="12" class="getBack">
                            <el-link type="info" :underline="false" @click="password">找回密码</el-link>
                        </el-col>
                    </el-row>
                </el-form-item>
            </el-form>
            <el-row type="flex" justify="center">
                <el-button-group>
                    <el-button id="login" @click="login" disabled type="primary">登录</el-button>
                    <el-button type="info" @click="register">注册></el-button>
                </el-button-group>
            </el-row>
        </el-main>
    </div>
</template>

<script>
    export default {
        name: "login",
        data() {
            return {
                labelPosition: 'top',
                formLabelAlign: {
                    email: '',
                    password: '',
                    check: '',
                },
                fullscreenLoading: false,
            };
        },
        mounted() {
            setInterval(() => {
                if (this.formLabelAlign.email === '' && this.formLabelAlign.password === '') {
                    document.getElementById("login").disabled = "disabled"
                } else {
                    document.getElementById("login").disabled = "";
                    document.getElementById("login").setAttribute('class', "el-button el-button--primary")
                }
            }, 1000)
        },
        methods: {
            register: function () {
                location.href = "#/register"
            },
            message(content, type = "error") {
                this.$message({
                    showClose: true,
                    message: content,
                    type: type
                });
            },
            login: function () {
                axios.post('/login', this.formLabelAlign)
                    .then(response => {
                        if (response.status !== 200) this.message("登录失败，请重试！");
                        if (response.data === 200) {
                            location.href = "#/user";
                        }else if(response.data === 4) {
                            this.message("账号已被禁止登录！");
                        } else {
                            this.message("登录失败，账号或者密码错误！");
                        }
                    })
                    .catch(error => {
                        for (let err in error.response.data.errors) {
                            for (let errors in error.response.data.errors[err]) {
                                this.message(error.response.data.errors[err][errors]);
                            }
                        }
                    })
            },
            password: function () {
                if (this.formLabelAlign.email) {
                    let regMail = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
                    if (!regMail.test(this.formLabelAlign.email)) return this.message('邮箱格式错误！');
                    this.fullscreenLoading = true;
                    axios.post('/password/email', {'email': this.formLabelAlign.email})
                        .then(response => {
                            if (response.status !== 200) return this.message("服务器开小差，请重试！");
                            if (response.data) {
                                this.message(`已经发送给${this.formLabelAlign.email}请查收。`, 'success');
                                this.fullscreenLoading = false;
                            } else {
                                this.message(`找不到${this.formLabelAlign.email}，请确认邮箱是否正确！`);
                                this.fullscreenLoading = false;
                            }
                        })
                        .catch(error => {
                            this.fullscreenLoading = false;
                            for (let err in error.response.data.errors) {
                                for (let errors in error.response.data.errors[err]) {
                                    this.message(error.response.data.errors[err][errors]);
                                }
                            }
                        })
                    this.fullscreenLoading = false;

                } else {
                    return this.message("请输入邮箱！");
                }
            },
        },
    }
</script>

<style scoped>
    .getBack {
        text-align: right;
    }

    #protocol {
        margin-top: 35px;
    }
</style>
