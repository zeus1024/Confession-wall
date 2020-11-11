<!-- 帖子预览页 -->
<template>
  <div class="posts">
    <div>
      <!-- 切换上面的标签栏 -->
      <van-tabs v-model="active" swipeable  @click="changetab">
        <!-- 表现现在已经有的板块 -->
        <van-tab v-for="item in posttype" 
        :key="item.tid"
        :title="item.type">
        <div>
          <!-- 切换是否显示内容，要修改button成为别的类型 -->
          <button v-show="show_content==false " @click="show_content=!show_content">点击显示内容</button>
          <button v-show="show_content==true" @click="show_content=!show_content">点击不显示内容</button>
        </div>
        <!-- 循环帖子列表， 可换成list -->
        <ul>
          <li v-for="item in postdata"  :key="item.tid">
            <router-link :to="{
             name:'Post_detail',
             params:{post_id:item.tid,type:posttype[item.type].type}
           }">
           <!-- 每个帖子的显示，里面的span，h2这些，换成更加高级的标签 -->
           <div v-show="active == item.type || active ==0" @click="goto_detail">
            <div> 头像：<img src="../assets/logo.png"></div>
            <!-- 头像可以注释掉 -->
            <span>发帖人：{{item.poster}}</span>
            <h2>{{item.title}}</h2>
            <!-- 是否显示发帖内容 -->
            <div v-show="show_content==true">
              <p >发帖内容：{{item.content}}</p>
            </div>
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

	export default {
    name: "Posts",
    components: {

    },
    props:{
      postdata:{
        type:Array,
        default(){
          return  null;
        }
      }


    },
    data()
    {
      return{
        active:0,
        show_content:1,
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