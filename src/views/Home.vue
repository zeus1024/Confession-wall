<template>
  <div>
   <Menu ></Menu>
      <keep-alive >
        <component v-bind:is="currentTabComponent" :postdata="posts"></component>
      </keep-alive>
      
    <!-- 使用路由 -->
  </div>
<!-- 路由匹配到的组件将显示在这里 -->

  <!-- <router-view /> -->
</template>
<script >
  import Menu from '../components/Menu.vue'
import axios from 'axios';
import Posts from './Posts.vue';
  import UserInformation from './UserInformation.vue';
   import Addposts from './Addposts.vue';
    
export default
{
  name:'Home',
  components:{
    Menu,Posts,UserInformation,Addposts
  },
 data () {
    return {
     currentTabComponent:"Posts",
     posts:'',
    }
  },
  computed: {},
  // created:vue生命周期中的钩子函数，在这个时间点，data中的数据已经注入到响应式系统中
created(){

    axios.get('data/post.json',{       // 还可以直接把参数拼接在url后边
        params:{
            title:'all'
        }
    }).then(res=>{
        console.log(this.posts); 
        this.posts = res.data.data;
        console.log(this.posts) ; // 加上then，res.data就是数据
    }).catch(error => {
        console.log(error);
    });
},
methods:{
  changetab(name){
    this.currentTabComponent = name;
  }
},

    
  }

</script>

<style lang="less">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
