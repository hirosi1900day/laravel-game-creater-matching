<template>
  <div class="post-marge">
    <div style="back-white">
      <img :src="item.user.url" >
      <router-link :to="{ name: 'UserDetail', params: { userId: item.user.id}}">{{item.user.name}}</router-link>
      <div>{{item.title}}</div>
      <div>{{item.content}}</div>
      <Favorite
        v-if="authCheck"
        :postId="item.id"
      />
      <router-link :to="{ name: 'PostDetail', params: { postId: item.id}}">詳細を確認する</router-link>
    </div>
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
</style>

<style scoped>
.back-white{
  background:white;
}
</style>