<template>
  <div class="post-marge">
    <div style="red">
      <router-link :to="{ name: 'UserDetail', params: { userId: post.user.id}}">{{post.user.name}}</router-link>
      <div>{{post.post.title}}</div>
      <div>{{post.post.content}}</div>
      <Favorite
        :postId="post.post.id"
      />
      <router-link :to="{ name: 'ChatRoom', params: { partnerUserId: post.user.id}}">チャットでメッセージを送る</router-link>
    </div>
  </div>
</template>

<script>
import { OK } from '../util'
import Favorite from  '../components/Favorite.vue'

export default {
  components: {
    Favorite
  },
   data () {
    return { 
      post: []
    }
  },
  props: ["postId"],
  methods: {
    async fetchUser () {
      const response = await axios.get(`/api/posts/${this.postId}/detail`)
      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }
      this.post = response.data
      console.log(this.post.post.id)
    }
  },
  created: function () {
    this.fetchUser()
  }  
}
</script>