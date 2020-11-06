<template>
	<div  >
		<div @tabname="changetab">

<van-tabbar  class="tabbar" v-model="active" @change="onChange">
<router-link :to="{
                   name:'Home',
                   params:{user_id:id}
                 }">
  <van-tabbar-item name="Posts" icon="home-o">帖子</van-tabbar-item></router-link>

  <router-link :to="{
                   name:'Addposts',
                   params:{user_id:id}
                 }">
  <van-tabbar-item name="Addposts" icon="search">发帖+</van-tabbar-item>
</router-link>
  <router-link :to="{
                   name:'UserInformation',
                   params:{user_id:id}
                 }">
  <van-tabbar-item name="UserInformation" icon="friends-o">我</van-tabbar-item>
</router-link>
</van-tabbar>
  </div>
  
</div>

</template>
<script type="text/javascript">
	// import Posts from '../views/Posts.vue';
	// import UserInformation from '../views/UserInformation.vue';
	// 	import Addposts from '../views/Addposts.vue';
	export default {
  name: "Menu",
  components: {
  	// Posts,UserInformation,Addposts
   
  },
 
   props:{
    posts:{
      type:Array,
      default(){
        return[]

        
      }
    }
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
        },
methods: {
      onChange() {
            //1、childFn 组件方法名，父组件中用childFn方法接收子组件中的数据；2、message是传递给父组件的数据
            this.$emit('tabname', this.active);

        },
       
  changetab(name){
    this.currentTabComponent = name;
  
},
    }    
     }


</script>
<style >
.tabbar{
  top:;
}
</style>
