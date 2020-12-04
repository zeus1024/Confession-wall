<!-- 修改密码 -->
<template>
	<div class="pa_background">
		<div>
			<!-- 使用navbar组件，上面的导航栏 -->
			<Navbar></Navbar>
		</div>
		
			<!-- 输入原密码 -->

			<van-field class="password1" v-model="oldword" label="原密码" />
			<!-- 输入新密码 -->
			<van-field class="password2"  v-model="newword" label="新密码" />
		
			<!-- 确定修改密码的按钮 -->
			<van-button class="change" type="info" @click="check" color="linear-gradient(to right, #46A3FF, #97cbff)">修改</van-button>
		
	</div>

</template>

<script >
	import axios from 'axios';
	import { Dialog } from 'vant';
	import Navbar from '../components/Navbar.vue';
	export default
	{
		name:'Changepassword',
		components:{Navbar,},
		data(){
			return{
				oldword:'',
				newword:'',
				code:''
			}

		},
		methods:{
			check(){
				if(this.oldword=='' || this.newword=='')
				{
					Dialog.alert({
						title: '错误',
						message: '输入不能为空',
}).then(() => {  // on close
});
}
else{this.changepassword()}
},
changepassword(){
	let data = new FormData();
data.append('password1',this.oldword);
data.append('password2',this.newword);
   axios.post('/php/user/pwdchange.php',
   data,
   ).then(res=>{ 
   	this.code = res.data.code;
 
   	if (this.code==1)

   		{Dialog.alert({
   			title: '提示',
   			message: '修改密码成功',
   		}).then(() => {
   			this.$router.push({name:'UserInformation'})
  // on close
});
   	}
   	if(this.code==0)
   		{Dialog.confirm({
   			title: '提示',
   			message: '修改密码失败，请检查原密码是否正确',
   		})
   	.then(() => {
   		return;
    // on confirm
})
   	;}
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
},


}
</script>

<style scoped>
	 .pa_background{
    position: absolute;
    height: 100%;
    width: 100%;
    background-size: cover;
   background-color:  #AFEEEE;
  }

 .password1{
    position:relative;
 width: 90%;
 left: 5%;
 margin-top:40%;
 padding: 2%;
 }
.password2{
   width: 90%;
  position:relative;
 left: 5%;
 margin-top:10%;
 padding: 2%;
}
  .change{
  position: relative;
 left: 40%;
 margin-top: 20%;
 width: 20%;
  }
</style>