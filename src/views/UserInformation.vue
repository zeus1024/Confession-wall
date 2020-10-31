<template>
	<div>
		表白墙
		<div>  <Menu></Menu></div>
<div>
  	<button class="return_post" @click= "return_post">返回</button>

  	</div>
		</div>

</template>
<script >
 import Menu from '../components/Menu.vue'
	export default {
  name: "UserImformation",
  components: {
  	Menu
  },
  	methods:{
  		return_post(){
    	this.$router.go(-1)
    }
  	}
  };
</script>
<style type="text/css">
.return_post{
	font-size: 3rem;
}	
</style>