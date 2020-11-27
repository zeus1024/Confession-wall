<!-- 用户个人信息页面 -->
<template>
	<div>
    <div>
    </div>
    <div class="background-userinformation">
      <!-- 用户已经登录的显示页面 -->
      <div style="font-size: 1px;text-align:center;color: gray;margin-top: 10px;">华南理工大学  South  China  University  of Technology</div>
      <div v-if="this.code==1">
      
       <div class="touxiang">
         <div class="circle">头像</div>
         <div class="yonghuming"><p style="font-family:NSimSun"> 用户名为：{{name}}</p></div>
       </div>


       
       <div class="operate">
       <van-button  class="box1" round type="info" :to="{name:'Changepassword'}">修改密码</van-button>
       <van-button  class="box2" round type="info" :to="{name:'Mylist'}">我的帖子</van-button>
       <van-button  class="box3" round type="info" @click="cancellation">注销登录</van-button>
       </div>
      

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

 <style >
.circle{
    width:4rem;
    height:4rem;
    background-color: gray;
    position: fixed;
    border-radius: 30%;
    left: 10%;
    top: 10%;
    font-size: 20px;
    text-align: center;
    font-family:NSimSun
  }

 .touxiang{

   width: 400px;
   height: 80px;
   margin-top: 40px;
   

 }

 .yonghuming{
   position: fixed;
   width: 6rem;
   height: 4rem;
   left: 40%;
   top: 10%;
 }

  .box1{
    width: 42%;
    color: blue;
    font-family:NSimSun;
    position:fixed;
    top: 30%;
    left: 29%;
    right: 29%;
  }

   .box2{
    width: 42%;
    color: blue;
    font-family:NSimSun;
    position:fixed;
    top: 48%;
    left: 29%;
    right: 29%;
  }

   .box3{
    width: 42%;
    color: blue;
    font-family:NSimSun;
    position:fixed;
    top: 66%;
    left: 29%;
    right: 29%;
  }
 
  .background-userinformation{
    height: 100%;
    width: 100%;
    background-image: url(https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=2193922693,786190290&fm=26&gp=0.jpg) ;
    position: fixed;
    background-size: cover;
  }
  
</style>
