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
import { Cell, CellGroup } from 'vant';

import axios from 'axios';
import VueAxios from 'vue-axios';
import qs from 'qs';


createApp(App)

  .use(router)
 
  .use(Button)
  .use(Tabbar)
   .use(TabbarItem)
    .use(Field)
    .use(Toast)
    .use(Picker)
    .use(Popup)
  .use(Skeleton)
  .use(Tab)
  .use(Tabs)
  .use(Cell)
.use(CellGroup)
  .use(qs)
  .use(VueAxios, axios)

  .mount("#app");