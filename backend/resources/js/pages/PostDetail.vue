<template>
  <div>
    <div class="shadow-x rounded-xl bg-white p-5 m-2">
      <div class=" text-gray-600 leading-tight text-lg  lg:text-xl xl:text:2xl font-bold">{{post.post.title}}</div>
      <div class="border-b-2">▽こんなことしたいです</div>
      <div class="text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg">{{post.post.content}}</div>
      <div class="border-b-2">▽こんな人を求めています</div>
      <div class="text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg">{{post.post.resources_required}}</div>
      <div class="border-b-2">▽応募資格</div>
      <div class="text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg">{{post.post.qualification}}</div>
       <div class="border-b-2">▽募集エリア</div>
      <div class="text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg">{{post.post.area}}</div>
    </div>
    <div class="p-2 m-2">
      <router-link :to="{ name: 'ChatRoom', params: { partnerUserId: post.user.id}}" class="bg-green-300 p-2 rounded-xl">チャットでメッセージを送る</router-link>
    </div>
    <div class="shadow-x rounded-xl bg-white p-5 m-2">
       <router-link class="text-gray-600 leading-tight text-lg  lg:text-xl xl:text:2xl font-bold m-2" :to="{ name: 'UserDetail', params: { userId: post.user.id}}">{{post.user.name}}</router-link>
      <img :src="post.post.user.url" class="image-size border-2 border-green-300 m-2">
      <Favorite
      :postId="post.post.id"
      class="m-2"
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
.image-size{
  width: 13vw;
  height: 13vw;
  border:3px solid ;
  border-radius: 50%;
  object-fit:cover;
}
</style>