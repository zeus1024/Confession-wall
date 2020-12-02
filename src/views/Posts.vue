<!-- 帖子预览页 -->
<template>
  <div class="background-posts">
    <div>
      <!-- 切换上面的标签栏 -->
      <van-tabs v-model="active" swipeable  @click="changetab">
        <!-- 表现现在已经有的板块 -->
        <van-tab v-for="item in posttype" 
        :key="item.tid"
        :title="item.type">
         <div class="spread">
          <!-- 切换是否显示内容，要修改button成为别的类型 -->
          <button v-show="show_content==false " @click="show_content=!show_content">点击展开帖子详细内容</button>
          <button v-show="show_content==true" @click="show_content=!show_content">点击收回帖子详细内容</button>
        </div>
        
        <!-- 循环帖子列表， 可换成list -->
        <ul>
          <li class="list" v-for="item in postdata"  :key="item.tid">
            <router-link :to="{
             name:'Post_detail',
             params:{post_id:item.tid,type:posttype[item.type].type}
           }">
           <!-- 每个帖子的显示，里面的span，h2这些，换成更加高级的标签 -->
           <p class="topline">_ __ ___ __ _ _ __ ___ __ _ _ __ ___ __ _</p>
           <div v-show="active == item.type || active ==0">

            <div class="posts-head"> 
              <div><img class="daxiao" src="../assets/logo.png"></div>

              <div>
              <div class="poster">{{item.poster}}</div>
              <div class="date">发帖于{{item.date}}</div>
              </div>
              <div class="type">{{posttype[item.type].type}}</div>
            </div>
            <!-- 头像可以注释掉 -->
            
            <h2 style="color: black; font-size: 1.5rem;">标题:{{item.title}}</h2>
            
            <!-- 是否显示发帖内容 -->
            <div v-show="show_content==true">
              <div>发帖内容：{{item.content}}</div>
            </div>
            
            <div class="bottompicture"></div>
            
            <p class="bottomline">_ __ ___ __ _ _ __ ___ __ _ _ __ ___ __ _</p>

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
    .background-posts{
     height: 100%;
    width: 100%;
    background-image: url(https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=2193922693,786190290&fm=26&gp=0.jpg) ;
    position: fixed;
    background-size: cover;
    }

    .posts-head{
      display: flex;
      flex-direction: row;
      flex-flow: start;
 
    }

    .list{
      width: 90%;
      margin-left: 1rem;
      margin-right: 1rem;
      border-style: ridge;
      border-color: #97cbff;
    }
    
    .poster{
      font-size: 1rem;
      padding-top: 0.5rem;
      color: black;

    }

    .daxiao{
      width: 4rem;
      height: 4rem;
    }

    .bottomline{
      text-align: center;
    }
    
     .topline{
      text-align: center;
      margin-top: 5px;
    }

     .spread{
       width: 50%;
       margin-left: 25%;
       margin-right: 25%;
     }

     .date{
      color: grey;
      font-size: 0.8rem;
      margin-top: 0.8rem;
     }

     .type{
      margin-left: 1.7rem;
      font-size: 1.3rem;
     }

     .bottompicture{
      
     }
</style>