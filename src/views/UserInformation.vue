<!-- 用户个人信息页面 -->
<template>
	<div>
    <div>
    </div>
    <div class="background-userinformation">
      <!-- 用户已经登录的显示页面 -->
     
      <div v-if="this.code==1"> 
      <van-cell>
       <div class="touxiang">
         <div class="userinformationpicture"><van-icon name="user-circle-o" size="5rem" /></div>
         <div class="yonghuming">
          <div ><van-icon name="star-o" /></div>
          <div style="font-family:NSimSun"> {{name}}</div>
          <div class="arrow"><van-icon name="arrow" /></div>
        </div>
       </div>
</van-cell>
<!-- <van-cell>
    <div >头像</div>
         <div ><p style="font-family:NSimSun"> 用户名为：{{name}}</p></div>
</van-cell>
        -->
     <!--   <div class="operate">
       <van-button  class="box1" round type="info" :to="{name:'Changepassword'}">修改密码</van-button>
       <van-button  class="box2" round type="info" :to="{name:'Mylist'}">我的帖子</van-button>
       <van-button  class="box3" round type="info" @click="cancellation">注销登录</van-button>
       </div> -->
       <div>
   <van-cell-group >
  <van-cell class="operate" title="我的帖子" :to="{name:'Mylist'}"></van-cell>
  <van-cell title="修改密码" :to="{name:'Changepassword'}"></van-cell>
   <van-cell title="注销登录" @click="cancellation"></van-cell>
    <van-cell title="关于我们" ></van-cell>
</van-cell-group>
       </div>
       <div class="scut">华南理工大学  South  China  University  of Technology</div>

     </div>
     <!-- 用户未登录的页面 -->
     <div v-if="this.code==2" >
       <p> {{name}}</p>
       <van-button type="primary" :to="{
         name:'Sign',
         params:{code:code}}">点击登录</van-button>
       </div>
     </div>
     <div>  
      <Menu></Menu>
    </div>
  </div>

</template>
<script >
  import { Dialog } from 'vant';
  import Menu from '../components/Menu.vue';
  import axios from 'axios'

  export default {
    name: "UserImformation",
    components: {
     Menu
   },
   data(){
    return{
      msg:"",
      name:'',
      code:'',

    }

  },

  methods:{
    return_post(){
    	this.$router.go(-1);
    },
    
    change(){
      this.code=1;
    },
    change2(){
      this.code=2;
    },
    
    cancellation()
    {
      axios.post('/php/user/logout.php',{
        withCredentials:true,
      }).then(res=>{
        this.code=res.data.code;
        if(this.code==1)
        {
          Dialog.alert({
            title: '提示',
            message: '注销成功',
          }).then(() => {
            this.name='您还没有登录';
            this.$router.go(0);
  // on close
})
          ;           }
        })
    },
  },

  created(){

    axios.get('/php/user/userquery.php',{       // 还可以直接把参数拼接在url后边
      withCredentials:true,
    }).then(res=>{ 
      this.code = res.data.code;
      this.name = res.data.data;
      if (this.code==2)
        {this.name='您还没有登录';}
         // 加上then，res.data就是数据
       }).catch(error => {
       
       Dialog.alert({
    title: '网路错误',
    message: error,
  }).then(() => {
    return;
}); 
      });

     },
   }
 </script>

 <style scoped>
 @import '../assets/css/userinformation.css';
</style>