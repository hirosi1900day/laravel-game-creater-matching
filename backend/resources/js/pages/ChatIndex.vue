
<template>
  <div class="photo-list">
    <div class="grid">
      <ChatUser
        class="grid__item"
        v-for="user in users.user"
        :key="user.id"
        :item="user"
      />
      <h1>chatIndex確認
      </h1>
    </div>
  </div>
</template>

<script>
import ChatUser from '../components/ChatUser.vue'
import {OK} from '../util.js'

export default {
  components: {
    ChatUser,
  },
  data () {
    return {
      users: [],
    }
  },
  methods: {
    async fetchUsers () {
      const response = await axios.get('/api/chat/index')
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
