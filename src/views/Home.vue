<template>
  <div>
   
   <Menu></Menu>
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
    Menu,Posts,UserInformation,Addposts,
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
// 服务器版本
    axios.get('/api/t/getlist.php',{ 
    withCredentials:true,      // 还可以直接把参数拼接在url后边
        params:{
           num:'50',
           offset:'0'
        }

    }).then(res=>{
      
        this.posts = res.data.data;
        this.code= res.data.code;
      // 加上then，res.data就是数据
    }).catch(error => {
        console.log(error);
    });
    //本地json
    // axios.get('data/post.json',{       // 还可以直接把参数拼接在url后边
    //     params:{
    //        num:'5000',
    //        offset:'0'
    //     }
    // }).then(res=>{
    //     console.log(this.posts); 
    //     this.posts = res.data.data;
    //     console.log(this.posts) ; // 加上then，res.data就是数据
    // }).catch(error => {
    //     console.log(error);
    // });

},
methods:{
  changetab(name){
    this.currentTabComponent = name;
  }
},

    
  }

</script>

<style type="text/css"></style>