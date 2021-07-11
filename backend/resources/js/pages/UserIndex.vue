<template>
  <div class="photo-list">
    <div class="grid">
      <User
        class="grid__item"
        v-for="user in users"
        :key="user.id"
        :item="user"
      />
      <h1>UserIndex確認
      </h1>
    </div>
  </div>
</template>

<script>
import User from '../components/User.vue'
import {OK} from '../util.js'

export default {
  components: {
    User,
  },
  data () {
    return {
      users: [],
    }
  },
  methods: {
    async fetchUsers () {
      const response = await axios.get('/api/user/index')
      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }
      this.users = response.data
      
    }
  },
  created: function() {
    this.fetchUsers() 
  }
}
</script>
