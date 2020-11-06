<template>
	<div>
	 <div>
  	<button class="return_post" @click= "return_post">返回</button>
  	<van-button type="default">提交</van-button>
</div>
<div><van-field
  v-model="message"
  rows="2"
  autosize
  label="留言"
  type="textarea"
  maxlength="50"
  placeholder="请输入留言"
  show-word-limit
/></div>

<div><van-field
  readonly
  clickable
  label="板块"
  v-model="value"
  placeholder="选择板块"
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
  	
  	</div>
</template>
<script >

	export default{
		name:"Addposts",
		components:{
			
		},
	data(){
		return{
			 value: '',

      showPicker: false,
      columns: ['杭州', '宁波', '温州', '绍兴', '湖州', '嘉兴', '金华', '衢州'],
			post:{
				centent:"",
				tid:"",
				

			},
			
    }

		
		
	},
	methods:{
		return_post(){
    	this.$router.go(-1)

    },
  onConfirm(value) {
      this.value = value;
      this.showPicker = false;
    },
 
  },


}

</script>
<style type="text/css">
.return_post{
	font-size: 3rem;
}	
</style>