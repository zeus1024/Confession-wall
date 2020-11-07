<template>
	<div>
	<div>
    <Navbar></Navbar>
  </div>
	<div>
<van-cell-group>
  <van-field
    v-model="input_name"
    label="用户名"
    left-icon="smile-o"
    right-icon="warning-o"
    placeholder="请输入用户名"
     @blur="check_name"
  /><div><van-icon v-if="code==5" name="clear" >该用户名已被注册</van-icon></div>
 <div> <van-icon v-if="code==1" name="checked" >该用户名可用</van-icon></div>
  <van-field
    v-model="input_password"
    clearable
    label="密码"
    left-icon="music-o"
    placeholder="请输入密码"
  />
</van-cell-group>
	</div>
	<div>
		<van-button round type="info" @click="register">注册</van-button>
	</div>
</div>
</template>
<script>
	import axios from 'axios';
	import Navbar from '../components/Navbar.vue';
import { Dialog } from 'vant';
	export default {
  name: "Register",
  components: {
  	Navbar,
  },

data(){
  	return {
      cheakname:'',
  		code:"",
  		username:"",//登录成功后获取的名字
  		input_name:"",
  		input_password:"",
  	}
  },
  created(){
  },
  methods:{
    check_name()
    {
      axios.get('/api/user/r_check.php', {
          withCredentials:true,
      params:{
    username: this.input_name,}
  }).then(res=>{
    this.code = res.data.code;
  })
  .catch(error=>{
    console.log(error);
  });
    },
  	register()
  	{ 
  	axios.get('/api/user/resister.php', {
          withCredentials:true,
  		params:{
    username: this.input_name,
    password: this.input_password,}
  }).then(res=>{
  	this.code = res.data.code;
  	this.username = res.data.data;
    if(this.code==1)
    {
    	Dialog.alert({
  title: '恭喜！！！',
  message: '注册成功！！！',
}).then(() => {
        this.$router.push({name:'Home'})

  // on close
});
    }
    if(this.code==0)
    {
      Dialog.alert({
  title: '抱歉',
  message: '注册失败',
}).then(() => {
       

  // on close
});
    }
  })
  .catch(error=>{
    console.log(error);
  });
  	}
  }
}
</script>
<style >
	
</style>