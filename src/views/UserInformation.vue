<!-- 用户个人信息页面 -->
<template>
	<div>
    <div>
    </div>
    <div>
      <!-- 用户已经登录的显示页面 -->
      <div v-if="this.code==1">
       <p> 用户名为：{{name}}</p>
       <van-button  type="primary" :to="{name:'Changepassword'}">修改密码</van-button>
       <van-button  type="primary" @click="cancellation">注销登录</van-button>
       <van-button  type="primary" :to="{name:'Mylist'}">我的帖子</van-button>

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
 <style type="text/css">
 .return_post{
   font-size: 3rem;
 }	
</style>