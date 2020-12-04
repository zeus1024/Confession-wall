<!-- 发帖页面 -->
<template>
	<div class="background-addposts">
    <div>
      <!-- 最上面的导航栏 -->
      <van-nav-bar title="发帖" left-text="返回" left-arrow @click="Return"></van-nav-bar>
    </div>
<van-divider />

    <div >
      <!-- 回复栏 -->
      <van-field class="addposts-headline"
      v-model="post.title"
      rows="1"
      autosize
label-width="0"
      type="textarea"
      maxlength="50"
      placeholder="请输入标题"
      show-word-limit
      />
    </div>
<van-divider />

    <div class="addposts-message">
      <van-field
      v-model="post.content"
      rows="5"
      autosize
label-width="0"
      type="textarea"
      maxlength="5000"
      placeholder="请输入内容"
      show-word-limit
      />
    </div>
<van-divider />
      <div class="addposts-section">
        <van-field
        readonly
        clickable
        label="板块"
        v-model="value"
        placeholder="请选择板块"
        @click="showPicker = true"
        />
        <!-- 弹出板块 -->
        <van-popup v-model:show="showPicker" round position="bottom">
          <van-picker
          :columns="columns"
          @cancel="showPicker = false"
          @confirm="onConfirm"
          />
        </van-popup>
      </div>
      <!-- 是否提交等 -->
      <div >
      <van-button  class="addposts-submit" type="primary" @click="submit">提交</van-button>
      <van-checkbox checked-color="#ee0a24" class="addposts-hide" v-model="hide">匿名</van-checkbox>
    </div>
    </div>
  </template>
  <script >
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
          hide:true,
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

    axios.get('/php/user/userquery.php',{       // 还可以直接把参数拼接在url后边

    }).then(res=>{ 
      this.code = res.data.code;
      this.name = res.data.data;
      if (this.code==2)
       Dialog.confirm({
        title:'提示',
        message: '您还没有登录，是否前往登录',
      }).then(() => {
        this.$router.push({name:'Sign'})
      })
      .catch(() => {
        this.$router.push({name:'Home'})
      });
         // 加上then，res.data就是数据
       }).catch(error => {
        Dialog.alert({
          title: '网路错误',
          message: error,
        }).then(() => {
          return;
        });      });

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
              if(this.post.content!='' && this.value!='' && this.post.title!='')
              {
                this.post_axios();
              }
            },
            post_axios(){
              let i=0;
              while(this.columns[i]!=this.value)
                {i++;}
              if(this.columns[i]==this.value)
                {this.post.type=++i;}
              let data = new FormData();
              data.append('title',this.post.title);
              data.append('content',this.post.content);
              data.append('type',this.post.type);
              data.append('hp',this.post.hp);
              axios.post('/php/t/tpost.php',
                data,
                ).then(res=>{
                 
                  this.code = res.data.code;
                  
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
                 Dialog.alert({
                  title: '网路错误',
                  message: error,
                }).then(() => {
                  return;
                }); 
              });
              },

            },


          }

        </script>

      <style scoped type="text/css">

      .background-addposts{
    height: 100%;
    width: 100%;
    background-color:  #87CEEB;
    position: fixed;
    background-size: cover;
  
      } 

      .addposts-headline{
        position: relative;
        width: 95%;
        top: 10%;
        left: 2.5%;
        right: 2.5%;
      }
     
      .addposts-message{
       position:relative;
        width: 95%;
        
        left: 2.5%;
        right: 2.5%;

      }

      .addposts-section{
        position: relative;
        
        left: 2.5%;
        width: 95%;
      }

      .addposts-submit{
        position: relative;
     margin-top:20%;
        width: 30%;
        left: 65%;
      }
     .addposts-hide{
        position: relative;
        margin-top:-10%;
        font-size: 1.5rem;
        left: 5%;
        width: 25%;
      }
      </style>