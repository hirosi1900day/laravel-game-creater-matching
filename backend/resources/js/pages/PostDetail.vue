<template>
<section class="text-gray-600 body-font overflow-hidden">
  
  <div class="container px-5 py-24 mx-auto">
    <router-link class="ml-2 text-gray-600 leading-tight text-lg  lg:text-xl xl:text:2xl font-bold p-auto" :to="{ name: 'UserDetail', params: { userId: post.user.id}}">{{post.user.name}}
      <img :src="post.post.user.url" class="rounded-full border-2 h-10 w-10 border-indigo-500 m-2">
    </router-link>
    <div class="lg:w-4/5 mx-auto flex flex-wrap">
      <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="https://dummyimage.com/400x400">
      <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
        <h2 class="text-sm title-font text-gray-500 tracking-widest">タイトル</h2>
        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">ここにタイトルが入ります</h1>
        <div class="flex mb-4">
        </div>
        <div class="border-b-2 leading-snug">▽こんなことしたいです</div>
        <div class="text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg">{{post.post.content}}</div>
        <div class="border-b-2 leading-snug">▽こんな人を求めています</div>
        <div class="text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg">{{post.post.resources_required}}</div>
        <div class="border-b-2 leading-snug">▽応募資格</div>
        <div class="text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg">{{post.post.qualification}}</div>
        <div class="border-b-2 leading-snug">▽募集エリア</div>
        <div class="text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg">{{post.post.area}}</div>
        <div class="flex">
          <router-link :to="{ name: 'ChatRoom', params: { partnerUserId: post.user.id}}" ><button class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">メッセージを送る</button></router-link>
           <Favorite
           :postId="post.post.id"
           class="m-2"
           />
        </div>
      </div>
    </div>
  </div>
</section>

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
      console.log('post確認')
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
  width: 40px;
  height: 40px;
  border:3px solid ;
  border-radius: 50%;
  object-fit:cover;
}
</style>