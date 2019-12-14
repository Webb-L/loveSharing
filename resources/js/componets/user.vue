<template>
    <div>
        <el-row v-show="!prompt" type="flex" justify="end">
            <el-col :span="12" v-show="tool">
                <router-link to="/video/create">
                    <i class="el-icon-s-promotion"></i>
                </router-link>
            </el-col>
            <el-col :span="12" v-show="tool" class="tool">
                <router-link to="/user/edit">
                    <i class="el-icon-s-tools"></i>
                </router-link>
            </el-col>
        </el-row>
        <el-row class="demo-avatar demo-basic" id="center">
            <el-avatar :size="150" :src="avatar"></el-avatar>
        </el-row>
        <h1 class="name" v-text="name">
            <el-link disabled v-text="status"></el-link>
        </h1>
        <el-link type="info" :underline="false" class="prompt" v-show="prompt" v-text="promptContent" @click="verify_mail"></el-link>
        <div>
            <h2 v-text="video_title"></h2>
            <el-container>
                <el-row>
                    <el-col v-for="(data,k) in videoList" :key="k" class="demo-image__placeholder">
                        <div class="block">
                            <div class="down" v-show="downshow">
                                <el-link :href="'/#/video/edit?id='+data.id" class="white">编辑</el-link>
                                |
                                <el-link type="danger" @click="open(data.id)">删除</el-link>
                            </div>
                            <el-image :src="data['displaymap']"></el-image>
                            <div class="content">
                                <div class="title"><h1 v-text="data['title']"></h1></div>
                                <el-link :href="'/#/video/show?id='+data.id">
                                    <div class="body"><i class="el-icon-video-play"></i></div>
                                </el-link>
                            </div>
                        </div>
                    </el-col>
                </el-row>
            </el-container>
        </div>
    </div>
</template>

<script>
    export default {
        name: "user",
        data() {
            return {
                prompt: false,
                promptContent: "请验证邮箱后才能正常使用！",
                name: '',
                avatar: 'https://cube.elemecdn.com/3/7c/3ea6beec64369c2642b92c6726f1epng.png',
                status: '',
                videoList: [],
                video_title: '',
                tool: true,
                downshow: true,
            }
        },
        mounted() {
            let url = location.hash.split('?')[1] ? location.hash.split('?')[1] : '';
            this.tool = !location.hash.split('?')[1] ? true : false;
            this.$parent.user_avatar = {status: false, src: ""};
            axios.get('/user?' + url)
                .then(response => {
                    if (response.status !== 200) this.$parent.message("验证信息错误，请重新登录！");
                    if (response.data === 0) {
                        this.$parent.message("登录信息已失效，请重新登录，2.5秒后跳转！");
                        setTimeout(function () {
                            location.href = "#/login"
                        }, 2500)
                    } else {
                        this.name = response.data[0];
                        this.video_title = location.hash.split('?')[1] ? response.data[0] + '的视频' : '我的视频';
                        this.downshow = !location.hash.split('?')[1] ? true : false;
                        this.avatar = response.data[1];
                        this.prompt = !response.data[2];
                        this.status = response.data[3];
                    }
                });
            axios.get('/video/user?' + url)
                .then(response => {
                    if (response.status !== 200) this.$parent.message("我视频获取失败！");
                    for (let i in response.data) {
                        this.videoList.push(response.data[i]);
                    }
                });
        },
        methods: {
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
            open(id) {
                this.$confirm(`是否要删除`, '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    axios.delete('/video/' + id)
                        .then(response => {
                            if (response.status !== 200) this.$parent.message("删除失败，请重试！");
                            this.$parent.message("删除成功！", 'success');
                            location.reload();
                        })
                        .catch(() => {
                            this.$parent.message("服务器错误，请重试！");
                        });
                    /**
                     let video_url = this.videoList[id].url.split('//')[1];
                     let image_url = this.videoList[id].displaymap.split('//')[1];
                     let video = video_url.split('/')[1] + "/" + video_url.split('/')[2];
                     let image = image_url.split('/')[1] + "/" + image_url.split('/')[2];
                     client.delete(video)
                     .then(response => {
                            if (response.res.statusCode !== 204) return this.$parent.message('删除视频失败！');
                        })
                     .catch(() => {
                            this.$parent.message("服务器错误，请重试！");
                        });
                     client.delete(image)
                     .then(response => {
                            if (response.res.statusCode !== 204) return this.$parent.message('删除视频失败！');
                        })
                     .catch(() => {
                            this.$parent.message("服务器错误，请重试！");
                        });
                     **/
                }).catch(() => {

                });
            },
        }
    }
</script>

<style scoped>
    #center {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .tool {
        display: flex;
        justify-content: flex-end;
    }
    .name {
        text-align: center;
    }

    .el-icon-s-tools,
    .el-icon-s-promotion {
        transform: scale(1.5);
        margin: 10px;
        color:#000;
    }

    .prompt {
        text-align: center;
        width: 100%;
    }

    .block {
        margin: 16px;
        box-shadow: 0 0 15px 0 rgba(0, 0, 0, .3);
        position: relative;
    }

    .down {
        position: absolute;
        top: 0;
        right: 10px;
        z-index: 999;
    }

    .content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .el-icon-video-play {
        font-size: 2em;
    }

    .title h1,
    .el-icon-video-play {
        margin: 10px
    }

    h2 {
        margin-top: 10vh;
        margin-left: 16px;
    }

    .white {
        color: white;
    }

    .el-container {
        margin-bottom: 75px;
    }
</style>
