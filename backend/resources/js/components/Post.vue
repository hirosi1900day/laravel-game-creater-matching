<template>
  
  <div class="back-white post-merge">
    <img :src="item.user.url" class="image-size border-center">
      <router-link :to="{ name: 'UserDetail', params: { userId: item.user.id}}">{{item.user.name}}</router-link>
      <div>{{item.title}}</div>
      <div>{{item.content}}</div>  
    <Favorite
        v-if="authCheck"
        :postId="item.id"
      />
    <router-link :to="{ name: 'PostDetail', params: { postId: item.id}}">詳細を確認する</router-link>
  </div>
</template>

<script>
import Favorite from  './Favorite.vue'
import {mapGetters} from "vuex"

export default {
  components: {
    Favorite
  },
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  computed: 
    mapGetters({
      authCheck: "auth/check"
    }),
}
</script>

<style scoped>
.post-marge {
  margin: 20px;
}
.back-white{
  background:white;
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

