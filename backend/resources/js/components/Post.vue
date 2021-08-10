<template>

  <section class="text-gray-600 body-font overflow-hidden">
   <div class="container px-5 py-24 mx-auto">
     <div class=" -m-12">
       <div class="p-12  items-start">
         <span class="inline-block py-1 px-2 rounded bg-indigo-50 text-indigo-500 text-xs font-medium tracking-widest">CATEGORY</span>
         <!-- title -->
         <h2 class="sm:text-3xl text-2xl title-font font-medium text-gray-900 mt-4 mb-4">
          <div v-if="item.title.length<30">{{item.title}}</div>
          <div v-else >{{item.title.substring(0,29)+".."}}</div>
         </h2>
         <!-- content -->
         <p class="leading-relaxed mb-8">
           <div v-if="item.content.length<100">{{item.content}}</div> 
           <div v-else>{{item.content.substring(0,98)+".."}}</div> 
         </p>
         <div class="flex items-center flex-wrap pb-4 mb-4 border-b-2 border-gray-100 mt-auto w-full">
           <router-link class="text-indigo-500 inline-flex items-center" :to="{ name: 'PostDetail', params: { postId: item.id}}">詳しくみる
             <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
               <path d="M5 12h14"></path>
               <path d="M12 5l7 7-7 7"></path>
             </svg>
           </router-link>
           <span class="text-gray-400 mr-3 inline-flex items-center ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
             <Favorite
             v-if="authCheck"
             :postId="item.id"
             />
           </span>
           <span class="text-gray-400 inline-flex items-center leading-none text-sm">
             <router-link class="m-2 p-2" :to="{ name: 'ChatRoom', params: { partnerUserId: item.user.id}}">
             <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
               <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
             </svg>
             </router-link>
           </span>
         </div>
         <a class="inline-flex items-center">
           <img alt="blog" :src="item.user.url" class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
           <span class="flex-grow flex flex-col pl-4">
             <span class="title-font font-medium text-gray-900">{{item.user.name}}</span>
             <span class="text-gray-400 text-xs tracking-widest mt-0.5">職業カテゴリー</span>
           </span>
         </a>
         </div>
       </div>
    </div>
 </section>

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

