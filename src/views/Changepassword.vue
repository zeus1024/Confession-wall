<template>
<div>
	<div>
		<Navbar></Navbar>

	</div>
	<div>
	<!-- 输入任意文本 -->
<van-field v-model="oldword" label="原密码" />
<!-- 输入任意文本 -->
<van-field v-model="newword" label="新密码" />
</div>
<div>
	<van-button type="info" @click="check">确定修改</van-button>
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
   axios.get('/api/user/pwdchange.php',{       // 还可以直接把参数拼接在url后边
        withCredentials:true,
        params:{
          password1:this.oldword,
          password2:this.newword,
        }
    }).then(res=>{ 
        this.code = res.data.code;
        console.log(this.code);
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
      console.log(error);
     
    });
},
},
//   	changepassword()
//     {
//        axios.post('/api/user/pwdchange.php',{
//         withCredentials:true,
//         params:{
//           Password1:this.oldword,
//           Password2:this.newword,
//         }
//       }).then(res=>{
//         this.code=res.data.code;
//         if(this.code==1)
//         {Dialog.alert({
//   title: '提示',
//   message: '修改密码成功',
// }).then(() => {
//     this.$router.push({name:'UserInformation'}) ;
//   // on close
// })
// ;           }
//               }).catch(error => {
//       console.log(error);
//       Dialog.alert({
//   title: '错误',
//   message: '修改密码错误',
// }).then(() => {
//   return;
//   // on close
// });
//     })
//     },

}
</script>
<style>
	
</style>