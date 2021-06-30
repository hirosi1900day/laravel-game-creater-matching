<template>
  <div>
    <div>ユーザー詳細ページ{{userId}}</div>
    <div>{{this.user.name}}</div>
    
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
    }
  },
  created: function () {
    this.fetchUser()
  }  
}
</script>