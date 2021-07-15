<template>
  <div class="post-marge back-white">
    <img :src="item.url" class="image-size border-circle">
    <router-link :to="{ name: 'UserDetail', params: { userId: item.id}}">{{item.name}}</router-link>
    <div>{{item.name}}</div>
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
.post-merge{
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