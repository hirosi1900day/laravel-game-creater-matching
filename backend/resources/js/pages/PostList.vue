<template>
  <div class="photo-list">
    <div class="grid">
      <Post
        class="bg-white mt-2"
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
      this.currentPage = response.data.current_page
      this.lastPage = response.data.last_page
    }
  },

  created: {
    Loading() {
      this.$store.commit('loading/setLoading', {
      loading: true,
      })
    }
  },
  mounted: {
    Loading() {
      this.$store.commit('loading/setLoading', {
      loading: false,
      })
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


</style>