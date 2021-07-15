<template>
  <div>
    <div class="post-marge back-white">
      <div>{{post.post.title}}</div>
      <div>{{post.post.content}}</div>
      <div>{{post.post.resources_required}}</div>
      <div>{{post.post.qualification}}</div>
      <div>{{post.post.area}}</div>
    </div>
    <div>
      <router-link :to="{ name: 'ChatRoom', params: { partnerUserId: post.user.id}}">チャットでメッセージを送る</router-link>
    </div>
    <div class="post-marge back-white">
       <router-link :to="{ name: 'UserDetail', params: { userId: post.user.id}}">{{post.user.name}}</router-link>
      <img :src="post.post.user.url" class="image-size">
      <Favorite
      :postId="post.post.id"
      />
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