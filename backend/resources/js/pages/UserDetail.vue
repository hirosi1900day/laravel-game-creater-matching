<template>
<div>
  <h1>{{user.name}}さんの詳細ページ
  </h1>
  <div class="post-marge back-white p-4 rounded-lg " >
    <img :src="this.user.url" class="rounded-full border-2 h-10 w-10 border-indigo-500 m-2">
    <div class="m-2 text-gray-600 leading-tight text-lg  lg:text-xl xl:text:2xl font-bold">{{this.user.name}}</div>
    <div class="shadow-x rounded-xl bg-white p-2 m-2">
      <div class="border-b-2 m-2">▽こんな人です</div>
      <div class="m-2 text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg whitespace-pre">{{user.self_introduce}}</div>
    </div>
  </div>
  <router-link class="m-3 flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded w-1/3" :to="{ name: 'ChatRoom', params: { partnerUserId: userId}}">メッセージを送る</router-link>
</div> 
</template>

<script>
import { OK } from '../util'

export default {
   data () {
    return { 
      user: []
    }
  },
  props: ["userId"],
  methods: {
    async fetchUser () {
      const response = await axios.get(`/api/users/${this.userId}`)
      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }
      this.user = response.data
      console.log(this.user)
    }
  },
  created: function () {
    this.fetchUser()
  }  
}
</script>

<style scoped>
.back-white{
  background: white;
}
</style>