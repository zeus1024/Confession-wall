<!-- 登陆界面 -->
<template>
  <div>
   <div>
    <Navbar></Navbar>
  </div>
   <div></div>
   <div>
<!-- 输入用户名和密码 -->
    <van-cell-group>
      <van-field
      v-model="input_name"
      label="用户名"
      left-icon="smile-o"
      right-icon="warning-o"
      placeholder="请输入用户名"
      />
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
    <van-button round type="info" @click="sign_in">登录</van-button>
  </div>
  <div>
    <van-button type="primary"  :to="{name:'Register'}">点击注册</van-button>
  </div>
</div>	
</template>
<script>
	import axios from 'axios';
	import Navbar from '../components/Navbar.vue';
  import { Dialog } from 'vant';
  export default {
    name: "Sign",
    components: {
     Navbar,
   },
   data(){
     return {
      code:"",
  		username:'',//登录成功后获取的名字
  		input_name:'',
  		input_password:"",
  	}
  },
  created(){
  },
  methods:{
  	sign_in()
  	{ 
  		if(this.input_password=='' || this.input_name=='')
  		{
  			Dialog.alert({
          message: '输入不能为空',
        }).then(() => {
          return;
    // on confirm
  })

      }
  axios.get('/api/user/access.php',{       // 还可以直接把参数拼接在url后边
    withCredentials:true,
    params:{
      username: this.input_name,
      password: this.input_password,

    }
  }).then(res=>{
    this.username = res.data.data;
    this.code = res.data.code;
        if(this.code==1)
        {
          Dialog.alert({
            message: '登录成功',
          }).then(() => {
            this.$router.go(-1);
    // on confirm
  })
        }
        if(this.code==3)
        {
          Dialog.alert({
            message: '该用户名还没有注册,是否前往注册',
          }).then(() => {
            this.$router.push({name:'Register'})
            .catch(() => {

            });
    // on confirm
  })
        }
        if(this.code==4)
        {
          Dialog.alert({
            message: '用户名或者密码错误',
          }).then(() => {
            return;
          });
    // on confirm

  }

}).catch(error => {
  Dialog.alert({
    title: '网路错误',
    message: error,
  }).then(() => {
    return;
}); 
});
}
}

}
</script>
<style>

</style>