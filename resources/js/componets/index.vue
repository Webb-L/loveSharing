<template>
    <div>
        <video autoplay @click="videoStatus" ref="video" :src="url" id="video"></video>
        <div class="pause" ref="pause" id="pause" @click="videoStatus">
            <el-button icon="el-icon-video-play" circle></el-button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                video: [],
                url: "",
            }
        },
        methods: {
            message(content, type = "error") {
                this.$message({
                    showClose: true,
                    message: content,
                    type: type
                });
            },
            videoStatus: function () {
                setInterval(() => {
                    if (this.$refs.video.ended) {
                        axios.get('/video/list')
                            .then(response => {
                                this.url = response.data.url;
                                this.video = response.data;
                                this.$refs.video.play();
                                this.$parent.user_avatar = {status: true, src: response.data.avatar};
                                this.$parent.user_link = '/#/user?id=' + response.data.user_id;
                                this.message(this.video.title + "播放完成", "warning");
                            }).catch(this.message('服务器错误，请重试。'));
                    }
                }, 1000);
                if (this.url === '') {
                    axios.get('/video/list')
                        .then(response => {
                            this.url = response.data.url;
                            this.video = response.data;
                            this.$refs.video.play();
                            this.$refs.pause.style.display = 'none';
                            this.$parent.user_avatar = {status: true, src: response.data.avatar};
                            this.$parent.user_link = '/#/user?id=' + response.data.user_id;
                            this.message("正在播放" + this.video.title, "success");
                        }).catch(this.message('服务器错误，请重试。'));
                } else {
                    if (this.$refs.video.paused) {
                        this.$refs.video.play();
                        this.$refs.pause.style.display = 'none'
                    } else {
                        this.$refs.video.pause();
                        this.$refs.pause.style.display = 'block'
                    }
                }
            },

        }
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

    video {
        width: 100%;
        height: 100%;
        position: absolute;
        left: 50%;
        transform: translate(-50%, -50%);
        top: 50%;
    }

    #user {
        display: block;
    }
</style>
