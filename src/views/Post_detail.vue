<!-- 帖子详情页 -->
<template>
  <div >
    <div>
      <!-- 帖子上面的导航栏 -->
      <van-nav-bar
      title="帖子详情"
      left-text="返回"
      right-text="更多"
      left-arrow
      @click-left="Return"
      @click-right="showPicker = true"
   
      />
    </div>

    <div>
      <!-- 更多里面的选项 -->
      <van-popup v-model:show="showPicker" round position="bottom">
        <van-picker
        :columns="columns"
        @cancel="showPicker = false"
        @confirm="post_more"
        />
      </van-popup>
    </div>
    <!-- 配置服务器版本 -->
    <!-- 帖子详情页，span等元素均要更换和设置CSS -->
    <div  >
      <van-cell>
      <div class="headline">{{post.title}}</div>
</van-cell>
      <div class="postdetail-head">
       <div><img class="postdetaildaxiao" src="../assets/logo.png"></div>
       <div>
         <div class="postdetailposter">{{post.poster}}</div>
         <div class="postdetaildate">{{post.date}}</div>
         <van-button class="star" round type="info" size="small" color="#d3a4ff">关注</van-button>
       </div>
     
       </div>
      <div class="posterborder">
        <van-cell class="content">{{post.content}}</van-cell>
      <div class="bottompicture-detail">
      <van-icon name="share-o" />
      <van-icon name="comment-o" />
      <van-icon name="good-job-o" />
      </div> 
      </div>
  
      <div class="bottomline-detail"></div>
      <van-cell id="plq">评论区</van-cell>
      <ul>
        <!-- 回复的 -->
        <li v-for="item in  post.reply"
        :key="item.rid">
      
        <van-cell class="replayborder">
        <div class="replay1">
          <div ><img class="replaydaxiao" src="../assets/logo.png"></div>
          <div class="replayposter">
            <div class="replayname">{{item.poster}}</div>
            <div class="replaydate">{{item.date}}</div>
          </div>        
        </div>
      <div class="replaycontent">{{item.content}}</div> 
      <div class="replaybottom">
     
          <van-icon name="comment-o" size="1.6rem" />
          <van-icon name="good-job-o" size="1.6rem" />
      </div>
 
  </van-cell>
      </li>
    </ul>
<van-cell class="de_buttom">滑到底了</van-cell>

  </div>
  <!-- 配置服务器的版本 -->
  <!-- 输入回复的框 -->
  <div class="reply"  @click="check_sign">
    <van-field
    v-model="input_reply"
    rows="1"
    autosize
label-width="0"
    type="textarea"
    placeholder="请输入回复"
    id="reply_input"/>
    <!--输入回复的按钮和匿名按钮  -->
    <van-button  id="reply_button" size="small"  @click="submit" round type="info" color="#d3a4ff">发表</van-button>
  <van-checkbox  id="reply_hide" v-model="hide">匿名</van-checkbox>
  </div>
