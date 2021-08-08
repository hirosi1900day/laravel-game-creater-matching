<template>
   <div>
       <button v-if="status == false" @click.prevent="favorite" >
          <svg class="favoriteFalse w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" ><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
       </button>
       <button v-else @click.prevent="unfavorite">
          <svg class="favoriteTrue w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>

       </button>
    </div>
</template>

<script>
import {OK} from '../util.js'

export default {
   data() {
     return {
       status: false,
     }
   },
   props: ['postId'],  
   methods: {
      async favorite_check() {
         console.log("favoriteチェック確認")
         const response = await axios.get(`/api/favorites/${this.postId}/check`)
         if (response.status !== OK) {
           this.$store.commit('error/setCode', response.status)
           return false
         }
          this.status = response.data.result
          console.log(this.status)
      },
      async favorite() {
         const formData = new FormData()
         formData.append('postId', this.postId)
         const response = await axios.post(`/api/favorites/favorite`,formData)
         if (response.status !== OK) {
            this.$store.commit('error/setCode', response.status)
            return false
         }
         this.favorite_check()
      },
      async unfavorite() {
         const formData = new FormData()
         formData.append('postId', this.postId)
         const response = await axios.post(`/api/favorites/unfavorite`,formData)
         if (response.status !== OK) {
            this.$store.commit('error/setCode', response.status)
            return false
         }
         this.favorite_check()
      }
   },
   created: function() {
      this.favorite_check()
   }
}
</script>
<style scoped>
.favoriteFalse{
    fill: #FAE2E2;
}
.favoriteTrue{
  fill: #FA9797;
  animation: like 0.3 ease-in-out;
  animation: circle 0.3 ease-in-out;
}

@keyframes like {
  0% {
    transform: scale(1,1);
  }
  50% {
    transform: scale(.5,.5);
  }
  100% {
    transform: scale(1,1);
  }
}

 @keyframes circle {
  0% {
    transform: scale(.2,.2);
  }
  50% {
    transform: scale(.5,.5);
  }
  80% {
    transform: scale(1,1);
    opacity: .8;
  }
  100% {
    transform: scale(1.3,1.3);
    opacity: 0;
  }
}

</style>