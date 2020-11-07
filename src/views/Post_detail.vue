<template>
  <div>
    <div>
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
<van-popup v-model:show="showPicker" round position="bottom">
  <van-picker
    :columns="columns"
  
    @cancel="showPicker = false"
    @confirm="post_more"
  />
</van-popup>
    </div>
  	<!-- 配置本地json版本 -->
<!--       <div>
      <ul>
      <div v-for="item in post" 
      :key="item.tid"
      v-show=" item.tid== post_id"><li >
        <span>发帖人：{{item.poster}}</span>
        <h2>题目：{{item.title}}</h2>
        <p>内容：{{item.content}}</p>
       <p>类型：{{post_type}}</p>
        <p>日期：{{item.date}}</p>    
     </li>
       <li v-for="reply in item.reply"
       :key="reply.rid">
       <span>回复人：{{reply.poster}}</span>
       <p>回复内容：{{reply.content}}</p>
       
       <p>回复日期：{{reply.date}}</p>
       
        </li>
    </div>
  </ul>
</div> -->
<!-- 配置本地的版本 -->

      <!-- 配置服务器版本 -->
    <div>
  		<div>
        <span>发帖者：{{post.poster}}</span>
        <h2>标题：{{post.title}}</h2>
        <p>内容：{{post.content}}</p>
       <p>类型：{{post_type}}</p>
        <p>日期：{{post.date}}</p>   	
      </div>
    <ul>
       <li v-for="item in  post.reply"
       :key="item.rid">
       <span>回复用户：{{item.poster}}</span>
       <p>内容：{{item.content}}</p>
       <p>日期：
       {{item.date}}</p>
       
        </li>
      </ul>
    
  
  	</div>
    <!-- 配置服务器的版本 -->
  	<div  @click="check_sign">
  		、<van-field
  v-model="input_reply"
  rows="1"
  autosize
  label="回复"
  type="textarea"
  placeholder="请输入回复"
/>
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
        // console.log(this.post); 
        this.post = res.data.data;
        // this.reply = this.post.reply;
        // console.log(this.reply);
        console.log(this.post) ;      
        
    }).catch(error => {
        console.log(error);
    });
    // 本地json
//     axios.get('../../data/detail.json',{       // 还可以直接把参数拼接在url后边
//         params:{
//             title:'all'
//         }
//     }).then(res=>{
//         // console.log(this.post); 
//         this.post = res.data.data;
//         // console.log(this.post) ;      
        
//     }).catch(error => {
//         console.log(error);
//     });
//本地json
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
}).then(() => {
   console.log(this.post_id);
  this.delete_post();
    // on confirm
  })
 .catch(() => {
return;
    // on cancel
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
      console.log(this.post_id);
        this.code = res.data.code;
        if (this.code==1)
       Dialog.confirm({
        title:'提示',
  message: '删帖成功',
}).then(() => {
  this.$router.push({name:'Home'})

    // on confirm
  })
  .catch(() => {

    // on cancel
  });
         // 加上then，res.data就是数据
    }).catch(error => {
        console.log(error);
    });
    
    },
    check_sign(){
axios.get('/api/user/userquery.php',{       // 还可以直接把参数拼接在url后边
            withCredentials:true,
    }).then(res=>{ 
        this.code = res.data.code;
        console.log(this.code) ;
        this.name = res.data.data;
        console.log(this.name);
        if (this.code==2)
       Dialog.confirm({
        title:'提示',
  message: '您还没有登录，无法回复，是否前往登录',
}).then(() => {
  this.$router.push({name:'Sign'})

    // on confirm
  })
  .catch(() => {

    // on cancel
  });
         // 加上then，res.data就是数据
    }).catch(error => {
        console.log(error);
    });
    
  
      
    },
    getRouterData() {
      this.post_id = this.$route.params.post_id;
      this.post_type=this.$route.params.type;
      console.log('post_id', this.post_id);
      console.log('post_type',this.post_type);
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
      console.log(error);
      Dialog.alert({
  title: '错误',
  message: '回复失败',
}).then(() => {
  return;
  // on close
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