</div>
</template>
<script>
	import axios from 'axios';
  import { Dialog } from 'vant';
  export default{
   name:'Post_detail',
   components:{

   },
   data() {
    return {
      post_id:'',
      post:'',
      reply:'',
      input_reply:'',
      post_type:'',
      hide:false,
      hp:0,
      value: '',
      showPicker: false,
      columns: [ '删除帖子'],
      
      
    }
  },


    // created:vue生命周期中的钩子函数，在这个时间点，data中的数据已经注入到响应式系统中
    created(){
     this.getRouterData();
 // 服务器使用axios
    axios.get('/php/t/getdetail.php',{       // 还可以直接把参数拼接在url后边
      params:{
        tid:this.post_id,
      }
    }).then(res=>{
      this.post = res.data.data;
    }).catch(error => {
     Dialog.alert({
      title: '网路错误',
      message: error,
    }).then(() => {
      return;
    }); 
  });

  },
  methods: {
    Return(){
      this.$router.go(-1)
    },
    post_more()
    {
     Dialog.confirm({
      title:'提示',
      message: '确定要删除帖子？',
      // 提示的内容
    }).then(() => {
     
     this.delete_post();
   })
    .catch(() => {
      return;
    });
  },
  delete_post()
  {
axios.get('/php/t/delete.php',{       // 还可以直接把参数拼接在url后边
  withCredentials:true,
  params:{
    tid:this.post_id,
  }
}).then(res=>{ 
  
  this.code = res.data.code;
  if (this.code==1)
   Dialog.confirm({
    title:'提示',
    message: '删帖成功',
    // 提示的内容
  }).then(() => {
    this.$router.push({name:'Home'})
  })
  .catch(() => {

  });
}).catch(error => {
 Dialog.alert({
  title: '网路错误',
  message: error,
}).then(() => {
  return;
}); 
});
},
check_sign(){
axios.get('/php/user/userquery.php',{       // 还可以直接把参数拼接在url后边
  withCredentials:true,
}).then(res=>{ 
  this.code = res.data.code;
  this.name = res.data.data;
  if (this.code==2)
   Dialog.confirm({
    title:'提示',
    message: '您还没有登录，无法回复，是否前往登录',
  }).then(() => {
    this.$router.push({name:'Sign'})

  })
  .catch(() => {
  });
         // 加上then，res.data就是数据
       }).catch(error => {
        Dialog.alert({
          title: '网路错误',
          message: error,
        }).then(() => {
          return;
        }); 
      });



     },
     getRouterData() {
      this.post_id = this.$route.params.post_id;
      this.post_type=this.$route.params.type;
    },
    submit(){

      if(this.hide == true)
      {
        this.hp =1;
      }
      if(this.input_reply=='')
      { 
        Dialog.alert({
          title: '温馨提示',
          message: '回复不能为空',
        }).then(() => {
          return false; 
        });
      }
      else{
       this.post_axios();
     };
   },
   post_axios(){
    let data = new FormData();
data.append('tid',this.post_id);
data.append('content',this.input_reply);
data.append('hp',this.hp);

axios.post('/php/t/rpost.php',
data,
).then(res=>{
  this.code = res.data.code;
  Dialog.alert({
    message: '回复成功',
  }).then(() => {
    this.$router.go(0);
// on close
});
}).catch(error => {
  Dialog.alert({
    title: '错误',
    message: error,
  }).then(() => {
    return;
  });
});
},


},
computed: {},

}
</script>

<style type="text/css">

.return_post{
	font-size: 10px;
}	

.headline{
  font-size: 1.7rem;
  font-weight: bold;
  margin-bottom: 1rem;
}
#plq{
  font-size: 1.5rem;
  color: black;
}
.postdetail-head{
  display: flex;
  flex-direction: row;
  flex-flow: start;
}

.postdetailposter{
  font-size: 0.8rem;
  padding-top: 0.5rem;
  color: black;
}

.postdetaildate{
 color: grey;
 font-size: 0.6rem;
 margin-top: 0.8rem;
}

.postdetaildaxiao{
  width: 3rem;
  height: 3rem;
  margin-left: 0.8rem;
}



.content{
  margin-top: 1.3rem;

}

.bottompicture-detail{
      display: flex;
      flex-direction: row;
      justify-content: space-around;
      margin-top: 0.7rem;
      margin-bottom: 0.7rem;
}

.bottomline-detail{
  background-color: #f0f0f0;
  padding-bottom: 0.5rem;
  padding-top: 0.5rem;
}

.posterborder{
  border-style: solid;
  border-color: #e0e0e0;
  width: 95%;
  height: auto;
}
.star{
  position: absolute;
  right: 10%;
  top:15%;
}
.replay1{
  display: flex;
  flex-direction: row;
  flex-flow: start;
}

.replayname{
  font-size: 0.9rem;
  padding-top: 0.5rem;
  color: black;}

.replaydate{
 color: grey;
 font-size: 0.6rem;
 margin-top: 0.8rem; 
 margin-top: 0.3rem; 
}

.replaydaxiao{
  width: 3rem;
  height: 3rem;
}

.replayborder{
  width: 96%;
  margin-left: 1%;
  margin-right: 1%;
  border-style: solid;
  border-color: #e0e0e0;
}

.replaycontent{
  margin-left: 3rem;
}

.replaybottom{
  margin-top: 0.5rem;
  margin-bottom: 0.2rem;
  margin-right: 1rem;
  display: flex;
  justify-content: flex-end;
}
.reply{
  position: fixed;
  bottom: 8%;
  width: 90%;
 z-index: 11;
}
#reply_input{
width: 80%;
position: absolute;
left: 12%;

}
#reply_button{
  position: absolute;
  left: 93%;
}

#reply_hide{
  position: absolute;
  left: 0%;
  padding-top: 3%;
}
.de_buttom{
  position: absolute;
  height: 15%;
  padding-left: 40%;
}
</style>