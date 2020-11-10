// 由main.js进入，然后生成路由和APP.vue
import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import { Button } from 'vant';
import { Tabbar, TabbarItem } from 'vant';
import { Skeleton } from 'vant';
import { Tab, Tabs } from 'vant';
import { Field } from 'vant';
import { Picker } from 'vant';
import { Toast } from 'vant';
import { Popup } from 'vant';
import { Dialog } from 'vant';
import { Checkbox, CheckboxGroup } from 'vant';
import { Cell, CellGroup } from 'vant';
import { NavBar } from 'vant';
import { Icon } from 'vant';
import { ActionSheet } from 'vant';
import axios from 'axios'; 
import VueAxios from 'vue-axios';
import qs from 'qs';
// axios.defaults.withCredentials = true;

createApp(App)

.use(router)
.use(Checkbox)
.use(CheckboxGroup)
.use(Button)
.use(Tabbar)
.use(NavBar)
.use(TabbarItem)
.use(Field)
.use(Toast)
.use(Icon)
.use(Picker)
.use(Popup)
.use(Skeleton)
.use(Tab)
.use(Tabs)
.use(ActionSheet)
.use(Cell)
.use(Dialog)
.use(CellGroup)
.use(qs)
.use(VueAxios, axios)

.mount("#app");