<template>
    <div>
        <el-form :inline="true" class="demo-form-inline">
            <el-row type="flex" justify="center">
                <el-input v-model="key" placeholder="输入关键词" maxlength="10" show-word-limit></el-input>
                <el-button type="primary" @click="onSubmit">查询</el-button>
            </el-row>
        </el-form>
        <el-container>
            <el-row>
                <el-col v-for="(data,k) in videoList" :key="k" class="demo-image__placeholder">
                    <el-link :href="'/#/video/show?id='+data.id">
                        <div class="block">
                            <el-image :src="data['displaymap']"></el-image>
                            <div class="content">
                                <div class="title"><h1 v-text="data['title']"></h1></div>
                                <div class="body"><i class="el-icon-video-play"></i></div>
                            </div>
                        </div>
                    </el-link>
                </el-col>
            </el-row>
        </el-container>
    </div>
</template>

<script>
    export default {
        name: "search",
        data() {
            return {
                key: '',
                videoList: [],
            }
        },
        methods: {
            onSubmit() {
                this.videoList = [];
                this.$parent.fullscreenLoading = true;
                axios.post('/video/search', {'key': this.key})
                    .then(response => {
                        this.$parent.fullscreenLoading = false;
                        if (response.status !== 200) return this.$parent.message("我视频获取失败！");
                        if (response.data.length <= 0) return this.$parent.message(`找不到有关${this.key}的视频`);
                        for (let i in response.data) {
                            this.videoList.push(response.data[i]);
                        }
                    })
                    .catch(errors => {
                        this.$parent.fullscreenLoading = false;
                    })
            }
        }
    }
</script>

<style scoped>
    .demo-form-inline {
        padding: 16px;
    }

    .block {
        margin: 16px;
        box-shadow: 0 0 15px 0 rgba(0, 0, 0, .3);
        position: relative;
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


    .el-container {
        margin-bottom: 75px;
    }
</style>
