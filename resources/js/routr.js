import VueRouter from 'vue-router'

import IndexComponets from './componets/index.vue';
import SearchComponets from './componets/search.vue';
import UserComponets from './componets/user.vue';
import LoginComponets from './componets/login.vue';
import RegisterComponets from './componets/register.vue';
// 视频页
import VideoCreateComponts from './componets/video/create.vue';
import VideoShowComponts from './componets/video/show.vue';
import VideoEditComponts from './componets/video/edit.vue';
//用户页
import UserEditComponts from './componets/user/edit.vue';
//通知页
import NoticeIndexComponts from './componets/notice/index.vue';

const route = new VueRouter({
    routes: [
        {path: '/', component: IndexComponets},
        {path: '/search', component: SearchComponets},
        {path: '/user', component: UserComponets},
        {path: '/login', component: LoginComponets},
        {path: '/register', component: RegisterComponets},
        {path: '/video/create', component: VideoCreateComponts},
        {path: '/video/show', component: VideoShowComponts},
        {path: '/video/edit', component: VideoEditComponts},
        {path: '/user/edit', component: UserEditComponts},
        {path: '/notice', component: NoticeIndexComponts},
    ],
    linkActiveClass: ''
});

export default route;
