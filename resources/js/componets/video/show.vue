<template>
    <div>
        <el-row>
            <el-col :span="24" class="header">
                <div class="grid-content bg-purple-dark navbar">
                    <i @click="back" class="el-icon-back"></i><span v-text="title"></span>
                    <el-link :href="user_url">
                        <el-avatar :size="30" :src="circleUrl"></el-avatar>
                    </el-link>
                </div>
            </el-col>
        </el-row>
        <video width="100%" height="100%" ref="video" :src="video_url" @click="videoStatus"></video>
        <div class="pause" ref="pause" id="pause" @click="videoStatus">
            <el-button icon="el-icon-video-play" circle></el-button>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'show',
        data() {
            return {
                video_url: '',
                circleUrl: "https://cube.elemecdn.com/3/7c/3ea6beec64369c2642b92c6726f1epng.png",
                user_url: '',
                title: '',
            }
        },
        mounted() {
            if (location.hash.split('?')[1].split('=')[1]) {
                axios.get('/video/' + location.hash.split('?')[1].split('=')[1])
                    .then(response => {
                        if (response.status !== 200) return this.$parent.message('服务器错误，请重试！');
                        this.video_url = response.data.video_url;
                        this.circleUrl = response.user_avatar ? response.user_avatar : 'https://cube.elemecdn.com/3/7c/3ea6beec64369c2642b92c6726f1epng.png';
                        this.user_url = response.data.user_id ? '/#/user?id=' + response.data.user_id : '/#/user';
                        this.title = response.data.title;
                    });
            } else {
                this.$parent.message("参数错误，正在跳转到上一个页面！");
                setTimeout(function () {
                    history.go(-1);
                }, 1000)
            }
        },
        methods: {
            videoStatus: function () {
                setInterval(() => {
                    if (this.$refs.video.ended) {
                        this.$refs.pause.style.display = 'block';
                    }
                }, 1000);
                if (this.$refs.video.paused) {
                    this.$refs.video.play();
                    this.$refs.pause.style.display = 'none'
                } else {
                    this.$refs.video.pause();
                    this.$refs.pause.style.display = 'block'
                }
            },
            back() {
                history.go(-1);
                this.$parent.navbar = true;
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
        z-index: 99;
    }

    .el-row {
        position: absolute;
        z-index: 999;
        width: 100%;
    }

    video {
        width: 100%;
        height: 100%;
        position: absolute;
        left: 50%;
        transform: translate(-50%, -50%);
        top: 50%;
    }

    .header {
        padding: 16px;
        color: #fff;
    }

    .el-icon-back {
        font-size: 2em;
    }

    .navbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .navbar span {
        margin-left: 32px;
    }

    .title h1,
    .el-icon-video-play {
        margin: 10px
    }
</style>
