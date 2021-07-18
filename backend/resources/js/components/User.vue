<template>
  <div class="post-marge back-white shadow p-2 m-2">
    <img :src="item.url" class="image-size border-circle">
    <router-link :to="{ name: 'UserDetail', params: { userId: item.id}}">
      <div>{{item.name}}</div>
       <div v-if="item.self_introduce.length<20" class="text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg whitespace-pre">{{item.self_introduce}}</div> 
      <div v-else class="text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg whitespace-pre">{{item.self_introduce.substring(0,19)+".."}}</div> 
    </router-link>
   
   
  </div>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  }
}
</script>

<style scoped>
.back-white{
  background: white;
}
.post-marge{
  margin: 20px;
}
.image-size{
  width: 10vw;
  height: 10vw;
  border:3px solid ;
  border-radius: 50%;
  object-fit:cover;
  border:4px solid #13b1c0;
}
.border-cercle{
  border-radius: 50%;
}
</style>