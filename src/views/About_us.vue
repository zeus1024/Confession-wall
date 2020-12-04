<template>
<div>
	<Navbar></Navbar>
	<div id="word">
		<p>本项目由华南理工大学电子与信息学院2019级软工第四小组构建而成。</p>
		<p>分别由：</p>
		<p>后端：李逸恒</p>
		<p>前端：陈修锦 贝奕</p>
		<p>完成</p>
	<van-divider />
	<div id="thanks">
		<p>感谢优秀的前端框架vue以及CSS框架vant</p>
		<a  href="https://cn.vuejs.org/index.html"><img  id="vue" src="../assets/vue.png" alt="图片加载失败"></a>

			<a href="https://vant-contrib.gitee.io/vant/#/zh-CN/"><img id="vant" alt="图片加载失败" src="../assets/vant.png"></a>
	</div>

	
</div>
<van-divider />
	<p id="banbeng">华工表白墙 &emsp;&emsp;|&emsp;&emsp;版本1.5</p>
</div>	
</template>
<script>
	export default {
    name: "About_us",
    components: {
    	Navbar,

    },}
    import Navbar from '../components/Navbar.vue';
</script>
<style>
	#vue{
		width: 100px;
		height: 100px;
		position: absolute;
		left: 0%;
	}
	#vant{
		width: 100px;
		height: 100px;
		position: absolute;
		left: 60%;
	}
	p{
		font-size: 1.2rem;
	}
	#word{
		position: absolute;
		left: 10%

	}
	#banbeng{
		position: absolute;
		left: 30%;
		bottom: 10%;
		font-size: 1rem;
	}
	
</style>