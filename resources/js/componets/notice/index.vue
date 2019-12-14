<template>
    <div class="margin-bottom">
        <el-alert v-for="i in alert_list"
                  :title="i.title"
                  :type="i.type"
                  :description="i.description"
                  show-icon
                  @close="hello">
        </el-alert>
    </div>
</template>

<script>
    export default {
        name: "index",
        data() {
            return {
                alert_list: [],
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
                    }
                });
            axios.get('/news')
                .then(response => {
                    if (response.status !== 200) return this.$parent.message("获取信息失败！");
                    if (response.data.length <= 0) return this.$parent.message("你还没有消息！", "warning");
                    for (let news in response.data) {
                        this.alert_list.push(response.data[news])
                    }
                });
        },
        methods: {
            hello() {
                console.log("Hello");
            },
        }
    }
</script>

<style scoped>
    .el-alert {
        width: 92%;
        margin: 16px;
        box-sizing: border-box;
    }

    .margin-bottom {
        margin-bottom: 100px;
    }
</style>
