<template>
		<div class="posts">
    <div>
      <van-tabs v-model="active" swipeable  @click="changetab">
  <van-tab v-for="item in posttype" 
  :key="item.tid"
  :title="item.type"
>
     <ul>
      <li v-for="item in postdata" 
      :key="item.tid">
      <router-link :to="{
                   name:'Post_detail',
                   params:{post_id:item.tid}
                 }">
    <div v-show="active == item.type || active ==0" @click="goto_detail">
        <span>{{item.poster}}</span>
        <h2>{{item.title}}</h2>
        <p>{{item.content}}</p>
       <p>{{item.type}}</p>
        <p>{{item.date}}</p>
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
  // data() {
  //   return{
      
  //     posts:[
  //     {
  //       type:"全部类型",
  //       content:"内容：1、山西省长治市宣布从2022年开始把裸眼视力和体重考核结果纳入中考总成绩，网友质疑其涉嫌基因与经济双重歧视2、青岛：将市胸科医院所在的楼山后社区定为中风险区域，其它区域风险等级不变5天内将对全市检测全覆盖，截至12日已采样超百万份，目前未发现新增；3、教育部明确：将心肺复苏和急救知识纳入学校基础教育相关课程；4、农业农村部：第16号台风将于13日晚在海南岛东部到广东雷州半岛一带沿海登陆，紧急部署台风防御工作，确保生产安全；海南发布台风三级预警，琼州海峡客滚船13日3时起停航；5、北京：地铁站周边50至100米内占路车位要为自行车腾地儿；北京：2021年居民医保门急诊医疗费用支付限额由4000元提高到4500元；",
  //       nickname:"昵称",
  //       title:"标题1",
  //       data:"2020年10月13日",
      
  //     },
  //     {
  //       type:"求交友",
  //       content:"内容：1、山西省长治市宣布从2022年开始把裸眼视力和体重考核结果纳入中考总成绩，网友质疑其涉嫌基因与经济双重歧视2、青岛：将市胸科医院所在的楼山后社区定为中风险区域，其它区域风险等级不变5天内将对全市检测全覆盖，截至12日已采样超百万份，目前未发现新增；3、教育部明确：将心肺复苏和急救知识纳入学校基础教育相关课程；4、农业农村部：第16号台风将于13日晚在海南岛东部到广东雷州半岛一带沿海登陆，紧急部署台风防御工作，确保生产安全；海南发布台风三级预警，琼州海峡客滚船13日3时起停航；5、北京：地铁站周边50至100米内占路车位要为自行车腾地儿；北京：2021年居民医保门急诊医疗费用支付限额由4000元提高到4500元；",
  //       nickname:"昵称2",
  //       title:"标题2",
  //       data:"2020年10月14日",
      
  //     },]
  //   }
  // },
    
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