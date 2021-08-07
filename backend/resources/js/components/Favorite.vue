<template>
   <div>
       <button v-if="status == false" @click.prevent="favorite" class="bg-green-300 p-2 rounded-xl">
          <div>気になる</div>
       </button>
       <button v-else @click.prevent="unfavorite" class="bg-pink-400 p-2 rounded-xl">
          <div>気になるを解除</div>
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