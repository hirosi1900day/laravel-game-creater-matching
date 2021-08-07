<template>
  <div class="photo-list">
    <div class="grid">
      <Post
        class="grid__item"
        v-for="post in posts"
        :key="post.id"
        :item="post"
      />
      <Pagination :current-page="currentPage" :last-page="lastPage" />
    </div>
  </div>
</template>

<script>
import Post from '../components/Post.vue'
import {OK} from '../util.js'
import Pagination from '../components/Pagination.vue'

export default {
  components: {
    Post,
    Pagination,
  },
  data () {
    return {
      posts: [],
      currentPage: 0,
      lastPage: 0,
    }
  },
  props: {
    page: {
      type: Number,
      required: false,
      default: 1
    }
  },
  methods: {
    async fetchPosts () {
      const response = await axios.get(`/api/posts?page=${this.page}`)
      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }
      this.posts = response.data.data
      console.log('確認') 
      console.log(this.posts)
      this.currentPage = response.data.current_page
      this.lastPage = response.data.last_page
    }
  },
  watch: {
    $route: {
      async handler () {
        await this.fetchPosts()
      },
      immediate: true
    }
  }
}
</script>

<style scoped>
.grid{
    display: grid;
    text-align: center;
    padding:0;
    width: 100%;
    grid-template-columns: repeat(2, 48%);
 }


</style>