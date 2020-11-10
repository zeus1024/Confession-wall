<!-- 上面的发挥导航栏组件 -->
<template>
<van-nav-bar
  title="华工表白墙"
  left-text="返回"
  left-arrow
  @click-left="Return">
</van-nav-bar>
</template>
<script>
export default {
	name:'Navbar',
  methods: {
    Return(){
    	this.$router.push({name:'Home'})
    },
  },
};
</script>
<style>
	
</style>