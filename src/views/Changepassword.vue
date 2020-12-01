<!-- 修改密码 -->
<template>
	<div class="backgroundpicture-changepassword">
		<div>
			<!-- 使用navbar组件，上面的导航栏 -->
			<Navbar></Navbar>
		</div>
		<div class="changeinformation">
			<!-- 输入原密码 -->
			<van-field  v-model="oldword" label="原密码" />
			<!-- 输入新密码 -->
			<van-field v-model="newword" label="新密码" />
		</div>
		<div class="changebutton">
			<!-- 确定修改密码的按钮 -->
			<van-button type="info" @click="check" color="linear-gradient(to right, #46A3FF, #97cbff)">修改</van-button>
		</div>
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

<style>
	.backgroundpicture-changepassword{ 
    height: 100%;
    width: 100%;
    background-image: url(https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=2193922693,786190290&fm=26&gp=0.jpg) ;
    position: fixed;
    background-size: cover;
  }
    
    .changeinformation{
    	position: fixed;
    	top: 40%;
    	width: 80%;
    	left: 10%;
    	right: 10%;
    }
 
    .changebutton{
    	position: fixed;
    	top: 60%;
    	width: 20%;
    	left: 40%;
    	right: 40%;
    }
</style>
