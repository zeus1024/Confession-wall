import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import Post_detail from "../views/Post_detail.vue";
import Addposts from "../views/Addposts.vue";
import UserInformation from "../views/UserInformation.vue";
import Sign from "../views/Sign.vue";
import Register from "../views/Register.vue";
import Changepassword from "../views/Changepassword.vue";
import Mylist from "../views/Mylist.vue";
// 修改页面路由

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home
    // 引入页面路由
  },

  {
    path: "/Post_detail/:post_id",
    name: "Post_detail",
    component: Post_detail
    // 引入页面路由
  },
  {
    path: "/Addposts/",
    name: "Addposts",
    component: Addposts
    // 引入页面路由
  },
   {
    path: "/UserInformation/",
    name: "UserInformation",
    component: UserInformation
    // 引入页面路由
  },
{
    path: "/Sign/",
    name: "Sign",
    component: Sign
    // 引入页面路由
  },
  {
    path: "/Register/",
    name: "Register",
    component: Register
    // 引入页面路由
  },
  {
    path: "/Changepassword/",
    name: "Changepassword",
    component: Changepassword
    // 引入页面路由
  },
   {
    path: "/Mylist/",
    name: "Mylist",
    component: Mylist
    // 引入页面路由
  },


  // {
  //   path: "/about",
  //   name: "About",
  //   // route level code-splitting
  //   // this generates a separate chunk (about.[hash].js) for this route
  //   // which is lazy-loaded when the route is visited.
  //   component: () =>
  //     import(/* webpackChunkName: "about" */ "../views/About.vue")

  // }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

export default router;
