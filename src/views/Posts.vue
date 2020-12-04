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
          <button v-show="show_content==false " @click="show_content=!show_content">展开内容</button>
          <button v-show="show_content==true" @click="show_content=!show_content">隐藏内容</button>
        </div>
        
        <!-- 循环帖子列表， 可换成list -->
        <ul>
          <li class="list" v-for="item in postdata"  :key="item.tid" v-show="active == item.type || active ==0">
            <van-cell class="list_cell">
            <router-link :to="{
             name:'Post_detail',
             params:{post_id:item.tid,type:posttype[item.type].type}
           }">
           <!-- 每个帖子的显示，里面的span，h2这些，换成更加高级的标签 -->
        

            <div class="posts-head"> 
              <div><img class="daxiao" src="../assets/logo.png"></div>

              <div>
              <div class="poster">{{item.poster}}</div>
              <div class="date">{{item.date}}</div>
              </div>

              <div class="post-circle"><div class="post-circle-word">{{posttype[item.type].type}}</div></div>
           
             <!--  <van-tag  class="type" round type="primary">{{posttype[item.type].type}}</van-tag> -->

            </div>
            <!-- 头像可以注释掉 -->
            
            <h2 style="color:black; font-size: 1.5rem;">{{item.title}}</h2>
            
            <!-- 是否显示发帖内容 -->
            <div v-show="show_content==true">
              <div style="color:black;font-style: 1rem">{{item.content}}</div>
            </div>
            
            <!-- <div class="bottompicture">
              <van-icon name="share-o" />
              <van-icon name="comment-o" />
              <van-icon name="good-job-o" />
            </div>    -->
          
          
        </router-link>
      </van-cell>
      </li>
    </ul>
  </van-tab>
</van-tabs>
</div>
<van-cell class="de_buttom">滑到底了</van-cell>
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
   background-color:  #87CEEB;
 
    }

    .posts-head{
      display: flex;
      flex-direction: row;
      flex-flow: start;
 
    }

    .list{
      width: 90%;
      margin:2% 5% 2% 5%;
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

  

     .spread{
       width: 50%;
       margin-left: 25%;
       margin-right: 25%;
     }

     .date{
      color: grey;
      font-size: 0.8rem;
      margin-top: 0.2rem;
      width: 150%;
     }

     .post-circle{
    width:5rem;
    height:2rem;
    font-size: 1rem;
    background-color: #2894ff;
    color: black;
   
    text-align: center;
    font-family:NSimSun;
    margin-left: 3.2rem;
  }

     .post-circle-word{
      margin-top: 10%;
     }

     /*.type{
      margin-left: 1.7rem;
      font-size: 1.3rem;
     }
*/
   /*  .bottompicture{
      display: flex;
      flex-direction: row;
      justify-content: space-around;
      margin-top: 2rem;
     }*/
</style>