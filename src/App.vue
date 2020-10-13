<template>
  <div id="nav">
   <Home></Home>
   

    <!-- 使用路由 -->
  </div>
<!-- 路由匹配到的组件将显示在这里 -->

  <!-- <router-view /> -->
</template>
<script >
  import Home from './views/Home.vue'

export default
{
  name:'APP',
  components:{
Home,
  },
 data () {
    return {
      
    }
  },
  computed: {},
  created () {},
}
</script>

<style lang="less">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
