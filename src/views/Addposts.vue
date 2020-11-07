<template>
	<div>
	 <div>
  	<van-nav-bar title="发帖" left-text="返回" left-arrow @click="Return">
</van-nav-bar>
  	
</div>
<div><van-field
  v-model="post.title"
  rows="2"
  autosize
  label="标题"
  type="textarea"
  maxlength="50"
  placeholder="请输入标题"
  show-word-limit
/></div>
<div><van-field
  v-model="post.content"
  rows="2"
  autosize
  label="留言"
  type="textarea"
  maxlength="5000"
  placeholder="请输入留言"
  show-word-limit
/></div>

<div><van-field
  readonly
  clickable
  label="板块"
  v-model="value"
  placeholder="请选择板块"
  @click="showPicker = true"
/>
<van-popup v-model:show="showPicker" round position="bottom">
  <van-picker
    :columns="columns"
    @cancel="showPicker = false"
    @confirm="onConfirm"
  />
</van-popup>
  	</div>
  	<van-button type="default" @click="submit">提交</van-button>

    <van-checkbox v-model="hide">是否匿名</van-checkbox>
  	</div>
</template>
<script >
// import Navbar from '../components/Navbar.vue' 
import { Dialog } from 'vant';
import axios from 'axios';
	export default{
		name:"Addposts",
		components:{	
		},
	data(){
		return{
			 value: '',
       code:'',
       hide:false,
      showPicker: false,
      columns: [ '表白', '交友', '失物招领'],
			post:{
        title:'',
				content:'',
				hp:0,
        type:-1,
			},	
    }
	},
  created(){
    
    axios.get('/api/user/userquery.php',{       // 还可以直接把参数拼接在url后边
        
    }).then(res=>{ 
        this.code = res.data.code;
        console.log(this.code) ;
        this.name = res.data.data;
        console.log(this.name);
        if (this.code==2)
       Dialog.confirm({
        title:'提示',
  message: '您还没有登录，是否前往登录',
}).then(() => {
  this.$router.push({name:'Sign'})

    // on confirm
  })
  .catch(() => {
    this.$router.push({name:'Home'})

    // on cancel
  });
         // 加上then，res.data就是数据
    }).catch(error => {
        console.log(error);
    });
    
  },
	methods:{
   Return(){
      this.$router.push({name:'Home'})
    },
  onConfirm(value) {
      this.value = value;
      this.showPicker = false;
    },
    submit(){
     
      if(this.post.title=='')
      {Dialog.alert({
  title: '提示',
  message: '请输入标题',
}).then(() => {
  // on close
  return ;
})
; }
if(this.post.content=='')
      {Dialog.alert({
  title: '提示',
  message: '请输入内容',
}).then(() => {
  return ;
  // on close
})
;   }
      
      if(this.hide == true)
      {
        this.post.hp =1;
      }
      if(this.value=='')
      {
        Dialog.alert({
  title: '提示',
  message: '请选择板块',
}).then(() => {
 this.showPicker = true;
 return;
  // on close
})
;      }
else{this.post_axios()}
},
      post_axios(){
        let i=0;
      while(this.columns[i]!=this.value)
        {i++;}
          if(this.columns[i]==this.value)
            {this.post.type=++i;
              console.log(this.post.type)
            console.log(this.post);}
      axios.get('/api/t/tpost.php',{ 
          withCredentials:true,      // 还可以直接把参数拼接在url后边
        params:{
          title:this.post.title,
           content:this.post.content,
           type:this.post.type,
           hp:this.post.hp,
           
        }
    }).then(res=>{
      console.log(this.post);
        this.code = res.data.code;
        console.log(this.code) ; // 加上then，res.data就是数据
         if(this.code == 1){
          Dialog.alert({
  message: '发送成功',
}).then(() => {
  this.$router.push({name:'Home'});
// on close
});
    }
    if(this.code==0)
    {
      Dialog.alert({
  message: '发送失败',
}).then(() => {
// on close
});
    }
  }).catch(error => {
      console.log(error);
      Dialog.alert({
  title: '错误',
  message: '发帖失败',
}).then(() => {
  return;
  // on close
});
    });
},

  },


}

</script>
<style type="text/css">
.return_post{
	font-size: 3rem;
}	
</style>