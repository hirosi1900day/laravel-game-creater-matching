<template>
  
  <div class="shadow-x rounded-lg bg-white p-1 m-2 shadow">
    <div class="flex border-b-2">
      <img :src="item.user.url" class="image-size rounded-ful flex-initial border-0 border-green-300">
      <router-link :to="{ name: 'UserDetail', params: { userId: item.user.id}}" class=" text-green-600 leading-tight text-base  lg:text-lg xl:text:xl flex-initial py-1 m-2">{{item.user.name}}</router-link>
    </div>
    <router-link class="m-2 p-2" :to="{ name: 'PostDetail', params: { postId: item.id}}">
      <div v-if="item.title.length<10" class="text-grey-600 leading-normal text-base  lg:text-lg xl:text:xl font-bold my-2 whitespace-pre">{{item.title}}</div>
      <div v-else class="text-grey-600 leading-normal text-base  lg:text-lg xl:text:xl font-bold my-2 whitespace-pre">{{item.title.substring(0,9)+".."}}</div>

      <div v-if="item.content.length<20" class="text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg whitespace-pre">{{item.content}}</div> 
      <div v-else class="text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg whitespace-pre">{{item.content.substring(0,19)+".."}}</div> 

    </router-link> 
    <Favorite
        class="m-2 p2"
        v-if="authCheck"
        :postId="item.id"
      />
    
  </div>
</template>

<script>
import Favorite from  './Favorite.vue'
import {mapGetters} from "vuex"

export default {
  components: {
    Favorite
  },
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  computed: 
    mapGetters({
      authCheck: "auth/check"
    }),
}
</script>

<style scoped>
.post-marge {
  margin: 20px;
}
.image-size{
  width: 6vw;
  height: 6vw;
  border-radius: 50%;
  object-fit:cover;
}
@media (min-width: 450px) {
 image-size{
  width: 10vw;
  height: 10vw;
  border:3px solid ;
  border-radius: 50%;
  object-fit:cover;
  border:4px solid #13b1c0;
 }
}
.border-cercle{
  border-radius: 50%;
}
</style>

