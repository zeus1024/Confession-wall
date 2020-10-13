<template>
	<div>
		<div>
<van-tabbar v-model="active" @change="currentTab = active">
  <van-tabbar-item name="Posts" icon="home-o">帖子</van-tabbar-item>
  <van-tabbar-item name="Addposts" icon="search">发帖+</van-tabbar-item>
  <van-tabbar-item name="UserInformation" icon="friends-o">我</van-tabbar-item>
</van-tabbar>
    	<keep-alive>
        <component v-bind:is="currentTabComponent" ></component>
      </keep-alive>
  </div>
  
</div>

</template>
<script type="text/javascript">
	import Posts from '../views/Posts.vue';
	import UserInformation from '../views/UserInformation.vue';
		import Addposts from '../views/Addposts.vue';
	export default {
  name: "Menu",
  components: {
  	Posts,UserInformation,Addposts
   
  },
  methods: {
   
  },
  data() {
  	return{
      active: 'Posts',
    currentTab: "Posts",
        
         
        }},
        computed: {
          currentTabComponent: function() {
            return this.currentTab;
          }
        }

     }


</script>
<style >

</style>
