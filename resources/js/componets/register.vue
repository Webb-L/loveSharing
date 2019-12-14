<template>
    <div>
        <el-main>
            <h1>注册</h1>
            <div style="margin: 20px;"></div>
            <el-form :label-position="labelPosition" label-width="80px" :model="formLabelAlign">
                <el-form-item label="昵称">
                    <el-input v-model="formLabelAlign.name" maxlength="10" show-word-limit ref="name"></el-input>
                </el-form-item>
                <el-form-item label="邮箱">
                    <el-input v-model="formLabelAlign.email" ref="email"></el-input>
                </el-form-item>
                <el-form-item label="密码">
                    <el-input v-model="formLabelAlign.password" maxlength="16" show-password ref="password"></el-input>
                </el-form-item>
                <el-form-item label="确认密码">
                    <el-input v-model="formLabelAlign.password_confirmation" maxlength="16" show-password
                              ref="password_confirmation"></el-input>
                </el-form-item>
            </el-form>
            <el-row type="flex" justify="center">
                <el-button-group>
                    <el-button type="info" @click="login">
                        <登录
                    </el-button>
                    <el-button type="primary" @click="register" disabled id="register">注册并同意《用户协议》</el-button>
                </el-button-group>
            </el-row>
        </el-main>
        <div class="protocol">
            <el-link type="primary">《用户协议》</el-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "register",
        data() {
            return {
                labelPosition: 'right',
                formLabelAlign: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                },
            };
        },
        mounted(){
            setInterval(()=>{
                for (let data in this.formLabelAlign) {
                    if (this.formLabelAlign[data] === '') {
                        document.getElementById("register").disabled="disabled"
                    }else {
                        document.getElementById("register").disabled=""
                        document.getElementById("register").setAttribute('class',"el-button el-button--primary")
                    }
                }
            },2000)
        },
        methods: {
            login: function () {
                location.href = "#/login"
            },
            message(content,type="error") {
                this.$message({
                    showClose: true,
                    message: content,
                    type: type
                });
            },
            register: function () {
                if (this.formLabelAlign['password'] !== this.formLabelAlign['password_confirmation']) {
                    this.message("密码和确认密码不一致！");
                } else {
                    axios.post('/register', this.formLabelAlign)
                        .then(response => {
                            if(response.status === 200){
                                for (let data in this.formLabelAlign){
                                    this.formLabelAlign[data] = "";
                                }
                                this.message("注册成功！", "success")
                            }else {
                                this.message("注册失败，请重试!");
                            }
                        })
                        .catch(error => {
                            for(let err in error.response.data.errors){
                                for (let errors in error.response.data.errors[err]){
                                    this.message(error.response.data.errors[err][errors]);
                                }
                            }
                        })
                }
            }
        },
    }
</script>

<style scoped>

    .protocol {
        margin-top: 35px;
        text-align: center;
    }
</style>
