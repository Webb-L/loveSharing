require('./bootstrap');

import Vue from 'vue';
import ElementUI from 'element-ui';
import VueRouter from 'vue-router'
// 组件
import app from './componets/app.vue';
import locale from 'element-ui/lib/locale/lang/zh-CN'
import router from './routr'
// 创建
import {
    Dialog,
    Menu,
    Submenu,
    MenuItem,
    MenuItemGroup,
    Input,
    InputNumber,
    Checkbox,
    CheckboxButton,
    CheckboxGroup,
    Switch,
    Button,
    ButtonGroup,
    Form,
    FormItem,
    Alert,
    Icon,
    Row,
    Col,
    Spinner,
    Badge,
    Card,
    Header,
    Aside,
    Main,
    Footer,
    Link,
    Image,
    Calendar,
    Backtop,
    PageHeader,
    CascaderPanel,
    Loading,
    MessageBox,
    Message,
    Notification
} from 'element-ui';

Vue.use(Dialog);
Vue.use(Menu);
Vue.use(Submenu);
Vue.use(MenuItem);
Vue.use(MenuItemGroup);
Vue.use(Input);
Vue.use(InputNumber);
Vue.use(Checkbox);
Vue.use(CheckboxButton);
Vue.use(CheckboxGroup);
Vue.use(Switch);
Vue.use(Button);
Vue.use(ButtonGroup);
Vue.use(Form);
Vue.use(FormItem);
Vue.use(Alert);
Vue.use(Icon);
Vue.use(Row);
Vue.use(Col);
Vue.use(Spinner);
Vue.use(Badge);
Vue.use(Card);
Vue.use(Header);
Vue.use(Aside);
Vue.use(Main);
Vue.use(Footer);
Vue.use(Link);
Vue.use(Image);
Vue.use(Calendar);
Vue.use(Backtop);
Vue.use(PageHeader);
Vue.use(CascaderPanel);

Vue.use(Loading.directive);

Vue.prototype.$loading = Loading.service;
Vue.prototype.$msgbox = MessageBox;
Vue.prototype.$alert = MessageBox.alert;
Vue.prototype.$confirm = MessageBox.confirm;
Vue.prototype.$prompt = MessageBox.prompt;
Vue.prototype.$notify = Notification;
Vue.prototype.$message = Message;Vue.use(ElementUI, {locale});
Vue.use(VueRouter);
new Vue({
    el: '#app',
    data: {},
    methods: {},
    render: c => c(app),
    router
});

