<template>
  <div class="bg-white p-2 shadow">
    <img :src="item.url" class="image-size border-2 border-green-300">
    <router-link :to="{ name: 'UserDetail', params: { userId: item.id}}">{{item.name}}</router-link>
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
.image-size{
  width: 10vw;
  height: 10vw;
  border:3px solid ;
  border-radius: 50%;
  object-fit:cover;
  border:4px solid #13b1c0;
}
</style>
