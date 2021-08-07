<template>
<div>
  <h1>{{user.name}}さんの詳細ページ
  </h1>
  <div class="post-marge back-white" >
    <img :src="this.user.url" class="image-size border-circle">
    <div class=" text-gray-600 leading-tight text-lg  lg:text-xl xl:text:2xl font-bold">{{this.user.name}}</div>
    <div class="shadow-x rounded-xl bg-white p-2 m-2">
      <div class="border-b-2">▽こんな人です</div>
      <div class="text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg whitespace-pre">{{user.self_introduce}}</div>
    </div>
  </div>
  <router-link class="bg-green-300 rounded-xl p-2 m-2" :to="{ name: 'ChatRoom', params: { partnerUserId: userId}}">メッセージを送る</router-link>
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
.back-white{
  background: white;
}
</style>