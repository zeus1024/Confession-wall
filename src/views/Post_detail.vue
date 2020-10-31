<template>
  <div>
  	<button class="return_post" @click= "return_post">返回</button>

  	<div>
  		<ul>
      <div v-for="item in post" 
      :key="item.tid"
      v-show=" item.tid== post_id"><li >
        <span>{{item.poster}}</span>
        <h2>{{item.title}}</h2>
        <p>{{item.content}}</p>
       <p>{{item.type}}</p>
        <p>{{item.date}}</p>   	
     </li>
       <li v-for="reply in item.reply"
       :key="reply.rid">
       <span>{{reply.poster}}</span>
       <p>{{reply.content}}</p>
       
       <p>{{reply.date}}</p>
       
        </li>
    </div>
  </ul>
  	</div>
  	<div>
  		<van-field
  v-model="sms"
  center
  clearable
  label="短信验证码"
  placeholder="请输入短信验证码"
>
  <template #button>
    <van-button size="small" type="primary">发送验证码</van-button>
  </template>
</van-field>
  	</div>
  </div>
</template>
<script>
	import axios from 'axios';
export default{
	name:'Post_detail',
  components:{
    
  },
  data() {
    return {
      post_id:'',
      post:'',
      
    }
  },
 
   
    // created:vue生命周期中的钩子函数，在这个时间点，data中的数据已经注入到响应式系统中
   created(){
 this.getRouterData();
    axios.get('../../data/detail.json',{       // 还可以直接把参数拼接在url后边
        params:{
            title:'all'
        }
    }).then(res=>{
        // console.log(this.post); 
        this.post = res.data.data;
        // console.log(this.post) ;      
        
    }).catch(error => {
        console.log(error);
    });
},
  methods: {
    getRouterData() {
      this.post_id = this.$route.params.post_id
      console.log('post_id', this.post_id)
    },
    return_post(){
    	this.$router.go(-1)
    }

  },
 computed: {},
  
}
</script>
<style type="text/css">
.return_post{
	font-size: 10px;
}	
</style>