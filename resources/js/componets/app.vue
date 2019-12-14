<template>
    <div v-loading.fullscreen.lock="fullscreenLoading">
        <router-view></router-view>
        <el-container v-show="navbar">
            <el-footer>
                <el-row>
                    <el-col :span="6">
                        <div class="grid-content">
                            <router-link to="/search">
                                <el-button icon="el-icon-search" circle></el-button>
                            </router-link>
                        </div>
                    </el-col>
                    <el-col :span="6">
                        <div class="grid-content">
                            <router-link to="/">
                                <el-button icon="el-icon-headset" circle></el-button>
                            </router-link>
                        </div>
                    </el-col>
                    <el-col :span="6" v-show="user_avatar.status">
                        <div class="grid-content user" id="user">
                            <el-link :href="user_link">
                                <el-avatar :src="user_avatar.src"></el-avatar>
                            </el-link>
                        </div>
                    </el-col>
                    <el-col :span="6">
                        <div class="grid-content">
                            <router-link to="/notice">
                                <el-badge :value="count" class="item">
                                    <el-button icon="el-icon-bell" circle></el-button>
                                </el-badge>
                            </router-link>
                        </div>
                    </el-col>
                    <el-col :span="6">
                        <div class="grid-content">
                            <router-link to="/user">
                                <el-button icon="el-icon-user" circle></el-button>
                            </router-link>
                        </div>
                    </el-col>
                </el-row>
            </el-footer>
        </el-container>
    </div>
</template>

<script>
    export default {
        name: "app",
        data() {
            return {
                navbar: true,
                user_avatar: {status: false, src: ""},
                user_link: '',
                fullscreenLoading: false,
                count: 0,
            }
        },
        mounted() {
            axios.get('/user')
                .then(response => {
                    if (response.data !== 0) {
                        setInterval(() => {
                            axios.get('news/count')
                                .then(responses => {
                                    this.count = responses.data;
                                })
                        }, 3000);
                    }
                });
        },
        methods: {
            message(content, type = "error") {
                this.$message({
                    showClose: true,
                    message: content,
                    type: type
                });
            },
            randomStr(randomFlag, min, max) {
                var str = "",
                    range = min,
                    arr = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
                        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',
                        'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v',
                        'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F',
                        'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P',
                        'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
                // 随机产生
                if (randomFlag) {
                    range = Math.round(Math.random() * (max - min)) + min;
                }
                for (var i = 0; i < range; i++) {
                    let pos = Math.round(Math.random() * (arr.length - 1));
                    str += arr[pos];
                }
                return str;
            },
        },
    }
</script>

<style scoped>
    .pause {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(2.5);
        z-index: 99999;
    }

    .el-footer {
        position: fixed;
        bottom: 0;
        width: 100vw;
    }

    .grid-content {
        color: #FFFFFF;
        min-height: 36px;
        text-align: center;
    }

    .user {
        position: absolute;
        top: -48px;
        left: 50%;
        width: 45px;
        border-radius: 50%;
        box-shadow: 0 -1px 5px;
        transform: translateX(-50%) scale(1.3);
    }
</style>
