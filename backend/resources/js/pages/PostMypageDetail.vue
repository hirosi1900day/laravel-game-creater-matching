<template>
  <div class="post-marge">
    <div style="red">
      <form class="form" @submit.prevent="submit">
        <input class="form__item" type="textarea" v-model="post.title">
        <input class="form__item" type="textarea" v-model="post.content">
        <!-- <div>{{post.post.title}}</div>
        <div>{{post.post.content}}</div> -->
        <div class="form__button">
          <button>内容を更新する</button>
        </div>
      </form>
      <button  @click="deletePost">投稿を削除する</button>
    </div>
    
  </div>
</template>

<script>
import { OK,UNPROCESSABLE_ENTITY } from '../util'

export default {
   data () {
    return { 
      post: []
    }
  },
  props: ["postId"],
  methods: {
    async fetchPost () {
      const response = await axios.get(`/api/posts/${this.postId}/mypost`)
      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }
      this.post = response.data
      console.log(this.post)
    },
    async submit () {
      const response = await axios.put(`/api/posts/${this.postId}/myupdate`, this.post)
      if (response.status === UNPROCESSABLE_ENTITY) {
        this.$store.commit('error/setErrorMessages', response.data.errors)
      } else {
        this.$store.commit('error/setCode', response.status)
      }
      this.reset()
      this.$router.push({name: 'PostMypage'})
    },
    async deletePost() {
      const response = await axios.delete(`/api/posts/${this.postId}/delete`);if (response.status === OK) {
        this.$store.commit('error/setErrorMessages', response.data.errors)
      } 
      this.$router.push({name: 'PostMypage'})
    },
    reset() {
      this.post.title = ''
      this.post.content = ''
    }
  },
  created: function () {
    this.fetchPost()
  }  
}
</script>