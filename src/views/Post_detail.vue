<!-- 帖子详情页 -->
<template>
  <div>
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
    <div>
      <div>
        <span>发帖者：{{post.poster}}</span>
        <h2>标题：{{post.title}}</h2>
        <p>内容：{{post.content}}</p>
        <p>类型：{{post_type}}</p>
        <p>日期：{{post.date}}</p>   	
      </div>
      <ul>
        <!-- 回复的 -->
        <li v-for="item in  post.reply"
        :key="item.rid">
        <span>回复用户：{{item.poster}}</span>
        <p>内容：{{item.content}}</p>
        <p>日期：{{item.date}}</p>
      </li>
    </ul>


  </div>
  <!-- 配置服务器的版本 -->
  <!-- 输入回复的框 -->
  <div  @click="check_sign">
    <van-field
    v-model="input_reply"
    rows="1"
    autosize
    label="回复"
    type="textarea"
    placeholder="请输入回复"/>
    <!--输入回复的按钮和匿名按钮  -->
    <van-button size="small" type="primary" @click="submit">回复</van-button>
    <van-checkbox v-model="hide">是否匿名</van-checkbox>
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
    axios.get('/api/t/getdetail.php',{       // 还可以直接把参数拼接在url后边
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
axios.get('/api/t/delete.php',{       // 还可以直接把参数拼接在url后边
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
axios.get('/api/user/userquery.php',{       // 还可以直接把参数拼接在url后边
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
axios.get('/api/t/rpost.php',{       // 还可以直接把参数拼接在url后边
  params:{
    tid:this.post_id,
    content:this.input_reply,
    hp:this.hp,

  }
}).then(res=>{
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
</style>