<template>
		<div class="posts">
     <div class="partition">
    <van-tabs v-model="active"  swipeable>
  <keep-alive><van-tab v-for="post in posts" 
  v-bind:key="post.type"
      :title="post.type">
    {{post.content}}
   </van-tab></keep-alive>
</van-tabs>

      
     </div>
    </div>

</template>
<script >
  
	export default {
  name: "Posts",
  components: {
    
  },
  data() {
    return{
      
      posts:[
      {
        type:"all",
        content:"the firet",
      },
      {type:"all2",
      content:"the second"},
      ],
    
    }
   
  },
        computed: {
          currentTabComponent: function() {
            return this.currentTab;
          }
        }, 
         methods: {
    onClick() {
     
    },
  },

     }


</script>

<style >

.posts-tab {
  display: flex;
}
.posts-sidebar {
  max-width: 40vw;
  margin: 0;
  padding: 0 10px 0 0;
  list-style-type: none;
  border-right: 1px solid #ccc;
}
.posts-sidebar li {
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
  cursor: pointer;
}
.posts-sidebar li:hover {
  background: #eee;
}
.posts-sidebar li.selected {
  background: lightblue;
}
.selected-post-container {
  padding-left: 10px;
}
.selected-post > :first-child {
  margin-top: 0;
  padding-top: 0;
}


</style>