<template>
	<div>
<div>
  	</div>
    <div >
      <div v-if="this.code==1">
             <p> 用户名为：{{name}}</p>
       <van-button  type="primary" :to="{name:'Changepassword'}">修改密码</van-button>
      <van-button  type="primary" @click="cancellation">注销登录</van-button>
             <van-button  type="primary" :to="{name:'Mylist'}">我的帖子</van-button>

    </div>




    <div v-if="this.code==2" >
           <p> {{name}}</p>
      <van-button type="primary" :to="{
                   name:'Sign',
                   params:{code:code}}">点击登录</van-button>
                 </div>
    </div>
    
    <!-- 之前本地测试的 -->
   <!--  <div><van-button type="primary" @click="change" >进入登录状态</van-button>
      <van-button type="primary" @click="change2" >退出登录状态</van-button></div> -->
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
      axios.post('/api/user/logout.php',{
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
    
    axios.get('/api/user/userquery.php',{       // 还可以直接把参数拼接在url后边
        withCredentials:true,
    }).then(res=>{ 
        this.code = res.data.code;
        this.name = res.data.data;
        if (this.code==2)
      {this.name='您还没有登录';}
         // 加上then，res.data就是数据
    }).catch(error => {
      console.log(error);
      Dialog.alert({
  title: '错误',
  message: '登陆失败',
}).then(() => {
  return;
  // on close
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