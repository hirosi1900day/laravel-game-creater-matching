<template>
  <div class="photo-list">
    <div class="grid">
      <MypagePost
        class="grid__item"
        v-for="post in posts"
        :key="post.id"
        :item="post"
      />
      <h1>投稿myapge</h1>
    </div>
  </div>
</template>

<script>
import MypagePost from '../components/MypagePost.vue'
import {OK} from '../util.js'

export default {
  components: {
    MypagePost,
  },
  data () {
    return {
      posts: [],
    }
  },
  methods: {
    async fetchPosts () {
      const response = await axios.get('/api/posts/mypage')
      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }
      this.posts = response.data
      console.log(response.data)
    }
  },
  created: function() {
     this.fetchPosts()
  }
}
</script>

<style scoped>

</style>