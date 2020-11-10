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
				<ul>
					<li v-for="item in mypost" 
					:key="item.tid">
					<router-link :to="{
						name:'Post_detail',
						params:{post_id:item.tid,type:posttype[item.type].type}
					}">
					<div v-show="active == item.type || active ==0" @click="goto_detail">
						<span>发帖人：{{item.poster}}</span>
						<h2>标题：{{item.title}}</h2>
						<p>发帖内容：{{item.content}}</p>
						<p>类型：{{posttype[item.type].type}}</p>
						<p>日期：{{item.date}}</p>

					</div>
				</router-link>
			</li>
		</ul>
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
axios.get('/api/t/getmylist.php',{ 
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

<style>

</style>