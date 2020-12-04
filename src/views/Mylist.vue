<!-- 我的帖子 -->
<template>
	<div class="Mylist">
		<div>
			<!-- 使用navbar组件 -->
			<Navbar></Navbar>
		</div>
		<div>
<!-- 同post里面的，参考post -->
			<van-tabs v-model="active" swipeable  @click="changetab">
				<van-tab v-for="item in posttype" 
				:key="item.tid"
				:title="item.type"
				>
				

					<div class="list" v-for="item in mypost" 
					:key="item.tid" style="color: black" v-show="active == item.type || active ==0" @click="goto_detail">
					<router-link :to="{
						name:'Post_detail',
						params:{post_id:item.tid,type:posttype[item.type].type}
					}">
					
						<van-cell><h2>{{item.title}}</h2>
						<p class="content">{{item.content}}</p>
						<van-tag  class=" type" round  plain type="primary">{{posttype[item.type].type}}</van-tag>
						<p class="date">发帖时间：{{item.date}}</p>
</van-cell>
					
				</router-link>
			</div>
	</van-tab>
</van-tabs>
</div>

</div>  



</template>

<script >
	import axios from 'axios';
	import { Dialog } from 'vant';
	import Navbar from '../components/Navbar.vue';

	export default {
		name: "Mylist",
		components: {
			Navbar,

		},
		data()
		{
			return{
				active:0,

				mypost:'',
				code:'',
				posttype:[
				{
					type:"全部",
					tid:0,
				},
				{
					type:"表白",
					tid:1,
				},
				{
					type:"交友",
					tid:2,
				},
				{
					type:"寻物启事",
					tid:3,
				},
				]

			}
		},
		created(){
// 服务器版本
axios.get('/php/t/getmylist.php',{ 
    withCredentials:true,      // 还可以直接把参数拼接在url后边

}).then(res=>{

	this.mypost = res.data.data;
	this.code= res.data.code;
	if(this.code==0)
	{
		Dialog.confirm({
			title: '出错了！！！',
			message: '是否重新获取我的帖子？',
		})
		.then(() => {
			this.$router.push({name:'Mylist'})

    // on confirm
})
		.catch(() => {
			this.$router.push({name:'UserInformation'})

    // on cancel
});
	}
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
computed: {
	currentTabComponent: function() {
		return this.currentTab;
	}
}, 
methods: {

	changetab(name){
		this.active=name;

	},

},

}


</script>

<style scoped>
.Mylist{
	background-color:   #87CEEB;
}
.list{
	padding: 2.5%;
	margin: 2.5%;
	
}
.type{
position: absolute;
left: 70%;
top:6%;
	padding: 0.3rem;
	font-size: 1rem;
}
.content{
	padding: 3%;

}
.date{
	position: relative;
	left: 0%;
	top: 0%;
	font-size: 0.6rem;
	height: 10%;
}
</style>