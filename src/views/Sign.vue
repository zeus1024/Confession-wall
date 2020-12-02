<!-- 登陆界面 -->
<template>
  <div><Navbar></Navbar></div>
  <body>

  <div class="backgroundpicture-sign">
  <div class="zhanghao" >
    <!-- 输入用户名和密码 -->
    <van-cell-group>
      <van-field
      v-model="input_name"
      label="用户名"
      left-icon="friends"
      right-icon="arrow-left"
      placeholder="请输入用户名"
      />
      <van-field
      v-model="input_password"
      clearable
      label="密码"
      left-icon="star"
      right-icon="arrow-left"
      placeholder="请输入密码"
      />
    </van-cell-group>
  </div>

  <div class="denglu">
    <van-button round type="info" @click="sign_in" color="#0080ff" plain >登录</van-button>
  </div>

  <div class="zhuce">
    <van-button type="primary"  :to="{name:'Register'}" color="linear-gradient(to right, #00ffff, #0080ff)">点击注册</van-button>
  </div>

</div>	

</body>

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
      let data = new FormData();
      data.append('username',this.input_name);
      data.append('password',this.input_password);
  axios.post('/php/user/access.php',       // 还可以直接把参数拼接在url后边
   
   data,
   ).then(res=>{
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

  .backgroundpicture-sign{ 
    height: 100%;
    width: 100%;
    background-size: cover;
    background-image: url(https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=2193922693,786190290&fm=26&gp=0.jpg) ;
    position: fixed;
  }

 .zhanghao{
 background-color: red;
 width: 75%;
 left: 13%;
 top: 30%;
 position: fixed;



 }

  .denglu{
  top: 44%;
  left: 42%;
  position: fixed;
 
  }

  .zhuce{
  position: fixed;
  top: 55%;
  left: 39%;
  }


</style>